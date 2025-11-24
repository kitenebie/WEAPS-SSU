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
        'created_at',
        'updated_at',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function getTagsAttribute($value)
    {
        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return array_filter($decoded, function($item) {
                return is_string($item) && !empty($item);
            });
        }
        return [];
    }

    public function setTagsAttribute($value)
    {
        if (is_array($value)) {
            $value = array_filter($value, function($item) {
                return is_string($item) && !empty($item);
            });
        } else {
            $value = [];
        }
        $this->attributes['tags'] = json_encode($value);
    }

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
