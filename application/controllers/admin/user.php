<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('typography');
        $this->load->helper('date');
    }

    public function index() {
        $data['site_config'] = $this->site_config_model->get_config();
        $data['users'] = $this->ion_auth->users()->result_array();
        $data['page'] = 'user';

        $this->load->view('admin/user', $data);
    }

    public function add() {
        $data['site_config'] = $this->site_config_model->get_config();
        $data['page'] = 'user';

        $this->load->view('admin/user_add', $data);
    }

    public function modify_password($id = '') {
        if (empty($id) || !is_numeric($id)) {
            redirect(site_url('admin'));
        }

        $data['site_config'] = $this->site_config_model->get_config();
        $data['user'] = $this->ion_auth->user($id)->row();
        $data['page'] = 'user';

        $this->load->view('admin/user_modify_password', $data);
    }

    public function modify_password_process() {
        $id = $this->input->post('user-id', TRUE);
        $password = $this->input->post('password', TRUE);

        if ($id === FALSE || $password === FALSE) {
            echo json_content('error', '必须提交密码');
            return;
        }
        if (empty($id) || empty($password)) {
            echo json_content('error', '密码不能为空');
            return;
        }

        if ($this->user_model->update($id, $password)) {
            echo json_content('success');
            $this->session->set_flashdata('success', '管理员信息修改成功');
        } else {
            echo json_content('非常抱歉，用户密码修改失败，请联系管理员');
        }
    }

    public function add_process() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        if ($username === FALSE || $password === FALSE) {
            echo json_content('error', '必须提交用户名和密码');
            return;
        }
        if (empty($username) || empty($password)) {
            echo json_content('error', '用户名和密码不能为空');
            return;
        }
        if ($this->ion_auth->username_check($username)) {
            echo json_content('error', '该用户名已经注册，请更换用户名');
            return;
        }

        if ($this->user_model->register($username, $password)) {
            echo json_content('success');
            $this->session->set_flashdata('success', '管理员添加成功');
        } else {
            echo json_content('error', '非常抱歉，用户注册失败，请联系管理员');
        }
    }

    public function delete_user() {
        $id = $this->input->get('id', TRUE);
        $id = intval($id);

        $user_flag = $this->ion_auth->user($id)->row();
        if (empty($user_flag)) {
            echo json_content('error', '非常抱歉，该用户不存在，请重试');
            return;
        }

        if ($id == $this->ion_auth->user()->row()->id) {
            echo json_content('error', '非常抱歉，不允许删除当前正在登陆的用户');
            return;
        }

        if (!$this->user_model->delete($id)) {
            echo json_content('error', '非常抱歉，删除时发生错误，请重试');
        } else {
            echo json_content('success');
            $this->session->set_flashdata('success', '删除用户成功');
        }
    }
}