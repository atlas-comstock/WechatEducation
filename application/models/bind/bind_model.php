<?php
class bind_model extends CI_Model {
    function __construct() {
        parent::__construct ();
        $this->load->database ();
    }

    function bind_user($user) {
        //$pwd = md5($user['1'].'ourstudio');
        //$data = array (
        //    'user_id' => $user [''],
        //    'pwd' => $pwd,
        //    'user_type' => $user [2],
        //);
        //$this->db->insert ( 'user', $data );
        $this->db->insert ( 'user', $user );
    }

    public function get_student_detail_infor($user_stu_id, $user_password)
    {
        $sql = "SELECT * FROM jwc WHERE `user_stu_id` = '$user_stu_id' AND `user_password` = '$user_password'";
        $result = $this->db->query($sql);
        //$result = $this->db->get_where('jwc', array('user_stu_id' => $user_stu_id), 3, 3)->result();
        return $result->result();
    }

    public function check_student_exist($user_stu_id, $user_password)
    {
        $info = self::get_student_detail_infor($user_stu_id, $user_password);
        if($info == NULL)
            return 0;
        else
            return $info;
    }

    public function take_user_by_user_open_id($user_open_id) {
        $sql = "SELECT * FROM user WHERE `user_open_id` = '$user_open_id'";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function take_user_by_user_user_id($user_id) {
        $sql = "SELECT * FROM user WHERE `user_id` = '$user_id'";
        $result = $this->db->query($sql);
        return $result->result();
    }


    public function delete_bind_user($user_open_id) {
        $sql = "DELETE FROM `user` WHERE `user_open_id` = '$user_open_id'";
        $this->db->query ( $sql );
    }

}
