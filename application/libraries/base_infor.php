<?php
class Base_infor{

	public $appID;
	public $appsecret;
	public $wx_api_url;

	function __construct(){
		$ci=get_instance();
		$this->appID=$ci->config->item('appID');
		$this->appsecret=$ci->config->item('appsecret');
		$this->wx_api_url=$ci->config->item('tx_wx_api');
	}

	function get_accessToken(){
		$APPID=$this->appID;
		$APPSECRET=$this->appsecret;
		$wx_url=$this->wx_api_url;
		$url = $wx_url."?type=access_token&appid=$APPID&appsecret=$APPSECRET";
		$json = file_get_contents($url);
		$json_arr = json_decode($json);
		return $json_arr->access_token;
	}

	function get_userInfo($openid){
		$APPID=$this->appID;
		$token = $this->get_accessToken();
		$wx_url=$this->wx_api_url;
		$url=$wx_url."?type=user_info&accesstoken=$token&openid=$openid&lang=zh_CN";
		$json = file_get_contents($url);
		return $json;
	}

}
?>
