@extends('layouts.layout')

@section('title')
    Редактирование заказа
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-xs-10 col-xs-offset-1">
        <div class="col-xs-12 form-title">Редактирвоаие заказа номер <strong>{{$order->id}}</strong></div>
        <form class="form-horizontal" method="post" action="{{ action('Orders\OrderController@update', [$order->id]) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="order_id" value="$order->id">
            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-3">Email клиента</label>
                <div class="col-xs-7">
                    <input type="text" name="client_email" class="form-control" value={{$order->client_email}}>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-3">Партнер</label>
                <div class="col-xs-7">
                    <input type="text" name="partner" class="form-control" value={{$order->partner->name}}>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="control-label col-xs-3">Продукты</label>
                <div class="col-xs-7">
                    @foreach($products as $product)
                        <div class="product-row">{{$product['name']}} стоимостью {{$product['price']}}</div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-3">Статус заказа</label>
                <div class="col-xs-7">
                    <select class="form-control"  name="order_status">
                        <option value="{{ \App\Order::NEW_ORDER }}" {{ $order->status == \App\Order::NEW_ORDER ? 'selected' : '' }}>{{ \App\Order::NEW_ORDER }}</option>
                        <option value="{{ \App\Order::CONFIRMED_ORDER }}" {{ $order->status == \App\Order::CONFIRMED_ORDER ? 'selected' : '' }}>{{ \App\Order::CONFIRMED_ORDER }}</option>
                        <option value="{{ \App\Order::COMPLETED_ORDER }}" {{ $order->status == \App\Order::COMPLETED_ORDER ? 'selected' : '' }}>{{ \App\Order::COMPLETED_ORDER }}</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-3">Общая стоимость заказ</label>
                <div class="col-xs-7">
                    <p class="form-control-static">{{$order->getProductsTotal()}}</p>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 btn-row">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
