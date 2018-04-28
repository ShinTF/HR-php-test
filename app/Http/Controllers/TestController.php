<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Partner;

class TestController extends Controller
{
    public function index(){

        $op = Partner::find(1);

        dd($op->orders->first()->client_email);
        return view('test');
    }
}
