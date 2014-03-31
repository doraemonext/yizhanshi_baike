<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_config_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_config($option_name = '') {
        if (empty($option_name)) {
            $query = $this->db->get('option');
        } else {
            $query = $this->db->get_where('option', array('option_name' => $option_name));
        }

        $result = $query->result();
        $config = array();
        foreach ($result as $row) {
            $config[$row->option_name] = $row->option_value;
        }

        return $config;
    }

    public function update_config($data) {
        $this->db->update('option', array('option_value' => $data['title']), array('option_name' => 'site_title'));
        $this->db->flush_cache();
        $this->db->update('option', array('option_value' => $data['pagination']), array('option_name' => 'pagination_number'));
    }
}