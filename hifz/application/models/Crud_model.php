<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {

        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    function get_column_name_by_id($table, $table_id = '', $id) {

        return $this->db->get_where($table, array($table_id => $id))->row()->name;
    }

    //Get all table data in array
    function get_table_data($table) {
        return $this->db->get($table)->result_array();
    }

    //Get all table data in array
    function get_table_data_where($table, $where) {
        return $this->db->get_where($table, $where)->result();
    }

    function create_log($data) {

        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));

        $data['ip'] = $_SERVER["REMOTE_ADDR"];

        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));

        $data['location'] = $location->City . ' , ' . $location->CountryName;

        $this->db->insert('log', $data);
    }

    function get_system_settings() {

        $query = $this->db->get('settings');

        return $query->result_array();
    }

    function get_system_branch($branch_id) {
        return $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
    }

    ////////IMAGE URL//////////

    function get_image_url($type = '', $image = '') {

        if (file_exists('uploads/' . $type . '_image/' . $image))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $image;
        else
            $image_url = base_url() . 'uploads/user.jpg';



        return $image_url;
    }

    public function do_resize($path) {

        $config['upload_path'] = './uploads/' . $path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        //$this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('student_image')) {
            echo $this->upload->display_errors();
            exit();
        } else {
            $data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/' . $path . '/' . $data["file_name"];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 405;
            $config['height'] = 525;
            $config['new_image'] = './uploads/' . $path . '/' . $data["file_name"];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            return $image_data = array('image' => $data["file_name"]);
        }
    }

    function unlink($type, $image) {

        $unlink_url = './uploads/' . $type . '_image/' . $image;
        unlink($unlink_url);
    }

    public function upload_image($path, $type) {
        $config['upload_path'] = './uploads/' . $path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($type)) {
            echo $this->upload->display_errors();
            exit();
        } else {
            $data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/' . $path . '/' . $data["file_name"];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 405;
            $config['height'] = 525;
            $config['new_image'] = './uploads/' . $path . '/' . $data["file_name"];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            return $image_data = array('image' => $data["file_name"]);
        }
    }

    public function update($table_name, $data, $where) {
        $this->db->where($where);
        $this->db->update($table_name, $data);
    }

    function get_month_name($month) {
        if ($month == 4)
            $m = 'محرم';
        else if ($month == 5)
            $m = 'صفر';
        else if ($month == 6)
            $m = 'ر بیع الاول';
        else if ($month == 7)
            $m = 'ر بیع الثانی';
        else if ($month == 8)
            $m = 'جمادی الاول';
        else if ($month == 9)
            $m = 'جمادی الثانی';
        else if ($month == 10)
            $m = 'رجب';
        else if ($month == 11)
            $m = 'شعبان';
        else if ($month == 12)
            $m = 'رمضان';
        else if ($month == 1)
            $m = 'شوال';
        else if ($month == 2)
            $m = 'ذوالقعدۃ';
        else if ($month == 3)
            $m = 'ذوالحجۃ';

        return $m;
    }

    function get_georg_month($i) {
        if ($i == 1)
            $m = 'جنوری';
        else if ($i == 2)
            $m = 'فروری';
        else if ($i == 3)
            $m = 'مارچ ';
        else if ($i == 4)
            $m = 'اپریل ';
        else if ($i == 5)
            $m = 'مئی ';
        else if ($i == 6)
            $m = 'جون ';
        else if ($i == 7)
            $m = 'جولائی ';
        else if ($i == 8)
            $m = 'اگست ';
        else if ($i == 9)
            $m = 'ستمبر ';
        else if ($i == 10)
            $m = 'اکتوبر ';
        else if ($i == 11)
            $m = 'نومبر ';
        else if ($i == 12)
            $m = 'دسمبر ';

        return $m;
    }

    //Data getting for all student according to branch id
    function get_student_data($branch_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('student.*, enroll.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where('enroll.branch_id', $branch_id);
        $this->db->where('enroll.status', 1);
        $this->db->where('enroll.year', $year);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    //Data getting for students having teacher and according to branch_id
    function get_student_parent_data($branch_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('student.*, enroll.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where('enroll.branch_id', $branch_id);
        $this->db->where('enroll.status', 1);
        $this->db->where('enroll.teacher_id >', 0);
        $this->db->where('enroll.year', $year);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    //Data getting for students having no teacher accordig to branch_id
    function get_unrranged_students($branch_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('student.*, enroll.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where('enroll.branch_id', $branch_id);
        $this->db->where('enroll.status', 1);
        $this->db->where('enroll.teacher_id', 0);
        $this->db->where('enroll.year', $year);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    //Data getting for single student
    function get_student_all_data($student_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('student.*, enroll.*, student_edu_data.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->join('student_edu_data', 'student_edu_data.student_id = student.student_id', 'inner')->distinct();
        $this->db->where('enroll.student_id', $student_id);
        $this->db->where('student.student_id', $student_id);
        $this->db->where('student_edu_data.student_id', $student_id);
        $this->db->where('enroll.status', 1);
        $this->db->where('enroll.year', $year);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    //Data for student accoriding to his teacher_id
    function get_student_teacher_data($teacher_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('student.*, enroll.*');
        $this->db->from('student');
        $this->db->join('enroll', 'enroll.student_id = student.student_id', 'inner')->distinct();
        $this->db->where('enroll.teacher_id', $teacher_id);
        $this->db->where('enroll.status', 1);
        $this->db->where('enroll.year', $year);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function count_branch_students() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $branch_id = $this->session->userdata('branch_id');
        $count = $this->db->where(array('status' => 1, 'year' => $running_year, 'branch_id' => $branch_id))->from("enroll")->count_all_results();
        return $count;
    }

    function count_teacher_students($teacher_id) {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $count = $this->db->where(array('status' => 1, 'year' => $running_year, 'teacher_id' => $teacher_id))->from("enroll")->count_all_results();
        return $count;
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

    ////////////CLASS///////////

    function get_class_name($class_id) {

        $query = $this->db->get_where('class', array('class_id' => $class_id));

        $res = $query->result_array();

        foreach ($res as $row)
            return $row['name'];
    }

    // Get any table data
    function get_table_data1($table) {
        return $this->db->get("$table")->result();
    }

    function get_branch_name_by_classid($class_id) {
        $branch_id = $this->db->get_where('class', array('class_id' => $class_id))->row()->branch_id;
        $branch_name = $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
        return $branch_name;
    }

    function get_branch_name($branch_id) {
        return $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->name;
    }

    function count_daily_report_absenty($student_id, $month, $field) {
        $year = date('Y');
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $notEmpty = 0;
        for ($i = 1; $i <= $days; $i++) {
            $timestamp = ($year . '-' . $month . '-' . $i);
            $this->db->select('*');
            $this->db->from('daily_student_report');
            $this->db->where('student_id', $student_id);
            $this->db->where('date', $timestamp);
            $query = $this->db->get();
            $result = $query->result();
            foreach ($result as $row) {
                $notEmpty += ($row->$field == 'ناغہ') ? 1 : 0;
            }
        }
        return $notEmpty;
    }

    function get_branch_teachers($branch_id) {
        $result = $this->db->get_where('teacher', array('branch_id' => $branch_id))->result();
        if (!empty($result)) {
            return $result;
        }
    }

}
