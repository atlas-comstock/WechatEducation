<?php

function curl_get_file_contents($URL)
{
$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($c, CURLOPT_HEADER, 1);//输出远程服务器的header信息
curl_setopt($c, CURLOPT_USERAGENT, 'MicroMessenger/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.baidu.com)');
curl_setopt($c, CURLOPT_URL, $URL);
$contents = curl_exec($c);
curl_close($c);
if ($contents) {return $contents;}
else {return FALSE;}
}


$url='http://wechat.52campus.net/Task/GoTo/f61924a1d9da48a2ae51fb0a19b2f99e-b21DeDZqaElIY1RLMm9RbUlYMEI5Q2hqRWhVOA==';//original

$url='http://wechat.52campus.net/WeChatApi/Authorize/501e8fed-9a10-4e1d-979b-8da9da087669?returnUrl=%2FTask%2FGoTo%2Ff61924a1d9da48a2ae51fb0a19b2f99e-b21DeDZqaElIY1RLMm9RbUlYMEI5Q2hqRWhVOA%3D%3D';//this site turn to UNIQLO

//$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3a3d4fb62fff9dd0&amp;redirect_uri=http%3a%2f%2fwechat.52campus.net%2fwechatApi%2fconnect%2f501e8fed9a104e1d979b8da9da087669%3freturnUrl%3d%252fTask%252fGoTo%252ff61924a1d9da48a2ae51fb0a19b2f99e-b21DeDZqaElIY1RLMm9RbUlYMEI5Q2hqRWhVOA%253d%253d&amp;response_type=code&amp;scope=snsapi_base&amp;state=#wechat_redirect';//this is empty

ini_set('user_agent','MicroMessenger/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.baidu.com)');
//$contents = file_get_contents($url);
$contents = curl_get_file_contents($url);
echo "start<br>";

if( !$contents )
   exit("contents is empty ");
//echo $contents;
$stderr = fopen('abcdef.txt','w+');
if(!$stderr )
    echo "false<br>";
fwrite($stderr,"\r\n\r\n".$contents);
fclose($stderr);
echo "end<br>";
?>



http://wechat.52campus.net/WeChatApi/Authorize/501e8fed-9a10-4e1d-979b-8da9da087669?returnUrl=%2FTask%2FGoTo%2Ff61924a1d9da48a2ae51fb0a19b2f99e-b21DeDZqaElIY1RLMm9RbUlYMEI5Q2hqRWhVOA%3D%3D
