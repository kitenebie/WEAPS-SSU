<x-filament-panels::page>
    {{ $this->table }}
    <style>
        /* Targets the close button and its SVG */
        .fi-modal-close-btn .fi-size-lg,
        .fi-size-md {
            color: #494949 !important;
            /* fill: #494949 !important; */
        }
        .fi-ac-btn-action{
            color: whitesmoke !important;
        }
        .fi-wi-stats-overview-stat-label-ctn .fi-size-md{
            color: whitesmoke !important;
            /* fill: whitesmoke !important; */

        }
    </style>
</x-filament-panels::page>
