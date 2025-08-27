<?php

namespace App\Filament\Widgets;

use Illuminate\Support\HtmlString;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;

class BlogPostsChart extends ApexChartWidget
{
    use HasFiltersSchema;
    // protected function getFilters(): ?array
    // {
    //     return [
    //         'today' => 'Today',
    //         'week' => 'Last week',
    //         'month' => 'Last month',
    //         'year' => 'This year',
    //     ];
    // }
    protected static ?string $loadingIndicator = 'Loading...';

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->default('Blog Posts Chart'),

            DatePicker::make('date_start')
                ->default('2025-07-01'),

            DatePicker::make('date_end')
                ->default('2025-07-31'),
        ]);
    }

    /**
     * Use this method to update the chart options when the filter form is submitted.
     */
    public function updatedInteractsWithSchemas(string $statePath): void
    {
        $this->updateOptions();
    }
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'blogPostsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'BlogPostsChart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected static bool $isCollapsible = true;
    protected static ?int $contentHeight = 300; //px
    protected static ?string $footer = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
    protected function getFooter(): null|string|Htmlable|View
    {
        return new HtmlString('<p class="text-danger-500">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>');
    }
    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'BlogPostsChart',
                    'data' => [7, 4, 6, 10, 14, 7, 5, 9, 10, 15, 13, 18],
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#F50B46FF'],
        ];
    }
}
