<x-filament-panels::page>
    @livewireStyles()
    @livewire('hire-email')
    @livewireScripts()
    <x-filament-actions::modals />
    <iframe src="/support/{{ $record->id }}" style="height: 100vh; width: 100%; border: none;"
        title="Applicant Resume"></iframe>
    <style>
        .fi-header {
            display: none !important;
        }
        .fi-page-content{
            row-gap: 2px;
        }
    </style>
</x-filament-panels::page>
