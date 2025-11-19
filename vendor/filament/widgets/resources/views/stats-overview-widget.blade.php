@php
    $columns = $this->getColumns();
    $pollingInterval = $this->getPollingInterval();

    $heading = $this->getHeading();
    $description = $this->getDescription();
    $hasHeading = filled($heading);
    $hasDescription = filled($description);
@endphp

<x-filament-widgets::widget :attributes="new \Illuminate\View\ComponentAttributeBag()
    ->merge(
        [
            'wire:poll.' . $pollingInterval => $pollingInterval ? true : null,
        ],
        escape: false,
    )
    ->class(['fi-wi-stats-overview'])">
    {{ $this->content }}
    <style>
        #total-users-stat, #total-companies-stat  {
            background-color: #7F1D1D !important;
        }
        #verified-users-stat, #unverified-companies-stat {
            background-color: #494949 !important;
        }
        #unverified-users-stat, #unverified-alumni-stat {
            background-color: #2992E3 !important;
        }
        #verified-alumni-stat, #active-companies-stat {
            background-color: #4FA753 !important;
        }
        .fi-wi-stats-overview-stat-label,
        .fi-wi-stats-overview-stat-value,
        .fi-wi-stats-overview-stat-description,
        .fi-icon
        {
            color: white !important;
        }
    </style>
</x-filament-widgets::widget>
