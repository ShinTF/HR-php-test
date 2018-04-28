<?php namespace App\Repositories;

use Carbon\Carbon;

class MainPageRepository {

    public function getWeatherInCity($cityID){

        $url = "http://api.openweathermap.org/data/2.5/weather?id=$cityID&units=metric&lang=ru&APPID=4a65e9d0eb1178fc8b9710a8495ae52e";
        $data = file_get_contents($url);

        if($data){
            $data = json_decode($data);
            $output = $this->weatherArrForOutput($data);

            return $output;
        }

        return false;
    }

    public function weatherArrForOutput($data){
        $weatherArr = [];
        $weatherArr['city'] = $data->name;                                                          //Название города на английском
        $weatherArr['date'] = Carbon::createFromTimestamp($data->dt)->format('d-m-Y');        //Время сейчас
        $weatherArr['temp_now_C'] = $data->main->temp;                                              //Температура в градусах Цельсия
        $weatherArr['humidity_percentage'] = $data->main->humidity;                                 //Влажность в процентах

        foreach ($data->weather as $state){
            $weatherArr['state_desc'] = $state->description;                                        //Что происходит на улице: снег, дожль и т.д.
            break;
        }

        $weatherArr['wind_speed_ms'] = $data->wind->speed;                                          //Скорость ветра м/с


        return $weatherArr;
    }

}