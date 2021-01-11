<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mujeeb_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_mujeeb_profile() {
        $mujeeb_id = $this->session->userdata('mujeeb_id');
        return $this->db->get_where('ifta_users', array('user_id' => $mujeeb_id))->row();
    }

    function get_mujeeb_data($where) {
        $mujeeb_id = $this->session->userdata('mujeeb_id');
        $this->db->select('ifta_question.*, ifta_question.date_added as qdate,ifta_question.admin_view_status as qad_v_status,ifta_user_question.*, ifta_user_question.date_added as mdate, ifta_user_question.admin_view_status as mad_v_status');
        $this->db->from('ifta_question');
        $this->db->join('ifta_user_question', 'ifta_user_question.question_id = ifta_question.question_id', 'inner')->distinct();
        $this->db->where('ifta_user_question.user_id', $mujeeb_id);
        $this->db->where($where);
        $this->db->order_by('ifta_user_question.id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_fatawas() {
        $mujeeb_id = $this->session->userdata('mujeeb_id');
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date,ifta_user_question.*, ifta_user_question.date_added as mdate');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'inner')->distinct();
        $this->db->join('ifta_user_question', 'ifta_user_question.question_id = ifta_question.question_id', 'inner')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_user_question.user_id', $mujeeb_id);
        $this->db->order_by('ifta_question.date_added', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function count_questions($where) {
        $this->db->select('*');
        $this->db->from('ifta_user_question');
        $this->db->where('user_id', $this->session->userdata('mujeeb_id'));
        $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function get_all_review() {
        $this->db->select('ifta_fatwa_review.*,ifta_fatwa_review.id as review_id,ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date,ifta_user_question.*, ifta_user_question.date_added as mdate');
        $this->db->from('ifta_fatwa_review');
        $this->db->join('ifta_question', 'ifta_question.question_id = ifta_fatwa_review.question_id', 'inner')->distinct();
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_fatwa_review.question_id', 'inner')->distinct();
        $this->db->join('ifta_user_question', 'ifta_user_question.question_id = ifta_fatwa_review.question_id', 'inner')->distinct();
        $this->db->where('ifta_fatwa_review.mujeeb_id', $this->session->userdata('mujeeb_id'));
        $this->db->order_by('ifta_fatwa_review.date', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

}
