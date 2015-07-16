<?php
class check_exam_schedule_model extends CI_Model {
    function __construct() {
        parent::__construct ();
        $this->load->database ();
    }
}
