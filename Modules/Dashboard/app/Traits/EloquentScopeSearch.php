<?php

namespace Modules\Dashboard\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait EloquentScopeSearch
{
    /**
     * Scope to Search.
     *
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function scopeApplySearch($query): Builder
    {
        if (! property_exists($this, 'searchable')) {
            throw new Exception(
                sprintf('Searchable property is missing in the class [ %s ] that using the EloquentScopeSearch trait.', static::class)
            );
        }

        $keyword = request('q');

        return $query->when($keyword, function ($query) use ($keyword) {

            $searchTerm = '%' . (str_replace(',', '', $keyword)) . '%';

            $query->where('id', 'LIKE', $searchTerm);

            foreach ($this->searchable as $column) {
                $query->orWhere($column, 'LIKE', $searchTerm);
            }
        });
    }
}
