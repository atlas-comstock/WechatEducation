<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
/*
 * 公众号回复消息类
 *
 */
$ci = &get_instance();
define("WELCOME",$ci->config->item('welcome'));
class Message {
    public $request = array ();
    public $funcflag = false;

    //发送消息核心类start
    public function response($callBack){

    	$ci = &get_instance();

        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->request = $postObj;
            $message = call_user_func($callBack,$postObj,$this,$ci);
            $ret="";
            if (strstr($message, "#title|")){
            	$message = $this->makeNews($message);
            }
            if (strstr($message,"murl")){
            	$message = $this->makeMusic($message);
            }
            if (!is_array($message))
            {
                $ret = $this->replyText($message);
            }
            elseif(array_key_exists("murl",$message))
            {
                $ret = $this->replyMusic($message);
            }else{
                $ret = $this->reply_news($message);
            }
            echo $ret;
        }
    }
    //发送消息核心类over

    /*
     * 消息回复模板
     * start
     */
    //回复文本信息
    public function replyText($message){
        if($message) {
            $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>0</FuncFlag>
                </xml>";
            $req = $this->request;
            $time = time();
            $message = sprintf($textTpl,$req->FromUserName, $req->ToUserName, $time, $message);
        }
        echo $message;
    }
    //回复多图文信息
    //多图文模板
    //description|{描述信息}#title|{标题 }@title|{第二个标题内容}#url|{点击图文item所跳转的连接}#pic|{图片url}@title|{第三个标题内容等等配置}。。。。"
    public function reply_news($arr_item){
    	if (!is_array($arr_item)||strstr($arr_item, "#title|")){
    		$arr_item = $this->makeNews($arr_item);
    	}
        $itemTpl = "<item>
            <Title><![CDATA[%s]]></Title>
            <Discription><![CDATA[%s]]></Discription>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
            </item>";
        $real_arr_item = $arr_item;
        if (isset($arr_item['title']))
            $real_arr_item = array($arr_item);

        $nr = count($real_arr_item);
        $item_str = "";
        foreach ($real_arr_item as $item)
            $item_str.= sprintf($itemTpl, $item['title'], $item['description'],
                $item['pic'], $item['url']);

        $req = $this->request;
        $time = time();
        $fun = $this->funcflag ? 1 : 0;

        $newsResult = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[news]]></MsgType>
            <Content><![CDATA[]]></Content>
            <ArticleCount>%s</ArticleCount>
            <Articles>%s</Articles>
            <FuncFlag>%s</FuncFlag>
            </xml>";

        $resultStr = sprintf($newsResult,$req->FromUserName, $req->ToUserName, $time, $nr,$item_str,$fun);
        echo $resultStr;
    }

    //回复音乐信息
    /*
     * 格式 title|{标题}#description|{描述}#murl|{音乐地址}#hqurl|{wifi下音乐地址}
     */
    public function replyMusic($arr_item){
        $itemTpl = "<Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <MusicUrl><![CDATA[%s]]></MusicUrl>
            <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>";
        $real_arr_item = $arr_item;
        if (isset($arr_item['title']))
            $real_arr_item = array($arr_item);
        $item_str = "";
        foreach ($real_arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['title'], $item['description'],
                $item['murl'], $item['hqurl']);

        $req = $this->request;
        $time = time();
        $fun = $this->funcflag ? 1 : 0;

        $musicResult = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[music]]></MsgType>
            <Music>%s</Music>
            <FuncFlag>%s</FuncFlag>
            </xml>";
        $resultStr = sprintf($musicResult,$req->FromUserName, $req->ToUserName,$time,$item_str,$fun);

        return $resultStr;
    }
    /*
     * 消息回复模板
     * over
     */

    //事件处理start
    public function get_msg_type(){
        return strtolower($this->request->MsgType);
    }

    public function get_event_type() //获得事件
    {
        return strtolower($this->request->Event);
    }

    public function get_event_key()  //获得自定义的菜单接口中的key值
    {
        return strtolower($this->request->EventKey);
    }

    //不同的事件处理流
    public function do_event($event){
        /* $open_id = $req->FromUserName; */
        switch ($event){
        case 'subscribe':$this->replyText(WELCOME);break;
        case 'unsubscribe':$this->replyText('bye');break;
        case 'location':$this->save_localtion();break;
        case 'click':
            $req = $this->request;
            $open_id = $req->FromUserName;
        	$event_key = $this->get_event_key();
            switch ($event_key) {
            case 'bind':
                $url = "http://av.jejeso.com/education/index.php/bind/index/".$open_id;
                $pic = "http://av.jejeso.com/education/myproject/bind.jpg";
                $reply_content = "#title|点此绑定个人信息.#url|".$url."#pic|".$pic;
                $this->reply_news($reply_content);
                break;
            case 'home':
                $url = "http://av.jejeso.com/education/index.php/student_main/index/".$open_id;
                $pic = "http://av.jejeso.com/education/myproject/index.jpg";
                $reply_content = "#title|点此进入个人首页.#url|".$url."#pic|".$pic;
                $this->reply_news($reply_content);
                break;
            case 'team': $this->replyText("by geekcreate");
                break;
            default:$this->replyText('hello');break;
            }
            break;

        }
    }
    //事件处理over

    //地理位置处理start
    function save_localtion(){
        //     	file_put_contents('log.txt',print_r($this->request->Longitude,true));
        $ci = &get_instance();
        $usr = $this->request->FromUserName;
        $ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        //     	if (!$lon=$ci->cache->get('Longitude')){
        $lat=$this->request->Latitude;
        $lon=$this->request->Longitude;
        $very = "$usr";
        $ci->cache->file->save("Latitude$very","$lat",300);
		     $ci->cache->file->save("Longitude$very","$lon",300);
		     /*
		      *
			    file_put_contents('log.txt',print_r($ci->cache->get('Longitude'),true));
		 		$this->replyText($lat.$lon);
		      *
		      */
//     	}
// 		$this->replyText($ci->cache->get("Longitude$very"));//测试语句
    }
    //地理位置处理over

    //音乐处理
    /*
     * 格式 title|{标题}#description|{描述}#murl|{音乐地址}#hqurl|{wifi下音乐地址}
     */
    public function makeMusic($content){
    	$a = array ();
    	foreach ( explode ( '#', $content ) as $reply_content ) {
    		list ( $k, $v ) = explode ( '|', $reply_content );
    		$a [$k] = $v;
    	}
    	$reply_content=$a;
    	return $reply_content;
    }

    //多图文处理函数 start- //在welcome::main中使用要用$m->makeNews($content);
    public function makeNews($content){
        $a=array();
        $b=array();
        $c=array();
        $n=0;
        $contents = $content;
        foreach (explode('@t',$content) as $b[$n])
        {
            if(strstr($contents,'@t'))
            {
                $b[$n] = str_replace("itle","title",$b[$n]);
                $b[$n] = str_replace("ttitle","title",$b[$n]);
            }

            foreach (explode('#',$b[$n]) as $content)
            {
                list($k,$v)=explode('|',$content);
                $a[$k]=$v;
                $d.= $k;
            }
            $c[$n] = $a;
            $n++;

        }
        $content = $c;
        return $content;
    }

}

?>
