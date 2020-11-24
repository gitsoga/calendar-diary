<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class calendarController extends Controller
{
    /**
     * カレンダー表示
     *
     * @param $month
     * @return View
     */
    public function show($month)
    {
        return view('calendar', ['month' => $month]);
    }
}
