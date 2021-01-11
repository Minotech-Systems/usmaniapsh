<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  @author   : itkoor
 *  date      : November, 2020
 *  iTkoor School Management System
 *  http://softsunny.com    
 *  imsunny37@gmail.com
 */

class User_model extends CI_Model {

//    protected $school_id;
//    protected $active_session;

    public function __construct() {
        parent::__construct();
//        $this->school_id = school_id();
//        $this->active_session = active_session();
    }

    // GET SUPERADMIN DETAILS
    public function get_superadmin() {
        $this->db->where('role', 'superadmin');
        return $this->db->get('users')->row_array();
    }

    // GET USER DETAILS
    public function get_user_details($user_id = '', $column_name = '') {
        if ($column_name != '') {
            return $this->db->get_where('users', array('id' => $user_id))->row($column_name);
        } else {
            return $this->db->get_where('users', array('id' => $user_id))->row_array();
        }
    }

    function get_all_users($user_id) {
        if (!empty($user_id)) {
            return $this->db->get_where('users', array('id' => $user_id));
        } else {
            return $this->db->get('users');
        }
    }

    // ADMIN CRUD SECTION STARTS
    public function create_admin() {
        $data['school_id'] = html_escape($this->input->post('school_id'));
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['password'] = sha1($this->input->post('password'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));
        $data['role'] = 'admin';

        // check email duplication
        $duplication_status = $this->check_duplication('on_create', $data['email']);
        if ($duplication_status) {
            $this->db->insert('users', $data);

            $response = array(
                'status' => true,
                'notification' => get_phrase('admin_added_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function update_admin($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));
        $data['school_id'] = html_escape($this->input->post('school_id'));
        // check email duplication
        $duplication_status = $this->check_duplication('on_update', $data['email'], $param1);
        if ($duplication_status) {
            $this->db->where('id', $param1);
            $this->db->update('users', $data);

            $response = array(
                'status' => true,
                'notification' => get_phrase('admin_has_been_updated_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function delete_admin($param1 = '') {
        $this->db->where('id', $param1);
        $this->db->delete('users');

        $response = array(
            'status' => true,
            'notification' => get_phrase('admin_has_been_deleted_successfully')
        );
        return json_encode($response);
    }

    // ADMIN CRUD SECTION ENDS
    //START TEACHER section
    public function create_teacher() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['password'] = hash_text($this->input->post('password'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));
        $data['role'] = 'teacher';

        // check email duplication
        $duplication_status = $this->check_duplication('on_create', $data['email']);
        if ($duplication_status) {
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();

            $teacher_table_data['user_id'] = $user_id;
            $teacher_table_data['name'] = html_escape($this->input->post('name'));
            $teacher_table_data['about'] = html_escape($this->input->post('about'));
            $teacher_table_data['phone'] = html_escape($this->input->post('phone'));
            $teacher_table_data['sex'] = html_escape($this->input->post('gender'));
            $teacher_table_data['blood_group'] = html_escape($this->input->post('blood_group'));
            $teacher_table_data['address'] = html_escape($this->input->post('address'));
            $social_links = array(
                'facebook' => $this->input->post('facebook_link'),
                'twitter' => $this->input->post('twitter_link'),
                'linkedin' => $this->input->post('linkedin_link')
            );
            $teacher_table_data['social_links'] = json_encode($social_links);
            $teacher_table_data['department_id'] = html_escape($this->input->post('department'));
            $teacher_table_data['designation'] = html_escape($this->input->post('designation'));
            $teacher_table_data['show_on_website'] = $this->input->post('show_on_website');
            $teacher_table_data['about'] = html_escape($this->input->post('about'));
            $teacher_table_data['designation'] = html_escape($this->input->post('designation'));

            $this->db->insert('teacher', $teacher_table_data);
            $teacher_id = $this->db->insert_id();

            //insert teacher class info 
            $teacher_class['teacher_id'] = $teacher_id;
            $teacher_class['department_id'] = html_escape($this->input->post('department'));
            $teacher_class['batch_id'] = html_escape($this->input->post('batch'));
            $teacher_class['semester_id'] = html_escape($this->input->post('semester'));

            $this->db->insert('teacher_class_info', $teacher_class);

            if (isset($_FILES["image_file"]["name"])) {
                $image_data = $this->crud_model->upload_image('teacher_images', 'image_file');
                $where = $this->db->where('teacher_id', $teacher_id);
                $this->crud_model->update('teacher', $image_data, $where);
            }

            $response = array(
                'status' => true,
                'notification' => get_phrase('teacher_added_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function update_teacher($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));
        $user_id = $this->input->post('user_id');
        // check email duplication
        $duplication_status = $this->check_duplication('on_update', $data['email'], $param1);
        if ($duplication_status) {
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);

            $teacher_table_data['name'] = html_escape($this->input->post('name'));
            $teacher_table_data['email'] = html_escape($this->input->post('email'));
            $teacher_table_data['phone'] = html_escape($this->input->post('phone'));
            $teacher_table_data['gender'] = html_escape($this->input->post('gender'));
            $teacher_table_data['blood_group'] = html_escape($this->input->post('blood_group'));
            $teacher_table_data['address'] = html_escape($this->input->post('address'));
            $teacher_table_data['designation'] = html_escape($this->input->post('designation'));
            $teacher_table_data['about'] = html_escape($this->input->post('about'));
            $social_links = array(
                'facebook' => $this->input->post('facebook_link'),
                'twitter' => $this->input->post('twitter_link'),
                'linkedin' => $this->input->post('linkedin_link')
            );
            $teacher_table_data['social_links'] = json_encode($social_links);
            $teacher_table_data['show_on_website'] = $this->input->post('show_on_website');
            $this->db->where('teacher_id', $param1);
            $this->db->update('teacher', $teacher_table_data);

            if ($_FILES['image_file']['name'] != "") {
                move_uploaded_file($_FILES['image_file']['tmp_name'], 'uploads/users/' . $param1 . '.jpg');
            }

            $response = array(
                'status' => true,
                'notification' => get_phrase('teacher_has_been_updated_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function delete_teacher($param1 = '', $param2) {
        $this->db->where('id', $param2);
        $this->db->delete('users');

        $this->db->where('teacher_id', $param1);
        $this->db->delete('teachers');

        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher_permissions');

        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher_class_info');

        $response = array(
            'status' => true,
            'notification' => get_phrase('teacher_has_been_deleted_successfully')
        );
        return json_encode($response);
    }

    public function get_teachers() {
        $checker = array(
            'role' => 'teacher'
        );
        return $this->db->get_where('users', $checker);
    }

    public function get_teacher_by_id($teacher_id = "") {
        $checker = array(
            'id' => $teacher_id
        );
        $result = $this->db->get_where('teachers', $checker)->row_array();
        return $this->db->get_where('users', array('id' => $result['user_id']));
    }

    //END TEACHER section
    //START TEACHER PERMISSION section
    public function teacher_permission() {
        $department_id = html_escape($this->input->post('department_id'));
        $batch_id = html_escape($this->input->post('batch_id'));
        $semester_id = html_escape($this->input->post('semester_id'));
        $teacher_id = html_escape($this->input->post('teacher_id'));
        $column_name = html_escape($this->input->post('column_name'));
        $value = html_escape($this->input->post('value'));

        $check_row = $this->db->get_where('teacher_permissions', array('department_id' => $department_id,
            'batch_id' => $batch_id,
            'semester_id' => $semester_id,
            'teacher_id' => $teacher_id));
        if ($check_row->num_rows() > 0) {
            $data[$column_name] = $value;
            $this->db->where('department_id', $department_id);
            $this->db->where('batch_id', $batch_id);
            $this->db->where('semester_id', $semester_id);
            $this->db->where('teacher_id', $teacher_id);
            $this->db->update('teacher_permissions', $data);
        } else {
            $data['department_id'] = $department_id;
            $data['batch_id'] = $batch_id;
            $data['semester_id'] = $semester_id;
            $data['teacher_id'] = $teacher_id;
            $data[$column_name] = 1;
            $this->db->insert('teacher_permissions', $data);
        }
    }

    //END TEACHER PERMISSION section
    //START PARENT section
    public function parent_create() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['password'] = sha1($this->input->post('password'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));
//        $data['school_id'] = $this->school_id;
        $data['role'] = 'parent';

        // check email duplication
        $duplication_status = $this->check_duplication('on_create', $data['email']);
        if ($duplication_status) {

            $this->db->insert('users', $data);

            $parent_data['user_id'] = $this->db->insert_id();
//            $parent_data['school_id'] = $this->school_id;
            $this->db->insert('parents', $parent_data);

            $response = array(
                'status' => true,
                'notification' => get_phrase('parent_added_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function parent_update($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));

        // check email duplication
        $duplication_status = $this->check_duplication('on_update', $data['email'], $param1);
        if ($duplication_status) {

            $this->db->where('id', $param1);
            $this->db->update('users', $data);

            $response = array(
                'status' => true,
                'notification' => get_phrase('parent_updated_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function parent_delete($param1 = '') {
        $this->db->where('id', $param1);
        $this->db->delete('users');

        $this->db->where('user_id', $param1);
        $this->db->delete('parents');

        $response = array(
            'status' => true,
            'notification' => get_phrase('parent_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    public function get_parents() {
        $checker = array(
            'role' => 'parent'
        );
        return $this->db->get_where('users', $checker);
    }

    public function get_parent_by_id($parent_id = "") {
        $checker = array(
            'id' => $parent_id
        );
        $result = $this->db->get_where('parents', $checker)->row_array();
        return $this->db->get_where('users', array('id' => $result['user_id']));
    }

    //END PARENT section
    //START ACCOUNTANT section
    public function accountant_create() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['password'] = sha1($this->input->post('password'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));
//        $data['school_id'] = $this->school_id;
        $data['role'] = 'accountant';

        $duplication_status = $this->check_duplication('on_create', $data['email']);
        if ($duplication_status) {
            $this->db->insert('users', $data);

            $response = array(
                'status' => true,
                'notification' => get_phrase('accountant_added_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function accountant_update($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['gender'] = html_escape($this->input->post('gender'));
        $data['blood_group'] = html_escape($this->input->post('blood_group'));
        $data['address'] = html_escape($this->input->post('address'));

        $duplication_status = $this->check_duplication('on_update', $data['email'], $param1);
        if ($duplication_status) {
            $this->db->where('id', $param1);
            $this->db->update('users', $data);

            $response = array(
                'status' => true,
                'notification' => get_phrase('accountant_has_been_updated_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function accountant_delete($param1 = '') {
        $this->db->where('id', $param1);
        $this->db->delete('users');

        $response = array(
            'status' => true,
            'notification' => get_phrase('accountant_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    public function get_accountants() {
        $checker = array(
//            'school_id' => $this->school_id,
            'role' => 'accountant'
        );
        return $this->db->get_where('users', $checker);
    }

    public function get_accountant_by_id($accountant_id = "") {
        $checker = array(
//            'school_id' => $this->school_id,
            'id' => $accountant_id
        );
        return $this->db->get_where('users', $checker);
    }

    //END LIBRARIAN section
    //START STUDENT AND ADMISSION section
    public function single_student_create() {
        $student_code = student_code();
        $user_email = $student_code . '@jamia.com';
        $user_data['name'] = html_escape($this->input->post('name'));
        $user_data['email'] = str_replace(' ', '', $user_email);
        $user_data['password'] = hash_text($student_code);
        $user_data['role'] = 'student';
        $user_data['address'] = html_escape($this->input->post('current_address'));
        $user_data['phone'] = html_escape($this->input->post('phone'));
        $user_data['birthday'] = strtotime(html_escape($this->input->post('dob')));
        $user_data['gender'] = html_escape($this->input->post('gender'));
        $user_data['blood_group'] = html_escape($this->input->post('blood_group'));
//error while insert in users
        // check email duplication
        $duplication_status = $this->check_duplication('on_create', $user_data['email']);
        if ($duplication_status) {

            $this->db->insert('users', $user_data);
            $user_id = $this->db->insert_id();
            $parent_data['name'] = html_escape($this->input->post('father_name'));
            $parent_data['parent_code'] = student_code();
            $parent_data['email'] = str_replace(' ', '', $parent_data['name']) . $parent_data['parent_code'] . '@jamia.com';
            $parent_data['password'] = hash_text($parent_data['parent_code']);
            $parent_data['phone'] = html_escape($this->input->post('phone'));
            $parent_data['address'] = html_escape($this->input->post('current_address'));
            $parent_data['profession'] = html_escape($this->input->post('occupation'));

            $this->db->insert('parent', $parent_data);
            $parent_id = $this->db->insert_id();


            $student_data['student_code'] = student_code();
            $student_data['name'] = html_escape($this->input->post('name'));
            $student_data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
            $student_data['sex'] = html_escape($this->input->post('gender'));
            $student_data['religion'] = 'Muslim';
            $student_data['blood_group'] = html_escape($this->input->post('blood_group'));
            $student_data['c_address'] = html_escape($this->input->post('current_address'));
            $student_data['p_address'] = html_escape($this->input->post('permanent_address'));
            $student_data['phone'] = html_escape($this->input->post('phone'));
            $student_data['parent_id'] = $parent_id;
            $student_data['test_rollno'] = html_escape($this->input->post('test_roll'));
            $student_data['test_marks'] = html_escape($this->input->post('test_marks'));
            $student_data['country_id'] = html_escape($this->input->post('country_id'));
            $student_data['province_id'] = html_escape($this->input->post('province_id'));
            $student_data['district_id'] = html_escape($this->input->post('district_id'));
            $student_data['user_id'] = $user_id;
            $this->db->insert('student', $student_data);
            $student_id = $this->db->insert_id();


            // Insert data in enroll table for stuent enrollment 
            $enroll_data['student_id'] = $student_id;
            $enroll_data['department_id'] = html_escape($this->input->post('department_id'));
            $enroll_data['batch_id'] = html_escape($this->input->post('batch_id'));
            $enroll_data['semester_id'] = html_escape($this->input->post('semester_id'));
            $enroll_data['section_id'] = html_escape($this->input->post('section_id'));
            $enroll_data['enroll_date'] = date('Y-m-d');
            $this->db->insert('enroll', $enroll_data);

            if (isset($_FILES["student_image"]["name"])) {
                $image_data = $this->crud_model->upload_image('student_images', 'student_image');
                $where = $this->db->where('student_id', $student_id);
                $this->crud_model->update('student', $image_data, $where);
            }

            $response = array(
                'status' => true,
                'notification' => get_phrase('student_added_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function student_update($student_id = '', $user_id = '') {
        $student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
        $user_data['name'] = html_escape($this->input->post('name'));
        $user_data['address'] = html_escape($this->input->post('current_address'));
        $user_data['phone'] = html_escape($this->input->post('phone'));
        $user_data['birthday'] = strtotime(html_escape($this->input->post('dob')));
        $user_data['gender'] = html_escape($this->input->post('gender'));
        $user_data['blood_group'] = html_escape($this->input->post('blood_group'));
        $this->db->where('id', $user_id);
        $this->db->update('users', $user_data);

        //Update Parent data
        $parent_data['name'] = html_escape($this->input->post('father_name'));
        $parent_data['phone'] = html_escape($this->input->post('phone'));
        $parent_data['address'] = html_escape($this->input->post('current_address'));
        $parent_data['profession'] = html_escape($this->input->post('occupation'));
        $this->db->where('parent_id', $student_info->parent_id);
        $this->db->update('parent', $parent_data);
        //Update student Data
        $student_data['name'] = html_escape($this->input->post('name'));
        $student_data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
        $student_data['sex'] = html_escape($this->input->post('gender'));
        $student_data['religion'] = 'Muslim';
        $student_data['blood_group'] = html_escape($this->input->post('blood_group'));
        $student_data['c_address'] = html_escape($this->input->post('current_address'));
        $student_data['p_address'] = html_escape($this->input->post('permanent_address'));
        $student_data['phone'] = html_escape($this->input->post('phone'));
        $student_data['test_rollno'] = html_escape($this->input->post('test_roll'));
        $student_data['test_marks'] = html_escape($this->input->post('test_marks'));
        $student_data['country_id'] = html_escape($this->input->post('country_id'));
        $student_data['province_id'] = html_escape($this->input->post('province_id'));
        $student_data['district_id'] = html_escape($this->input->post('district_id'));
        $this->db->where('student_id', $student_id);
        $this->db->update('student', $student_data);

        //Update Enroll Data 
        $enroll_data['department_id'] = html_escape($this->input->post('department_id'));
        $enroll_data['batch_id'] = html_escape($this->input->post('batch_id'));
        $enroll_data['semester_id'] = html_escape($this->input->post('semester_id'));
        $enroll_data['section_id'] = html_escape($this->input->post('section_id'));
        $this->db->where('student_id', $student_id);
        $this->db->where('batch_lock', 0);
        $this->db->where('semester_lock', 0);
        $this->db->update('enroll', $enroll_data);
        // Check Duplication
        $response = array(
            'status' => TRUE,
            'notification' => 'Student data has been updated Successfully...'
        );

        return json_encode($response);
    }

    public function delete_student($student_id, $user_id) {
        $this->db->where('id', $student_id);
        $this->db->delete('students');

        $this->db->where('student_id', $student_id);
        $this->db->delete('enrols');

        $this->db->where('id', $user_id);
        $this->db->delete('users');

        $path = 'uploads/users/' . $user_id . '.jpg';
        if (file_exists($path)) {
            unlink($path);
        }

        $response = array(
            'status' => true,
            'notification' => get_phrase('student_deleted_successfully')
        );

        return json_encode($response);
    }

    public function student_enrolment($section_id = "") {
        return $this->db->get_where('enrols', array('section_id' => $section_id));
    }

    // This function will help to fetch student data by section, class or student id
    public function get_student_details_by_id($type = "", $id = "") {
        $enrol_data = array();
        if ($type == "section") {
            $checker = array(
                'section_id' => $id,
//                'session' => $this->active_session,
//                'school_id' => $this->school_id
            );
            $enrol_data = $this->db->get_where('enrols', $checker)->result_array();
            foreach ($enrol_data as $key => $enrol) {
                $student_details = $this->db->get_where('students', array('id' => $enrol['student_id']))->row_array();
                $enrol_data[$key]['code'] = $student_details['code'];
                $enrol_data[$key]['user_id'] = $student_details['user_id'];
                $enrol_data[$key]['parent_id'] = $student_details['parent_id'];
                $user_details = $this->db->get_where('users', array('id' => $student_details['user_id']))->row_array();
                $enrol_data[$key]['name'] = $user_details['name'];
                $enrol_data[$key]['email'] = $user_details['email'];
                $enrol_data[$key]['role'] = $user_details['role'];
                $enrol_data[$key]['address'] = $user_details['address'];
                $enrol_data[$key]['phone'] = $user_details['phone'];
                $enrol_data[$key]['birthday'] = $user_details['birthday'];
                $enrol_data[$key]['gender'] = $user_details['gender'];
                $enrol_data[$key]['blood_group'] = $user_details['blood_group'];

                $class_details = $this->crud_model->get_class_details_by_id($enrol['class_id'])->row_array();
                $section_details = $this->crud_model->get_section_details_by_id('section', $enrol['section_id'])->row_array();

                $enrol_data[$key]['class_name'] = $class_details['name'];
                $enrol_data[$key]['section_name'] = $section_details['name'];
            }
        } elseif ($type == "class") {
            $checker = array(
                'class_id' => $id,
//                'session' => $this->active_session,
//                'school_id' => $this->school_id
            );
            $enrol_data = $this->db->get_where('enrols', $checker)->result_array();
            foreach ($enrol_data as $key => $enrol) {
                $student_details = $this->db->get_where('students', array('id' => $enrol['student_id']))->row_array();
                $enrol_data[$key]['code'] = $student_details['code'];
                $enrol_data[$key]['user_id'] = $student_details['user_id'];
                $enrol_data[$key]['parent_id'] = $student_details['parent_id'];
                $user_details = $this->db->get_where('users', array('id' => $student_details['user_id']))->row_array();
                $enrol_data[$key]['name'] = $user_details['name'];
                $enrol_data[$key]['email'] = $user_details['email'];
                $enrol_data[$key]['role'] = $user_details['role'];
                $enrol_data[$key]['address'] = $user_details['address'];
                $enrol_data[$key]['phone'] = $user_details['phone'];
                $enrol_data[$key]['birthday'] = $user_details['birthday'];
                $enrol_data[$key]['gender'] = $user_details['gender'];
                $enrol_data[$key]['blood_group'] = $user_details['blood_group'];

                $class_details = $this->crud_model->get_class_details_by_id($enrol['class_id'])->row_array();
                $section_details = $this->crud_model->get_section_details_by_id('section', $enrol['section_id'])->row_array();

                $enrol_data[$key]['class_name'] = $class_details['name'];
                $enrol_data[$key]['section_name'] = $section_details['name'];
            }
        } elseif ($type == "student") {
            $checker = array(
                'student_id' => $id,
//                'session' => $this->active_session,
//                'school_id' => $this->school_id
            );
            $enrol_data = $this->db->get_where('enrols', $checker)->row_array();
            $student_details = $this->db->get_where('students', array('id' => $enrol_data['student_id']))->row_array();
            $enrol_data['code'] = $student_details['code'];
            $enrol_data['user_id'] = $student_details['user_id'];
            $enrol_data['parent_id'] = $student_details['parent_id'];
            $user_details = $this->db->get_where('users', array('id' => $student_details['user_id']))->row_array();
            $enrol_data['name'] = $user_details['name'];
            $enrol_data['email'] = $user_details['email'];
            $enrol_data['role'] = $user_details['role'];
            $enrol_data['address'] = $user_details['address'];
            $enrol_data['phone'] = $user_details['phone'];
            $enrol_data['birthday'] = $user_details['birthday'];
            $enrol_data['gender'] = $user_details['gender'];
            $enrol_data['blood_group'] = $user_details['blood_group'];

            $class_details = $this->crud_model->get_class_details_by_id($enrol_data['class_id'])->row_array();
            $section_details = $this->crud_model->get_section_details_by_id('section', $enrol_data['section_id'])->row_array();

            $enrol_data['class_name'] = $class_details['name'];
            $enrol_data['section_name'] = $section_details['name'];
        }
        return $enrol_data;
    }

    // Get User Image Starts
    public function get_user_image($type = NULL, $user_id = NULL) {
        if ($type == 'student') {
            $student_image = $this->db->get_where('student', array('student_id' => $user_id))->row()->image;
            if (file_exists('uploads/images/student_images/' . $student_image)) {
                return base_url() . 'uploads/images/student_images/' . $student_image;
            }
        } elseif ($type == 'admin') {
            return base_url() . 'uploads/users/placeholder.jpg';
        } elseif ($type == 'teacher') {
            $teacher_image = $this->db->get_where('teacher', array('teacher_id' => $user_id))->row()->image;
            if (file_exists('uploads/images/teacher_images/' . $teacher_image)) {
                return base_url() . 'uploads/images/teacher_images/' . $teacher_image;
            }
        } else {
            return base_url() . 'uploads/users/placeholder.jpg';
        }
    }

    // Get User Image Ends
    // Check user duplication
    public function check_duplication($action = "", $email = "", $user_id = "") {
        $duplicate_email_check = $this->db->get_where('users', array('email' => $email));

        if ($action == 'on_create') {
            if ($duplicate_email_check->num_rows() > 0) {
                return false;
            } else {
                return true;
            }
        } elseif ($action == 'on_update') {
            if ($duplicate_email_check->num_rows() > 0) {
                if ($duplicate_email_check->row()->id == $user_id) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
    }

    //GET LOGGED IN USER DATA
    public function get_profile_data() {
        return $this->db->get_where('users', array('id' => $this->session->userdata('user_id')))->row_array();
    }

    public function update_profile() {
        $response = array();
        $user_id = $this->session->userdata('user_id');
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        // Check Duplication
        $duplication_status = $this->check_duplication('on_update', $data['email'], $user_id);
        if ($duplication_status) {
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);

            move_uploaded_file($_FILES['profile_image']['tmp_name'], 'uploads/users/' . $user_id . '.jpg');

            $response = array(
                'status' => true,
                'notification' => get_phrase('profile_updated_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('sorry_this_email_has_been_taken')
            );
        }

        return json_encode($response);
    }

    public function update_password() {
        $user_id = $this->session->userdata('user_id');
        if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $user_details = $this->get_user_details($user_id);
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                $data['password'] = sha1($new_password);
                $this->db->where('id', $user_id);
                $this->db->update('users', $data);

                $response = array(
                    'status' => true,
                    'notification' => get_phrase('password_updated_successfully')
                );
            } else {

                $response = array(
                    'status' => false,
                    'notification' => get_phrase('mismatch_password')
                );
            }
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('password_can_not_be_empty')
            );
        }
        return json_encode($response);
    }

    //GET LOGGED IN USERS CLASS ID AND SECTION ID (FOR STUDENT LOGGED IN VIEW)
    public function get_logged_in_student_details() {
        $user_id = $this->session->userdata('user_id');
        $student_data = $this->db->get_where('students', array('user_id' => $user_id))->row_array();
        $student_details = $this->get_student_details_by_id('student', $student_data['id']);
        return $student_details;
    }

    // GET STUDENT LIST BY PARENT
    public function get_student_list_of_logged_in_parent() {
        $parent_id = $this->session->userdata('user_id');
        $parent_data = $this->db->get_where('parents', array('user_id' => $parent_id))->row_array();
        $checker = array(
            'parent_id' => $parent_data['id'],
//            'session' => $this->active_session,
//            'school_id' => $this->school_id
        );
        $students = $this->db->get_where('students', $checker)->result_array();
        foreach ($students as $key => $student) {
            $checker = array(
                'student_id' => $student['id'],
//                'session' => $this->active_session,
//                'school_id' => $this->school_id
            );
            $enrol_data = $this->db->get_where('enrols', $checker)->row_array();

            $user_details = $this->db->get_where('users', array('id' => $student['user_id']))->row_array();
            $students[$key]['student_id'] = $student['id'];
            $students[$key]['name'] = $user_details['name'];
            $students[$key]['email'] = $user_details['email'];
            $students[$key]['role'] = $user_details['role'];
            $students[$key]['address'] = $user_details['address'];
            $students[$key]['phone'] = $user_details['phone'];
            $students[$key]['birthday'] = $user_details['birthday'];
            $students[$key]['gender'] = $user_details['gender'];
            $students[$key]['blood_group'] = $user_details['blood_group'];
            $students[$key]['class_id'] = $enrol_data['class_id'];
            $students[$key]['section_id'] = $enrol_data['section_id'];

            $class_details = $this->crud_model->get_class_details_by_id($enrol_data['class_id'])->row_array();
            $section_details = $this->crud_model->get_section_details_by_id('section', $enrol_data['section_id'])->row_array();

            $students[$key]['class_name'] = $class_details['name'];
            $students[$key]['section_name'] = $section_details['name'];
        }
        return $students;
    }

    // In Array for associative array
    function is_in_array($associative_array = array(), $look_up_key = "", $look_up_value = "") {
        foreach ($associative_array as $associative) {
            $keys = array_keys($associative);
            for ($i = 0; $i < count($keys); $i++) {
                if ($keys[$i] == $look_up_key) {
                    if ($associative[$look_up_key] == $look_up_value) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

}
