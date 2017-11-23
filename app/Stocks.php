<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{



    public static $rules = [
        'name'  => 'required|',
        'quantity' => 'required',
    ];

    protected $fillable = [
        'name',
        'quantity',
    ];


    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('barcode', 'LIKE', '%'.$keyword.'%');
            });
        }

        return $query;
    }
}
