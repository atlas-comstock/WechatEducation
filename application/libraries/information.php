<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
class information {
    public function check_student_exist($xh, $pw) {
        $info = self::get_student_detail_infor($xh, $pw);
        //$info = json_decode ( $info, true );
        $name = $info ['xm'];
        $class = $info ['bjmc'];
        if ((! $name) || (! $class)) {
            return 0;
        }else {
            return $info;
        }
    }

    function get_student_detail_infor($xh, $pw)
    {
    }

    function get_student_detail_infor_back_up($xh, $pw)
    {
        //提交账号和密码，身份模拟登陆
        $post_fields 	= '__VIEWSTATE=dDwtNjg3Njk1NzQ3O3Q8O2w8aTwxPjs%2BO2w8dDw7bDxpPDg%2BO2k8MTM%2BO2k8MTU%2BOz47bDx0PHA8O3A8bDxvbmNsaWNrOz47bDx3aW5kb3cuY2xvc2UoKVw7Oz4%2BPjs7Pjt0PHA8bDxWaXNpYmxlOz47bDxvPGY%2BOz4%2BOzs%2BO3Q8cDxsPFZpc2libGU7PjtsPG88Zj47Pj47Oz47Pj47Pj47bDxpbWdETDtpbWdUQzs%2BPvpW9bNHRO98aj%2BzEmn77FHqeOjK&tbYHM='.$xh.'&tbPSW='.$pw.'&ddlSF=%D1%A7%C9%FA&imgDL.x=28&imgDL.y=19';
        $submit_url 	= 'http://10.50.17.2/default3.aspx';//提价页面

        $ch = curl_init($submit_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HEADER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        $contents = curl_exec($ch);

        preg_match('/Set-Cookie: (.*);/i', $contents, $results);
        $cookie = $results[1];
        curl_close($ch);
/*
$geturl_xsxx = 'http://10.50.17.2/xsxx.aspx?xh='.$xh;//个人信息页面

 查询学生个人信息保存到数据库

 正则表达匹配信息
 preg_match("/<span id=\"xm\">(.*)<\/span>/",$string,$xm);

 $xh  学号
 $pw  密码
 $xm  姓名
 $csrq 出身日期
 $xb 性别
 $xymc 学院名称
 $zymc 专业名称
 $zyfx 专业方向
 $bjmc 班级名称
 $nj 年级
 */
        $geturl_xsxx = 'http://10.50.17.2/xsxx.aspx?xh='.$xh;//个人信息页面

        $header[]='Cookie:'.$cookie;

        $ch = curl_init($geturl_xsxx);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $string = curl_exec($ch);//输出内容
        $string=self::get_utf8_string($string);//转成utf8

        //匹配姓名
        preg_match("/<span id=\"xm\">(.*)<\/span>/",$string,$xm);
        $xm=$xm[1];
        $xm=self::get_utf8_string($xm);

        //匹配出生日期
        preg_match("/<span id=\"csrq\">(.*)<\/span>/",$string,$csrq);
        $csrq=$csrq[1];
        $csrq=self::get_utf8_string($csrq);

        //匹配性别
        preg_match("/<span id=\"xb\">(.*)<\/span>/",$string,$xb);
        $xb=$xb[1];
        $xb=self::get_utf8_string($xb);


        //匹配学院
        preg_match("/<span id=\"xymc\">(.*)<\/span>/",$string,$xymc);
        $xymc=$xymc[1];
        $xymc=self::get_utf8_string($xymc);

        //匹配专业名称
        preg_match("/<span id=\"zymc\">(.*)<\/span>/",$string,$zymc);
        $zymc=$zymc[1];
        $zymc=self::get_utf8_string($zymc);

        //匹配专业方向
        preg_match("/<span id=\"zyfx\">(.*)<\/span>/",$string,$zyfx);
        $zyfx=$zyfx[1];
        $zyfx=self::get_utf8_string($zyfx);

        //匹配班级名称
        preg_match("/<span id=\"bjmc\">(.*)<\/span>/",$string,$bjmc);
        $bjmc=$bjmc[1];
        $bjmc=self::get_utf8_string($bjmc);


        //匹配年级
        preg_match("/<span id=\"dqszj\">(.*)<\/span>/",$string,$nj);
        $nj=$nj[1];
        $nj=self::get_utf8_string($nj);

        if($xm){
            $ret=array('xm'=>$xm,'xymc'=>$xymc,'bjmc'=>$bjmc, 'zymc'=>$zymc, 'nj'=>$nj,'$xb'=>$xb,
            'zyfx'=>$zyfx);
            //var_dump($ret);
            return $ret;
            //echo post_db($xh,$pw,$xm,$csrq,$xb,$xymc,$zymc,$zyfx,$bjmc,$nj);


        }else{
            return self::get_utf8_string("获取失败...");
        }
    }

    function get_utf8_string($content) {
        $encoding = mb_detect_encoding ( $content, array (
            'ASCII',
            'UTF-8',
            'GB2312',
            'GBK',
            'BIG5'
        ) );
        return mb_convert_encoding ( $content, 'utf-8', $encoding );
    }
}
