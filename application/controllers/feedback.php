<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('typography');
        $this->load->helper('date');
    }

    public function article($id) {
        if (empty($id)) {
            redirect(site_url('/'));
        }

        $id = intval($id);
        $data['site_config'] = $this->site_config_model->get_config();
        $data['question'] = $this->question_answer_model->get_question_by_id($id);
        if (empty($data['question'])) {
            show_404();
        }
        $data['category'] = $this->category_model->get_category();
        $data['category_id'] = $data['question']['category_id'];

        $this->load->view('feedback', $data);
    }

    public function submit() {
        $question_id = $this->input->post('question-id', TRUE);
        $feedback = $this->input->post('feedback', TRUE);

        if (empty($question_id)) {
            echo json_content('error', '未知问题ID');
            return;
        }
        if (empty($feedback)) {
            echo json_content('error', '反馈内容不能为空');
            return;
        }

        $question_id = strip_tags($question_id);
        $feedback = strip_tags($feedback);

        $this->feedback_model->insert($question_id, $feedback);

        echo json_content('success');
    }
}