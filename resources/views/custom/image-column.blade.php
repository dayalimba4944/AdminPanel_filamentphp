<!-- resources/views/filament/forms/components/custom-field.blade.php -->

<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="text" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" {!! $attributes->merge(['class' => 'form-input']) !!}>
    @error($name) <span class="error">{{ $message }}</span> @enderror
</div>
