<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$ci = &get_instance();
define("TOKEN",$ci->config->item('TOKEN'));
 
class Validate{
	
	function valid(){
		$echoStr = $_GET['echostr'];
		if($this->checkSign()){
			if(isset($_GET['echostr'])){
				echo $echoStr;
				exit(0);
			}
		}else {
			exit(0);
		}
	}
	
	function checkSign(){
		
	  	$signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
		
	}
	
}
?>