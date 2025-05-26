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
               <x-form.input name="price" label="Price" type="number" :value="$product->price ?? ''" />
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

       {{-- <div class="row">
           <div class="col-12">
               <div class="form-group">
                   <label for="images" class="form-control-label">Product Images</label>
                   <input class="form-control @error('images') is-invalid @enderror" type="file" name="images[]"
                       id="images" multiple accept="image/*">
                   @error('images')
                       <div class="invalid-feedback">{{ $message }}</div>
                   @enderror
                   <small class="form-text text-muted">You can select multiple images</small>
               </div>
           </div>
       </div>

       @if ($product->id && $product->images && count($product->images) > 0)
           <div class="row">
               <div class="col-12">
                   <label class="form-control-label">Current Images</label>
                   <div class="row">
                       @foreach ($product->images as $image)
                           <div class="col-md-3 mb-3">
                               <div class="card">
                                   <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top"
                                       style="height: 150px; object-fit: cover;" alt="Product Image">
                                   <div class="card-body p-2">
                                       <div class="form-check">
                                           <input class="form-check-input" type="checkbox" name="delete_images[]"
                                               value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                           <label class="form-check-label text-sm"
                                               for="delete_image_{{ $image->id }}">
                                               Delete this image
                                           </label>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   </div>
               </div>
           </div>
       @endif --}}
   </div>
