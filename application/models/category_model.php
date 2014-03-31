<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_category() {
        return $this->db->get('category')->result_array();
    }

    public function get_category_by_id($id) {
        return $this->db->get_where('category', array('id' => $id))->row();
    }

    public function get_category_title($id) {
        return $this->db->get_where('category', array('id' => $id))->row()->title;
    }

    public function delete_category($id) {
    	$this->db->delete('category', array('id' => $id));
        $this->db->delete('question', array('category_id' => $id));
    }

    public function create_category($title) {
        return $this->db->insert('category', array('title' => $title));
    }

    public function update_category($id, $title) {
        return $this->db->update('category', array('title' => $title), array('id' => $id));
    }
}