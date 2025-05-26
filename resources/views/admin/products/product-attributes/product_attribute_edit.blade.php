@extends('admin.layout.layout')

@section('title',
    $productAttribute->id
    ? 'Edit Product Attribute - ' . $productAttribute->name
    : 'Create Product
    Attribute')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">
                                {{ $productAttribute->id ? 'Edit Product Attribute - ' . $productAttribute->name : 'Create Product Attribute' }}
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ $productAttribute->id ? route('admin.product-attributes.update', $productAttribute->id) : route('admin.product-attributes.store') }}">
                            @csrf
                            @if ($productAttribute->id)
                                @method('PUT')
                            @endif

                            <x-form.input name="name" label="Name" type="text" :value="$productAttribute->name ?? ''" />

                            <x-form.input name="slug" label="Slug" type="text" :value="$productAttribute->slug ?? ''" />

                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" id="isActive" name="is_active"
                                    value="1" {{ $productAttribute->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">Is active?</label>
                            </div>

                            <div class="row mt-4 justify-content-center">
                                <div class="col-auto">
                                    <button type="submit"
                                        class="btn btn-primary btn-sm px-4 shadow-none">{{ $productAttribute->id ? 'Update' : 'Save' }}</button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.product-attributes.index') }}"
                                        class="btn btn-light btn-sm px-4 shadow-none">Go
                                        back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if ($productAttribute->id)
            <livewire:admin.products.product-attributes.product-attribute-choice-list :product-attribute="$productAttribute" />
        @endif
    </div>
@endsection
