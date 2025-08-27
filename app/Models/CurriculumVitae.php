<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'phone',
        'address',
        'job_title',
        'summary',
        'highest_degree',
        'university',
        'graduation_year',
        'years_of_experience',
        'skills',
        'work_experience',
        'linkedin_url',
        'github_url',
        'portfolio_url',
    ];

    protected $casts = [
        'skills' => 'array',
        'work_experience' => 'array',
    ];
}
