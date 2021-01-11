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

class Newadmission extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('newadmission_model');

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_admission_id') == 1)
            redirect(base_url() . 'index.php?newadmission/dashboard', 'refresh');
    }

    public function dashboard() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('new_admission');
        $this->load->view('backend/index', $page_data);
    }

    function admit_student($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        if ($param1 == 'admit') {
            $s_data['name'] = $this->input->post('name');
            $s_data['father_name'] = $this->input->post('parent');
            $s_data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
            $s_data['c_address'] = $this->input->post('c_address');
            $s_data['p_address'] = $this->input->post('p_address');
            $s_data['phone'] = $this->input->post('phone');
            $s_data['country_id'] = $this->input->post('country_id');
            $s_data['prov_id'] = $this->input->post('province_id');
            $s_data['dist_id'] = $this->input->post('district_id');
            $s_data['gender'] = $this->input->post('gender');
            $s_data['reg_no'] = $this->input->post('reg_no');
            $s_data['admission_date'] = date('Y-m-d');
            $s_data['test_marks'] = $this->input->post('test_marks');
            $s_data['father_nic'] = $this->input->post('father_nic');



            $this->db->insert('new_student', $s_data);
            $student_id = $this->db->insert_id();
            $image = $_FILES["student_image"]["name"];


            if (!empty($image)) {
                $image_data = $this->crud_model->do_resize('new_admission_image');
                $where = $this->db->where('student_id', $student_id);
                $this->crud_model->update('new_student', $image_data, $where);
            }

            $en_data['branch_id'] = $this->input->post('branch_id');
            $en_data['class_id'] = $this->db->get_where('class', array('branch_id' => $en_data['branch_id']))->row()->class_id;
            $en_data['section_id'] = $this->db->get_where('section', array('class_id' => $en_data['class_id']))->row()->section_id;
            $en_data['student_id'] = $student_id;
            $en_data['year'] = $running_year;
            $en_data['talimi_saal'] = $talimi_saal;
            $this->db->insert('new_enroll', $en_data);

            $fee = $this->input->post('month');
            if (!empty($fee)) {
                $amount = $this->input->post('amount');
                foreach ($fee as $months) {
                    $f_data['student_id'] = $student_id;
                    $f_data['month'] = $months;
                    $f_data['amount'] = $amount;
                    $f_data['branch_id'] = $this->input->post('branch_id');
                    $f_data['year'] = $running_year;

                    $this->db->insert('new_student_transaction', $f_data);
                }
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?newadmission/admit_student/', 'refresh');
        }

        if ($param1 == 'update') {
            $s_data['name'] = $this->input->post('name');
            $s_data['father_name'] = $this->input->post('parent');
            $s_data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
            $s_data['c_address'] = $this->input->post('c_address');
            $s_data['p_address'] = $this->input->post('p_address');
            $s_data['phone'] = $this->input->post('phone');
            $s_data['country_id'] = $this->input->post('country_id');
            $s_data['prov_id'] = $this->input->post('province_id');
            $s_data['dist_id'] = $this->input->post('district_id');
            $s_data['gender'] = $this->input->post('gender');
            $s_data['reg_no'] = $this->input->post('reg_no');
            $s_data['test_marks'] = $this->input->post('test_marks');
            $s_data['father_nic'] = $this->input->post('father_nic');

            //Update Student Profile
            $this->db->where('student_id', $param2);
            $this->db->update('new_student', $s_data);

            $en_data['branch_id'] = $this->input->post('branch_id');
            $en_data['class_id'] = $this->db->get_where('class', array('branch_id' => $en_data['branch_id']))->row()->class_id;
            $en_data['section_id'] = $this->db->get_where('section', array('class_id' => $en_data['class_id']))->row()->section_id;
            $en_data['student_id'] = $param2;
            $en_data['year'] = $running_year;
            //Update Enroll data
            $this->db->where('student_id', $param2);
            $this->db->where('year', $running_year);
            $this->db->update('new_enroll', $en_data);

            $enroll_student_id1 = $this->db->get_where('new_enroll', array('student_id' => $param2, 'year' => $running_year))->row()->enroll_student_id;
            if (!empty($enroll_student_id1)) {
                $this->db->where('student_id', $enroll_student_id1);
                $this->db->update('student', array('dob' => date('Y-m-d', strtotime($this->input->post('dob'))), 'phone' => $this->input->post('phone'), 'father_nic' => $this->input->post('father_nic')));
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?newadmission/edit_student_profile/' . $param2, 'refresh');
        }
        $page_data['page_name'] = 'admit_student';
        $page_data['page_title'] = get_phrase('admit_student');
        $this->load->view('backend/index', $page_data);
    }

    function update_student_image($param1 = '') {
        if (isset($_FILES["student_image"]["name"])) {

            $image_data = $this->crud_model->upload_image('new_admission_image', 'student_image');

            // delete the old image from folder through its type and image name
            $image = $this->db->get_where('new_student', array('student_id' => $param1))->row()->image;
            $this->crud_model->unlink('new_admission', $image);

            $where = $this->db->where('student_id', $param1);
            $this->crud_model->update('new_student', $image_data, $where);
        }

        $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
        redirect(base_url() . 'index.php?newadmission/student_information/', 'refresh');
    }

    function student_information() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if (!empty($this->input->post('branch_id'))) {
            $branch_id = $this->input->post('branch_id');
            $page_data['students'] = $this->newadmission_model->getbranch_student_info($running_year, $branch_id);
            $page_data['branch'] = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        }
        $page_data['page_name'] = 'student_information';
        $page_data['page_title'] = get_phrase('student_information');
        $this->load->view('backend/index', $page_data);
    }

    function edit_student_profile($param1 = '') {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['student_name'] = $this->db->get_where('new_student', array('student_id' => $param1))->row()->name;
        $page_data['student_data'] = $this->newadmission_model->get_student_data($param1);
        $page_data['student_id'] = $param1;
        $page_data['page_name'] = 'edit_student_profile';
        $page_data['page_title'] = get_phrase('edit_student_profile');
        $this->load->view('backend/index', $page_data);
    }

    function delete_student($student_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');
        //Delete Fee data 
        $this->db->where('student_id', $student_id);
        $this->db->delete('new_student_transaction');
        // delete enroll data
        $this->db->where('student_id', $student_id);
        $this->db->delete('new_enroll');
        // Delete student info
        $this->db->where('student_id', $student_id);
        $this->db->delete('new_student');
        $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
        redirect(base_url() . 'index.php?newadmission/student_information/', 'refresh');
    }

    function get_province($country_id) {
        $prov = $this->db->get_where('province', array(
                    'country_id' => $country_id
                ))->result_array();
        echo '<option value=""> صوبہ منتخب کریں</option>';
        foreach ($prov as $row) {
            echo '<option value="' . $row['prov_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_districts($prov_id) {
        $districts = $this->db->get_where('district', array('prov_id' => $prov_id))->result_array();
        echo '<option value=""> ضلع منتخب کریں</option>';
        foreach ($districts as $row) {
            echo '<option value="' . $row['dist_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class($branch_id) {
        $districts = $this->db->get_where('class', array('branch_id' => $branch_id))->result_array();
        echo '<option value=""> کلاس منتخب کریں</option>';
        foreach ($districts as $row) {
            echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function end_of_admission($param1 = '') {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');


        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if (!empty($this->input->post('branch_id'))) {
            $page_data['branch_id1'] = $this->input->post('branch_id');
            $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $page_data['branch_id1']))->row()->name;
            $page_data['students'] = $this->newadmission_model->getbranch_student_info($running_year, $page_data['branch_id1']);
        }

        if (is_numeric($param1)) {
            $page_data['branch_id1'] = $param1;
            $page_data['branch_name'] = $this->db->get_where('branches', array('branch_id' => $param1))->row()->name;
            $page_data['students'] = $this->newadmission_model->getbranch_student_info($running_year, $param1);
        }
        if ($param1 == 'confirm') {
            $students = $this->input->post('student_id');

//            $this->newadmission_model->dummy();
//            die;
            foreach ($students as $data) {
                $student_data = $this->db->get_where('new_student', array('student_id' => $data))->row();
                $image = '';
                $image = $student_data->image;
                //Student Info Data
                $std_data['name'] = $student_data->name;
                $std_data['father_name'] = $student_data->father_name;
                $std_data['image'] = $student_data->image;
                $std_data['dob'] = $student_data->dob;
                $std_data['c_address'] = $student_data->c_address;
                $std_data['p_address'] = $student_data->p_address;
                $std_data['phone'] = $student_data->phone;
                $std_data['country_id'] = $student_data->country_id;
                $std_data['prov_id'] = $student_data->prov_id;
                $std_data['dist_id'] = $student_data->dist_id;
                $std_data['gender'] = $student_data->gender;
                $std_data['test_marks'] = $student_data->test_marks;
                $std_data['admission_date'] = $student_data->admission_date;
                $std_data['father_nic'] = $student_data->father_nic;
                //Insert student Info data
                $this->db->insert('student', $std_data);
                $student_id = $this->db->insert_id();

                $enroll_data = $this->db->get_where('new_enroll', array('student_id' => $data, 'year' => $running_year))->row();
                //Student Enroll data
                $en_data['student_id'] = $student_id;
                $en_data['class_id'] = $enroll_data->class_id;
                $en_data['section_id'] = $enroll_data->section_id;
                $en_data['branch_id'] = $enroll_data->branch_id;
                $en_data['year'] = $enroll_data->year;
                $en_data['talimi_saal'] = $enroll_data->talimi_saal;
                $this->db->insert('enroll', $en_data);
                //Update Enroll for admission confrimation 
                $this->db->where('student_id', $data);
                $this->db->where('year', $running_year);
                $this->db->update('new_enroll', array('enroll_status' => 0, 'enroll_student_id' => $student_id));

                //Get Student Fee data if any

                $fee_data = $this->db->get_where('new_student_transaction', array('student_id' => $data, 'year' => $running_year))->result();
                if (!empty($fee_data)) {
                    foreach ($fee_data as $fe_d) {
                        $fee['student_id'] = $student_id;
                        $fee['branch_id'] = $fe_d->branch_id;
                        $fee['month'] = $fe_d->month;
                        $fee['year'] = $fe_d->year;
                        $fee['amount'] = $fe_d->amount;
                        $fee['date'] = date('Y-m-d');

                        $this->db->insert('student_transaction', $fee);
                    }
                }

                $student_fee = $this->db->get_where('new_student_transaction', array('student_id' => $data, 'year' => $running_year))->row();
                if (!empty($student_fee)) {
                    $std_fee['student_id'] = $student_id;
                    $std_fee['teacher_id'] = 0;
                    $std_fee['section_id'] = $enroll_data->section_id;
                    $std_fee['branch_id'] = $enroll_data->branch_id;
                    $std_fee['year'] = $running_year;
                    $std_fee['amount'] = $student_fee->amount;
                    $std_fee['sponsor_id'] = 0;

                    $this->db->insert('student_fee', $std_fee);
                }

                $data2['student_id'] = $student_id;
                $data2['nazra_quran'] = '';
                $data2['hifz'] = '';
                $data2['madrasa'] = '';
                $data2['class'] = '';
                $data2['school_type'] = '';
                $data2['school_name'] = '';

                $this->db->insert('student_edu_data', $data2);

                $imagePath = $this->crud_model->get_image_url('new_admission', $image);
                $newPath = "uploads/student_image/";
                $newName = $newPath . $image;
                copy($imagePath, $newName);
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?newadmission/end_of_admission/' . $enroll_data->branch_id, 'refresh');
        }
        $page_data['page_name'] = 'end_of_admission';
        $page_data['page_title'] = get_phrase('end_of_admission');
        $this->load->view('backend/index', $page_data);
    }

    function delete_new_enroll($student_id, $enroll_student_id) {
        $this->db->where('student_id', $enroll_student_id);
        $this->db->delete('enroll');

        $this->db->where('student_id', $enroll_student_id);
        $this->db->delete('student');

        $this->db->where('student_id', $enroll_student_id);
        $this->db->delete('student_fee');

        $this->db->where('student_id', $enroll_student_id);
        $this->db->delete('student_transaction');

        $this->db->where('student_id', $student_id);
        $this->db->update('new_enroll', array('enroll_status' => 1, 'enroll_student_id' => 0));

        $branch_id = $this->db->get_where('new_enroll', array('student_id', $student_id))->row()->branch_id;

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?newadmission/end_of_admission/' . $branch_id, 'refresh');
    }

    /*     * ******* REPORTS ******** */

    function new_admit_students_report() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if (!empty($this->input->post('branch_id'))) {
            $page_data['branch_id1'] = $this->input->post('branch_id');
            $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $page_data['branch_id1']))->row()->name;
            $page_data['students'] = $this->newadmission_model->get_enrolledstudent_info($running_year, $page_data['branch_id1']);
        }
        $page_data['page_name'] = 'reports/new_admit_students_report';
        $page_data['page_title'] = get_phrase('student_information');
        $this->load->view('backend/index', $page_data);
    }

    function select_student_report() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if (!empty($this->input->post('branch_id'))) {
            $page_data['branch_id1'] = $this->input->post('branch_id');
            $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $page_data['branch_id1']))->row()->name;
            $page_data['students'] = $this->newadmission_model->get_select_std_info($running_year, $page_data['branch_id1']);
        }
        $page_data['page_name'] = 'reports/select_student_report';
        $page_data['page_title'] = get_phrase('student_information');
        $this->load->view('backend/index', $page_data);
    }

    function print_select_student_report($branch_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['branch_id1'] = $branch_id;
        $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        $page_data['students'] = $this->newadmission_model->get_select_std_info($running_year, $branch_id);
        $page_data['page_title'] = get_phrase('student_information');
        $this->load->view('backend/newadmission/reports/print_select_student_report', $page_data);
    }

    function print_admit_student_report($branch_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['branch_id1'] = $branch_id;
        $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        $page_data['students'] = $this->newadmission_model->get_enrolledstudent_info($running_year, $branch_id);
        $page_data['page_title'] = get_phrase('student_information');
        $this->load->view('backend/newadmission/reports/print_admit_student_report', $page_data);
    }

    function new_students_ajmali_report() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $branch_id = $this->input->post('branch_id');
        if (!empty($branch_id)) {
            $page_data['branch_id1'] = $branch_id;
            $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        }

        $page_data['page_name'] = 'reports/new_students_ajmali_report';
        $page_data['page_title'] = get_phrase('new_students_ajmali_report');
        $this->load->view('backend/index', $page_data);
    }

    function new_students_ajmali_report_print($param1) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_title'] = 'نیاء طلباء اجمالی رپورٹ';
        $page_data['param1'] = $param1;
        $this->load->view('backend/newadmission/reports/new_students_ajmali_report_print', $page_data);
    }

    function old_student_ajmali_report() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');
        if (!empty($this->input->post('branch_id'))) {
            $page_data['branch_id1'] = $this->input->post('branch_id');
            $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $page_data['branch_id1']))->row()->name;
        }

        $page_data['page_title'] = get_phrase('old_student_ajmali_report');
        $page_data['page_name'] = 'reports/old_student_ajmali_report';
        $this->load->view('backend/index', $page_data);
    }

    function old_student_ajmali_report_print($value) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_title'] = 'تجدید رپورٹ';
        $page_data['branch_id'] = $value;
        $page_data['branch_name'] = $this->db->get_where('branches', array('branch_id' => $value))->row()->name;
        $this->load->view('backend/newadmission/reports/old_student_ajmali_report_print', $page_data);
    }

    function print_admission_from($student_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_title'] = 'ایڈمیشن فارم';
        $page_data['student_id'] = $student_id;
        $this->load->view('backend/newadmission/reports/print_admission_from', $page_data);
    }

    function get_branch_teacher($branch_id) {
        $teachers = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result_array();
        echo '<option value=""> استاد منتخب کریں</option>';
        foreach ($teachers as $row) {
            echo '<option value="' . $row['teacher_id'] . '">' . $row['name'] . '</option>';
        }
    }

    /*     * ******* OLD STUDENTS PROMOTION START*************** */

    function old_student_promotion() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $page_data['running_year'] = $running_year;
        $page_data['page_name'] = 'old_student_promotion';
        $page_data['page_title'] = 'تجد ید قدیم طلباء';
        $this->load->view('backend/index', $page_data);
    }

    function get_students_to_promote($branch_id, $teacher_id, $year) {
        $years = explode('-', $year);
        $y1 = ($years[0]) - 1;
        $y2 = ($years[1]) - 1;
        $pre_year = $y1 . '-' . $y2;

        $page_data['prev_year'] = $pre_year;
        $page_data['branch_id'] = $branch_id;
        $page_data['teacher_id'] = $teacher_id;

        $page_data['running_year'] = $year;
        $this->load->view('backend/newadmission/student_promotion_selector', $page_data);
    }

    function promote_old_students() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $pre_year = explode('-', $running_year);
        $previous_year = ($pre_year[0] - 1) . '-' . ($pre_year[1] - 1);
        $students = $this->input->post('check_list');

        foreach ($students as $st_data) {
            $enroll_data = $this->db->get_where('enroll', array('year' => $previous_year, 'student_id' => $st_data))->row();

            $admit_data['student_id'] = $enroll_data->student_id;
            $admit_data['class_id'] = $enroll_data->class_id;
            $admit_data['section_id'] = $enroll_data->section_id;
            $admit_data['year'] = $running_year;
            $admit_data['teacher_id'] = $enroll_data->teacher_id;
            $admit_data['branch_id'] = $enroll_data->branch_id;
            $admit_data['talimi_saal'] = $talimi_saal;
            $admit_data['status'] = 1;

            $this->db->insert('enroll', $admit_data);

            $std_fee_data = $this->db->get_where('student_fee', array('student_id' => $st_data))->row();

            if (!empty($std_fee_data)) {
                $std_fee['student_id'] = $st_data;
                $std_fee['teacher_id'] = $std_fee_data->teacher_id;
                $std_fee['section_id'] = $std_fee_data->section_id;
                $std_fee['branch_id'] = $std_fee_data->branch_id;
                $std_fee['year'] = $running_year;
                $std_fee['amount'] = $std_fee_data->amount;
                $std_fee['sponsor_id'] = $std_fee_data->sponsor_id;

                $this->db->insert('student_fee', $std_fee);
            }
        }
        $this->session->set_flashdata('flash_message', get_phrase('student_promoted_succesfully'));
        redirect(base_url() . 'index.php?newadmission/old_student_promotion/', 'refresh');
    }

    function delete_promotion($student_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->where('year', $running_year);
        $this->db->where('student_id', $student_id);
        $this->db->delete('enroll');

        $this->db->where('year', $running_year);
        $this->db->where('student_id', $student_id);
        $this->db->delete('student_fee');

        $this->session->set_flashdata('flash_message', get_phrase('student_deleted_succesfully'));
        redirect(base_url() . 'index.php?newadmission/old_student_promotion/', 'refresh');
    }

    function old_student_promotion_report() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if (!empty($this->input->post('branch_id'))) {
            $page_data['branch_id1'] = $this->input->post('branch_id');
            $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $page_data['branch_id1']))->row()->name;
            $page_data['students'] = $this->newadmission_model->get_student_info($running_year, $page_data['branch_id1']);
        }
        $page_data['page_name'] = 'reports/old_student_promotion_report';
        $page_data['page_title'] = 'رپورٹ تجد ید قدیم طلباء';
        $this->load->view('backend/index', $page_data);
    }

    function print_old_student_promotion_report($branch_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_title'] = 'تجدید رپورٹ';
        $page_data['branch_id'] = $branch_id;
        $page_data['branch_name1'] = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        $this->load->view('backend/newadmission/reports/print_old_student_promotion_report', $page_data);
    }

    /*     * ******* OLD STUDENTS PROMOTION END*************** */

    function add_student_monthly_fee() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $fee = $this->input->post('month');
        $student_id = $this->input->post('student_id');
        if (!empty($fee)) {
            $amount = $this->input->post('amount');
            foreach ($fee as $months) {
                $f_data['student_id'] = $student_id;
                $f_data['month'] = $months;
                $f_data['amount'] = $amount;
                $f_data['branch_id'] = $this->input->post('branch_id');
                $f_data['year'] = $running_year;

                $this->db->insert('new_student_transaction', $f_data);
            }


            $std_fee['student_id'] = $student_id;
            $std_fee['year'] = $running_year;
            $std_fee['amount'] = $amount;
            $check_fee = $this->db->get_where('new_student_fee', array('student_id' => $student_id))->row();
            if (!empty($check_fee)) {
                $this->db->where('student_id', $student_id);
                $this->db->update('new_student_fee', array('amount' => $amount));
            } else {
                $this->db->insert('new_student_fee', $std_fee);
            }
            $this->session->set_flashdata('flash_message', get_phrase('student_added_succesfully'));
            redirect(base_url() . 'index.php?newadmission/student_fee/' . $student_id, 'refresh');
        } else {
            $std_fee['student_id'] = $student_id;
            $std_fee['year'] = $running_year;
            $std_fee['amount'] = $this->input->post('amount');
            $check_fee = $this->db->get_where('new_student_fee', array('student_id' => $student_id))->row();
            if (!empty($check_fee)) {
                $this->db->where('student_id', $student_id);
                $this->db->update('new_student_fee', array('amount' => $this->input->post('amount')));
            } else {
                $this->db->insert('new_student_fee', $std_fee);
            }

            $this->session->set_flashdata('flash_message', get_phrase('student_added_succesfully'));
            redirect(base_url() . 'index.php?newadmission/student_fee/' . $student_id, 'refresh');
        }
    }

    function student_fee($student_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['student_id'] = $student_id;
        $page_data['page_name'] = 'student_fee';
        $page_data['page_title'] = 'طلباء فیس';
        $this->load->view('backend/index', $page_data);
    }

    function edit_student_fee() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $student_id = $this->input->post('student_id');
        $fee = $this->input->post('fee');
        $this->db->where('student_id', $student_id);
        $this->db->where('year', $running_year);
        $this->db->update('new_student_transaction', array('amount' => $fee));

        $this->session->set_flashdata('flash_message', get_phrase('student_updated_succesfully'));
        redirect(base_url() . 'index.php?newadmission/student_fee/' . $student_id, 'refresh');
    }

    function fee_system() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'fee_system';
        $page_data['page_title'] = 'طلباء فیس';
        $this->load->view('backend/index', $page_data);
    }

    function add_other_fee() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');
        $data['name'] = $this->input->post('name');
        $data['amount'] = $this->input->post('amount');
        $data['branch_id'] = $this->input->post('branch_id');
        $data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->insert('new_other_fee', $data);

        $this->session->set_flashdata('flash_message', get_phrase('student_added_succesfully'));
        redirect(base_url() . 'index.php?newadmission/fee_system/', 'refresh');
    }

    function update_other_fee() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $data['name'] = $this->input->post('name');
        $data['amount'] = $this->input->post('amount');
        $data['branch_id'] = $this->input->post('branch_id');
        $fee_id = $this->input->post('fee_id');
        $this->db->where('id', $fee_id);
        $this->db->update('new_other_fee', $data);

        $this->session->set_flashdata('flash_message', get_phrase('student_added_succesfully'));
        redirect(base_url() . 'index.php?newadmission/fee_system/', 'refresh');
    }

    function add_other_transaction() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $branch_id = $this->input->post('branch_id');
        $other_fee = $this->db->get_where('new_other_fee', array('branch_id' => $branch_id, 'year' => $running_year))->result();
        $student_id = $this->input->post('student_id');
        foreach ($other_fee as $fee) {
            $data['fee_id'] = $fee->id;
            $data['amount'] = $this->input->post("amount_$fee->id");
            $check = $this->db->get_where('new_other_fee_transaction', array('student_id' => $student_id, 'fee_id' => $fee->id))->result();
            if (!empty($check)) {
                $this->db->where('fee_id', $fee->id);
                $this->db->update('new_other_fee_transaction', array('amount' => $this->input->post("amount_$fee->id")));
            } else {
                $data['student_id'] = $student_id;
                $data['branch_id'] = $branch_id;
                $data['date'] = date('Y-m-d');
                $data['year'] = $running_year;
                $this->db->insert('new_other_fee_transaction', $data);
            }
        }
        $this->session->set_flashdata('flash_message', get_phrase('student_added_succesfully'));
        redirect(base_url() . 'index.php?newadmission/student_fee/' . $student_id, 'refresh');
    }

    function delete_other_fee($param1) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $this->db->where('fee_id', $param1);
        $this->db->delete('new_other_fee_transaction');

        $this->db->where('id', $param1);
        $this->db->delete('new_other_fee');
        $this->session->set_flashdata('flash_message', get_phrase('student_deleted_succesfully'));
        redirect(base_url() . 'index.php?newadmission/fee_system/', 'refresh');
    }

    function fee_report() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['param1'] = $this->input->post('branch_id');
        $page_data['page_name'] = 'fee_report';
        $page_data['page_title'] = 'طلباء فیس';
        $this->load->view('backend/index', $page_data);
    }

    function print_fee_report() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->load->view('backend/newadmission/reports/print_fee_report', $data);
    }

    function enrolled_student_sms() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        if (!empty($this->input->post('branch_id1'))) {
            $page_data['branch_id1'] = $this->input->post('branch_id1');
        }

        $page_data['page_name'] = 'enrolled_student_sms';
        $page_data['page_title'] = 'طلباء پیغام';
        $this->load->view('backend/index', $page_data);
    }

    function get_class_students_mass($branch_id) {

        $page_data['branch_id'] = $branch_id;
        $this->load->view('backend/newadmission/student_for_sms', $page_data);
    }

    function print_reg_form($student_id) {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $page_data['student_data'] = $this->newadmission_model->get_student_data($student_id);
        $page_data['tamlimi_saal'] = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        $this->load->view('backend/newadmission/print_reg_form', $page_data);
    }

}
