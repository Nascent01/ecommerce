<?php

namespace App\Services\Product;

use App\Constants\FilePath\FilePathConstant;
use App\Models\Product\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Arr;

class ProductHandler
{
    use ImageUploadTrait;

    public function __construct(
        private ProductService $productService
    ) {}

    /**
     * Handle the creation of a new product.
     */
    public function handleStore(array $data): Product
    {
        $dataToInsert = Arr::except($data, ['product_category_ids', 'image']);

        $product = $this->productService->create($dataToInsert);

        if (!empty($productCategoryIds) && count($data['product_category_ids']) > 0) {
            $product->categories()->sync($productCategoryIds);
        }

        if (isset($data['image'])) {
            $this->uploadImage($data['image'], FilePathConstant::PRODUCT_IMAGE_PATH, $product, 'image');
        }

        return $product;
    }

    /**
     * Handle the update of an existing product.
     */
    public function handleUpdate(array $data, Product $product): Product
    {
        $dataToInsert = Arr::except($data, ['product_category_ids', 'image']);

        $this->productService->update($product, $dataToInsert);

         if (!empty($productCategoryIds) && count($data['product_category_ids']) > 0) {
            $product->categories()->sync($productCategoryIds);
        }

         if (isset($data['image'])) {
            $this->uploadImage($data['image'], FilePathConstant::PRODUCT_IMAGE_PATH, $product, 'image');
        }

        return $product;
    }
}
