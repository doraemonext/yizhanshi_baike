<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($question_id, $content) {
        return $this->db->insert('feedback', array(
            'question_id' => $question_id,
            'content' => $content,
            'datetime' => mdate('%Y-%m-%d %H:%i:%s', now()),
        ));
    }

    public function get() {
        return $this->db->order_by('datetime', 'desc')->get('feedback')->result_array();
    }
}