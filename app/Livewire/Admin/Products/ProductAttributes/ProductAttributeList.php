<?php

namespace App\Livewire\Admin\Products\ProductAttributes;

use App\Models\Product\ProductAttribute;
use App\Traits\Sortable;
use Livewire\Component;

class ProductAttributeList extends Component
{
    use Sortable;

    public $name;
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
        $productAttributesQb = ProductAttribute::filter($this->name);

        return view('livewire.admin.products.product-attributes.product-attribute-list', [
            'attributes' => $productAttributesQb->orderBy($this->sortField, $this->sortDirection)->paginate(20),
        ]);
    }
}
