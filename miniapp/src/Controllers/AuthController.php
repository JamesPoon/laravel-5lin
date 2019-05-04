<?php

namespace Weixin\App\Controllers;

use EasyWeChat\Factory;
use EasyWeChat\MiniProgram\Auth\Client;
use EasyWeChatComposer\EasyWeChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Weixin\App\Models\User;
use Weixin\App\Models\WeixinAccount;

class AuthController extends Controller
{
    public function register(Request $request) {

    }
    public function login(Request $request) {
        info($request);
        $referer = $request->header("Referer");
        info($referer);
        $uri = parse_url($referer);
        info($uri);
        $segments = explode("/", $uri["path"]);
        info($segments);
        info($segments[1]);
        $appid = $segments[1];
        $account    =   WeixinAccount::find($appid);
        info($account);
#        info(app("config")->all());
        $code = $request->get('code');
        $encryptedData = $request->get('encryptedData');
        $iv = $request->get('iv');
        $appid = env("MAPP_APPID");
        $secret = env("MAPP_SECRET");

//        $client = new \GuzzleHttp\Client();
//        $url = 'https://api.weixin.qq.com/sns/jscode2session';
//        $res = $client->request("GET", $url, [
//            'query' => [
//                'appid' =>$appid,
//                'secret' => $secret,
//                'js_code' => $code,
//                'grant_type' => 'authorization_code',
//            ]
//        ]);
//        info($res->getBody());
//        $url = $url."?".urldecode(http_build_query([
//                'appid' =>$appid,
//                'secret' => $secret,
//                'js_code' => $code,
//                'grant_type' => 'authorization_code',
//            ]));
//        info($url);
//        $res =  $client->request("GET", $url, []);
//	info($res->getBody());
//        $body = json_decode($res->getBody());
//        $openid = $body->openid;
//        $session_key = $body->session_key;
//
//
//        $userifo = new \WXBizDataCrypt($appid, $session_key);
//
//        $errCode = $userifo->decryptData($encryptedData, $iv, $data);
//
//        $info = json_decode($data);
        $config = [
            'app_id' => $account->appid,
            'secret' => $account->secret,
        ];
        $app = Factory::miniProgram($config);
        $result = $app->auth->session(request("code"));
        info($result);
        $openid = $result["openid"];
        $user = User::whereHas("miniapp", function ($query) use ($appid, $openid){
            info([$openid, $appid]);
            $query->where("open_id", $openid)->where("appid", $appid);
        })->first();
        info($user);
        if ($user) {
            $result = $user->createToken("miniApp");
        }
        return response()->json($result);
    }
}
