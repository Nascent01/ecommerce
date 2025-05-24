<?php

use App\Models\Product\Product;
use App\Models\Product\ProductAttributeChoice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_product_attribute_choice', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->cascadeOnDelete();
            $table->foreignIdFor(ProductAttributeChoice::class)->cascadeOnDelete();

            $table->primary(['product_id', 'product_attribute_choice_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_product_attribute_choice');
    }
};
