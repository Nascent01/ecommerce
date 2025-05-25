<?php

namespace App\Livewire\Admin\Products\ProductAttributes;

use App\Models\Product\Product;
use App\Models\Product\ProductAttributeChoice;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ProductAttributeChoiceList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $productAttribute, $productAttributeChoice,  $choiceNameFilter;

    public $productAttributeChoiceName = '';
    public $editingChoiceId = null;

    protected $rules = [
        'productAttributeChoiceName' => 'required|string|max:255',
    ];

    public function mount($productAttribute)
    {
        $this->productAttribute = $productAttribute;
    }

    public function clearFilters()
    {
        $this->resetExcept('productAttribute');
    }

    public function openProductAttributeChoiceModal($choiceId = null)
    {
        $this->resetValidation();

        if ($choiceId) {
            $choice = ProductAttributeChoice::find($choiceId);
            if ($choice) {
                $this->editingChoiceId = $choiceId;
                $this->productAttributeChoiceName = $choice->name;
            }
        } else {
            $this->editingChoiceId = null;
            $this->productAttributeChoiceName = '';
        }
    }

    public function saveProductAttributeChoice()
    {
        $this->validate();

        if ($this->editingChoiceId) {

            $choice = ProductAttributeChoice::find($this->editingChoiceId);
            $choice->name = $this->productAttributeChoiceName;
            $choice->save();

            $message = 'Product attribute choice updated successfully.';
        } else {
            ProductAttributeChoice::create([
                'name' => $this->productAttributeChoiceName,
                'product_attribute_id' => $this->productAttribute->id,
            ]);

            $message = 'Product attribute choice created successfully.';
            $this->resetForm();
        }

        session()->flash('livewire-success', $message);
        $this->dispatch('alertHide');
    }

    private function resetForm()
    {
        $this->productAttributeChoiceName = '';
        $this->editingChoiceId = null;
        $this->resetValidation();
    }

    public function deleteChoice($choiceId)
    {
        try {
            $choice = ProductAttributeChoice::findOrFail($choiceId);

            $productsUsingChoice = $choice->productsCount();

            if ($productsUsingChoice > 0) {
                session()->flash('livewire-error', 'Cannot delete choice. It is being used by ' . $productsUsingChoice . ' product(s).');
                $this->dispatch('alertHide');
                return;
            }

            $choiceName = $choice->name;
            $choice->delete();

            session()->flash('livewire-success', "Choice '{$choiceName}' has been deleted successfully.");

            $this->dispatch('alertHide');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            session()->flash('livewire-error', 'Choice not found.');
        } catch (\Exception $e) {
            session()->flash('livewire-error', 'An error occurred while deleting the choice: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $productAttributeChoices = $this->productAttribute
            ->productAttributeChoices()
            ->filter($this->choiceNameFilter)
            ->paginate(10);

        return view('livewire.admin.products.product-attributes.product-attribute-choice-list', [
            'productAttributeChoices' => $productAttributeChoices,
        ]);
    }
}
