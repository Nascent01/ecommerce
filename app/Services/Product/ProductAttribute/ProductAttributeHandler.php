<?php

namespace App\Services\Product\ProductAttribute;

use App\Models\Product\ProductAttribute;

class ProductAttributeHandler
{
    public function __construct(
        private ProductAttributeService $productAttributeService
    ) {}

    public function handleStore($data): ProductAttribute
    {
        return $this->productAttributeService->create($data);
    }

    public function handleUpdate($data, ProductAttribute $productAttribute): ProductAttribute
    {
        return $this->productAttributeService->update($productAttribute, $data);
    }
}
