<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'location',
        'founded_year',
        'employee_count',
        'description',
        'industry',
        'company_size',
        'specialties',
        'website',
        'phone',
        'email',
        'cover_photo',
        'logo',
        'about',
        'Document_Permit',
        'isActive',
        'user_handle',
    ];

    protected $casts = [
        'specialties' => 'array',
        'Document_Permit' => 'array',
        'isActive' => 'boolean',
        'founded_year' => 'integer',
        'employee_count' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function careers()
    {
        return $this->hasMany(Carrer::class);
    }

    public function posts()
    {
        return $this->hasMany(CompanyPost::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    // Accessors/Mutators if needed
    public function getTaglineAttribute()
    {
        // Assuming tagline is derived or stored separately
        return $this->attributes['tagline'] ?? 'Innovation • Excellence • Growth';
    }
}