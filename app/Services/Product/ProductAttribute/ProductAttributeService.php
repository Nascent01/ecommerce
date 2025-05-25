<?php

namespace App\Services\Product\ProductAttribute;

use App\Models\Product\ProductAttribute;

class ProductAttributeService
{
    public function create($data): ProductAttribute
    {
        return ProductAttribute::create($data);
    }

    public function update(ProductAttribute $productAttribute, $data): ProductAttribute
    {
        $productAttribute->update($data);
        return $productAttribute;
    }
}
