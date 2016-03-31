<?php
class Notice_model extends CI_Model {
    function __construct() {
        parent::__construct ();
        $this->load->database ();
    }

    public function get_content($noti_id) {
        $sql = "SELECT * FROM  notification WHERE `noti_id` = '$noti_id'";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function get_all_people() {
        $sql = "SELECT `user_open_id` FROM user";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function get_notification() {
        $sql = "SELECT  * FROM notification";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function insert_notification($noti_title, $noti_content, $noti_from_user, $noti_from_user_image, $noti_type) {
        switch($noti_type) {
        case 1:
            $noti_from_user_name = "学生"; break;
        case 2:
            $noti_from_user_name = "教师"; break;
        case 3:
            $noti_from_user_name = "领导"; break;
        case 4:
            $noti_from_user_name = "管理员"; break;
        }
        $data = array (
            'noti_title' => $noti_title,
            'noti_content' => $noti_content,
            'noti_from_user' => $noti_from_user,
            'noti_date' => date('y-m-d H:i:s',(time()+6*60*60)),
            'noti_from_user' => $noti_from_user,
            'noti_from_user_image' => $noti_from_user_image,
            'noti_from_user_name' => $noti_from_user_name,
            'noti_type' => $noti_type,
        );
        $this->db->insert ( 'notification', $data );
    }
}
