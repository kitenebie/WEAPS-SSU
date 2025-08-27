<?php

namespace App\Filament\Admin\Pages;

use BackedEnum;
use Inerba\DbConfig\AbstractPageSettings;
use Filament\Schemas\Components;
use Filament\Schemas\Schema;

class WebsiteSettings extends AbstractPageSettings
{
    public ?array $data = [];

    protected static ?string $title = 'Website';

    // protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver'; // Uncomment if you want to set a custom navigation icon

    // protected ?string $subheading = ''; // Uncomment if you want to set a custom subheading

    // protected static ?string $slug = 'website-settings'; // Uncomment if you want to set a custom slug

    protected string $view = 'filament.pages.website-settings';

    protected function settingName(): string
    {
        return 'website';
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                // You can delete these statements!
                Components\Text::make(new \Illuminate\Support\HtmlString(
                    \Illuminate\Support\Facades\View::make('db-config::filament.pages.settings-help', [
                        'group' => $this->settingName(),
                        'pageClass' => class_basename(self::class),
                    ])->render()
                )),
            ])
            ->statePath('data');
    }
}
