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


    public function q($queryString = null)
    {
        if (!$queryString) {
            return $this->builder;
        }
        $queryStringArr = explode(" ", $queryString);
        $maxIteration = count($queryStringArr) < 4 ? count($queryStringArr) : 4;
        for ($i = 0; $i < $maxIteration; $i++) {
            $queryString = $queryStringArr[$i];
            $this->builder->where(function ($query) use ($queryString) {
                return $this->userSearchQueryDetails($query, $queryString);
            });
        }

    }
}
