<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('date');
        $this->load->helper('typography');
        $this->load->library('pagination');
    }

    public function index() {
    	$data['site_config'] = $this->site_config_model->get_config();

    	$content = $this->input->get('search', TRUE);
    	$category = $this->input->get('category', TRUE);
    	$limit = intval($data['site_config']['pagination_number']);
    	$offset = intval($this->input->get('per_page', TRUE));

    	$data['question'] = $this->question_answer_model->search($content, $category, $limit, $offset);
    	$data['total_result'] = $this->question_answer_model->count_search($content, $category);

        // 配置分页功能
        $config['base_url'] = site_url('search/index?category='.$category.'&search='.$content);
        $config['total_rows'] = $data['total_result'];
        $config['per_page'] = $data['site_config']['pagination_number'];
        $config['uri_segment'] = 3;
        $config['num_links'] = 10;
        $config['page_query_string'] = TRUE;
        $this->pagination->make_styled_config($config);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

    	$data['category'] = $this->category_model->get_category();
        $data['category_id'] = -1;
        $data['heat'] = $this->question_answer_model->get_question_by_heat(10);
	$data['search_tags'] = $this->search_tags_model->get_search_tags();

    	$this->load->view('search', $data);
    }
}