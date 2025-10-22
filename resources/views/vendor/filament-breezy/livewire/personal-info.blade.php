<x-filament::section style="margin-bottom: 1rem" :aside="true" :heading="__('filament-breezy::default.profile.personal_info.heading')" :description="__('filament-breezy::default.profile.personal_info.subheading')">
    <form wire:submit.prevent="submit" class="space-y-6">

        {{ $this->form }}
        <br>

        <div class="text-right">
            <x-filament::button type="submit" form="submit" class="align-right">
                {{ __('filament-breezy::default.profile.personal_info.submit.label') }}
            </x-filament::button>
        </div>
    </form>
</x-filament::section>
