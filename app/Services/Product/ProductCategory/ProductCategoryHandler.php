<?php

namespace App\Services\Product\ProductCategory;

use App\Models\Product\ProductCategory;

class ProductCategoryHandler
{
    public function __construct(
        private ProductCategoryService $productCategoryService
    ) {}

    /**
     * Handle the creation of a new product category.
     */
    public function handleStore(array $data): ProductCategory
    {
        return $this->productCategoryService->create($data);
    }

    /**
     * Handle the update of an existing product category.
     */
    public function handleUpdate(array $data, ProductCategory $productCategory): ProductCategory
    {
        return $this->productCategoryService->update($productCategory, $data);
    }
}
