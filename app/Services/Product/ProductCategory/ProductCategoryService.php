<?php

namespace App\Services\Product\ProductCategory;

use App\Models\Product\ProductCategory;

class ProductCategoryService
{
    public function create($data): ProductCategory
    {
        return ProductCategory::create($data);
    }

    public function update(ProductCategory $productCategory, $data): ProductCategory
    {
        $productCategory->update($data);
        return $productCategory;
    }
}
