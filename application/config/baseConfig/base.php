<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 公众号本身需要的参数设置
 * 微信公众号以及地址配置
 * 2015-5-14 Conan
 * how to use? $this->config->item('索引名称');
 * 
 */
//appid
$config['appID'] = 'wxd51ca028ed09e0c8';
//appsecret
$config['appsecret'] = '2118cdb94a5b2d1be52aa19a9bb78197';
//调试模式开关
$config['DEBUG'] = false;
//连接微信api http5
$config['tx_wx_api'] = 'http://av.jejeso.com/getAccessToken.php';
//设置公众号验证token
$config['TOKEN'] = 'ours';

//设置公众号关注后的欢迎消息
$config['welcome']='欢迎信息';

$config['MENU']='这里是功能菜单';
