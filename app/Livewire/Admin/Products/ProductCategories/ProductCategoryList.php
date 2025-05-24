<?php

namespace App\Livewire\Admin\Products\ProductCategories;

use App\Models\Product\ProductCategory;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategoryList extends Component
{
    use Sortable, WithPagination;

    public $name, $isActive;
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
        $productCategoriesQb = ProductCategory::filter($this->name, $this->isActive);

        return view('livewire.admin.products.product-categories.product-category-list', [
            'productCategories' => $productCategoriesQb->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }
}
