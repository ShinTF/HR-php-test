<?php namespace App\Repositories;

use App\Order;

class OrderRepository {

    public function getOrdersWithRelations()
    {
        return Order::with('partner')
            ->with(['order_products' => function($query){
                $query->with('product');
            }])
            ->get();
    }

    public function makeOrdersDataArray()
    {
        $orders = $this->getOrdersWithRelations();

        $output = array();
        $i = 0;
        foreach ($orders as $order){

            $output[$i]['id'] = $order->id;
            $output[$i]['parnter_name'] = $order->partner->name;

            $orderProductSum = 0;
            $orderTotalProductAmount = 0;
            $orderProducts = '';

            foreach ($order->order_products as $order_product){
                $orderProductSum += $order_product->price;
                $orderTotalProductAmount += $order_product->quantity;
                $orderProducts .= $order_product->product->name. ' ';
            }

            $output[$i]['sum'] = $orderProductSum;
            $output[$i]['amount'] = $orderTotalProductAmount;
            $output[$i]['products'] = $orderProducts;
            $output[$i]['status'] = $order->status;

            $i++;
        }

        return $output;
    }

    public function getProductsList(Order $order)
    {
        $productsList = array();

        $orderProducts = $order->order_products;
        $i = 0;
        foreach ($orderProducts as $orderProduct){
            $productsList[$i]['price'] = $orderProduct->price;
            $productsList[$i]['name'] = $orderProduct->product->name;
            $i++;
        }

        return $productsList;
    }
}