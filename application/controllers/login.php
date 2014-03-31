<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Home_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('date');
        $this->load->helper('email');
    }

    public function index() {
        $data['site_config'] = $this->site_config_model->get_config();
        $data['category'] = $this->category_model->get_category();
        $data['category_id'] = -1;
        $data['back_url'] = back_url_trans($this->input->get('back_url', TRUE), current_url());

        if ($this->ion_auth->logged_in()) {
            redirect($data['back_url']);
        }

        $this->load->view('login', $data);
    }

    public function process() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        if (trim($username) == '') {
            echo json_content('error', '用户名不能为空');
            return;
        }
        if (trim($password) == '') {
            echo json_content('error', '密码不能为空');
            return;
        }

        if ($this->ion_auth->login($username, $password)) {
            echo json_content('success');
        } else {
            echo json_content('error', '用户名或密码错误');
        }
    }
}