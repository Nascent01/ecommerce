<?php

use App\Models\Product\AttributeChoice;
use App\Models\Product\Product;
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
        Schema::create('attribute_choice_product', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->cascadeOnDelete();
            $table->foreignIdFor(AttributeChoice::class)->cascadeOnDelete();

            $table->primary(['product_id', 'attribute_choice_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_choice_product');
    }
};
