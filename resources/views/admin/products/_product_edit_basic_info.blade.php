<div class="tab-pane fade show active" id="main-characteristics-tab" role="tabpanel"
    aria-labelledby="main-characteristics-tab">
    <div class="row">
        <div class="col-md-6">
            <x-form.input name="name" label="Name" type="text" :value="$product->name ?? ''" />
        </div>
        <div class="col-md-6">
            <x-form.input name="slug" label="Slug" type="text" :value="$product->slug ?? ''" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-form.input name="sku" label="Sku" type="text" :value="$product->sku ?? ''" />
        </div>
        <div class="col-md-6">
            <x-form.input name="price" label="Price" type="text" :value="$product->price ?? ''" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="product_category_ids" class="form-control-label">Categories</label>
                <select multiple class="form-control" name="product_category_ids[]" id="product_category_ids">
                    @foreach ($categories ?? [] as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, $selectedCategoryIds ?? []) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_category_ids')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-check form-switch">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" id="isActive" name="is_active" value="1"
                    {{ $product->is_active ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="isActive">Is active?</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group d-flex align-items-start gap-1">
            <div class="col-md-4">
                @if (isset($product) && !empty($product->image))
                    <div id="existingImage" class="mt-3">
                        <div class="card" style="width: 500px; height: 400px; overflow: hidden;">
                            <img src="{{ $product->getImage() }}" class="card-img-top imagePreview"
                                alt="Current Product Image"
                                style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                        </div>
                    </div>
                @else
                    <div class="mt-3">
                        <div class="card" style="width: 500px; height: 400px; overflow: hidden;">
                            <img src="{{ asset('themes/custom/images/placeholder-image.jpg') }}" alt="No Image"
                                class="card-img-top imagePreview"
                                style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <label for="image" class="form-control-label">Product Image</label>
                <input type="file" onchange="previewImage(this)" class="form-control" name="image" id="image"
                    accept="image/*">
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
