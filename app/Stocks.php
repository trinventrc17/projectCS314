<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{


    protected $appends = [
        'added_by',
    ];

    public static $rules = [
        'name'  => 'required|',
        'quantity' => 'required',
    ];

    protected $fillable = [
        'name',
        'quantity',
        'added_by',
    ];


    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            });
        }

        return $query;
    }
}
