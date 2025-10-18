<?php

namespace Modules\Dashboard\Traits;

use Modules\Dashboard\Models\Admin;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CreatedByRelation
{
    /**
     * Return the created By admin data.
     *
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by')
            ->select('id', 'name')
            ->withDefault();
    }
}
