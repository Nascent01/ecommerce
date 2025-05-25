<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAttribute\StoreProductAttributeRequest;
use App\Http\Requests\ProductAttribute\UpdateProductAttributeRequest;
use App\Models\Product\ProductAttribute;
use App\Services\Product\ProductAttribute\ProductAttributeHandler;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductAttributeController extends Controller
{
    public function __construct(
        private ProductAttributeHandler $productAttributeHandler
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.products.product-attributes.product_attribute_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.products.product-attributes.product_attribute_edit', ['productAttribute' => new ProductAttribute()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductAttributeRequest $request): RedirectResponse
    {
        $productAttribute = $this->productAttributeHandler->handleStore($request->validated());

        return redirect()->route('admin.product-attributes.edit', $productAttribute->id)
            ->with('success', 'Product Attribute created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttribute $productAttribute): View
    {
        return view('admin.products.product-attributes.product_attribute_edit', ['productAttribute' => $productAttribute]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductAttributeRequest $request, ProductAttribute $productAttribute)
    {
        $productAttribute = $this->productAttributeHandler->handleUpdate($request->validated(), $productAttribute);

        return redirect()->route('admin.product-attributes.edit', $productAttribute->id)
            ->with('success', 'Product Attribute updated successfully!');
    }
}
