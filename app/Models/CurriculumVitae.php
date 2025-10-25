<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class CurriculumVitae extends Model
{
    use HasFactory, Loggable;
    protected $fillable = [
          'user_id',
          'isActive',
          'first_name',
          'last_name',
          'middle_name',
          'email',
          'phone',
          'address',
          'job_title',
          'summary',
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
          'front_id',
          'back_id',
          'School_id',
          'isAiValidate',
      ];

    protected $casts = [
          'isActive' => 'boolean',
          'isAiValidate' => 'boolean',
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

    /**
     * Get the user that owns the curriculum vitae.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::created(function (self $cv): void {
            self::logChange($cv, 'create');
        });

        static::updated(function (self $cv): void {
            $changes = $cv->getChanges();
            if (!empty($changes)) {
                self::logChange($cv, 'update', $changes);
            }
        });

        static::deleted(function (self $cv): void {
            self::logChange($cv, 'delete');
        });
    }
}
