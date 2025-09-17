@props([
    'label' => null,
    'name',
    'placeholder' => null,
    'type' => 'text',
    'checked' => false,
    'inputClass' => '',
    'inputLabelClass' => '',
    'labelClass' => ''
])

@if($label)
    <label for="{{ $name }}" class="{{ $inputLabelClass }}">
        <p class="{{ $labelClass }}">
            {{ $label }}
        </p>
@endif
<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    class="{{ $inputClass }}"
    @if($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
    @if(($type === 'checkbox' || $type === 'radio') && $checked)
        checked
    @endif
 />
@if($label)
    </label>
@endif
