<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    public static $rules = [
        'amount'    => 'required',
        'purpose'   => 'required',
        'person'   => 'required',
        'issued'   => 'required',
    ];

    protected $fillable = [
        'amount',
        'purpose',
        'person',
        'issued',
    ];
}
