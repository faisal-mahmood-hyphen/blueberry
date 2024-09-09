@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert-success mb-4 p-3']) }}>
        {{ $status }}
    </div>
@endif
