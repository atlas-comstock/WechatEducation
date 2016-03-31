<?php
class small_wechat_model extends CI_Model {
    function __construct() {
        parent::__construct ();
        $this->load->database ();
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

    public function get_group_name($group_id) {
        $sql = "SELECT * FROM `group` WHERE `group_id` = '$group_id'";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function get_group_latest_id() {
        $this->db->select_max('group_id');
        $query = $this->db->get('group');
        /* //$sql = "SELECT * FROM group"; */
        /* $result = $this->db->query($sql); */
        return $query->result();
    }

    public function insert_group($new_group) {
        $this->db->insert ( 'group', $new_group );
    }

    public function delete_group($group_id) {
        $sql = "DELETE FROM `group` WHERE `group_id` = '$group_id'";
        $this->db->query ( $sql );
    }

    public function get_group_header_id($group_id) {
        $sql = "SELECT * FROM `group` WHERE `group_id` = '$group_id'";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function get_groups() {
        $result = $this->db->get('group');
        return $result->result();
    }

}
