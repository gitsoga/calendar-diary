<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model 
{
    use Notifiable;

    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'diary';

    /**
     * 値の上書きをしないカラム 
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'user_id',
        'date',
    ];
}
