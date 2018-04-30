<?php namespace App\Repositories;

use App\Order;

use Mail;

class OrderRepository {

    public function getOrdersByStatuses($statuses){

        $data = array();

        foreach ($statuses as $status){
            switch($status){
                case 'expired':

                    $orders = Order::OrdersWithRelations()->expired()->get();
                    $data['expired'] = $this->makeOrdersDataArray($orders);

                    break;
                case 'current':

                    $orders = Order::OrdersWithRelations()->current()->get();
                    $data['current'] = $this->makeOrdersDataArray($orders);

                    break;
                case 'new':

                    $orders = Order::OrdersWithRelations()->new()->get();
                    $data['new'] = $this->makeOrdersDataArray($orders);

                    break;

                case 'completed':
                    $orders = Order::OrdersWithRelations()->completed()->get();
                    $data['completed'] = $this->makeOrdersDataArray($orders);

                    break;
            }
        }

        return $data;
    }

    public function makeOrdersDataArray($orders)
    {
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

    public function sendMailToParnerAndVendors(Order $order)
    {
        $mails = array();
        $products = $order->order_products;

        foreach ($products as $product){
            $mails[] = $product->product->vendor->email;
        }

        $mails[] = $order->partner->email;

        $dataForMail = array();
        $dataForMail['id'] = $order->id;
        $dataForMail['product_list'] = $this->getProductsList($order);
        $dataForMail['total_sum'] = $order->getProductsTotal();

        foreach ($mails as $mail){
            try {
                Mail::send('emails.orders.status_confirmed', ['data' => $dataForMail], function ($message) use ($mail) {
                    $message->to($mail)->subject('Завершен заказ');
                });
            }catch(\Exception $e) {
                continue;
            }
        }
    }

}