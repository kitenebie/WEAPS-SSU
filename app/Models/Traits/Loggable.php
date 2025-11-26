<?php

namespace App\Models\Traits;

use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Loggable
{
    public function logChange($action, $changes = null)
    {
        SystemLog::create([
            'model_type' => get_class($this),
            'model_id' => $this->getKey(),
            'action' => $action,
            'changes' => $changes,
            'user_id' => Auth::id(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

 public static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->storeLog('create');
        });

        static::updated(function ($model) {
            $model->storeLog('update');
        });

        static::deleted(function ($model) {
            $model->storeLog('delete');
        });
    }

    protected function storeLog(string $action): void
    {
        // Build a { field: { column_name: ..., old: ..., new: ... } } map
        [$diff, $columns] = match ($action) {
            'create' => $this->buildCreateDiff(),
            'update' => $this->buildUpdateDiff(),
            'delete' => $this->buildDeleteDiff(),
            default  => [[], []],
        };

        // Skip empty/no-op logs (esp. for update)
        if ($action === 'update' && empty($columns)) {
            return;
        }

        SystemLog::create([
            'user_id'          => Auth::id(),
            'model'            => get_class($this),
            'model_id'         => $this->getKey(),
            'action'           => $action,
            'modified'         => $diff,
            'modified_columns' => $columns,
            'ip_address'       => request()?->ip(),
        ]);
    }

    /**
     * On CREATE: old = null, new = current value
     */
    protected function buildCreateDiff(): array
    {
        $attrs = $this->getAttributes();
        $diff = [];
        foreach ($attrs as $key => $newVal) {
            $diff[$key] = [
                'column_name' => $key,
                'old'         => null,
                'new'         => $newVal,
            ];
        }
        return [$diff, array_keys($attrs)];
    }

    /**
     * On UPDATE: only changed attributes
     */
    protected function buildUpdateDiff(): array
    {
        $changed = $this->getChanges();
        unset($changed['updated_at']); // ignore timestamp noise if you want

        $diff = [];
        foreach ($changed as $key => $newVal) {
            $diff[$key] = [
                'column_name' => $key,
                'old'         => $this->getOriginal($key),
                'new'         => $newVal,
            ];
        }

        return [$diff, array_keys($diff)];
    }

    /**
     * On DELETE: old = current/original value, new = null
     */
    protected function buildDeleteDiff(): array
    {
        $original = $this->getOriginal();
        $diff = [];
        foreach ($original as $key => $oldVal) {
            $diff[$key] = [
                'column_name' => $key,
                'old'         => $oldVal,
                'new'         => null,
            ];
        }
        return [$diff, array_keys($original)];
    }
}
