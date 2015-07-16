<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('validate');
        $this->load->library('message');
    }

    public function index()
    {
        //公众号接入验证
        if(isset($_GET['echostr'])){
            $this->validate->valid();
        }else {
            $this->message->response('Welcome::main');
        }
    }

    function main($request,$wechat,$ci) {
        if($wechat->get_msg_type() == "event") {
            $wechat->do_event($wechat->get_event_type());
        }else {
            $content = $request->Content;//用户发送过来的消息
            $par = array('request',$request);
            $ci->load->library('request',$par);
            $content = $ci->request->do_request($content);//处理用户发来的文字信息请求
        }
        return $content;
    }
}
