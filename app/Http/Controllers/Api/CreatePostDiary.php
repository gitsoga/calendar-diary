<?php

namespace App\Http\Controllers\Api;

use App\Diary;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AccessCognito;
use App\Http\Middleware\CheckDateFormat;
use App\Http\Requests\StoreDiaryPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Storage;

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
        $validated = $request->validated();

        // AWS Cognitoで認証しているユーザーのusername取得
        if (! ($username = AccessCognito::getUsername($request->header('X-Authorization')))) {
            return response()->json([], 403);
        }

        $image = $validated['image'];
        $image_path = null;
        if ($image) {
            $path = Storage::disk('s3')->putFile('diary_image', $image, 'public');
            $image_path = Storage::disk('s3')->url($path);
        }

        $diary = new Diary();
        $diary->aws_username = $username;
        $diary->date = $validated['date'];
        $diary->diary = $validated['diary'];
        $diary->image_path = $image_path;
        $diary->save();

        return response()->json([], 201);
    }
}
