<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class Carrer extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'role_type',
        'location',
        'min_salary',
        'max_salary',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'career_id');
    }

    public function savedCareers()
    {
        return $this->hasMany(SaveCareer::class, 'career_id');
    }
}
