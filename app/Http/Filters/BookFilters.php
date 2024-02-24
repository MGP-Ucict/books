<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookFilters extends QueryFilters
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
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
                return $this->bookSearchQueryDetails($query, $queryString);
            });
        }

    }
}



