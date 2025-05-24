<?php

namespace App\Livewire\Admin\Products\ProductAttributes;

use App\Models\Product\ProductAttribute;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;

class ProductAttributeList extends Component
{
    use Sortable, WithPagination;

    public $name, $isActive;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function clearFilters()
    {
        $this->reset();
    }

    public function toggleActive(ProductAttribute $productAttribute)
    {
        $productAttribute->is_active = !$productAttribute->is_active;
        $productAttribute->save();
    }

    public function render()
    {
        $productAttributesQb = ProductAttribute::filter($this->name, $this->isActive);

        return view('livewire.admin.products.product-attributes.product-attribute-list', [
            'attributes' => $productAttributesQb->orderBy($this->sortField, $this->sortDirection)->paginate(20),
        ]);
    }
}
