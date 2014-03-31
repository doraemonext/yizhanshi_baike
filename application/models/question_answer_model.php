<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question_answer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_question_by_id($id) {
        $result = $this->db->get_where('question', array('id' => $id))->result_array();

        if (empty($result)) {
            return $result;
        } else {
            return $result[0];
        }
    }

    public function get_question_by_offset($limit = '', $offset = '') {
        if (empty($limit) && empty($offset)) {
            return $this->db->order_by('datetime', 'desc')->get('question')->result_array();
        } else {
            return $this->db->order_by('datetime', 'desc')->get('question', $limit, $offset)->result_array();
        }
    }

    public function get_question_by_category_offset($category_id, $limit = '', $offset = '') {
        if (empty($limit) && empty($offset)) {
            return $this->db->order_by('datetime', 'desc')->get_where('question', array('category_id' => $category_id))->result_array();
        } else {
            return $this->db->order_by('datetime', 'desc')->get_where('question', array('category_id' => $category_id), $limit, $offset)->result_array();
        }
    }

    public function count_all_question() {
        return $this->db->count_all('question');
    }

    public function count_all_category_question($id) {
        return $this->db->from('question')->where('category_id', $id)->count_all_results();
    }

    public function count_search($content, $category_id) {
        if ($category_id == 0) {
            $sql = 'SELECT * FROM question WHERE title LIKE ? OR reply LIKE ?';
            return $this->db->query($sql, array('%'.$content.'%', '%'.$content.'%'))->num_rows();
        } else {
            $sql = 'SELECT * FROM question WHERE category_id = ? AND (title LIKE ? OR reply LIKE ?)';
            return $this->db->query($sql, array($category_id, '%'.$content.'%', '%'.$content.'%'))->num_rows();
        }
    }

    public function search($content, $category_id, $limit, $offset) {
        if ($category_id == 0) {
            $sql = 'SELECT * FROM question WHERE title LIKE ? OR reply LIKE ? ORDER BY datetime DESC LIMIT ?, ?';
            return $this->db->query($sql, array('%'.$content.'%', '%'.$content.'%', $offset, $limit))->result_array();
        } else {
            $sql = 'SELECT * FROM question WHERE category_id = ? AND (title LIKE ? OR reply LIKE ?) ORDER BY datetime DESC LIMIT ?, ?';
            return $this->db->query($sql, array($category_id, '%'.$content.'%', '%'.$content.'%', $offset, $limit))->result_array();
        }
    }

    public function submit_answer($user_id, $question_id, $title, $category_id, $content) {
        $this->db->update('question', array(
            'reply' => $content,
            'reply_user_id' => $user_id,
            'title' => $title,
            'category_id' => $category_id,
            'reply_status' => 1,
            ), array(
            'id' => $question_id,
            ));
    }

    public function submit_question(&$id, $author, $email, $content, $category_id) {
        $this->db->insert('question', array(
            'title' => $content,
            'author' => $author,
            'author_email' => $email,
            'datetime' => mdate('%Y-%m-%d %H:%i:%s', now()),
            'reply_status' => 0,
            'reply_user_id' => 1,
            'category_id' => $category_id
            ));

        $id = $this->db->insert_id();
    }

    public function delete_question($id) {
        $this->db->delete('question', array('id' => $id));
    }

    public function add_heat($id) {
        $this->db->set('heat', 'heat+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('question');
    }

    public function get_question_by_heat($limit = 10) {
        return $this->db->order_by('heat', 'desc')->get('question', $limit, 0)->result_array();
    }
}