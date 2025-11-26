<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class Company extends Model
{
    use HasFactory, Loggable;

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
         'user_id',
         'isAdminVerified',
     ];

    protected $casts = [
          'specialties' => 'array',
          'Document_Permit' => 'array',
          'isActive' => 'boolean',
          'isAdminVerified' => 'boolean',
          'founded_year' => 'integer',
          'employee_count' => 'integer',
      ];

    public function getSpecialtiesAttribute($value)
    {
        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return array_filter($decoded, function($item) {
                return is_string($item) && !empty($item);
            });
        }
        return [];
    }

    public function setSpecialtiesAttribute($value)
    {
        if (is_array($value)) {
            $value = array_filter($value, function($item) {
                return is_string($item) && !empty($item);
            });
        } else {
            $value = [];
        }
        $this->attributes['specialties'] = json_encode($value);
    }

    public function getDocumentPermitAttribute($value)
    {
        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return array_filter($decoded, function($item) {
                return is_string($item) || is_array($item);
            });
        }
        return [];
    }

    public function setDocumentPermitAttribute($value)
    {
        if (is_array($value)) {
            $value = array_filter($value, function($item) {
                return is_string($item) || is_array($item);
            });
        } else {
            $value = [];
        }
        $this->attributes['Document_Permit'] = json_encode($value);
    }

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
        return $this->hasMany(CompanyReview::class);
    }

    public function companyReviews()
    {
        return $this->hasMany(CompanyReview::class);
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

    protected static function booted(): void
    {
        static::created(function (self $company): void {
            $company->logChange('create');
        });

        static::updated(function (self $company): void {
            $changes = $company->getChanges();
            if (!empty($changes)) {
                $company->logChange('update', $changes);
            }
        });

        static::deleted(function (self $company): void {
            $company->logChange('delete');
        });
    }
}