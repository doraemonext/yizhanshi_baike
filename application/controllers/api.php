<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->helper('typography');
        $this->load->helper('date');
        $this->load->helper('email');
        $this->load->helper('form');
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

    public function create() {
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

        $id = 0;
        $this->question_answer_model->submit_question($id, $author, $email, $content, $category);
        echo json_content('success', strval($id));
    }
}
