<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use App\Models\Company;
use Filament\Actions\Action;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ApplicantStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';

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
                ->extraAttributes(['style' => 'cursor:pointer; border:1px solid #CAD5E2'])
                ->action(Action::make('filter_pending')->action(fn() => $this->getPage()->dispatch('filterApplicants', ['status' => 'pending']))),

            Stat::make('Approved Applications', $approved)
                ->extraAttributes(['style' => 'cursor:pointer; border:1px solid #CAD5E2'])
                ->action(Action::make('filter_approved')->action(fn() => $this->getPage()->dispatch('filterApplicants', ['status' => 'approved']))),

            Stat::make('Hired Applicants', $hired)
                ->extraAttributes(['style' => 'cursor:pointer; border:1px solid #CAD5E2'])
                ->action(Action::make('filter_hired')->action(fn() => $this->getPage()->dispatch('filterApplicants', ['status' => 'hired']))),

            Stat::make('Rejected Applications', $rejected)
                ->extraAttributes(['style' => 'cursor:pointer; border:1px solid #CAD5E2'])
                ->action(Action::make('filter_rejected')->action(fn() => $this->getPage()->dispatch('filterApplicants', ['status' => 'rejected']))),
        ];
    }
}
