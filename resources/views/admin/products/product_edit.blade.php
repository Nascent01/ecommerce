@extends('admin.layout.layout')

@section('title', $product->id ? 'Edit Product - ' . $product->name : 'Create Product')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ $product->id ? 'Edit Product - ' . $product->name : 'Create Product' }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $product->id ? route('admin.products.update', $product) : route('admin.products.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($product->id)
                                @method('PUT')
                            @endif

                            @include('admin.products._product_edit_nav_tabs')

                            <div class="tab-content" id="pills-tabContent">
                                @include('admin.products._product_edit_basic_info')

                                @if ($product->id)
                                    @include('admin.products._product_edit_attribute_choices')
                                @endif
                            </div>

                            <hr class="horizontal dark">
                            <div class="row mt-4 justify-content-center">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $product->id ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-light me-2">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = document.querySelector('.imagePreview');
                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
