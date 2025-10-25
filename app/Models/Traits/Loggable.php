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
}