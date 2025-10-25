<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class Applicant extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'user_id',
        'company_id',
        'career_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function career()
    {
        return $this->belongsTo(Carrer::class, 'career_id');
    }
}