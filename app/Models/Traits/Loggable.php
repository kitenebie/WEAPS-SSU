<?php

namespace App\Models\Traits;

use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Loggable
{
    protected static function logChange($model, $action, $changes = null)
    {
        SystemLog::create([
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'action' => $action,
            'changes' => $changes,
            'user_id' => Auth::id(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    protected static function bootLoggable()
    {
        static::created(function ($model) {
            static::logChange($model, 'create', null);
        });

        static::updated(function ($model) {
            $dirty = $model->getDirty();

            $changes = [];
            foreach ($dirty as $field => $newValue) {
                $changes[$field] = [
                    'old' => $model->getOriginal($field),
                    'new' => $newValue,
                ];
            }

            if (!empty($changes)) {
                static::logChange($model, 'update', $changes);
            }
        });

        static::deleted(function ($model) {
            static::logChange($model, 'delete', null);
        });
    }
}
