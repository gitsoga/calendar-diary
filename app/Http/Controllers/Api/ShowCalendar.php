<?php

namespace App\Http\Controllers\Api;

use App\Diary;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckDateFormat;
use App\Http\Middleware\AccessCognito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * 要求された年月の日記データを返す.
 */
class ShowCalendar extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return
     */
    public function __invoke(Request $request, $year_month = null)
    {
        // 指定がない場合、今日の年-月を取得
        if (isset($year_month)) {
            CheckDateFormat::checkYearMonth($year_month);
            $date = new Carbon($year_month);
        } else {
            $now = Carbon::now();
            $year_month = $now->format('Y-m');
            $date = new Carbon($year_month);
        }

        // AWS Cognitoで認証しているユーザーのusername取得
        if(!($username = AccessCognito::getUsername($request->header('X-Authorization')))){
            return response()->json([], 403);
        }

        // 指定された年月の日記を取得
        $diaries = Diary::getUserDiaryForMonth($username, $year_month);

        // 指定された年月の１日の曜日を取得
        $space_num = $date->format('w');

        // 指定された年月の最終日を取得
        $last_day = $date->format('t');

        // カレンダーと日記データを整形
        $calendars = self::formatCalendar($diaries, $last_day);

        return response()->json([
            'yearMonth' => $year_month,
            'calendars' => $calendars,
            'spaceNum' => $space_num,
        ], 200);
    }

    /**
     * 日記データを整形する.
     *
     * @param Diary $diaries 日記データ
     * @param int $last_day 日記の最終日
     * @return array
     */
    private static function formatCalendar($diaries, $last_day)
    {
        // 1ヶ月分の配列を作成
        $calendars = [];
        for ($i = 1; $i <= $last_day; $i++) {
            $calendars[$i] = [];
        }

        foreach ($diaries as $diary) {
            $day = (int) substr($diary->date, -2);
            $calendars[$day] = $diary;
        }

        return $calendars;
    }
}
