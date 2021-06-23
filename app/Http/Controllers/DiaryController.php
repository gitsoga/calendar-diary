<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Http\Requests\StoreDiaryPost;
use App\Http\Middleware\CheckDateFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    /**
     * 日記の新規作成画面表示.
     *
     * @param $yearMonthDay
     * @return View
     */
    public function new($yearMonthDay)
    {
        // 日付の書式・存在をチェック
        CheckDateFormat::checkYearMonthDay($yearMonthDay);

        $date = new \Datetime($yearMonthDay);

        return view('new', ['date' => $date->format('Y-m-d')]);
    }

    /**
     * 日記の編集画面表示.
     *
     * @param $yearMonthDay
     * @return View
     */
    public function edit($yearMonthDay)
    {
        // 日付の書式・存在をチェック
        CheckDateFormat::checkYearMonthDay($yearMonthDay);

        $date = new \Datetime($yearMonthDay);

        // 現在認証されているユーザーのID取得
        $user_id = Auth::id();

        $diary = Diary::where('user_id', $user_id)
            ->where('date', $yearMonthDay)
            ->firstOrFail();

        return view('edit', [
            'date' => $date->format('Y-m-d'),
            'diary' => $diary['diary'],
        ]);
    }

    /**
     * 日記の新規保存.
     *
     * @param  StoreDiaryPost  $request
     * @return Response
     */
    public function store(StoreDiaryPost $request)
    {
        // バリデーション済みデータの取得
        $validated = $request->validated();

        // 現在認証されているユーザーのID取得
        $user_id = Auth::id();

        $diary = new Diary();

        $diary->user_id = $user_id;
        $diary->date = $validated['date'];
        $diary->diary = $validated['diary'];

        $diary->save();

        return view('complete');
    }

    /**
     * 日記の編集結果の保存.
     *
     * @param  StoreDiaryPost  $request
     * @return Response
     */
    public function editStore(StoreDiaryPost $request)
    {
        // バリデーション済みデータの取得
        $validated = $request->validated();

        // 現在認証されているユーザーのID取得
        $user_id = Auth::id();

        $diary = Diary::where('user_id', $user_id)
            ->where('date', $validated['date'])
            ->firstOrFail();

        $diary->diary = $validated['diary'];

        $diary->save();

        return view('complete');
    }
}
