<x-filament-panels::page>
    <div>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link rel="stylesheet" href="/src/outStyle.css">
        @livewireStyles()
        @livewire('my-application')
        @livewireScripts()
    </div>
</x-filament-panels::page>
