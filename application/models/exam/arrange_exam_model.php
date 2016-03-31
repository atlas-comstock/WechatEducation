<?php
class arrange_exam_model extends CI_Model {
    function __construct() {
        parent::__construct ();
        $this->load->database ();
    }
    public function take_user_by_open_id($open_id) {
        $sql = "SELECT * FROM user WHERE `open_id` = '$open_id'";
        $result = $this->db->query ( $sql );
        return $result;
    }

}
