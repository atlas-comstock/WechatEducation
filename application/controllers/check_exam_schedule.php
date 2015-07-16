<?php
//$url = base_url()."/application/controllers/exam_schedule//Excel/reader.php";
require_once("/opt/lampp/htdocs/newwechat/wechat/application/controllers/exam_schedule/Excel/reader.php");
class Check_exam_schedule extends CI_Controller {
    function __construct() {
        parent::__construct ();
        //    $this->load->model ( 'exam/check_exam_schedule_model' );
        //$url = base_url()."application/controllers/exam_schedule/Excel/reader.php";
        $this->load->library('information');
    }

    function get_student_infor($xh, $pw)
    {
        $contents = $this->information->get_student_detail_infor($xh, $pw);
        if( !$contents )  exit("contents is empty ");
        if( strpos($contents, "失败") )  exit("获取专业班别信息失败");
        $infor = $contents;
        return $infor;
    }

    public function get_exam_schedule($open_id, $user_id, $user_pwd, $user_type)
    {
        $xl_reader = new Spreadsheet_Excel_Reader();
        $xl_reader->setOutputEncoding('utf-8');
//        $url = base_url()."/application/controllers/exam_schedule/exam.xls";
//        $file_path = $url;
        $file_path = "/opt/lampp/htdocs/newwechat/wechat/application/controllers/exam_schedule/exam.xls";
        $xl_reader -> read($file_path);

        $xh = $user_id;
        $pw = $user_pwd;
        $student_infor = self::get_student_infor($xh, $pw);
        $ret = self::find_exam_schedule($xl_reader, $student_infor);
        if ($ret == -1) {
            echo "找不到你所在专业班别的考试安排";
        }else {
            $sheets_number = $ret[0];
            $major_number = $ret[1];
            self::echo_exam_schedule($xl_reader, $sheets_number, $major_number);
        }
    }

    function find_exam_schedule($schedule_data, $student_infor)
    {
        $institute = $student_infor["xymc"];
        if (strstr($institute, "药科学院"))
        {
            $grade = $student_infor["bjmc"];
            $institute = $institute.$grade;
            if(strstr($institute, "药科学院2011"))
                $sheets_number = 0;
            else if(strstr($institute, "药科学院2012"))
                $sheets_number = 1;
            else if(strstr($institute, "药科学院2013"))
                $sheets_number = 2;
        }
        else if (strstr($institute, "中药学院"))
            $sheets_number = 3;
        else if (strstr($institute, "公共卫生学院") || strstr($institute, "护理学院"))
            $sheets_number = 4;
        else if (strstr($institute, "医药信息工程学院"))
            $sheets_number = 5;
        else if (strstr($institute, "医药经济学院"))
            $sheets_number = 6;
        else if (strstr($institute, "临床医学院") || strstr($institute, "生命科学与生物制药学院") || strstr($institute, "外国语学院"))
            $sheets_number = 7;
        else if (strstr($institute, "赤岗校区公共卫生学院") || strstr($institute, "赤岗校区临床医学院") || strstr($institute, "赤岗校区护理学院"))
            $sheets_number = 8;
        else if (strstr($institute, "医药商学院"))
            $sheets_number = 9;
        else if (strstr($institute, "食品科学学院"))
            $sheets_number = 10;
        else if (strstr($institute, "医药化工学院"))
            $sheets_number = 11;
        else if (strstr($institute, "中山中药"))
            $sheets_number = 12;
        else if (strstr($institute, "中山信工"))
            $sheets_number = 13;
        else
            $sheets_number = -1;

        $find_times = 1;
        if ( ($sheets_number==3 || $sheets_number==5) )
            $find_times = 2;
        for ($count=0; $count<$find_times; ++$count)
        {
            if ($count == 1)
            {
                if ($sheets_number == 3)
                    $sheets_number = 12;
                else
                    $sheets_number = 13;
            }
            if ($sheets_number == -1)
                return -1;
            $cols_length = $schedule_data->sheets[$sheets_number]['numCols'];
            for ($i=1; $i<$cols_length; ++$i)
            {
                if (isset ($schedule_data->sheets[$sheets_number]['cells'][3][$i]))//检查是否有内容
                {
                    $temp = $schedule_data->sheets[$sheets_number]['cells'][3][$i];//具体专业
                    $major = $student_infor['zymc'];
                    $major_detail = $student_infor['zyfx'];
                    $class = $student_infor['bjmc'];
                    $class = str_replace('（','(',$class);
                    $class = str_replace('）',')',$class);
                    $class = str_replace('(','',$class);
                    $class = str_replace(')','',$class);
                    $class = str_replace('方向','',$class);
                    if (strstr($temp, $major) || strstr($temp, $major_detail))
                    {
                        $temp = str_replace('（','(',$temp);
                        $temp = str_replace('）',')',$temp);
                        $temp = str_replace('(','',$temp);
                        $temp = str_replace(')','',$temp);
                        $temp = str_replace('方向','',$temp);
                        if (strpos($class, $temp)!==false || strpos($temp, $class)!==false)
                        {
                            $ret[0] = $sheets_number;
                            $ret[1] = $i;
                            return $ret;
                        }
                    }
                }
            }
        }

        return -1;
    }

    function echo_exam_schedule($schedule_data, $sheets_number, $major_number)
    {
        echo $schedule_data->sheets[$sheets_number]['cells'][1][2].'</br>';//校区信息
        echo $schedule_data->sheets[$sheets_number]['cells'][2][2].'</br>';//学院信息
        $other_infor[0] =  $schedule_data->sheets[$sheets_number]['cells'][1][2].'</br>';//校区信息
        $other_infor[1] = $schedule_data->sheets[$sheets_number]['cells'][2][2].'</br>';//学院信息
        echo "<br><br>";
        $rows_length = $schedule_data->sheets[$sheets_number]['numRows'];
        $temp = 0;
        $class_idx = $time_idx = $major_idx = 0;
        for ($i=3; $i<$rows_length; ++$i)
        {
            if(isset ($schedule_data->sheets[$sheets_number]['cells'][$i][$major_number]))
            {
                ++$temp;
                echo "<br><br>".$temp."  ";
//                if($temp == 2)
//                    echo "major:".$schedule_data->sheets[$sheets_number]['cells'][$i][1].'</br>';//考试时间
                if($temp%2 == 0) {
                    echo "time: ".$schedule_data->sheets[$sheets_number]['cells'][$i][1].'</br></br>';//考试时间
                    $time[$time_idx++] = $schedule_data->sheets[$sheets_number]['cells'][$i][1].'</br></br>';//考试时间
                    echo "major: ".$schedule_data->sheets[$sheets_number]['cells'][$i][$major_number].'</br>';
                    $major[$major_idx++] = $schedule_data->sheets[$sheets_number]['cells'][$i][$major_number].'</br>';
                }else {
                    if($temp == 1)
                        $other_infor[2] = $schedule_data->sheets[$sheets_number]['cells'][$i][$major_number].'</br>';
                    else {
                        echo "class : ".$schedule_data->sheets[$sheets_number]['cells'][$i][$major_number].'</br>';
                        $class[$class_idx++] = $schedule_data->sheets[$sheets_number]['cells'][$i][$major_number].'</br>';
                    }
                }

            }
        }
        echo "<br><br>time data<Br><br>";
        var_dump($time);
        echo "<br><br>class data<Br><br>";
        var_dump($class);
        echo "<br><br>major data<Br><br>";
        var_dump($major);
        //print_r($xl_reader->sheets[$sheets_number]['cells']); 
    }
}
