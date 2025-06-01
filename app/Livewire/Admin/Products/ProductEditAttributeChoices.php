<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product\ProductAttributeChoice;
use App\Repositories\Product\ProductAttributeChoiceRepository;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ProductEditAttributeChoices extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $product;
    public $search = '';
    public $suggestions = [];
    public $showSuggestions = false;
    public $selectedChoice = null;
    public $attachedChoices = [];
    public $nameFilter;

    public function mount($product = null)
    {
        if ($product) {
            $this->product = $product;
            $this->loadAttachedChoices();
        }
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $excludeIds = collect($this->attachedChoices)->pluck('id')->toArray();

            $this->suggestions = (new ProductAttributeChoiceRepository())->getSearchResults($this->search, $excludeIds);

            $this->showSuggestions = true;
        } else {
            $this->suggestions = [];
            $this->showSuggestions = false;
        }
    }

    public function selectChoice($choiceId)
    {
        $choice = ProductAttributeChoice::with('productAttribute')->find($choiceId);
        if ($choice) {
            $this->selectedChoice = $choice;
            $this->search = $choice->productAttribute->name . ' - ' . $choice->name;
            $this->showSuggestions = false;
        }
    }

    public function attachChoice()
    {
        if ($this->selectedChoice && $this->product) {
            if (!collect($this->attachedChoices)->contains('id', $this->selectedChoice->id)) {
                $this->product->productAttributeChoices()->attach($this->selectedChoice->id);

                $this->loadAttachedChoices();

                $this->resetSelection();

                session()->flash('livewire-success', 'Attribute choice attached successfully!');
            } else {
                session()->flash('livewire-error', 'This attribute choice is already attached!');
            }
        }
        $this->dispatch('alertHide');
    }

    public function detachChoice($choiceId)
    {
        if ($this->product) {
            $this->product->productAttributeChoices()->detach($choiceId);
            $this->loadAttachedChoices();
            session()->flash('livewire-success', 'Attribute choice detached successfully!');
            $this->dispatch('alertHide');
        }
    }

    public function resetSelection()
    {
        $this->search = '';
        $this->selectedChoice = null;
        $this->suggestions = [];
        $this->showSuggestions = false;
    }

    public function hideSuggestions()
    {
        $this->dispatch('hide-suggestions');
    }

    private function loadAttachedChoices()
    {
        if ($this->product) {
            $this->attachedChoices = $this->product->productAttributeChoices()
                ->with('productAttribute')
                ->get()
                ->toArray();
        }
    }

    private function paginateAttributeChoices()
    {
        if (!$this->product) {
            return collect();
        }

        $attributeChoicesQb = $this->product->productAttributeChoices()
            ->with('productAttribute');

        if (!empty($this->nameFilter)) {
            $attributeChoicesQb->where(function ($query) {
                $query->where('name', 'like', '%' . $this->nameFilter . '%')
                    ->orWhereHas('productAttribute', function ($subQuery) {
                        $subQuery->where('name', 'like', '%' . $this->nameFilter . '%');
                    });
            });
        }

        return $attributeChoicesQb->paginate(5);
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit-attribute-choices', [
            'attributeChoices' => $this->paginateAttributeChoices(),
        ]);
    }
}
