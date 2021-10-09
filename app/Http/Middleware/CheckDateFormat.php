<?php

namespace App\Http\Middleware;

use App\Exceptions\DataFormatException;

class CheckDateFormat
{
    /**
     * 日付の書式チェック(年-月).
     *
     * @param  string $yearMonth
     * @return Exception
     */
    public static function checkYearMonth($yearMonth)
    {
        // 日付の形式チェック
        if (preg_match('/\A[0-9]{4}-[0-9]{1,2}\z/', $yearMonth) == false) {
            throw new DataFormatException('不正な日付データです');
        }

        // 日付の存在チェック
        [$year, $month] = explode('-', $yearMonth);
        if (checkdate($month, 1, $year) == false) {
            throw new DataFormatException('不正な日付データです');
        }
    }

    /**
     * 日付の書式チェック(年-月-日).
     *
     * @param  string $yearMonthDay
     * @return Exception
     */
    public static function checkYearMonthDay($yearMonthDay)
    {
        // 日付の形式チェック
        if (preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $yearMonthDay) == false) {
            throw new DataFormatException('不正な日付データです');
        }

        // 日付の存在チェック
        [$year, $month, $day] = explode('-', $yearMonthDay);
        if (checkdate($month, $day, $year) == false) {
            throw new DataFormatException('不正な日付データです');
        }
    }
}
