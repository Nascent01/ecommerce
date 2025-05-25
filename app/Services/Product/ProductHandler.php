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
        return $this->productService->create($data);
    }

    /**
     * Handle the update of an existing product.
     */
    public function handleUpdate(array $data, Product $product): Product
    {
        return $this->productService->update($product, $data);
    }
}
