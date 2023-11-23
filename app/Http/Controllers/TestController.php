<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sendTestEvent()
    {
        return view('welcome');
    }
}
