<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->helper('typography');
        $this->load->helper('date');
    }

    public function index($offset = 0) {
        $offset = intval($offset);
        $data['site_config'] = $this->site_config_model->get_config();

        // 配置分页功能
        $config['base_url'] = site_url('home/index');
        $config['total_rows'] = $this->question_answer_model->count_all_question();
        $config['per_page'] = $data['site_config']['pagination_number'];
        $config['uri_segment'] = 3;
        $config['num_links'] = 10;
        $this->pagination->make_styled_config($config);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['question'] = $this->question_answer_model->get_question_by_offset($config['per_page'], $offset);
        $data['category'] = $this->category_model->get_category();
        $data['category_id'] = 0;
        $data['heat'] = $this->question_answer_model->get_question_by_heat(10);
        $data['search_tags'] = $this->search_tags_model->get_search_tags();

        $this->load->view('home', $data);
    }

    public function category($id, $offset = 0) {
        $id = intval($id);
        $offset = intval($offset);
        $data['site_config'] = $this->site_config_model->get_config();

        // 配置分页功能
        $config['base_url'] = site_url('home/category').'/'.$id;
        $config['total_rows'] = $this->question_answer_model->count_all_category_question($id);
        $config['per_page'] = $data['site_config']['pagination_number'];
        $config['uri_segment'] = 4;
        $config['num_links'] = 10;
        $this->pagination->make_styled_config($config);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['question'] = $this->question_answer_model->get_question_by_category_offset($id, $config['per_page'], $offset);
        $data['category'] = $this->category_model->get_category();
        $data['category_id'] = $id;
        $data['heat'] = $this->question_answer_model->get_question_by_heat(10);
        $data['search_tags'] = $this->search_tags_model->get_search_tags();

        $this->load->view('home', $data);
    }
}