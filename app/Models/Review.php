<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class Review extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'company_id',
        'user_id',
        'rate',
        'comment',
    ];

    protected $casts = [
        'rate' => 'integer',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}