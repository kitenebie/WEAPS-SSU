<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecentVisitor extends Model
{
    protected $fillable = [
        'visitor_id',
        'profile_id',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'visitor_id');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(User::class, 'profile_id');
    }

    public static function getTopRecentVisitors(int $profileId, int $limit = 3)
    {
        return self::where('profile_id', $profileId)
            ->with('visitor')
            ->orderBy('visited_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
