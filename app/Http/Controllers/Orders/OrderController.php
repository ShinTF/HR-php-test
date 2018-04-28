<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateOrderRequest;

use App\Order;

use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    protected $ordersRepository;

    public function __construct()
    {
        $this->ordersRepository = new OrderRepository();
    }

    public function index()
    {
        $orders = $this->ordersRepository->makeOrdersDataArray();

        return view('orders.index')->with('orders', $orders);
    }

    public function edit(Request $request)
    {
        $order = Order::find($request['id']);
        $productsList = $this->ordersRepository->getProductsList($order);

        return view('orders.edit')
            ->with('order', $order)
            ->with('products', $productsList);
    }

    public function update(UpdateOrderRequest $request)
    {
        $data = $request->all();
        $orderID = $request['id'];

        $order = Order::find($orderID);
        $order->partner->name = $data['partner'];
        $order->client_email = $data['client_email'];
        $order->status = $data['order_status'];

        if($order->save() && $order->partner->save()) {

            return redirect()->action('Orders\OrderController@index');
        }

        return redirect()->back()->withErrors('Ошибка сохранения в базе данных');
    }
}
