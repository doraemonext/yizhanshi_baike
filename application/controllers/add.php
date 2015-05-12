<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->helper('typography');
        $this->load->helper('date');
        $this->load->helper('email');
        $this->load->helper('form');
    }

    public function index() {
        $data['site_config'] = $this->site_config_model->get_config();
        $data['category'] = $this->category_model->get_category();
        $data['category_id'] = -1;
        $data['heat'] = $this->question_answer_model->get_question_by_heat(10);

        $this->load->view('add', $data);
    }

    public function process() {
        $category = intval($this->input->post('category', TRUE));
        $author = $this->input->post('author', TRUE);
        $email = $this->input->post('email', TRUE);
        $content = $this->input->post('content', TRUE);

        if (empty($category)) {
            echo json_content('error', '您必须选择一个问题类别');
            return;
        } else {
            $category = strip_tags($category);
        }
        if (empty($author)) {
            echo json_content('error', '您的昵称不能为空');
            return;
        } else {
            $author = strip_tags($author);
        }
        if (empty($email)) {
            $email = '';
        } elseif (!valid_email($email)) {
            echo json_content('error', '您的电子邮件格式不正确');
            return;
        }
        if (empty($content)) {
            echo json_content('error', '您的提问内容不能为空');
            return;
        } else {
            $content = strip_tags($content);
        }
        if (mb_strlen($content, 'utf-8') > strlen($content) / 2) {
            echo json_content('error', '请不要发送垃圾信息');
            return;
        }

        $id = 0;
        $this->question_answer_model->submit_question($id, $author, $email, $content, $category);
        echo json_content('success', strval($id));
    }
}