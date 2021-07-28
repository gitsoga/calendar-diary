<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Diary extends Model
{
    use Notifiable;

    /**
     * モデルと関連しているテーブル.
     *
     * @var string
     */
    protected $table = 'diary';

    /**
     * 値の上書きをしないカラム.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'aws_username',
        'date',
    ];

    /**
     * 指定された年月の日記を取得.
     *
     * @param $username
     * @param $yearmonth
     * @return object
     */
    public static function getUserDiaryForMonth($username, $yearmonth)
    {
        return self::select('date', 'diary')
            ->where('aws_username', '=', $username)
            ->where('date', 'like', $yearmonth.'%')
            ->orderBy('date')
            ->get();
    }
}
