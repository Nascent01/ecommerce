@extends('admin.layout.layout')

@section('title',
    $productCategory->id
    ? 'Edit Product Category - ' . $productCategory->name
    : 'Create Product
    Category')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">
                                {{ $productCategory->id ? 'Edit Product Category - ' . $productCategory->name : 'Create Product Category' }}
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $productCategory->id ? route('admin.product-categories.update', $productCategory->id) : route('admin.product-categories.store') }}">
                            @csrf
                            @if ($productCategory->id)
                                @method('PUT')
                            @endif

                            <x-form.input name="name" label="Name" type="text" :value="$productCategory->name ?? ''" />

                            <x-form.input name="slug" label="Slug" type="text" :value="$productCategory->slug ?? ''" />

                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" id="isActive" name="is_active"
                                    value="1" {{ $productCategory->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">Is active?</label>
                            </div>

                            <div class="row mt-4 justify-content-center">
                                <div class="col-auto">
                                    <button type="submit"
                                        class="btn btn-primary btn-sm px-4 shadow-none">{{ $productCategory->id ? 'Update' : 'Save' }}</button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.product-categories.index') }}"
                                        class="btn btn-light btn-sm px-4 shadow-none">Go
                                        back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
