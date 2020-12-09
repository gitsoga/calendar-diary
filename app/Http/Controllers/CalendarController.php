<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;

class calendarController extends Controller
{
    /**
     * TOP表示
     * 表示した年月に合わせたカレンダーを表示するURLへリダイレクト.
     *
     * @param $yearmonth
     * @return Route
     */
    public function top()
    {
        $date = new \Datetime();
        $yearmonth = $date->format('Y-m');

        return redirect()->action('CalendarController@show', ['yearmonth' => $yearmonth]);
    }

    /**
     * カレンダー表示.
     *
     * @param $yearmonth
     * @return View
     */
    public function show($yearmonth)
    {
        // 年-月の形でなければエラーとする
        $date = new \Datetime($yearmonth);
        if (0) {
        }

        // 指定された年月の日記を取得
        $diaries = Diary::getUserDiaryForMonth(1, $yearmonth);

        // 指定された年月の最終日を取得
        $lastDay = $date->format('t');

        // カレンダーと日記データを整形
        $calendars = self::formatCalendar($diaries, $lastDay);

        return view('calendar', [
            'yearmonth' => $yearmonth,
            'calendars' => $calendars,
        ]);
    }

    private static function formatCalendar($diaries, $lastDay)
    {
        // 1ヶ月分の配列を作成
        $calendars = [];
        for ($i = 1; $i <= $lastDay; $i++) {
            $calendars[$i] = [];
        }

        foreach ($diaries as $diary) {
            $day = (int) substr($diary->date, -2);
            $calendars[$day] = $diary;
        }

        return $calendars;
    }
}
