@extends('layouts.layout')

@section('title')
    Главная страница
@endsection

@section('content')
    <div class="row main-page-container col-xs-10 col-xs-offset-1">
        <div class="col-xs-6 weather">
                @foreach($weather as $title => $data)
                    <div class="col-xs-12 weather__item">
                        <div class="col-xs-6 item-title">
                            @switch($title)
                                @case('temp_now_C')
                                    Температура (°C)
                                @break
                                @case('humidity_percentage')
                                    Влажность (%)
                                @break
                                @case('state_desc')
                                    Описание
                                @break
                                @case('wind_speed_ms')
                                    Скорость ветра (метр/сек)
                                @break
                                @case('city')
                                    Город
                                @break
                                @case('date')
                                    Дата
                                @break
                            @endswitch
                        </div>
                        <div class="col-xs-6 item-data">
                            {{$data}}
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="col-xs-6 links">
            <div class="row">
                <a href="{{ action('Orders\OrderController@index') }}">Заказы</a>
            </div>
            <div class="row">
                <a href="{{ action('Products\ProductController@index') }}">Продукты</a>
            </div>
        </div>
    </div>

@endsection
