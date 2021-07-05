<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Http\Middleware\CheckDateFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * TOP表示
     * 表示した年月に合わせたカレンダーを表示する.
     *
     * @return Route
     * @return View
     */
    public function top()
    {
        return view('calendar');
    }
}
