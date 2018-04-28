@extends('layouts.layout')

@section('title')
    Заказы
@endsection

@section('content')
    <div class="col-xs-10 col-xs-offset-1">
        <table id="orders-table">
            <thead>
                <tr class='header-wrap'>
                    <td class='header-wrap' rowspan="1">ID заказа</td>
                    <td class='header-wrap' rowspan="1">Название партнера</td>
                    <td class='header-wrap' colspan="1">Обшая стоимость</td>
                    <td class='header-wrap' colspan="1">Количество единиц товара</td>
                    <td class='header-wrap' colspan="1">Товары в заказе</td>
                    <td class='header-wrap' colspan="1">Статус заказа</td>
                </tr>
            </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ action('Orders\OrderController@edit', [$order['id']]) }}">{{$order['id']}}</a>
                        </td>
                        <td>
                            {{$order['parnter_name']}}
                        </td>
                        <td>
                            {{$order['sum']}}
                        </td>
                        <td>
                            {{$order['amount']}}
                        </td>
                        <td>
                            {{$order['products']}}
                        </td>
                        <td>
                            {{$order['status']}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
    </div>
@endsection
