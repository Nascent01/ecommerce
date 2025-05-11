<?php

namespace App\Services\Command;

use App\Constants\Product\AttributeConstant;
use App\Models\Product\Attribute;
use App\Models\Product\AttributeChoice;
use App\Models\Product\Product;
use App\Repositories\Product\ProductCategoryRepository;
use App\Traits\CommandTrait;

class ImportProductsHandler
{
    use CommandTrait;

    public function handleAttributesInsert()
    {
        $attributesData = [];

        foreach (AttributeConstant::ATTRIBUTES_ARRAY as $attribute) {
            $attributesData[] = [
                'name' => $attribute,
                'slug' => str_slug($attribute),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $this->bulkInsert(Attribute::class, $attributesData);
    }

    public function handleProductsAndAttributeChoices($products)
    {
        $productsData = [];
        $existingProductSlugs = [];

        $attributesChoicesInsertData = [];
        $existingAttributeChoices = [];
        $productAttributeChoiceData = [];
        $attributeIdsMappedByName = Attribute::pluck('id', 'name')->toArray();

        foreach ($products as $product) {
            $productData = $this->handleProductArrayForInsert($product, $existingProductSlugs);

            if ($productData !== null) {
                $productsData[] = $productData;
            }

            $this->handleAttributeChoices($product, $attributeIdsMappedByName, $attributesChoicesInsertData, $existingAttributeChoices, $productAttributeChoiceData);
        }

        $this->bulkInsert(Product::class, $productsData);
        $this->bulkInsert(AttributeChoice::class, $attributesChoicesInsertData);

        $this->handleAttributeChoiceProductInsert($productAttributeChoiceData);
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
            'image' => 'placeholder-image.png',
            'price' => fake()->randomFloat(2, 100, 1000),
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function handleAttributeChoices($product, $attributeIdsMappedByName, &$attributesChoicesInsertData, &$existingAttributeChoices, &$productAttributeChoiceData)
    {
        foreach ($product as $attributeName => $attributeChoiceValue) {
            if (in_array($attributeName, AttributeConstant::ATTRIBUTES_ARRAY) && !empty($attributeChoiceValue)) {
                if (!isset($existingAttributeChoices[$attributeName])) {
                    $existingAttributeChoices[$attributeName] = [];
                }

                if (isset(AttributeConstant::ATTRIBUTE_SEPERATOR_MAPPING[$attributeName])) {
                    $separator = AttributeConstant::ATTRIBUTE_SEPERATOR_MAPPING[$attributeName];
                    $choice = explode($separator, $attributeChoiceValue)[0];
                } else if ($attributeName == AttributeConstant::TYPE_ATTRIBUTE_MODEL) {
                    $choice = str_replace('_', '', $attributeChoiceValue);
                } else {
                    $choice = $attributeChoiceValue;
                }

                $choice = trim($choice);
                $slug = str_slug($choice);
                if (!in_array($slug, $existingAttributeChoices[$attributeName])) {
                    $existingAttributeChoices[$attributeName][] = $slug;
                    $attributesChoicesInsertData[] = [
                        'attribute_id' => $attributeIdsMappedByName[$attributeName],
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

        $attributes = Attribute::query()->get();

        $attributeChoicesGroupedByAttributeName = $attributes->mapWithKeys(function ($attribute) {
            return [
                $attribute->name =>
                $attribute->attributeChoices->pluck('id', 'machine_name')->toArray()
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
                            'attribute_choice_id' => $choiceId,
                        ];
                    }
                }
            }
        }

        $this->bulkInsertPivot('attribute_choice_product', $productAttributeChoiceArrayForInsert);
    }
}
