<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
//class User extends Authenticatable
{
    use Notifiable;

    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'user';


    /**
     * 値の上書きをしないカラム 
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
}
