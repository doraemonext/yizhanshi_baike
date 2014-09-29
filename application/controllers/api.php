<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('date');
    }

    public function question($id = 0) {
        $id = intval($id);
        if ($id != 0)  {
            $question = $this->question_answer_model->get_question_by_id($id);
            if (!$question) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($question));
                return;
            }
            $question['category'] = $this->category_model->get_category_by_id($question['category_id']);
            unset($question['category_id']);
            unset($question['reply_user_id']);
        } else {
            $order = $this->input->get('order');
            $from = $this->input->get('from');
            $count = $this->input->get('count');
            $search = $this->input->get('search');
            if (!$order) {
                $order = 'heat';
            }
            if (!$from) {
                $from = 0;
            }
            if (!$count) {
                $count = 10;
            }

            $question = $this->question_answer_model->api_get_question($order, $from, $count, $search);
            foreach ($question as &$q) {
                $q['category'] = $this->category_model->get_category_by_id($q['category_id']);
                unset($q['category_id']);
                unset($q['reply_user_id']);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($question));
    }
}


