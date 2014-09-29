<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_tags extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('typography');
        $this->load->helper('date');
    }

    public function index($offset = 0) {
        $data['site_config'] = $this->site_config_model->get_config();

        $data['search_tags'] = $this->search_tags_model->get_search_tags();
        $data['page'] = 'search_tags';

        $this->load->view('admin/search_tags', $data);
    }

    public function add() {
        $data['site_config'] = $this->site_config_model->get_config();
        $data['page'] = 'search_tags';

        $this->load->view('admin/search_tags_add', $data);
    }

    public function add_process() {
        $title = $this->input->post('title', TRUE);

        if ($title === FALSE || empty($title)) {
            echo json_content('error', '搜索热词不能为空');
            return;
        }

        $this->search_tags_model->create_search_tags($title);
        $this->log_model->insert($this->ion_auth->user()->row()->username, '新建了搜索热词"'.$title.'"');
        echo json_content('success');
        $this->session->set_flashdata('success', '新建搜索热词成功');
    }

    public function modify_search_tags($id = '') {
        if (empty($id) || !is_numeric($id)) {
            redirect(site_url('admin'));
        }

        $data['site_config'] = $this->site_config_model->get_config();
        $data['search_tags'] = $this->search_tags_model->get_search_tags_by_id($id);
        $data['page'] = 'search_tags';

        $this->load->view('admin/search_tags_modify', $data);
    }

    public function modify_search_tags_process() {
        $id = $this->input->post('search-tags-id', TRUE);
        $title = $this->input->post('title', TRUE);

        if ($id === FALSE || $title === FALSE || empty($id) || empty($title)) {
            echo json_content('error', '搜索热词不能为空');
            return;
        }

        $this->search_tags_model->update_search_tags($id, $title);
        echo json_content('success');
        $this->session->set_flashdata('success', '修改搜索热词成功');
    }

    public function delete_search_tags() {
        $id = $this->input->get('id', TRUE);
        $id = intval($id);

        $title = $this->search_tags_model->get_search_tags_title($id);
        $this->log_model->insert($this->ion_auth->user()->row()->username, '删除了搜索热词"'.$title.'"');

        $this->search_tags_model->delete_search_tags($id);
        $this->session->set_flashdata('success', '删除搜索热词成功');
    }
}