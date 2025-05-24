<?php

namespace App\Services\Product\ProductCategory;

use App\Models\Product\ProductCategory;

class ProductCategoryHandler
{
    public function __construct(
        private ProductCategoryService $productCategoryService
    ) {}

   public function handleStore($data): ProductCategory
   {
       return $this->productCategoryService->create($data);
   } 

   public function handleUpdate($data, ProductCategory $productCategory): ProductCategory
   {
       return $this->productCategoryService->update($productCategory, $data);
   }
}