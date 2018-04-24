<?php
ini_set("display_errors", "On");
error_reporting(0);

if (!function_exists('curl_init')) {
  throw new Exception('YiBan needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('YiBan needs the JSON PHP extension.');
}
if (!function_exists('mcrypt_decrypt')) {
  throw new Exception('YiBan needs the mcrypt PHP extension.');
}

//以下三个变量内容需换成本应用的
$APPID = "84c22bbbfd373a17";   //在open.yiban.cn管理中心的AppID
$APPSECRET = "641170025b0dfb1e8ecc72d8b3c6c461"; //在open.yiban.cn管理中心的AppSecret
$CALLBACK = "http://f.yiban.cn/iapp190321";  //在open.yiban.cn管理中心的oauth2.0回调地址

if(isset($_GET["code"])){   //用户授权后跳转回来会带上code参数，此处code非access_token，需调用接口转化。
    $getTokenApiUrl = "https://oauth.yiban.cn/token/info?code=".$_GET['code']."&client_id={$APPID}&client_secret={$APPSECRET}&redirect_uri={$CALLBACK}";
    $res = sendRequest($getTokenApiUrl);
	
	echo $res;

    if(!$res){
        throw new Exception('Get Token Error');
    }
    $userTokenInfo = json_decode($res);
    $access_token = $userTokenInfo["access_token"];
}else{
    $postStr = pack("H*", $_GET["verify_request"]);
	echo ppp;
    if(strlen($APPID) == '16') {
        $postInfo = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $APPSECRET, $postStr, MCRYPT_MODE_CBC, $APPID);echo ooo;
    }else {
        $postInfo = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $APPSECRET, $postStr, MCRYPT_MODE_CBC, $APPID);echo iii;
    }
    $postInfo = rtrim($postInfo);echo uuu;
    $postArr = json_decode($postInfo, true);
    if(!$postArr['visit_oauth']){  //说明该用户未授权需跳转至授权页面
        header("Location: https://openapi.yiban.cn/oauth/authorize?client_id={$APPID}&redirect_uri={$CALLBACK}&display=web");
        die;
    }
    $access_token = $postArr['visit_oauth']['access_token'];
}
//$asd=sendRequest("https://openapi.yiban.cn/oauth/revoke_token?client_id={$APPID}&access_token={$access_token}");
//$yut=json_decode($asd);
//var_dump($yut);

/*
//拿到access token了，接下来我们获取当前用户的基本信息试试看，so easy!
$userInfoJsonStr = sendRequest("https://openapi.yiban.cn/user/me?access_token={$access_token}");
$userInfo = json_decode($userInfoJsonStr);
echo u6dryj;
var_dump($userInfo.i75ytd);
echo u6dryj;
function sendRequest($uri){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Yi OAuth2 v0.1');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array());
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $response = curl_exec($ch);
    return $response;
}

?>