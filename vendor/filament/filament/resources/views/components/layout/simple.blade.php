@php
    use Filament\Support\Enums\Width;

    $livewire ??= null;

    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= filament()->getSimplePageMaxContentWidth() ?? Width::Large;

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])

    <div class="fi-simple-layout">
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

        @if (($hasTopbar ?? true) && filament()->auth()->check())
            <div class="fi-simple-layout-header">
                @if (filament()->hasDatabaseNotifications())
                    @livewire(Filament\Livewire\DatabaseNotifications::class, [
                        'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                    ])
                @endif

                @if (filament()->hasUserMenu())
                    @livewire(Filament\Livewire\SimpleUserMenu::class)
                @endif
            </div>
        @endif

        <div class="fi-simple-main-ctn">
            <main @class([
                'fi-simple-main',
                $maxContentWidth instanceof Width
                    ? "fi-width-{$maxContentWidth->value}"
                    : $maxContentWidth,
            ])>
                {{ $slot }}
            </main>
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
    </div>
    <style>
        .fi-simple-layout {
            /* background-color: #7F1D1D !important; */
        }

        .fi-ac-btn-action {
            background-color: #7F1D1D !important;
            color: #ffffff !important;
        }

        .fi-link {
            color: #7F1D1D !important;
        }

        .fi-simple-main-ctn {
            flex-grow: 1;
            justify-content: center;
            align-items: center;
            width: 100%;
            display: flex;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(109, 1, 1, 0.83) 0%, rgba(128, 0, 0, 0.7) 30%, rgba(100, 1, 1, 0.8) 70%, rgba(92, 1, 1, 0.842) 100%), url(/bg.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1), 0 4px 16px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.4), inset 0 -1px 0 rgba(255, 255, 255, 0.2);
        }
    </style>
</x-filament-panels::layout.base>
