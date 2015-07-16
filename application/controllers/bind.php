<?php
class Bind extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->model ( 'bind/bind_model' );
    }

    public function index() {
        $this->load->view ( 'bind/index' );
    }

    public function single_bind()
    {
        $user_open_id = "open_id";//$GLOBALS['HTTP_RAW_POST_DATA'];
        $user_stu_id = $_REQUEST ['user_stu_id'];
        $user_password = $_REQUEST ['user_password'];
        $user_power = $_REQUEST ['user_power'];
        //        echo "hi";
        return self::atom_bind($user_open_id, $user_stu_id, $user_password, $user_power);
    }


    public function atom_bind($user_open_id, $user_stu_id, $user_password, $user_power)
    {
        $data = $this->bind_model->take_user_by_user_open_id($user_open_id);
        if ($data != NULL) {
            echo "HAVE_BIND";
            return 0;
        }
//        $user_id = 11111;
        $student_info = $this->bind_model->check_student_exist($user_stu_id, $user_password);
        if ($student_info == NULL) {
            echo "NO_INFO";
            return 0;
        }
        echo "SUC";
        //var_dump($student_info);
        if($user_power==1 && $student_info == NULL) {
            ;//redirect ( 'not exisit' );
        }else {
            $user_stu_name = $student_info[0]->user_stu_name;
            $user_class = $student_info[0]->user_class;
            $arr = array (
 //               'user_id' => $user_id,
                'user_open_id' => $user_open_id,
                'user_stu_id' => $user_stu_id,
                'user_password' => $user_password,
                'user_power' => $user_power,
                'user_stu_name' => $user_stu_name,
                'user_class' => $user_class
                //                'user_birthday' => $user_birthday=$student_info ['csrq'],
                //                'user_sex' => $user_sex=$student_info ['xb'],
                //                'user_college' => $user_college=$student_info ['xymc'],
                //                'user_major' => $user_major=$student_info ['zymc'],
                //                'user_major_detail' => $user_major_detail=$student_info ['zyfx'],
                //                'user_grade' => $user_major_detail=$student_info ['nj']
            );
            $this->bind_model->bind_user( $arr );
            //redirect ( 'success' );
            return 1;
        }
    }

    public function rebind_index() {
        $this->load->view ( 'bind/rebind' );
    }

    public function rebind() {
        $user_open_id = "open_id";//$GLOBALS['HTTP_RAW_POST_DATA'];
        $user_stu_id = $_REQUEST ['user_stu_id'];
        $user_password = $_REQUEST ['user_password'];
        $user_power = $_REQUEST ['user_power'];
        $data = $this->bind_model->take_user_by_user_open_id($user_open_id);
        if ($data == NULL) {
            echo "NO_USER";
            return 0;
        }
        $this->bind_model->delete_bind_user( $user_open_id );
        self::atom_bind($user_open_id, $user_stu_id, $user_password, $user_power);
    }
}
