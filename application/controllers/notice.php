<?php
class Notice extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->library('Base_infor');
        $this->load->model('comm/small_wechat_model');
        $this->load->model ( 'notice/notice_model' );
        $this->load->helper('url');
    }

    public function index($open_id) {
        $student_info = $this->small_wechat_model->take_user_by_user_open_id($open_id);
        $user_id = $student_info[0]->user_id;
        $user_stu_name = $student_info[0]->user_stu_name;
        $user_image = $student_info[0]->user_image;
        $user_power = $student_info[0]->user_power;
        $data['user_id'] = $user_id;
        $data['user_stu_name'] = $user_stu_name;
        $data['user_image'] = $user_image;
        $data['power'] = $user_power;

        $history_contents = $this->notice_model->get_notification();
        $data['history_contents'] = $history_contents;
        $this->load->view ( 'notice/index', $data );
    }


    public function show_content($noti_id)
    {
        $content = $this->notice_model->get_content($noti_id);
        $noti_title = $content[0]->noti_title;
        $noti_content = $content[0]->noti_content;

        $data['noti_title'] = $noti_title;
        $data['noti_content'] = $noti_content;
        $this->load->view ( 'notice/show_content', $data );
    }

//    public function test()
//    {
//        self::send_msg(11114,4,"聂琦好可爱的说","对呀对呀");
//    }

    public function send_msg_action($user_id, $power)
    {
        $student_info = $this->small_wechat_model->take_user_by_user_user_id($user_id);
        $user_stu_name = $student_info[0]->user_stu_name;
        $user_image = $student_info[0]->user_image;
        $user_power = $student_info[0]->user_power;
        $data['user_id'] = $user_id;
        $data['user_stu_name'] = $user_stu_name;
        $data['user_image'] = $user_image;
        $data['power'] = $power;

        $this->load->view ( 'notice/send_msg_action', $data );
    }

    public function send_msg_get($user_id, $power)
    {
        $noti_title = $_REQUEST ['noti_title'];
        $noti_content = $_REQUEST ['noti_content'];
        self::send_msg($user_id, $power, $noti_title, $noti_content);
    }

    public function send_msg($user_id, $power, $noti_title, $noti_content)
    {
        $student_power=1; $teacher_power=2; $leader_power=3; $root_power=4;
        switch($power) {
        case $leader_power:
        case $root_power:
            $student_info = $this->small_wechat_model->take_user_by_user_user_id($user_id);
            $open_id = $student_info[0]->user_open_id;
            $user_image = $student_info[0]->user_image;
            $data = $this->notice_model->get_all_people();
            if(!$data)
                echo "没有人存在<br>";
            $wechat_content = $noti_title."\n".$noti_content;
            foreach ($data as $single_data) {
                self::atom_send_msg($single_data->user_open_id, $wechat_content, "text", 0);
            }
            $this->notice_model->insert_notification($noti_title, $noti_content, $user_id, $user_image, $power);
            self::index($open_id);
            break;
        default:
            echo "你没有权限操作<br>";
        }
    }

    public function atom_send_msg($open_id,$content,$type,$video_id)
    {
        //$sql = "SELECT `token` FROM `gdpu_token` where `Id`='1'";
        //$result=mysql_query($sql);
        //$array=mysql_fetch_array($result);
        //$ACC_TOKEN = $array['token'];
        //
        //
        /* 8min */
        /* $APPID="wxdec4cacd20cacc89"; */
        /* $APPSECRET="8e56eb3b05b4cca636f17f8cece6f84b"; */

        $APPID="wxd51ca028ed09e0c8";
        $APPSECRET="2118cdb94a5b2d1be52aa19a9bb78197";
        $TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $json=file_get_contents($TOKEN_URL, false, stream_context_create($arrContextOptions));
        $result=json_decode($json,true);

        $ACC_TOKEN=$result['access_token'];
        $MENU_URL="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$ACC_TOKEN;

        if($type == 'text'){
            $data= array(
                'touser'=>$open_id,
                'msgtype'=>$type,
                'text'=>array(
                    'content'=>$content
                )
            );
        }
        else if($type == 'voice'){
            $data= array(
                'touser'=>$open_id,
                'msgtype'=>$type,
                'voice'=>array(
                    'media_id'=>$content
                )
            );
        }
        else if($type == 'image'){
            $data= array(
                'touser'=>$open_id,
                'msgtype'=>$type,
                'image'=>array(
                    'media_id'=>$content
                )
            );
        }
        else if($type == 'video'){
            $data= array(
                'touser'=>$open_id,
                'msgtype'=>$type,
                'video'=>array(
                    'media_id'=>$content,
                    'thumb_media_id'=>$video_id,
                    'title'=>'my video',
                    'description'=>'我的小视频'
                )
            );
        }



        $code =self::my_json_encode($data);
        //$param = preg_replace("/\u([0-9a-f]{4})/ie", "iconv('UCS-2', 'UTF-8', pack('H*', '$1'));", $param);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $MENU_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $code);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $info = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Errno'.curl_error($ch);
        }

        curl_close($ch);

    }

    public function my_json_encode($arr){
        //convmap since 0x80 char codes so it takes all multibyte codes (above ASCII 127). So such characters are being "hidden" from normal json_encoding
        array_walk_recursive($arr, function (&$item, $key) { if (is_string($item)) $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); });
        return mb_decode_numericentity(json_encode($arr), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
    }


}
//    public function single_bind()
//    {
//        $user_open_id = "open_id";//$GLOBALS['HTTP_RAW_POST_DATA'];
//        $user_stu_id = $_REQUEST ['user_stu_id'];
//        $user_password = $_REQUEST ['user_password'];
//        $user_power = $_REQUEST ['user_power'];
//        //        echo "hi";
//        return self::atom_bind($user_open_id, $user_stu_id, $user_password, $user_power);
//    }
//
//
//    public function atom_bind($user_open_id, $user_stu_id, $user_password, $user_power)
//    {
//        $data = $this->bind_model->take_user_by_user_open_id($user_open_id);
//        if ($data != NULL) {
//            echo "HAVE_BIND";
//            return 0;
//        }
////        $user_id = 11111;
//        $student_info = $this->bind_model->check_student_exist($user_stu_id, $user_password);
//        if ($student_info == NULL) {
//            echo "NO_INFO";
//            return 0;
//        }
//        echo "SUC";
//        //var_dump($student_info);
//        if($user_power==1 && $student_info == NULL) {
//            ;//redirect ( 'not exisit' );
//        }else {
//            $user_stu_name = $student_info[0]->user_stu_name;
//            $user_class = $student_info[0]->user_class;
//            $arr = array (
// //               'user_id' => $user_id,
//                'user_open_id' => $user_open_id,
//                'user_stu_id' => $user_stu_id,
//                'user_password' => $user_password,
//                'user_power' => $user_power,
//                'user_stu_name' => $user_stu_name,
//                'user_class' => $user_class
//                //                'user_birthday' => $user_birthday=$student_info ['csrq'],
//                //                'user_sex' => $user_sex=$student_info ['xb'],
//                //                'user_college' => $user_college=$student_info ['xymc'],
//                //                'user_major' => $user_major=$student_info ['zymc'],
//                //                'user_major_detail' => $user_major_detail=$student_info ['zyfx'],
//                //                'user_grade' => $user_major_detail=$student_info ['nj']
//            );
//            $this->bind_model->bind_user( $arr );
//            //redirect ( 'success' );
//            return 1;
//        }
//    }
//
//    public function rebind_index() {
//        $this->load->view ( 'bind/rebind' );
//    }
//
//    public function rebind() {
//        $user_open_id = "open_id";//$GLOBALS['HTTP_RAW_POST_DATA'];
//        $user_stu_id = $_REQUEST ['user_stu_id'];
//        $user_password = $_REQUEST ['user_password'];
//        $user_power = $_REQUEST ['user_power'];
//        $data = $this->bind_model->take_user_by_user_open_id($user_open_id);
//        if ($data == NULL) {
//            echo "NO_USER";
//            return 0;
//        }
//        $this->bind_model->delete_bind_user( $user_open_id );
//        self::atom_bind($user_open_id, $user_stu_id, $user_password, $user_power);
//    }
