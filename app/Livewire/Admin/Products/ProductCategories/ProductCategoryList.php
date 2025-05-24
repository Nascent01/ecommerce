<?php

namespace App\Livewire\Admin\Products\ProductCategories;

use App\Models\Product\ProductCategory;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategoryList extends Component
{
    use Sortable;
    use WithPagination;

    public $name;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function clearFilters()
    {
        $this->reset();
    }

    public function toggleActive(ProductCategory $productCategory)
    {
        $productCategory->is_active = !$productCategory->is_active;
        $productCategory->save();
    }

    public function render()
    {
        $productCategoriesQb = ProductCategory::filter($this->name);

        return view('livewire.admin.products.product-categories.product-category-list', [
            'productCategories' => $productCategoriesQb->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }
}
