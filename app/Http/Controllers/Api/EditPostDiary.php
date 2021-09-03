<?php

namespace App\Http\Controllers\Api;

use App\Diary;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiaryPost;
use App\Http\Middleware\AccessCognito;
use Carbon\Carbon;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * 日記の編集データ保存.
 */
class EditPostDiary extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  StoreDiaryPost  $request
     * @param Integer $id 日記ID
     * @return Response
     */
    public function __invoke(StoreDiaryPost $request, $id)
    {
        // AWS Cognitoで認証しているユーザーのusername取得
        if(!($username = AccessCognito::getUsername($request->header('X-Authorization')))){
            return response()->json([], 403);
        }

        $diary = Diary::where('aws_username', $username)
            ->where('id', $id)
            ->firstOrFail();

        // バリデーション済みデータの取得
        $validated = $request->validated();

        $diary->image_path = $this->uploadDeleteImage(
            $diary['image_path'],
            $validated['image'],
            $validated['image_del_flg']
        );
        $diary->diary = $validated['diary'];

        $diary->save();

        return response()->json([], 200);
    }

    /**
     * 画像の削除、アップロード処理
     *
     * @param string $old_image_path 今の画像URL
     * @param file $image 画像ファイル
     * @param boolean $image_del_flg 画像削除フラグ
     * @return $image_path 新しい画像URL
     */
    private function uploadDeleteImage($old_image_path, $image, $image_del_flg)
    {
        $disk = Storage::disk('s3');

        $image_path = $old_image_path;
        if($old_image_path && $image_del_flg) {
            $disk->delete($old_image_path);
            $image_path = null;
        }
        if ($image) {
            if($old_image_path) {
                $disk->delete($old_image_path);
            }
            $path = $disk->putFile('diary_image', $image, 'public');
            $image_path = $disk->url($path);
        }

        return $image_path;
    }
}
