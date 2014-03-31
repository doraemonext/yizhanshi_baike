<?php

class Logout extends Home_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $back_url = back_url_trans($this->input->get('back_url', TRUE), current_url());
        $this->ion_auth->logout();
        redirect($back_url);
    }
}
