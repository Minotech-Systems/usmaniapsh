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

    /*     * **  JAMIA EXPNESES MODEULE DATA   *** */

    function get_jamia_expenses($year) {
        $this->db->select('*');
        $this->db->from('jamia_expenses');
        $this->db->where('year', $year);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }

    function get_month_name($month) {
        if ($month == 1)
            $m = 'محرم';
        else if ($month == 2)
            $m = 'صفر';
        else if ($month == 3)
            $m = 'ر بیع الاول';
        else if ($month == 4)
            $m = 'ر بیع الثانی';
        else if ($month == 5)
            $m = 'جمادی الاول';
        else if ($month == 6)
            $m = 'جمادی الثانی';
        else if ($month == 7)
            $m = 'رجب';
        else if ($month == 8)
            $m = 'شعبان';
        else if ($month == 9)
            $m = 'رمضان';
        else if ($month == 10)
            $m = 'شوال';
        else if ($month == 11)
            $m = 'ذوالقعدۃ';
        else if ($month == 12)
            $m = 'ذوالحجۃ';

        return $m;
    }

    function get_sum_mad_expenses($mad_id, $month, $page_num, $year) {
        $this->db->select('SUM(amount) as total');
        $this->db->from('jamia_expenses');
        $this->db->where('child_expense_id', $mad_id);
        $this->db->where('year', $year);
        $this->db->where('page_num', $page_num);
        $this->db->where('arabic_month', $month);
        $query = $this->db->get();
        return $query->row()->total;
    }

    function get_sum_orevious($mad_id, $month, $page_num, $year) {
        $this->db->select('SUM(amount) as total');
        $this->db->from('jamia_expenses');
        $this->db->where('child_expense_id', $mad_id);
        $this->db->where('year', $year);
        $this->db->where('page_num<', $page_num);
        $this->db->where('arabic_month', $month);
        $query = $this->db->get();
        return $query->row()->total;
    }

    function get_all_page_expenses($page_num, $year) {
        $this->db->select('SUM(amount) as total');
        $this->db->from('jamia_expenses');
        $this->db->where('page_num<=', $page_num);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query->row()->total;
    }

    function get_pages_expenses($month, $year) {
        $this->db->select('page_num');
        $this->db->distinct();
        $this->db->from('jamia_expenses');
        $this->db->where('arabic_month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Income
    function get_income_category() {
        return $this->db->get('income_category')->result_array();
    }

    function get_income() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        return $this->db->get_where('income', array('year' => $running_year))->result_array();
    }

    function get_income_pages($month, $year) {
        $this->db->select('page_num');
        $this->db->distinct();
        $this->db->from('income');
        $this->db->where('year', $year);
        $this->db->where('arabic_month', $month);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_income_history($page_no, $month, $year) {
        $query = $this->db->get_where('income', array(
                    'year' => $year,
                    'arabic_month' => $month,
                    'page_num' => $page_no,
                ))->result_array();

        return $query;
    }

    function get_income_cat_sum($cat_id,$page_num,$month,$year) {
        $this->db->select('SUM(amount) as total');
        $this->db->from('income');
        $this->db->where('income_category_id',$cat_id);
        $this->db->where('arabic_month',$month);
        $this->db->where('page_num', $page_num);
        $this->db->where('year', $year);
        $query = $this->db->get();
        return $query->row()->total;
    }

}
