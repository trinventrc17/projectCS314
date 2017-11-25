<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'price',
        'quantity',
        'session',
    ];

    public function getSubtotalAttribute()
    {
        return $this->attributes['price'] * $this->attributes['quantity'];
    }

    public function trackings()
    {
        return $this->morphOne('App\InventoryTracking', 'trackable');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    // public static function search($params = [])
    // {
    //     return self::when(!empty($params), function ($query) use ($params) {
    //         switch ($params['date_range']) {
    //             case 'today':
    //                 $query->whereDay('created_at', '=', date('d'));
    //                 break;
    //             case 'current_week':
    //                 // $query->where(DB::raw("YEARWEEK(`created_at`, 1) = YEARWEEK(DATE(), 1)"));
    //                 break;
    //             case 'current_month':
    //                 $query->whereMonth('created_at', '=', date('m'));
    //                 break;
    //             default:

    //                 break;
    //         }

    //         return $query;
    //     })->orderBy('created_at', 'DESC');
    // }
}
