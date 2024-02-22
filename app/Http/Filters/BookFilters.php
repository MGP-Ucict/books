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

    public function title($title)
    {
        return $this->builder->where('title', $title);
    }

    public function author($author)
    {
       return $this->builder->where('author', $author);
    }
}



