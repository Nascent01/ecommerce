<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAttribute\StoreAttributeRequest;
use App\Models\Product\ProductAttribute;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductAttributeController extends Controller
{
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
    public function store(StoreAttributeRequest $request): RedirectResponse
    {
        dd($request->all());
        $attribute = ProductAttribute::create($request->validated());

        return redirect()->route('admin.product-attributes.edit', $attribute->id)
            ->with('success', 'Attribute created successfully!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
