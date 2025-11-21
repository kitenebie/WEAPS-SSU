<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['user_id', 'career_id'];

    /**
     * Get the user that owns the email.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the career that the email is for.
     */
    public function career()
    {
        return $this->belongsTo(Carrer::class, 'career_id');
    }
}
