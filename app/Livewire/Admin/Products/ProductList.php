<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product\Product;
use App\Traits\Sortable;
use Livewire\Component;

class ProductList extends Component
{
    use Sortable;

    public $name, $sku;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function clearFilters()
    {
        $this->reset();
    }

    public function toggleActive(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->save();
    }

    public function render()
    {
        $productsQb = Product::filter($this->name, $this->sku);

        return view('livewire.admin.products.product-list', [
            'products' => $productsQb->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }
}
