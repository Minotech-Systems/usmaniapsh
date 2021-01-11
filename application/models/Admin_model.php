<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check($table, $where) {
        $query = $this->db->get_where("$table", $where)->result();
        if (!empty($query)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function get_table_data($table) {
        return $this->db->get("$table")->result();
    }

    function get_ifta_books() {
        return $this->db->get('ifta_books')->result();
    }

    /////Get books lessons data 
    function get_book_lessons() {
        $this->db->select('*');
        $this->db->from('ifta_chapter_lessons');
        $this->db->order_by("book_id", 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    ///Get user data (Mujeed)
    function get_ifta_users() {
        return $this->db->get_where('ifta_users', array('status' => 1))->result();
    }

    // function get_solved_questions() {
    //     $this->db->select('ifta_question.*, ifta_question.date_added as q_date_added,ifta_question.admin_view_status as q_view_status,'
    //             . 'ifta_user_question.*, ifta_user_question.date_added as u_date_added, ifta_user_question.admin_view_status as u_view_status,'
    //             . 'ifta_answer.*, ifta_answer.date_added as ans_date_added');
    //     $this->db->from('ifta_question');
    //     $this->db->join('ifta_user_question', 'ifta_user_question.question_id = ifta_question.question_id ', 'inner')->distinct();
    //     $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id ', 'inner')->distinct();
    //     $this->db->where('ifta_user_question.solved_status', 1);
    //     $this->db->where('ifta_user_question.admin_view_status', 0);
    //     $this->db->order_by("ifta_user_question.submitted_date", 'DESC');
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {

    //         return $query->result();
    //     }
    // }

function get_solved_questions() {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date_added,ifta_question.admin_view_status as q_view_status,'
                . 'ifta_user_question.*, ifta_user_question.date_added as u_date_added, ifta_user_question.admin_view_status as u_view_status,'
                . 'ifta_answer.*, ifta_answer.date_added as ans_date_added');
        $this->db->from('ifta_question');
        $this->db->join('ifta_user_question', 'ifta_user_question.question_id = ifta_question.question_id ', 'inner')->distinct();
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id ', 'inner')->distinct();
        $this->db->where('ifta_user_question.solved_status', 1);
        $this->db->where('ifta_answer.admin_approval', 0);
        $this->db->order_by("ifta_user_question.submitted_date", 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }
    // Get User fatwa data which are solved by the user
    function get_user_question_data($user_id) {
        $this->db->select('ifta_user_question.*, ifta_user_question.date_added as u_date_add, ifta_question.*, ifta_question.date_added as q_date_add,'
                . 'ifta_question.islamic_date as q_islamic_date,ifta_answer.*, ifta_answer.date_added as ans_date_added, ifta_answer.islamic_date as ans_islamic_date');
        $this->db->from('ifta_user_question');
        $this->db->join('ifta_question', 'ifta_question.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->where('ifta_user_question.user_id', $user_id);
        $this->db->order_by('ifta_user_question.id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    // Get user fatwa data according to book
    function get_user_book_question_data($user_id, $book_id) {
        $this->db->select('ifta_user_question.*, ifta_user_question.date_added as u_date_add, ifta_question.*, ifta_question.date_added as q_date_add,'
                . 'ifta_question.islamic_date as q_islamic_date,ifta_answer.*, ifta_answer.date_added as ans_date_added, ifta_answer.islamic_date as ans_islamic_date');
        $this->db->from('ifta_user_question');
        $this->db->join('ifta_question', 'ifta_question.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->where('ifta_user_question.user_id', $user_id);
        $this->db->where('ifta_question.book_id', $book_id);
        $this->db->order_by('ifta_user_question.id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    // Get user fatwa data according to book chapter
    function get_user_cahpter_question_data($user_id, $chapter_id) {
        $this->db->select('ifta_user_question.*, ifta_user_question.date_added as u_date_add, ifta_question.*, ifta_question.date_added as q_date_add,'
                . 'ifta_question.islamic_date as q_islamic_date,ifta_answer.*, ifta_answer.date_added as ans_date_added, ifta_answer.islamic_date as ans_islamic_date');
        $this->db->from('ifta_user_question');
        $this->db->join('ifta_question', 'ifta_question.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->where('ifta_user_question.user_id', $user_id);
        $this->db->where('ifta_question.chapter_id', $chapter_id);
        $this->db->order_by('ifta_user_question.id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    // Get user fatwa data according to book lesson
    function get_user_lesson_question_data($user_id, $lesson_id) {
        $this->db->select('ifta_user_question.*, ifta_user_question.date_added as u_date_add, ifta_question.*, ifta_question.date_added as q_date_add,'
                . 'ifta_question.islamic_date as q_islamic_date,ifta_answer.*, ifta_answer.date_added as ans_date_added, ifta_answer.islamic_date as ans_islamic_date');
        $this->db->from('ifta_user_question');
        $this->db->join('ifta_question', 'ifta_question.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_user_question.question_id ', 'inner')->distinct();
        $this->db->where('ifta_user_question.user_id', $user_id);
        $this->db->where('ifta_question.lesson_id', $lesson_id);
        $this->db->order_by('ifta_user_question.id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

}
