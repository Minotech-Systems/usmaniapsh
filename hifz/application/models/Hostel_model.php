<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hostel_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function get_rooms() {
        $this->db->order_by('hostel_id', 'ASC');
        $branch_id = $this->session->userdata('branch_id');
        $query = $this->db->get_where('hostel_room', array('branch_id' => $branch_id))->result();
        if (!empty($query)) {
            return $query;
        }
    }

    function get_room($room_id) {
        return $this->db->get_where('hostel_room', array('id' => $room_id))->row()->room_number;
    }

    //Get Hostel Floor for room
    function get_hostel_floor($floor_id) {
        return $this->db->get_where('hostel_floor', array('id' => $floor_id))->row()->floor_number;
    }

    function get_hostel_name($hostel_id) {
        return $this->db->get_where('hostel', array('id' => $hostel_id))->row()->name;
    }

    function get_branch_id($hostel_id) {
        return $this->db->get_where('hostel', array('id' => $hostel_id))->row()->branch_id;
    }

    function get_branch_students($branch_id, $year) {
        $this->db->select('enroll.*, student.*');
        $this->db->from('enroll');
        $this->db->join('student', 'student.student_id = enroll.student_id', 'inner')->distinct();
        $this->db->where(array(
            'enroll.branch_id' => $branch_id,
            'enroll.status' => 1,
            'enroll.year' => $year));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_room_students($room_id, $year) {
        $this->db->select('hostel_students.*, student.*');
        $this->db->from('hostel_students');
        $this->db->join('student', 'student.student_id = hostel_students.student_id', 'inner')->distinct();
        $this->db->where(array(
            'hostel_students.room_id' => $room_id,
            'hostel_students.year' => $year));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_floor_students($hostel_id, $floor_id, $room_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('hostel_students.*, student.*, enroll.*');
        $this->db->from('hostel_students');
        $this->db->join('student', 'student.student_id = hostel_students.student_id', 'inner')->distinct();
        $this->db->join('enroll', 'enroll.student_id = hostel_students.student_id', 'inner')->distinct();
        $this->db->where(array(
            'hostel_students.hostel_id' => $hostel_id,
            'hostel_students.room_id' => $room_id,
            'hostel_students.floor_id' => $floor_id,
            'hostel_students.year' => $year,
            'enroll.year' => $year));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

}
