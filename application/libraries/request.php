<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 用户发送的请求处理类
 * Conan 2015-5-20  520这个日子我居然在做这个
 * //音乐模板
 * title|{标题}#murl|{音乐地址}#hqurl|{音乐地址}
 * 多图文模板
 * description|{描述信息}#title|{标题 }@title|{第二个标题内容}#url|{点击图文item所跳转的连接}#pic|{图片url}@title|{第三个标题内容等等配置}。。。。
 */
$ci = &get_instance();
define("MENU",$ci->config->item('MENU'));

class Request{
	
	public $wc;
	public $to;
	public $from;
	public $ci;
	public $baseurl;
	
	function __construct($wechat){
		$this->ci = &get_instance();	
		$this->wc = $wechat[1];
		$this->from = $this->wc->FromUserName;
		$this->to = $this->wc->ToUserName;
		$this->baseurl = $this->ci->config->item('base_url');
	}
	
	//处理用户指令请求
	function do_request($content){
		if ($content=='test') return '这里是测试框架';
		if ($content=='考勤') return "$this->baseurl/index.php/attend/attendent/index?openid=$this->from";
		if ($content=='信息') return "$this->baseurl/index.php/information/infor_controller/index?openid=$this->from";
		if ($content=='交流') return "$this->baseurl/index.php/communication/comm/index?openid=$this->from";
		return $this->tulingResponse($content);//无匹配则调用图灵回复
	}
	
	function clear(){
		$this->ci->load->driver('cache');
		$this->ci->cache->clean();
	}
	
	//机器人回复
	function tulingResponse($content){
		
		$url = 'http://www.tuling123.com/openapi/api?key=2de48f93cfa6fb3fff1c0ede2ac8b953&info=' . $content;
		$json = file_get_contents($url);
		$arr = json_decode($json);
		$content = $arr->text;	
		if(!$content){
			$content = "你说的话太深奥了，教我如何答你好呢？\n";
		}
		return $content;
	}
}
?> 