<x-filament-panels::page>
    @livewireStyles()
    @livewire('hire-email')
    @livewireScripts()
    <iframe src="/support/{{ $record->id }}" style="height: 100vh; width: 100%; border: none;"
        title="Applicant Resume"></iframe>
    <style>
        .fi-page-content, .fi-page-header-main-ctn{
            row-gap: 2px;
        }
    </style>
</x-filament-panels::page>
