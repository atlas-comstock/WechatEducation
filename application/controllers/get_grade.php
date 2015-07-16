<?php
class Bind extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->model ( 'exam/get_grade_model' );
    }

    function get_grade() {
        $open_id = 123;//$GLOBALS['HTTP_RAW_POST_DATA'];
        $data['result'] = $this->bind_model->take_user_by_open_id($open_id);
        if ($data ['result']->num_rows > 0) {//<=
            return 0;
        }else {
            $xh = $data['result']['user_name'];
            $pw = $data['result']['user_pwd'];
            $url = 'http://av.jejeso.com/helper/api/chengji/get_chengji.php?xh=' . $xh . '&pw=' . $pw;
            $chengjidan = file_get_contents ( $url );
            $content = '#title|成绩单@title|亲爱的学霸Orz，这是您的成绩单请笑纳~^_^(若页面为空请确认密码学号无误)#url|#pic@title|'. $chengjidan . '#pic';
            $content = self::replypic($content);
            return $content;

        }
    }

    function replypic($reply_content) {
        $a = array ();
        $b = array ();
        $c = array ();
        $n = 0;
        $contents = $reply_content;
        foreach ( explode ( '@t', $reply_content ) as $b [$n] ) {
            if (strstr ( $contents, '@t' )) {
                $b [$n] = str_replace ( "itle", "title", $b [$n] );
                $b [$n] = str_replace ( "ttitle", "title", $b [$n] );
            }

            foreach ( explode ( '#', $b [$n] ) as $reply_content ) {
                list ( $k, $v ) = explode ( '|', $reply_content );
                $a [$k] = $v;
                $d .= $k;
            }
            $c [$n] = $a;
            $n ++;
        }
        $reply_content = $c;
        return $reply_content;
    }
}
