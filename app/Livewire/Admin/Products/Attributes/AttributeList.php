<?php

namespace App\Livewire\Admin\Products\Attributes;

use App\Models\Product\Attribute;
use App\Traits\Sortable;
use Livewire\Component;

class AttributeList extends Component
{
    use Sortable;

    public $name;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function clearFilters()
    {
        $this->reset();
    }

    public function toggleActive(Attribute $attribute)
    {
        $attribute->is_active = !$attribute->is_active;
        $attribute->save();
    }

    public function render()
    {
        $attributesQb = Attribute::filter($this->name);

        return view('livewire.admin.products.attributes.attribute-list', [
            'attributes' => $attributesQb->orderBy($this->sortField, $this->sortDirection)->paginate(20),
        ]);
    }
}
