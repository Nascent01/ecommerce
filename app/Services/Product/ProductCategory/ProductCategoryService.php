<?php

namespace App\Services\Product\ProductCategory;

use App\Models\Product\ProductCategory;

class ProductCategoryService
{
    /**
     * Create a new product category.
     */
    public function create(array $data): ProductCategory
    {
        return ProductCategory::create($data);
    }

    /**
     * Update an existing product category.
     */
    public function update(ProductCategory $productCategory, array $data): ProductCategory
    {
        $productCategory->update($data);
        return $productCategory;
    }
}
