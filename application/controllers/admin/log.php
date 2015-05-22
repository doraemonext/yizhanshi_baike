<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('date');
    }

    public function index() {
        $data['site_config'] = $this->site_config_model->get_config();

        $data['page'] = 'log';
        $data['log'] = $this->log_model->get();

        $this->load->view('admin/log', $data);
    }
}