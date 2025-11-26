<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemLog extends Model
{
    protected $fillable = [
        'user_id',
        'model',
        'model_id',
        'action',
        'changes',
        'ip_address',
        'modified_columns',
        'modified'
    ];

    protected $casts = [
        'modified' => 'array',          // now the main diff payload
        'modified_columns' => 'array',  // list of changed columns
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}