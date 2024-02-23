<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are not assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
}
