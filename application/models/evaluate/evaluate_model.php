<?php
class evaluate_model extends CI_Model {
    function __construct() {
        parent::__construct ();
        $this->load->database ();
    }

    function search_subject($subject_name) {
        $sql = "SELECT * FROM user WHERE `subject_name` like '$subject_name'";
        $result = $this->db->query ( $sql );
        return $result;
    }

    function comment_teacher($comment) {
        //$pwd = md5($user['1'].'ourstudio');
        //$data = array (
        //    'user_id' => $user [''],
        //    'pwd' => $pwd,
        //    'user_type' => $user [2],
        //);
        //$this->db->insert ( 'user', $data );
        $this->db->insert ( 'comment', $comment );
    }

    public function take_user_by_open_id($open_id) {
        $sql = "SELECT * FROM user WHERE `open_id` = '$open_id'";
        $result = $this->db->query ( $sql );
        return $result;
    }
    public function delete_bind_user($open_id) {
        $sql = "DELETE FROM `user` WHERE `open_id` = '$open_id'";
        $this->db->query ( $sql );
    }
}
