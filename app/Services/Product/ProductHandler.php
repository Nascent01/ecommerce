<?php

namespace App\Services\Product;

use App\Models\Product\Product;

class ProductHandler
{
    public function __construct(
        private ProductService $productService
    ) {}

    /**
     * Handle the creation of a new product.
     */
    public function handleStore(array $data): Product
    {
        $productCategoryIds = $data['product_category_ids'] ?? [];
        unset($data['product_category_ids']);

        $product = $this->productService->create($data);

        if (!empty($productCategoryIds)) {
            $product->categories()->sync($productCategoryIds);
        }

        return $product;
    }

    /**
     * Handle the update of an existing product.
     */
    public function handleUpdate(array $data, Product $product): Product
    {
        $productCategoryIds = $data['product_category_ids'] ?? [];
        unset($data['product_category_ids']);

        $this->productService->update($product, $data);

        $product->categories()->sync($productCategoryIds);

        return $product;
    }
}
