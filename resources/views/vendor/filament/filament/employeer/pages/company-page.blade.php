<x-filament-panels::page>
    <link href="{{ asset('src/outStyle.css') }}" rel="stylesheet">

    <style>
        .star-rating {
            display: flex;
            font-size: 1.75rem;
            cursor: pointer;
            gap: 0.25rem;
            align-items: center;
        }

        .star {
            transition: all 0.2s ease;
            color: #d1d5db;
            font-size: 1.75rem;
        }

        .star:hover {
            color: #fbbf24;
            transform: scale(1.1);
        }

        .star.active {
            color: #fbbf24;
        }

        .star-rating-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rating-display {
            display: flex;
            font-size: 1.25rem;
            gap: 0.125rem;
        }

        .rating-display .star {
            color: #fbbf24;
            font-size: 1rem;
            margin-right: 0.125rem;
        }
    </style>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('src/outScript.js') }}"></script>

    <div id="company-page-root">
        @livewire('company.profile')
    </div>


</x-filament-panels::page>
