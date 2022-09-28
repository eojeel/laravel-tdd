@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-default']) }}>
    {{ $value ?? $slot }}
</label>
