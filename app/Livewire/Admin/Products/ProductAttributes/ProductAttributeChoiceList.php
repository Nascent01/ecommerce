<?php

namespace App\Livewire\Admin\Products\ProductAttributes;

use App\Models\Product\ProductAttributeChoice;
use Livewire\Component;
use Livewire\WithPagination;

class ProductAttributeChoiceList extends Component
{
    use WithPagination;

    public $productAttribute, $choiceNameFilter;
    public $productAttributeChoice;
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
            // Editing existing choice
            $choice = ProductAttributeChoice::find($choiceId);
            if ($choice) {
                $this->editingChoiceId = $choiceId;
                $this->productAttributeChoiceName = $choice->name;
            }
        } else {
            // Creating new choice
            $this->editingChoiceId = null;
            $this->productAttributeChoiceName = '';
        }

        $this->dispatch('openModal', 'editChoiceModal');
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
        }

        session()->flash('success', $message);

        $this->dispatch('closeModal', 'editChoiceModal');
        $this->resetForm();
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
        // Find the choice
        $choice = ProductAttributeChoice::findOrFail($choiceId);
        
        // Optional: Check if choice is being used by products
        // Uncomment if you want to prevent deletion of choices in use
        /*
        $productsUsingChoice = Product::whereHas('attributeChoices', function($query) use ($choiceId) {
            $query->where('product_attribute_choice_id', $choiceId);
        })->count();
        
        if ($productsUsingChoice > 0) {
            session()->flash('error', 'Cannot delete choice. It is being used by ' . $productsUsingChoice . ' product(s).');
            return;
        }
        */
        
        // Delete the choice
        $choiceName = $choice->name; // Store name for success message
        $choice->delete();
        
        // Refresh the choices list
        $this->loadProductAttributeChoices(); // Assuming you have this method
        
        // Success message
        session()->flash('success', "Choice '{$choiceName}' has been deleted successfully.");
        
        // Optional: Emit event to update other components
        $this->dispatch('choiceDeleted', $choiceId);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        session()->flash('error', 'Choice not found.');
    } catch (\Exception $e) {
        session()->flash('error', 'An error occurred while deleting the choice: ' . $e->getMessage());
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
