<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->library('email');
        $this->load->helper('typography');
        $this->load->helper('date');
        $this->load->helper('email');
    }

    public function view($id = '') {
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

        $this->question_answer_model->add_heat($id);

        $this->load->view('question', $data);
    }

    public function submit_answer() {
        if (!$this->ion_auth->logged_in()) {
            echo json_content('error', '请先登录');
            return;
        }

        $question_id = $this->input->post('question-id', TRUE);
        $title = $this->input->post('title', TRUE);
        $category = $this->input->post('category', TRUE);
        $content = $this->input->post('content', FALSE);

        if (empty($question_id)) {
            echo json_content('error', '未知问题ID');
            return;
        }
        if (empty($title)) {
            echo json_content('error', '问题标题不能为空');
            return;
        }
        if (empty($category)) {
            echo json_content('error', '问题分类不能为空');
            return;
        }
        if (empty($content)) {
            echo json_content('error', '回复内容不能为空');
            return;
        }

        $question_id = strip_tags($question_id);
        $title = strip_tags($title);
        $category = strip_tags($category);
        $this->question_answer_model->submit_answer($this->ion_auth->user()->row()->id, $question_id, $title, $category, $content);
        $question = $this->question_answer_model->get_question_by_id($question_id);
        $site_config = $this->site_config_model->get_config();

        if (!empty($question['author_email'])) {
            $this->email->from($this->config->item('from_email'), $this->config->item('from_email_name'));
            $this->email->to($question['author_email']);
            $this->email->subject('您在'.$site_config['site_title'].'上的提问有了回复');
            $this->email->message('您于 '.$question['datetime'].' 在 '.$site_config['site_title'].' 上的提问：<br><strong>'.auto_typography($question['title']).'</strong><br>有了新回答<br><strong>'.auto_typography($question['reply']).'</strong><br>具体信息请查看：'.site_url('question/view').'/'.$question['id']);
            @$this->email->send();
        }

        echo json_content('success');
    }
}