<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($username, $content) {
        return $this->db->insert('log', array(
            'username' => $username,
            'content' => $content,
            'datetime' => mdate('%Y-%m-%d %H:%i:%s', now()),
        ));
    }

    public function get() {
        return $this->db->order_by('datetime', 'desc')->get('log')->result_array();
    }
}