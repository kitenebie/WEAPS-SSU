<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = [
        'model_type',
        'model_id',
        'action',
        'changes',
        'user_id',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    // relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relationship to the affected model
    public function model()
    {
        return $this->morphTo();
    }
}
