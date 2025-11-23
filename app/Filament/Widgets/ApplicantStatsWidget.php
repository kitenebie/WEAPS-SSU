<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use App\Models\Company;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Facades\Auth;


class ApplicantStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $company = Company::where('user_id', Auth::id())->first();

        $applicantsQuery = Applicant::where('company_id', $company ? $company->id : null);

        $pending = (clone $applicantsQuery)->where('status', 'pending')->count();
        $approved = (clone $applicantsQuery)->where('status', 'approved')->count();
        $hired = (clone $applicantsQuery)->where('status', 'hired')->count();
        $rejected = (clone $applicantsQuery)->where('status', 'rejected')->count();

        return [
            Stat::make('Pending Applications', $pending)
                        ->extraAttributes([
                            'id' => 'total-users-stat',
                            // 'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                        ]),
            Stat::make('Approved Application', $approved)
                        ->extraAttributes([
                            'id' => 'verified-alumni-stat',
                            // 'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                        ]),
            Stat::make('Hired Applicants', $hired)
                        ->extraAttributes([
                            'id' => 'unverified-users-stat',
                            // 'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                        ]),
            Stat::make('Rejected Application', $rejected)
                        ->extraAttributes([
                            'id' => 'verified-users-stat',
                            // 'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                        ]),
        ];
    }
}