<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 前台父控制器
 */
class Home_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("PRC");
    }
}

/**
 * 后台父控制器
 */
class Admin_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("PRC");

        // 当访问管理后台的用户并非管理员时，跳转到登陆页面
        if (!$this->ion_auth->logged_in()) {
            redirect(site_url('login?back_url='.site_url('admin')));
        }
    }
}
