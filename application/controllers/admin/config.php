<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('typography');
        $this->load->helper('date');
    }

    public function index() {
        $data['site_config'] = $this->site_config_model->get_config();

        $data['page'] = 'config';

        $this->load->view('admin/config', $data);
    }

    public function process() {
        $title = $this->input->post('title', TRUE);
        $pagination = $this->input->post('pagination', TRUE);

        if ($title === FALSE) {
            echo json_content('error', '网站名称不能为空');
            return;
        }
        if ($pagination === FALSE) {
            echo json_content('error', '每页显示问题数目不能为空');
            return;
        }

        if (!is_numeric($pagination)) {
            echo json_content('error', '每页显示问题数目必须是一个整数');
            return;
        }

        $this->site_config_model->update_config(array(
            'title' => $title,
            'pagination' => $pagination,
            ));
        echo json_content('success');
	$this->session->set_flashdata('success', '系统设定更新成功');
    }
}