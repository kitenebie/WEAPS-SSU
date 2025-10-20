<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveCareer extends Model
{
    use HasFactory;

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
