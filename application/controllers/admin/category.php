<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('typography');
        $this->load->helper('date');
    }

    public function index($offset = 0) {
        $data['site_config'] = $this->site_config_model->get_config();

        $data['category'] = $this->category_model->get_category();
        $data['page'] = 'category';

        $this->load->view('admin/category', $data);
    }

    public function add() {
        $data['site_config'] = $this->site_config_model->get_config();
        $data['page'] = 'category';

        $this->load->view('admin/category_add', $data);
    }

    public function add_process() {
        $title = $this->input->post('title', TRUE);

        if ($title === FALSE || empty($title)) {
            echo json_content('error', '分类名称不能为空');
            return;
        }

        $this->category_model->create_category($title);

        $this->log_model->insert($this->ion_auth->user()->row()->username, '新建了分类"'.$title.'"');

        echo json_content('success');
        $this->session->set_flashdata('success', '新建分类成功');
    }

    public function modify_category($id = '') {
        if (empty($id) || !is_numeric($id)) {
            redirect(site_url('admin'));
        }

        $data['site_config'] = $this->site_config_model->get_config();
        $data['category'] = $this->category_model->get_category_by_id($id);
        $data['page'] = 'category';

        $this->load->view('admin/category_modify', $data);
    }

    public function modify_category_process() {
        $id = $this->input->post('category-id', TRUE);
        $title = $this->input->post('title', TRUE);

        if ($id === FALSE || $title === FALSE || empty($id) || empty($title)) {
            echo json_content('error', '分类名称不能为空');
            return;
        }

        $this->category_model->update_category($id, $title);
        echo json_content('success');
        $this->session->set_flashdata('success', '修改分类成功');
    }

    public function delete_category() {
        $id = $this->input->get('id', TRUE);
        $id = intval($id);

        $title = $this->category_model->get_category_title($id);
        $this->log_model->insert($this->ion_auth->user()->row()->username, '删除了分类"'.$title.'"');

        $this->category_model->delete_category($id);
        $this->session->set_flashdata('success', '删除分类成功');
    }
}