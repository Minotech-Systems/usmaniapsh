<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author 	: Ejaz Sunny
 * 	date		: 1st jan, 2019
 * 	iTkoor School managment system
 * 	http://itkoor.com
 * 	imsunny37@gmail.com
 */

class Admission extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    function student_admmission() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['classes'] = $this->db->get_where('class', array('branch_id' => $page_data['branch_id']))->result();
        $page_data['page_name'] = 'admission/student_admission';
        $page_data['page_title'] = get_phrase('admit_student');
        $this->load->view('backend/index', $page_data);
    }

    function admit_student() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $reg = explode('-', $running_year);
        $data['name'] = $this->input->post('name');
        $data['father_name'] = $this->input->post('father_name');
        $data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
        $data['c_address'] = $this->input->post('c_address');
        $data['p_address'] = $this->input->post('p_address');
        $data['country_id'] = $this->input->post('country_id');
        $data['prov_id'] = $this->input->post('province_id');
        $data['dist_id'] = $this->input->post('district_id');
        $data['father_nic'] = $this->input->post('father_nic');
        $data['phone'] = $this->input->post('father_phone');
        $data['test_marks'] = $this->input->post('test_marks');
        $data['admission_date'] = date('Y-m-d');

        $this->db->insert('student', $data);
        $student_id = $this->db->insert_id();
        $reg_no = $reg[1] . $student_id;

        $this->db->where('student_id', $student_id);
        $this->db->update('student', array('reg_no' => $reg_no));

        if (!empty(($_FILES["student_image"]["name"]))) {
            $image_data = $this->crud_model->upload_image('student_image', 'student_image');
            $where = $this->db->where('student_id', $student_id);
            $this->crud_model->update('student', $image_data, $where);
        }

        $data1['student_id'] = $student_id;
        $data1['year'] = $running_year;
        $data1['class_id'] = $this->input->post('class_id');
        $data1['section_id'] = $this->input->post('section_id');
        if ($this->session->userdata('branch_id') == 0) {
            $data1['branch_id'] = $this->input->post('branch_id');
        } else {
            $data1['branch_id'] = $this->session->userdata('branch_id');
        }
        $data1['talimi_saal'] = $talimi_saal;
        $this->db->insert('enroll', $data1);

        $data2['student_id'] = $student_id;
        $data2['nazra_quran'] = $this->input->post('quran_nazra');
        $data2['hifz'] = $this->input->post('hifz');
        $data2['madrasa'] = $this->input->post('madrasa');
        $data2['class'] = $this->input->post('class');
        $data2['school_type'] = $this->input->post('school');
        $data2['school_name'] = $this->input->post('school_name');

        $this->db->insert('student_edu_data', $data2);

        if ($this->input->post('same_as_father')) {
            
        } else {
            $data_g['student_id'] = $student_id;
            $data_g['name'] = $this->input->post('g_name');
            $data_g['father_name'] = $this->input->post('g_pname');
            $data_g['nic'] = $this->input->post('g_nic');
            $data_g['address'] = $this->input->post('g_name');
            $data_g['phone'] = $this->input->post('g_phone');
            $data_g['address'] = $this->input->post('g_address');
            $data_g['country_id'] = $this->input->post('g_country_id');
            $data_g['prov_id'] = $this->input->post('g_province_id');
            $data_g['dist_id'] = $this->input->post('g_district_id');
            $this->db->insert('guardian', $data_g);
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?admission/student_admmission/', 'refresh');
    }

    function edit_student($student_id) {
        $data['name'] = $this->input->post('name');
        $data['father_name'] = $this->input->post('father_name');
        $data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
        $data['c_address'] = $this->input->post('c_address');
        $data['p_address'] = $this->input->post('p_address');
        $data['country_id'] = $this->input->post('country_id');
        $data['prov_id'] = $this->input->post('province_id');
        $data['dist_id'] = $this->input->post('district_id');
        $data['father_nic'] = $this->input->post('father_nic');
        $data['phone'] = $this->input->post('father_phone');
        $data['test_marks'] = $this->input->post('test_marks');
        $data['admission_date'] = date('Y-m-d');

        $this->db->where('student_id', $student_id);
        $this->db->update('student', $data);

        if (!empty(($_FILES["student_image"]["name"]))) {
            $image_data = $this->crud_model->upload_image('student_image', 'student_image');
            $where = $this->db->where('student_id', $student_id);
            $this->crud_model->update('student', $image_data, $where);
        }

        $data2['nazra_quran'] = $this->input->post('quran_nazra');
        $data2['hifz'] = $this->input->post('hifz');
        $data2['madrasa'] = $this->input->post('madrasa');
        $data2['class'] = $this->input->post('class');
        $data2['school_type'] = $this->input->post('school');
        $data2['school_name'] = $this->input->post('school_name');

        $this->db->where('student_id', $student_id);
        $this->db->update('student_edu_data', $data2);

        if ($this->input->post('same_as_father')) {
            
        } else {
            $data_g['student_id'] = $student_id;
            $data_g['name'] = $this->input->post('g_name');
            $data_g['father_name'] = $this->input->post('g_pname');
            $data_g['nic'] = $this->input->post('g_nic');
            $data_g['address'] = $this->input->post('g_name');
            $data_g['phone'] = $this->input->post('g_phone');
            $data_g['address'] = $this->input->post('g_address');
            $data_g['country_id'] = $this->input->post('g_country_id');
            $data_g['prov_id'] = $this->input->post('g_province_id');
            $data_g['dist_id'] = $this->input->post('g_district_id');
            $this->db->insert('guardian', $data_g);
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(base_url() . 'index.php?admin/edit_student/' . $student_id, 'refresh');
    }

    //Delete Student

    function delete_student($student_id) {
        //Delete Enroll Data
        $this->db->where('student_id', $student_id);
        $this->db->delete('enroll');
        //Delete Educational Data
        $this->db->where('student_id', $student_id);
        $this->db->delete('student_edu_data');
        //Delete Student Info
        $this->db->where('student_id', $student_id);
        $this->db->delete('student_edu_data');

        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(base_url() . 'index.php?admin/students/' . $student_id, 'refresh');
    }

    function get_class_section($class_id) {
        $classes = $this->db->get_where('section', array(
                    'class_id' => $class_id
                ))->result_array();
        echo '<option value=""> سیکشن منتخب کریں</option>';
        foreach ($classes as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

}
