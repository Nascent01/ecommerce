@props(['name', 'label', 'type', 'value'])

<div class="form-group mb-3">
    <label for="{{ $name }}" class="form-control-label">{{ $label }}</label>
    <input class="form-control" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        value="{{ old($name, $value) }}">
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
