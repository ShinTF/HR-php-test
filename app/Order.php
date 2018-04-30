<?php


namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const NEW_ORDER = 0;
    const CONFIRMED_ORDER = 10;
    const COMPLETED_ORDER = 20;

    /*Relations*/

    protected $table = 'orders';

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }

    /*Methods*/

    public function getProductsTotal()
    {
        return $this->order_products->sum('price');
    }

    public function getProductsAmount()
    {
        return $this->order_products->sum('quantity');
    }

    public function getProductsString()
    {
        $orderProducts = $this->order_products->all();
        $productsString = '';

        foreach ($orderProducts as $orderProduct){
            $productsString .= $orderProduct->product->name . ' ';
        }
        return $productsString;
    }

    /*Scopes*/

    /*Orders Scopes*/

    public function scopeOrdersWithRelations($query)
    {
        return $query->with('partner')
                    ->with(['order_products' => function($query){
                        $query->with('product');
                    }]);
    }

    public function scopeExpired($query)
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');

        return $query->where('delivery_dt', '<', $date)
                     ->where('status', '=', self::CONFIRMED_ORDER)
                     ->orderBy('delivery_dt', 'desc')
                     ->take(50);
    }

    public function scopeNew($query)
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');

        return $query->where('delivery_dt', '>', $date)
                     ->where('status', '=', self::NEW_ORDER)
                     ->orderBy('delivery_dt', 'asc')
                     ->take(50);
    }

    public function scopeCurrent($query)
    {
        $date_from = Carbon::now()->format('Y-m-d H:i:s');
        $date_to = Carbon::now()->addDay()->format('Y-m-d H:i:s');

        return $query->whereBetween('delivery_dt',[$date_from,$date_to])
                     ->where('status', '=', self::CONFIRMED_ORDER)
                     ->orderBy('delivery_dt', 'asc');
    }

    public function scopeCompleted($query)
    {
        $date_from = Carbon::today()->format('Y-m-d H:i:s');
        $date_to = Carbon::tomorrow()->subSecond()->format('Y-m-d H:i:s');

        return $query->whereBetween('delivery_dt',[$date_from,$date_to])
            ->where('status', '=', self::COMPLETED_ORDER)
            ->orderBy('delivery_dt', 'desc')
            ->take(50);
    }

}
