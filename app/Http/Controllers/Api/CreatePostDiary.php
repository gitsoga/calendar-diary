<?php

namespace App\Http\Controllers\Api;

use App\Diary;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiaryPost;
use App\Http\Middleware\CheckDateFormat;
use App\Http\Middleware\AccessCognito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * 日記の新規データ保存.
 */
class CreatePostDiary extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  StoreDiaryPost  $request
     * @return Response
     */
    public function __invoke(StoreDiaryPost $request)
    {
      Log::info('api top');

      $validated = $request->validated();

        // AWS Cognitoで認証しているユーザーのusername取得
        if(!($username = AccessCognito::getUsername($request->header('X-Authorization')))){
            return response()->json([], 403);
        }

        $diary = new Diary();
        $diary->aws_username = $username;
        $diary->date = $validated['date'];
        $diary->diary = $validated['diary'];
        $diary->save();

        return response()->json([], 201);
    }
}
