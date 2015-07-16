<?php
class Evaluate extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->library('information');
        $this->load->model ( 'evaluate/evaluate_model' );
    }

    public function index() {
        $this->load->view ( 'evaluate/index.php' );
    }

    public function search_subject($subject_name)
    {
        $result = $this->evalute_model->search_subject( $subject_name );
        return $result;
    }

    public function evalute_teacher($open_id)
    {
        $data['result'] = $this->bind_model->take_user_by_open_id($open_id);
        if ($data ['result']->num_rows > 0) {//<=
            echo "please login first.";
            return 0;
        }else {
            $teacher_name = $_REQUEST ['teacher_name'];
            $mark_lesson = $_REQUEST ['mark_lesson'];
            $mark_answer_count = $_REQUEST ['mark_answer_count'];
            $comment = $_REQUEST ['comment'];
            $mark_date = $time();


            $arr = array (
                'teacher_id' => $teacher_id,
                'teacher_name' => $teacher_name,
                'mark_lesson' => $mark_lesson,
                'mark_answer_count' => $mark_answer_count,
                'comment' => $comment,
                'mark_date' => $mark_date,
            );
            $this->evalute_model->comment_teacher( $arr );
            redirect ( 'success' );
            return 1;
        }
    }
}
