<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDiaryPost;

class DiaryController extends Controller
{
    /**
     * 日記の新規作成
     *
     * @param $yearMonthDay
     * @return View
     */
    public function new($yearMonthDay)
    {
        // 形式チェック
        if(0){
        
        }

        $date = new \Datetime($yearMonthDay);
        return view('new', ['date' => $date->format('Y-m-d')]);
    }

    /**
     * 新しいブログポストの保存
     *
     * @param  StoreDiaryPost  $request
     * @return Response
     */
    public function store(StoreDiaryPost $request)
    {
        // バリデーション済みデータの取得
        $validated = $request->validated();
    }
}
