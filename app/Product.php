<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
