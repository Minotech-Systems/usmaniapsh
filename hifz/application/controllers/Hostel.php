<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author 	: Ijaz Sunny
 * 	date		: 27 september, 2016
 * 	iTkoor School Management System Pro
 * 	http://itkoor.com
 * 	imsunny37@gmail.com
 */

class Hostel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function manage_hostel() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['branches'] = $this->db->get('branches')->result();
        $page_data['hostel_rooms'] = $this->hostel_model->get_rooms();
        $page_data['hostels'] = $this->db->get_where('hostel', array('branch_id' => $page_data['login_user_branch']))->result();
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'hostel/manage_hostel';
        $page_data['page_title'] = get_phrase('hostel');
        $this->load->view('backend/index', $page_data);
    }

    function add_hostel() {
        $branch_id = $this->session->userdata('branch_id');
        $data['branch_id'] = $branch_id;
        $data['name'] = $this->input->post('hostel_name');
        if (!empty($data['branch_id']) && !empty($data['name'])) {
            $this->db->insert('hostel', $data);
            $this->session->set_flashdata('flash_message', 'ہاسٹل کا اندراج کامیابی سے کر دیا گیا۔۔۔');
            redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'ہاسٹل کا اندراج صیحح طریقے سے نہیں ہوا۔۔۔۔');
            redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
        }
    }

    function update_hostel($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if (!empty($param1)) {
            $name = $this->input->post('name');
            $this->db->where('id', $param1);
            $this->db->update('hostel', array('name' => $name));
            $this->session->set_flashdata('flash_message', 'ہاسٹل کی تصیحح کامیابی سے کردی گئی ہے۔۔۔');
            redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'Error.!');
            redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
        }
    }

    function add_hostel_floor($param = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if (!empty($param)) {
            $data['hostel_id'] = $param;
            $data['floor_number'] = $this->input->post('floor_num');
            $data['floor_name'] = $this->input->post('floor_name');
            $this->db->insert('hostel_floor', $data);
            $this->session->set_flashdata('flash_message', 'فلورک اندراج کامیابی سے کر دیا گیا۔۔۔');
            redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'Error.!');
            redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
        }
    }

    function delete_hostel_floor($floor_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $this->db->where('id', $floor_id);
        $this->db->delete('hostel_floor');
        $this->session->set_flashdata('flash_message', 'ہاسٹل فلور کو کامیابی سے ختم کر دیا گیا۔۔۔');
        redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
    }

    function get_hostel_floor($hostel_id) {
        $floors = $this->db->get_where('hostel_floor', array('hostel_id' => $hostel_id))->result();
        echo '<option value="">فلور منتخب کریں</option>';
        foreach ($floors as $row) {
            echo '<option value="' . $row->id . '">' . $row->floor_number . ' ' . $row->floor_name . '</option>';
        }
    }

    function get_floor_room($floor_id) {
        $floors = $this->db->get_where('hostel_room', array('floor_id' => $floor_id))->result();
        echo '<option value="">روم منتخب کریں</option>';
        foreach ($floors as $row) {
            echo '<option value="' . $row->id . '">' . $row->room_number . '</option>';
        }
    }

    function add_hostel_room() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['hostel_id'] = $this->input->post('hostel_id');
        $data['floor_id'] = $this->input->post('floor_id');
        $data['room_number'] = $this->input->post('room');
        $data['branch_id'] = $this->hostel_model->get_branch_id($data['hostel_id']);
        $this->db->insert('hostel_room', $data);
        $this->session->set_flashdata('flash_message', 'ہاسٹل روم کامیابی سے شامل کر دیا گیا۔۔۔۔');
        redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
    }

    function room_update($param = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $data['hostel_id'] = $this->input->post('hostel_id');
        $data['floor_id'] = $this->input->post('floor_id');
        $data['room_number'] = $this->input->post('room_number');

        $this->db->where('id', $param);
        $this->db->update('hostel_room', $data);

        $this->session->set_flashdata('flash_message', 'روم کی تصیحح کامیابی سے کر دی گئی ہے۔۔۔۔');
        redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
    }

    function hostel_student() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $branch_id = $this->session->userdata('branch_id');
        $page_data['hostels'] = $this->db->get_where('hostel', array('branch_id' => $branch_id))->result();
        $page_data['hostel_rooms'] = $this->hostel_model->get_rooms();
        $page_data['students'] = $this->hostel_model->get_branch_students($branch_id, $year);
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['login_user_branch'] = $this->session->userdata('login_user_branch');
        $page_data['page_name'] = 'hostel/hostel_student';
        $page_data['page_title'] = get_phrase('hostel_student');
        $this->load->view('backend/index', $page_data);
    }

    function add_student_to_room() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $student_id = $this->input->post('student_id');
        foreach ($student_id as $std_data) {
            $enroll_data = $this->db->get_where('enroll', array('student_id' => $std_data, 'year' => $year))->row();
            $data['student_id'] = $std_data;
            $data['class_id'] = $enroll_data->class_id;
            $data['section_id'] = $enroll_data->section_id;
            $data['teacher_id'] = $enroll_data->teacher_id;
            $data['year'] = $year;
            $data['talimi_saal'] = $talimi_saal;
            $data['hostel_id'] = $this->input->post('hostel_id');
            $data['floor_id'] = $this->input->post('floor_id');
            $data['room_id'] = $this->input->post('room_id');
            $data['branch_id'] = $enroll_data->branch_id;

            $this->db->insert('hostel_students', $data);
        }
        $this->session->set_flashdata('flash_message', 'طلباء کو کامیابی سے کمرہ میں داخل کردیا گیا');
        redirect(base_url() . 'index.php?hostel/hostel_student/', 'refresh');
    }

    function delete_student_room($student_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->where('student_id', $student_id);
        $this->db->where('year', $year);
        $this->db->delete('hostel_students');
        $this->session->set_flashdata('flash_message', 'طالب علم کو کامیابی سے نکال دیا گیا۔۔۔');
        redirect(base_url() . 'index.php?hostel/hostel_student/', 'refresh');
    }

    function add_room_leader() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $leader_id = $this->input->post('leader_id');
        $this->db->where('id', $leader_id);
        $this->db->update('hostel_students', array('leader' => 1));

        $this->session->set_flashdata('flash_message', 'امیر کو کامیابی سے داخل کردیا گیا۔۔۔');
        redirect(base_url() . 'index.php?hostel/hostel_student/', 'refresh');
    }

    function add_room_pro_leader() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $leader_id = $this->input->post('proleader_id');
        $this->db->where('id', $leader_id);
        $this->db->update('hostel_students', array('pro_leader' => 1));

        $this->session->set_flashdata('flash_message', 'معاون کو کامیابی سے داخل کردیا گیا۔۔۔');
        redirect(base_url() . 'index.php?hostel/hostel_student/', 'refresh');
    }

    function delete_room($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $this->db->where('id', $param1);
        $this->db->delete('hostel_room');

        $this->db->where('room_id', $param1);
        $this->db->delete('hostel_students');

        $this->session->set_flashdata('flash_message', 'روم کو کامیابی سے ختم کر دیا گیا۔۔۔۔۔');
        redirect(base_url() . 'index.php?hostel/manage_hostel/', 'refresh');
    }

    //Reports
    function hostel_student_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['hostels'] = $this->db->get_where('hostel', array('branch_id' => $page_data['login_user_branch']))->result();

        if (!empty($this->input->post('hostel_id'))) {
            $page_data['hostel_id'] = $this->input->post('hostel_id');
            $page_data['floor_id'] = $this->input->post('floor_id');
        }

        $page_data['page_name'] = 'hostel/hostel_student_report';
        $page_data['page_title'] = get_phrase('hostel_student_report');
        $this->load->view('backend/index', $page_data);
    }

    function print_hostel_report($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if (!empty($param1) && empty($param2)) {
            $data['hostel_id'] = $param1;
            $this->load->view('backend/admin/hostel/print_hostel_report', $data);
        }
        if (!empty($param1) && !empty($param2)) {
            $data['hostel_id'] = $param1;
            $data['floor_id'] = $param2;
            $this->load->view('backend/admin/hostel/print_floor_report', $data);
        }
    }

}
