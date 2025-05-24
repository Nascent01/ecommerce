<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\StoreProductCategoryRequest;
use App\Http\Requests\ProductCategory\UpdateProductCategoryRequest;
use App\Models\Product\ProductCategory;
use App\Services\Product\ProductCategory\ProductCategoryHandler;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductCategoryController extends Controller
{
    public function __construct(
        private ProductCategoryHandler $productCategoryHandler
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.products.product-categories.product_category_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.products.product-categories.product_category_edit', ['productCategory' => new ProductCategory()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request): RedirectResponse
    {
       $productCategory = $this->productCategoryHandler->handleStore($request->validated());

        return redirect()->route('admin.product-categories.edit', $productCategory->id)
            ->with('success', 'Product category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory): View
    {
        return view('admin.products.product-categories.product_category_edit', ['productCategory' => $productCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory): RedirectResponse
    {
        $productCategory = $this->productCategoryHandler->handleUpdate($request->validated(), $productCategory);

        return redirect()->route('admin.product-categories.edit', $productCategory->id)
            ->with('success', 'Product category updated successfully!');
    }
}
