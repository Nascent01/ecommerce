<div wire:ignore.self class="modal fade" id="editChoiceModal" tabindex="-1" role="dialog"
    aria-labelledby="editChoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="saveProductAttributeChoice" id="editChoiceForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editChoiceModalLabel">
                        {{ $editingChoiceId ? 'Edit Choice' : 'Add Choice' }}
                    </h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productAttributeChoiceName">Choice Name</label>
                        <input wire:model="productAttributeChoiceName" type="text" class="form-control"
                            placeholder="Enter choice name" id="productAttributeChoiceName">
                    </div>
                    @error('productAttributeChoiceName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-primary shadow-none">
                        {{ $editingChoiceId ? 'Update Choice' : 'Save Choice' }}
                    </button>
                    <button type="button" class="btn bg-gradient-secondary shadow-none"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
