<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Problem extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('typography');
        $this->load->helper('date');
        $this->load->library('pagination');
    }

    public function index($offset = 0) {
        $data['site_config'] = $this->site_config_model->get_config();

        // 配置分页功能
        $config['base_url'] = site_url('admin/problem/index');
        $config['total_rows'] = $this->question_answer_model->count_all_question();
        $config['per_page'] = $data['site_config']['pagination_number'];
        $config['uri_segment'] = 4;
        $config['num_links'] = 3;
        $this->pagination->make_styled_config_admin($config);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['question'] = $this->question_answer_model->get_question_by_offset($config['per_page'], $offset);
        $data['category'] = $this->category_model->get_category();
        $data['page'] = 'problem';

        $this->load->view('admin/problem', $data);
    }

    public function delete_question() {
        $id = $this->input->get('id', TRUE);
        $id = intval($id);

        $question = $this->question_answer_model->get_question_by_id($id);
        $this->log_model->insert($this->ion_auth->user()->row()->username, '删除了问题"'.$question['title'].'"');

        $this->question_answer_model->delete_question($id);
    }
}