<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function register($username, $password) {
    	return $this->ion_auth->register($username, $password, 'none@none.com', array());
    }

    public function delete($id) {
    	if (!$this->ion_auth->delete_user($id)) {
            return FALSE;
        }

        $this->db->update('question', array('reply_user_id' => 0), array('reply_user_id' => $id));
        return TRUE;
    }

    public function update($id, $password) {
        return $this->ion_auth->update($id, array('password' => $password));
    }
}