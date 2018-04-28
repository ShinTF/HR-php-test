<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const NEW_ORDER = 0;
    const CONFIRMED_ORDER = 10;
    const COMPLETED_ORDER = 20;


    protected $table = 'orders';

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function getProductsTotal()
    {
        return $this->order_products->sum('price');
    }

    public function getProductsAmount()
    {
        return $this->order_products->sum('quantity');
    }

    public  function getProductsString()
    {
        $orderProducts = $this->order_products->all();
        $productsString = '';

        foreach ($orderProducts as $orderProduct){
            $productsString .= $orderProduct->product->name . ' ';
        }
        return $productsString;
    }
}
