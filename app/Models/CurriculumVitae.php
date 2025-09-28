<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    use HasFactory;
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
        'education',
        'certifications',
        'awards',
        'affiliations',
        'publications',
        'volunteer_work',
        'references',
        'linkedin_url',
        'github_url',
        'portfolio_url',
        'facebook_url',
        'profile_picture',
        'languages',
        'projects',
    ];

    protected $casts = [
        'skills' => 'array',
        'work_experience' => 'array',
        'education' => 'array',
        'certifications' => 'array',
        'awards' => 'array',
        'affiliations' => 'array',
        'publications' => 'array',
        'volunteer_work' => 'array',
        'references' => 'array',
        'languages' => 'array',
        'projects' => 'array',
    ];

    public function getFullnameAttribute(){
        return $this->last_name . ", " . $this->first_name . " " . $this->middle_name;
    }
}
