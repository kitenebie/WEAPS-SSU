<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class SaveCareer extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'user_id',
        'career_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function career()
    {
        return $this->belongsTo(Carrer::class, 'career_id');
    }
}
