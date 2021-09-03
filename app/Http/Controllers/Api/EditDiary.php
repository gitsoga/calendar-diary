<?php

namespace App\Http\Controllers\Api;

use App\Diary;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AccessCognito;
use App\Http\Middleware\CheckDateFormat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * 日記の編集データ取得.
 */
class EditDiary extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return
     * @param  Request  $request
     * @param int $id 日記ID
     * @return Response
     */
    public function __invoke(Request $request, $id)
    {
        // AWS Cognitoで認証しているユーザーのusername取得
        if (! ($username = AccessCognito::getUsername($request->header('X-Authorization')))) {
            return response()->json([], 403);
        }

        $diary = Diary::where('aws_username', $username)
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'id' => $id,
            'date' => $diary['date'],
            'diary' => $diary['diary'],
            'image_path' => $diary['image_path'],
        ], 200);
    }
}
