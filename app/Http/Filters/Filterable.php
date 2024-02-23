<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param $query
     * @param QueryFilters $filters
     * @return Builder|mixed
     */
    public function scopeFilter($query, QueryFilters $filters)
    {
        if (!$filters->flag) {
            return $query;
        }

        return $filters->apply($query);
    }
}
