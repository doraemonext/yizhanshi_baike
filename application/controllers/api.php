<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('date');
    }

    public function question($amount = 10) {
        $amount = intval($amount);
        $question = $this->question_answer_model->get_question_by_offset($amount, 0);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($question));
    }
}