<?php

namespace App\Http\Controllers\Api;

use App\Diary;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiaryPost;
use App\Http\Middleware\AccessCognito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * .
 */
class EditPostDiary extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return
     */
    public function __invoke(StoreDiaryPost $request, $id)
    {
        // AWS Cognitoで認証しているユーザーのusername取得
        if(!($username = AccessCognito::getUsername($request->header('X-Authorization')))){
            return response()->json([], 403);
        }

        // バリデーション済みデータの取得
        $validated = $request->validated();

        $diary = Diary::where('aws_username', $username)
            ->where('id', $id)
            ->firstOrFail();

        $diary->diary = $validated['diary'];

        $diary->save();

        return response()->json([], 200);
    }
}
