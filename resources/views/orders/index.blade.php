@extends('layouts.layout')

@section('title')
    Заказы
@endsection

@section('content')
    {{--<div class="col-xs-10 col-xs-offset-2">--}}
        {{--<table id="orders-table">--}}
            {{--<thead>--}}
                {{--<tr class='header-wrap'>--}}
                    {{--<td class='header-wrap' rowspan="1">ID заказа</td>--}}
                    {{--<td class='header-wrap' rowspan="1">Название партнера</td>--}}
                    {{--<td class='header-wrap' colspan="1">Обшая стоимость</td>--}}
                    {{--<td class='header-wrap' colspan="1">Количество единиц товара</td>--}}
                    {{--<td class='header-wrap' colspan="1">Товары в заказе</td>--}}
                    {{--<td class='header-wrap' colspan="1">Статус заказа</td>--}}
                {{--</tr>--}}
            {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($orders as $order)--}}
                    {{--<tr>--}}
                        {{--<td>--}}
                            {{--<a href="{{ action('Orders\OrderController@edit', [$order['id']]) }}">{{$order['id']}}</a>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$order['parnter_name']}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$order['sum']}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$order['amount']}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$order['products']}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$order['status']}}--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}

    <div class="col-xs-10 col-xs-offset-1">
        <ul class="nav nav-tabs nav-orders">
            <li class="active"><a data-toggle="tab" href="#expired">Просроченные</a></li>
            <li><a data-toggle="tab" href="#current">Текущие</a></li>
            <li><a data-toggle="tab" href="#new">Новые</a></li>
            <li><a data-toggle="tab" href="#completed">Выполненные</a></li>
        </ul>
    </div>
    <div class="tab-content col-xs-10 col-xs-offset-1 orders">
            @foreach($orders as $status => $items)

                <?php $tabClass = ($status == 'expired') ? 'tab-pane fade in active' : 'tab-pane fade' ?>

                <div id="{{$status}}" class="{{$tabClass}}">
                    @if($items)
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
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        <a href="{{ action('Orders\OrderController@edit', [$item['id']]) }}">{{$item['id']}}</a>
                                    </td>
                                    <td>
                                        {{$item['parnter_name']}}
                                    </td>
                                    <td>
                                        {{$item['sum']}}
                                    </td>
                                    <td>
                                        {{$item['amount']}}
                                    </td>
                                    <td>
                                        {{$item['products']}}
                                    </td>
                                    <td>
                                        {{$item['status']}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="nothing-found">
                            Ничего не найдено
                        </div>
                    @endif
                </div>

            @endforeach
    </div>



@endsection
