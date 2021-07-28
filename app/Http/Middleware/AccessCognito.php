<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use \Firebase\JWT\JWT;
use CoderCat\JWKToPEM\JWKConverter;

/**
 * AWS Cognito(認証)関連処理
 * (ユーザー登録・認証はjsのみ)
 */
class AccessCognito
{
    /**
     * tokenをcognitoに渡し検証、usernameを取得する
     *
     * @param string $jwt
     * @return string $username|false
     */
    public static function getUsername ($jwt) {
        try {
            if ($jwt) {
                $jwks = file_get_contents(config('app.cognito_publickey'));

                $tks = explode('.', $jwt);
                if (count($tks) != 3) {
                    throw new Exception('JWTのフォーマットがおかしいです');
                }
                list($headb64, $bodyb64, $cryptob64) = $tks;

                $jwt_header = json_decode(JWT::urlsafeB64Decode($headb64), true);
                if (empty($jwt_header["kid"])) {
                    throw new Exception("JSON Web Tokenにkidがありません");
                }
                $publicKey = "";
                $jwks_data = json_decode($jwks, true);
                foreach ($jwks_data["keys"] as $jwk) {
                    if ($jwk["kid"] == $jwt_header["kid"]) {
                        $jwkConverter = new JWKConverter();
                        $publicKey = $jwkConverter->toPEM($jwk);
                        break;
                    }
                }
                if ( !$publicKey ) {
                    throw new Exception("公開鍵が取得出来ません");
                }

                $decoded = JWT::decode($jwt, $publicKey, array('RS256'));

                if ( !$decoded ){
                    throw new Exception("検証エラー");
                }
                $decoded_array = (array) $decoded;
                return $decoded_array['username'];
            }
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
        return false;
    }
}
