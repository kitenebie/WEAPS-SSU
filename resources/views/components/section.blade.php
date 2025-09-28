@props(['title' => null, 'description' => null])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-gray-200 bg-white shadow-sm p-6']) }}>
    @if ($title || $description)
        <div class="mb-4">
            @if ($title)
                <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            @endif
            @if ($description)
                <p class="mt-1 text-sm text-gray-600">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="space-y-4">
        {{ $slot }}
    </div>
</div>
