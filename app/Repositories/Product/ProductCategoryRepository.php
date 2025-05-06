<?php

namespace App\Repositories\Product;

use App\Models\Product\ProductCategory;

class ProductCategoryRepository
{
    public function getByName($name)
    {
        return ProductCategory::firstWhere('name', $name);
    }
}
