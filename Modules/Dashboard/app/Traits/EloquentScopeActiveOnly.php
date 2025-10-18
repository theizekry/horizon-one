<?php

namespace Modules\Dashboard\Traits;

use Illuminate\Database\Eloquent\Builder;

trait EloquentScopeActiveOnly
{
    /**
     * Scope to get the only active records.
     *
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function scopeActiveOnly($query): Builder
    {
        return $query->where('is_active', true);
    }
}
