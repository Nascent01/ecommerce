<?php

namespace Database\Seeders\Product;

use App\Constants\Product\ProductCategoryConstant;
use App\Services\Product\ProductCategoryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ProductCategoryService $productCategoryService): void
    {
        $productCategoryService->create([
            'parent_id' => null,
            'name' => ProductCategoryConstant::TYPE_PHONE_CATEGORY,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
