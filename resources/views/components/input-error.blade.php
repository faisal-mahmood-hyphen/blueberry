@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <span class="text-danger">{{ $message }}</span>
        @endforeach
    </div>
@endif
