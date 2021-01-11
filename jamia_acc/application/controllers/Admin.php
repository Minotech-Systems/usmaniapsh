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

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('date_helper');


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

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function expenses_type($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'add') {
            $data['name'] = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('expenses_category', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/expenses_type/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');

            $this->db->where('id', $param2);
            $this->db->update('expenses_category', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/expenses_type/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('expenses_category');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/expenses_type/', 'refresh');
        }
        $page_data['expenses_type'] = $this->crud_model->get_table_data('expenses_category');
        $page_data['page_name'] = 'expenses_type';
        $page_data['page_title'] = get_phrase('expenses_type');
        $this->load->view('backend/index', $page_data);
    }

    function expenses_mad($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add') {
            $data['name'] = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['expenses_category_id'] = $this->input->post('expenses_category_id');
            $this->db->insert('child_expense_category', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/expenses_mad/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['expenses_category_id'] = $this->input->post('expenses_category_id');
            $this->db->where('id', $param2);
            $this->db->update('child_expense_category', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/expenses_mad/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('child_expense_category');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/expenses_mad/', 'refresh');
        }
        $page_data['expenses_maad'] = $this->crud_model->get_table_data('child_expense_category');
        $page_data['page_name'] = 'expenses_mad';
        $page_data['page_title'] = get_phrase('expenses_mad');
        $this->load->view('backend/index', $page_data);
    }

    function khata_banam($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'add') {
            $data['name'] = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['child_expense_id'] = $this->input->post('child_expenses_id');
            $this->db->insert('sub_child_expense_category', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/khata_banam/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['child_expense_id'] = $this->input->post('child_expenses_id');
            $this->db->where('id', $param2);
            $this->db->update('sub_child_expense_category', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/khata_banam/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('sub_child_expense_category');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/khata_banam/', 'refresh');
        }
        $page_data['khata_banaam'] = $this->crud_model->get_table_data('sub_child_expense_category');
        $page_data['page_name'] = 'khata_banam';
        $page_data['page_title'] = get_phrase('khata_banam');
        $this->load->view('backend/index', $page_data);
    }

    function jamia_expenses($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        if ($param1 == 'create') {

            $data['sub_child_expense_id'] = $this->input->post('sub_child_expense_id');
            $data['child_expense_id'] = $this->db->get_where('sub_child_expense_category', array('id' => $data['sub_child_expense_id']))->row()->child_expense_id;
            $data['expense_category_id'] = $this->db->get_where('child_expense_category', array('id' => $data['child_expense_id']))->row()->expenses_category_id;
            $data['bill_no'] = $this->input->post('bill_no');
            $data['amount'] = $this->input->post('amount');
            $data['arabic_month'] = $this->input->post('islamic_month');
            $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
            $data['comment'] = $this->input->post('comment');
            $data['year'] = $year;
            $data['talimi_saal'] = $talimi_saal;
            $data['page_num'] = $this->input->post('page_no');
            //date conversion to hijri
            $g_day = date('d', strtotime($this->input->post('date')));
            $g_m = date('m', strtotime($this->input->post('date')));
            $g_year = date('Y', strtotime($this->input->post('date')));
            $islamic_date = Greg2Hijri($g_day, $g_m, $g_year);
            $data['arabic_date'] = $islamic_date['year'] . '-' . $islamic_date['month'] . '-' . $islamic_date['day'];
            $this->db->insert('jamia_expenses', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/jamia_expenses/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['sub_child_expense_id'] = $this->input->post('sub_child_expense_id');
            $data['child_expense_id'] = $this->db->get_where('sub_child_expense_category', array('id' => $data['sub_child_expense_id']))->row()->child_expense_id;
            $data['expense_category_id'] = $this->db->get_where('child_expense_category', array('id' => $data['child_expense_id']))->row()->expenses_category_id;
            $data['bill_no'] = $this->input->post('bill_no');
            $data['amount'] = $this->input->post('amount');
            $data['arabic_month'] = $this->input->post('islamic_month');
            $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
            $data['comment'] = $this->input->post('comment');

            $this->db->where('id', $param2);
            $this->db->update('jamia_expenses', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/jamia_expenses/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('jamia_expenses');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/jamia_expenses/', 'refresh');
        }

        $page_data['kata_banam'] = $this->crud_model->get_table_data('sub_child_expense_category');
        $page_data['expenses'] = $this->crud_model->get_jamia_expenses($year);
        $page_data['page_name'] = 'jamia_expenses';
        $page_data['page_title'] = get_phrase('jamia_expenses');
        $this->load->view('backend/index', $page_data);
    }

    //Expenses  Report

    function jamia_expenses_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->input->post('month') != '' && $this->input->post('year')) {
            $page_data['month'] = $this->input->post('month');
            $page_data['d_year'] = $this->input->post('year');
        }
        $a_date = Greg2Hijri(date('d'), date('m'), date('Y'));
        $page_data['a_year'] = $a_date['year'];
        $page_data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['page_name'] = 'jamia_expenses_report';
        $page_data['page_title'] = get_phrase('jamia_expenses_report');
        $this->load->view('backend/index', $page_data);
    }

    function print_expenses_report($month, $d_year) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $year = explode('-', $running_year);
        $page_data['a_year'] = $year[0];
        $page_data['d_year'] = $d_year;
        $page_data['month'] = $month;
        $page_data['running_year'] = $running_year;
        $page_data['page_title'] = get_phrase('jamia_expenses_report');
        $this->load->view('backend/admin/reports/print_expenses_report', $page_data);
    }

    /*
      |--------------------------------------------------------------------------
      | JAMIA INCOME
      |--------------------------------------------------------------------------
      |
      | ALL INCOME OF JAMIA'S FUNCTIONS STRAT FROM HERE
      |
     */
    function income_category($param1='', $param2=''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if($param1 == 'add'){
            $data['name']    = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('income_category',$data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/income_category/', 'refresh');
        }
        if($param1 == 'update'){
            $data['name']    = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $this->db->where('id',$param2);
            $this->db->update('income_category',$data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/income_category/', 'refresh');
        }
        if($param1 == 'delete'){
            $this->db->where('id',$param2);
            $this->db->delete('income_category');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url().'index.php?admin/income_category/','refresh');
        }
        $page_data['income_category'] = $this->crud_model->get_income_category();
        $page_data['page_name'] = 'income_category';
        $page_data['page_title'] = get_phrase('income_category');
        $this->load->view('backend/index', $page_data);
    }
    
    function add_income($param1='',$param2=''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
        
        if($param1 == 'create'){
            $data['income_category_id'] = $this->input->post('income_type_id');
            $data['bill_no'] = $this->input->post('bill_no');
            $data['amount'] = $this->input->post('amount');
            $data['arabic_month'] = $this->input->post('islamic_month');
            $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
            $data['comment'] = $this->input->post('comment');
            $data['year'] = $year;
            $data['talimi_saal'] = $talimi_saal;
            $data['page_num'] = $this->input->post('page_no');
            $data['assistant'] = $this->input->post('assistant');
            //date conversion to hijri
            $g_day = date('d', strtotime($this->input->post('date')));
            $g_m = date('m', strtotime($this->input->post('date')));
            $g_year = date('Y', strtotime($this->input->post('date')));
            $islamic_date = Greg2Hijri($g_day, $g_m, $g_year);
            $data['arabic_date'] = $islamic_date['year'] . '-' . $islamic_date['month'] . '-' . $islamic_date['day'];
            $this->db->insert('income', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/add_income/', 'refresh');
        }
        if($param1 == 'update'){
            $data['income_category_id'] = $this->input->post('income_category_id');
            $data['bill_no'] = $this->input->post('bill_no');
            $data['amount'] = $this->input->post('amount');
            $data['assistant'] = $this->input->post('assistant');
            $data['arabic_month'] = $this->input->post('islamic_month');
            $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
            $data['comment'] = $this->input->post('comment');

            $this->db->where('id', $param2);
            $this->db->update('income', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/add_income/', 'refresh');
        }
        if($param1 == 'delete'){
            $this->db->where('id',$param2);
            $this->db->delete('income');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?admin/add_income/', 'refresh');
        }
        
        
        $page_data['income'] = $this->crud_model->get_income();
        $page_data['page_name'] = 'income';
        $page_data['page_title'] = get_phrase('income');
        $this->load->view('backend/index', $page_data);
    }
    
    function income_report(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->input->post('month') != '' && $this->input->post('year')) {
            $page_data['month'] = $this->input->post('month');
            $page_data['d_year'] = $this->input->post('year');
        }
        $a_date = Greg2Hijri(date('d'), date('m'), date('Y'));
        $page_data['a_year'] = $a_date['year'];
        $page_data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['page_name'] = 'income_report';
        $this->db->order_by('id','asc'); 
        
       
        $page_data['income_cate'] = $this->crud_model->get_income_category();
        $page_data['page_title'] = get_phrase('income_report');
        $this->load->view('backend/index', $page_data);
    }
            
    function change_income_page(){
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_num = $this->input->post('page_num');
        $query = $this->db->get_where('income_page_lock', array('year' => $running_year, 'number' => $page_num));
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error_message', 'ی�? ص�?ح�? پ�?لے سے موجود �?ے۔۔۔');
            redirect(base_url() . 'index.php?admin/add_income/', 'refresh');
        }
        
        $this->db->where('year', $running_year);
        $this->db->update('income_page_lock', array('status' => 0));

        $data['number'] = $this->input->post('page_num');
        $data['year'] = $running_year;
        $this->db->insert('income_page_lock', $data);
        $this->session->set_flashdata('flash_message', 'ص�?ح�? کو کامیابی سے تبدیل کر دیا گیا۔۔۔');
        redirect(base_url() . 'index.php?admin/add_income/', 'refresh');
    }
            
    function change_page_num() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_num = $this->input->post('page_num');
        $query = $this->db->get_where('page_lock', array('year' => $running_year, 'number' => $page_num));
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error_message', 'ی�? ص�?ح�? پ�?لے سے موجود �?ے۔۔۔');
            redirect(base_url() . 'index.php?admin/jamia_expenses/', 'refresh');
        }
        $this->db->where('year', $running_year);
        $this->db->update('page_lock', array('status' => 0));

        $data['number'] = $this->input->post('page_num');
        $data['year'] = $running_year;
        $this->db->insert('page_lock', $data);
        $this->session->set_flashdata('flash_message', 'ص�?ح�? کو کامیابی سے تبدیل کر دیا گیا۔۔۔');
        redirect(base_url() . 'index.php?admin/jamia_expenses/', 'refresh');
    }

    /*     * ***SITE/SYSTEM SETTINGS******** */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type', 'system_name');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type', 'system_title');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type', 'address');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type', 'phone');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type', 'paypal_email');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type', 'currency');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type', 'system_email');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type', 'system_name');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type', 'language');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type', 'text_align');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('running_year');
            $this->db->where('type', 'running_year');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('talimi_saal');
            $this->db->where('type', 'talimi_saal');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('sms_app');
            $this->db->where('type', 'sms_app');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type', 'skin_colour');
            $this->db->update('settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('theme_selected'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*     * ***LANGUAGE SETTINGS******** */

    function manage_language($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language = $param2;
            $total_phrase = $this->input->post('total_phrase');
            for ($i = 1; $i < $total_phrase; $i++) {
                //$data[$language]	=	$this->input->post('phrase').$i;
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        $page_data['page_name'] = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function get_session_changer() {
        $this->load->view('backend/admin/change_session');
    }

    function change_session() {
        $data['description'] = $this->input->post('running_year');
        $this->db->where('type', 'running_year');
        $this->db->update('settings', $data);
        $this->session->set_flashdata('flash_message', get_phrase('session_changed'));
        redirect(base_url() . 'index.php?admin/dashboard/', 'refresh');
    }

    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = sha1($this->input->post('password'));
            $data['new_password'] = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('admin', array(
                        'admin_id' => $this->session->userdata('admin_id')
                    ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));

                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

}
