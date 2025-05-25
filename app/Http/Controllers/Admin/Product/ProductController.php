<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\Product;
use App\Services\Product\ProductHandler;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private ProductHandler $productHandler
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.products.product_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.products.product_edit', ['product' => new Product()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productHandler->handleStore($request->validated());

        return redirect()->route('admin.products.edit', $product->id)
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('admin.products.product_edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = $this->productHandler->handleUpdate($request->validated(), $product);

        return redirect()->route('admin.products.edit', $product->id)
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
