<?php
class small_wechat_model extends CI_Model {
    function __construct() {
        parent::__construct ();
        $this->load->database ();
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
