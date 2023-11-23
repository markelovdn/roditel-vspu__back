<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Events\OrderShipmentStatusUpdated;
use App\Events\TranslationEvent;

class UserController extends Controller
{
    public function show(): View
    {
        return view('user');
    }

    public function event()
    {
        return event(new TranslationEvent(1, 'Сообщение из контроллера'));
    }
}
