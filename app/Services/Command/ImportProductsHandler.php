<?php

namespace App\Services\Command;

use App\Constants\Product\ProductAttributeConstant;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeChoice;
use App\Models\Product\Product;
use App\Repositories\Product\ProductCategoryRepository;
use App\Traits\CommandTrait;

class ImportProductsHandler
{
    use CommandTrait;

    public function handleAttributesInsert()
    {
        $attributesData = [];

        foreach (ProductAttributeConstant::ATTRIBUTES_ARRAY as $index => $attribute) {
            $attributesData[] = [
                'name' => $attribute,
                'slug' => str_slug($attribute),
                'weight' => $index + 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $this->bulkInsert(ProductAttribute::class, $attributesData);
    }

    public function handleProducts($products)
    {
        $productsData = [];
        $existingProductSlugs = [];

        foreach ($products as $product) {
            $productData = $this->handleProductArrayForInsert($product, $existingProductSlugs);

            if ($productData !== null) {
                $productsData[] = $productData;
            }
        }

        $this->bulkInsert(Product::class, $productsData);
    }

    public function handleProductArrayForInsert($product, &$existingProductSlugs)
    {
        if (empty($product['Model'])) {
            return null;
        }

        $productModelWithoutSymbols = str_replace('_', '', $product['Model']);
        $productName = $product['Brand'] . ' ' . $productModelWithoutSymbols;

        $slug = str_slug($productName);
        $counter = 1;

        while (in_array($slug, $existingProductSlugs)) {
            $slug = str_slug($productName) . '-' . $counter;
            $counter++;
        }

        $existingProductSlugs[] = $slug;

        return [
            'sku' => $product['objectId'],
            'name' => $productName,
            'slug' => $slug,
            'image' => null,
            'price' => fake()->randomFloat(2, 100, 1000),
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function handleProductAttributeChoices($products)
    {
        $attributesChoicesInsertData = [];
        $existingAttributeChoices = [];
        $productAttributeChoiceData = [];
        $attributeIdsMappedByName = ProductAttribute::pluck('id', 'name')->toArray();

        foreach ($products as $product) {
            $this->handleAttributeChoices($product, $attributeIdsMappedByName, $attributesChoicesInsertData, $existingAttributeChoices, $productAttributeChoiceData);
        }

        $this->bulkInsert(ProductAttributeChoice::class, $attributesChoicesInsertData);

        $this->handleAttributeChoiceProductInsert($productAttributeChoiceData);
    }

    public function handleAttributeChoices($product, $attributeIdsMappedByName, &$attributesChoicesInsertData, &$existingAttributeChoices, &$productAttributeChoiceData)
    {
        foreach ($product as $attributeName => $attributeChoiceValue) {
            if (in_array($attributeName, ProductAttributeConstant::ATTRIBUTES_ARRAY) && !empty($attributeChoiceValue)) {
                if (!isset($existingAttributeChoices[$attributeName])) {
                    $existingAttributeChoices[$attributeName] = [];
                }

                if (isset(ProductAttributeConstant::ATTRIBUTE_SEPERATOR_MAPPING[$attributeName])) {
                    $separator = ProductAttributeConstant::ATTRIBUTE_SEPERATOR_MAPPING[$attributeName];
                    $choice = explode($separator, $attributeChoiceValue)[0];
                } else if ($attributeName == ProductAttributeConstant::TYPE_ATTRIBUTE_MODEL) {
                    $choice = str_replace('_', '', $attributeChoiceValue);
                } else {
                    $choice = $attributeChoiceValue;
                }

                $choice = trim($choice);
                $slug = str_slug($choice);
                if (!in_array($slug, $existingAttributeChoices[$attributeName])) {
                    $existingAttributeChoices[$attributeName][] = $slug;
                    $attributesChoicesInsertData[] = [
                        'product_attribute_id' => $attributeIdsMappedByName[$attributeName],
                        'name' => $choice,
                        'slug' => $slug,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                $productAttributeChoiceData[$attributeName][] =
                    [
                        'sku' => $product['objectId'],
                        'choice_value' => $slug,
                    ];
            }
        }
    }

    public function handleProductProductCategoryInsert()
    {
        $productCategory = (new ProductCategoryRepository)->getByName('Phones');

        $productProductCategoryData = Product::pluck('id')
            ->map(function ($productId) use ($productCategory) {
                return [
                    'product_id' => $productId,
                    'product_category_id' => $productCategory->id,
                ];
            })
            ->toArray();

        $this->bulkInsertPivot('product_product_category', $productProductCategoryData);
    }

    public function handleAttributeChoiceProductInsert($productAttributeChoiceData)
    {

        $productAttributeChoiceArrayForInsert = [];

        $attributes = ProductAttribute::query()->get();

        $attributeChoicesGroupedByAttributeName = $attributes->mapWithKeys(function ($attribute) {
            return [
                $attribute->name =>
                $attribute->productAttributeChoices->pluck('id', 'slug')->toArray()
            ];
        });

        $productIdsMappedBySku = Product::select('id', 'sku')
            ->pluck('id', 'sku')
            ->toArray();

        foreach ($productAttributeChoiceData as $attributeName => $productAttributeChoiceArray) {
            foreach ($productAttributeChoiceArray as $productChoice) {
                if (isset($attributeChoicesGroupedByAttributeName[$attributeName])) {
                    $productId = $productIdsMappedBySku[$productChoice['sku']];
                    $choiceId = $attributeChoicesGroupedByAttributeName[$attributeName][$productChoice['choice_value']] ?? null;

                    if ($choiceId) {
                        $productAttributeChoiceArrayForInsert[] = [
                            'product_id' => $productId,
                            'product_attribute_choice_id' => $choiceId,
                        ];
                    }
                }
            }
        }

        $this->bulkInsertPivot('product_product_attribute_choice', $productAttributeChoiceArrayForInsert);
    }
}
