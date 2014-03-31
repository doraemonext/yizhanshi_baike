<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_tags_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_search_tags() {
        return $this->db->get('search_tags')->result_array();
    }

    public function get_search_tags_by_id($id) {
        return $this->db->get_where('search_tags', array('id' => $id))->row();
    }

    public function get_search_tags_title($id) {
        return $this->db->get_where('search_tags', array('id' => $id))->row()->title;
    }

    public function delete_search_tags($id) {
        $this->db->delete('search_tags', array('id' => $id));
    }

    public function create_search_tags($title) {
        return $this->db->insert('search_tags', array('title' => $title));
    }

    public function update_search_tags($id, $title) {
        return $this->db->update('search_tags', array('title' => $title), array('id' => $id));
    }
}