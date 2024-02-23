<?php


namespace App\Http\Filters;

use App\Models\AdditionalAgreement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilters
{
    protected Request $request;
    protected $builder;
    public bool $flag;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if (isset($request->all()['q']) && !$request->all()['q']) {
            $this->flag = false;
        } else {
            $this->flag = true;
        }

        $this->request = $request;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (!method_exists($this, $name)) {
                continue;
            }
            if (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }
        return $this->builder;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->request->all();
    }
}