<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author 	: Ejaz Ul Haq
 * 	date		: 1st Feb, 2018
 * 	Ekattor School Management System Pro
 * 	http://itkoor.com
 */

class Student_fee extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');


        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function manage_student_fee($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $branch_id = $this->session->userdata('branch_id');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        if ($param1 == 'create') {
            $data['amount'] = $this->input->post('amount');
            $data['branch_id'] = $this->input->post('branch_id');
            $data['year'] = $running_year;

            $this->db->insert('monthly_fee', $data);

            $students = $this->db->get_where('enroll', array('branch_id' => $data['branch_id'], 'year' => $running_year, 'status' => 1))->result_array();
            foreach ($students as $row) {
                $fee = $this->db->get_where('student_fee', array('student_id' => $row['student_id'], 'year' => $running_year))->result();
                if (empty($fee)) {
                    $data_f['student_id'] = $row['student_id'];
                    $data_f['teacher_id'] = $row['teacher_id'];
                    $data_f['section_id'] = $row['section_id'];
                    $data_f['year'] = $running_year;
                    $data_f['amount'] = $this->input->post('amount');
                    $data_f['branch_id'] = $this->input->post('branch_id');

                    $this->db->insert('student_fee', $data_f);
                }
            }
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?student_fee/manage_student_fee/', 'refresh');
        }

        if ($param1 == 'update') {
            $branch_id = $this->db->get_where('monthly_fee', array('monthly_fee_id' => $param2))->row()->branch_id;
            $data['amount'] = $this->input->post('amount');
            //update monthly fee
            $this->db->where('monthly_fee_id', $param2);
            $this->db->update('monthly_fee', $data);

            $this->db->where(array('year' => $running_year, 'branch_id' => $branch_id));
            $this->db->update('student_fee', array('amount' => $data['amount']));

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?student_fee/manage_student_fee/', 'refresh');
        }

        $page_data['monthly_fee'] = $this->db->get_where('monthly_fee', array('year' => $running_year, 'branch_id' => $branch_id))->result_array();
        $page_data['login_user_level'] = $this->session->userdata('login_user_level');
        $page_data['login_user_branch'] = $this->session->userdata('login_user_branch');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/manage_student_fee';
        $page_data['page_title'] = get_phrase('student_fee');

        $this->load->view('backend/index', $page_data);
    }

    function student_fee_detail($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'edit') {
            $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $amount = $this->input->post('amount');
            $this->db->where('student_id', $param2);
            $this->db->where('year', $running_year);
            $this->db->update('student_fee', array('amount' => $amount));

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?student_fee/student_fee_detail/return_data', 'refresh');
        }
        if ($this->input->post('teacher_id') != '' && $this->input->post('year')) {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['year'] = $this->input->post('year');
            $class_fee_edit_data = array($page_data['teacher_id'], $page_data['year']);
            $this->session->set_userdata('class_fee_edit_data', $class_fee_edit_data);
        } else if ($param1 == 'return_data') {
            $class_fee_edit_data = $this->session->userdata('class_fee_edit_data');
            $page_data['teacher_id'] = $class_fee_edit_data[0];
            $page_data['year'] = $class_fee_edit_data[1];
        } else {
            $page_data['teacher_id'] = '';
        }

        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/student_fee_detail';
        $page_data['page_title'] = get_phrase('student_fee_info');

        $this->load->view('backend/index', $page_data);
    }

    function view_student_transaction($param1, $param2) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'edit') {
            $amount = $this->input->post('amount');
            $month = $this->input->post('month');
            $student_id = $this->db->get_where('student_transaction', array('student_transaction_id' => $param2))->row()->student_id;
            $this->db->where('student_transaction_id', $param2);
            $this->db->update('student_transaction', array('amount' => $amount, 'month' => $month));
            
            $amount_s = $this->input->post('amount_s');
            $month_s = $this->input->post('month_s');

            $date = date('Y-m-d', strtotime($this->input->post('date_s')));
            $scholor_transaction_id = $this->input->post('scholarship_id');
            $this->db->where('id', $scholor_transaction_id);
            $this->db->update('scholorship_transaction', array('amount' => $amount_s, 'month' => $month_s, 'date' => $date));

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?student_fee/view_student_transaction/' . $student_id, 'refresh');
        }
        if ($param1 == 'delete') {
            $student_id = $this->db->get_where('student_transaction', array('student_transaction_id' => $param2))->row()->student_id;
            $this->db->where('student_transaction_id', $param2);
            $this->db->delete('student_transaction');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?student_fee/view_student_transaction/' . $student_id, 'refresh');
        }
        if ($param1 == 'edit_additional') {
            $amount = $this->input->post('amount');
            $month = $this->input->post('month');
            $date = date('Y-m-d', strtotime($this->input->post('date')));
            $student_id = $this->db->get_where('additional_student_fee', array('id' => $param2))->row()->student_id;
            $this->db->where('id', $param2);
            $this->db->update('additional_student_fee', array('amount' => $amount, 'month' => $month, 'date' => $date));

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?student_fee/view_student_transaction/' . $student_id, 'refresh');
        }
        if ($param1 == 'delete_additional') {
            $student_id = $this->db->get_where('additional_student_fee', array('id' => $param2))->row()->student_id;
            $this->db->where('id', $param2);
            $this->db->delete('additional_student_fee');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?student_fee/view_student_transaction/' . $student_id, 'refresh');
        }

        $page_data['student_id'] = $param1;
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/view_student_transaction';
        $page_data['page_title'] = get_phrase('student_transaction');
        $this->load->view('backend/index', $page_data);
    }

    /*     * ***Student Sponsor Start **** */

    function add_student_sponsor($param1 = '') {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $monthly_fee = $this->input->post('monthly_fee');
        $data['amount'] = $this->input->post('amount');
        $sponsor_id = $this->input->post('sponsor_id');


        $this->db->where('student_id', $param1);
        $this->db->where('year', $running_year);
        $this->db->update('student_fee', array('sponsor_id' => $sponsor_id));

        $data1['year'] = $running_year;
        $data1['amount'] = $this->input->post('amount');
        $data1['student_id'] = $param1;
        $data1['sponsor_id'] = $this->input->post('sponsor_id');
        $data1['teacher_id'] = $this->db->get_where('enroll', array('student_id' => $param1, 'year' => $running_year))->row()->teacher_id;
        $data1['branch_id'] = $this->db->get_where('enroll', array('student_id' => $param1, 'year' => $running_year))->row()->branch_id;

        $this->db->insert('sponsor_help', $data1);



        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(base_url() . 'index.php?student_fee/student_fee_detail/return_data', 'refresh');
    }

    function student_sponsor($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['branch_id'] = $this->input->post('branch_id');

            $this->db->insert('students_sponsor', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?student_fee/student_sponsor/', 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name'] = $this->input->post('name');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['branch_id'] = $this->input->post('branch_id');

            $this->db->where('sponsor_id', $param2);
            $this->db->update('students_sponsor', $data);

            $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?student_fee/student_sponsor/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('sponsor_id', $param2);
            $this->db->delete('students_sponsor');

            $this->session->set_flashdata('flash_message', get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'index.php?student_fee/student_sponsor/', 'refresh');
        }

        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/student_sponsor';
        $page_data['page_title'] = get_phrase('sponsor');
        $this->load->view('backend/index', $page_data);
    }

    function update_sponsor_help($param1 = '', $param2 = '') {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $data['amount'] = $this->input->post('amount');
        $data['sponsor_id'] = $this->input->post('sponsor_id');
        $this->db->where('student_id', $param1);
        $this->db->where('year', $running_year);
        $this->db->update('sponsor_help', $data);

        $this->db->where('student_id', $param1);
        $this->db->where('year', $running_year);
        $this->db->update('student_fee', array('sponsor_id' => $data['sponsor_id']));

        $this->session->set_flashdata('flash_message', get_phrase('data_updated_successfully'));
        redirect(base_url() . 'index.php?student_fee/student_fee_detail/return_data', 'refresh');
    }

    function delete_student_sponsor($student_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->where('student_id', $student_id);
        $this->db->where('year', $running_year);
        $this->db->update('student_fee', array('sponsor_id' => 0));

        $this->db->where('student_id', $student_id);
        $this->db->where('year', $running_year);
        $this->db->delete('sponsor_help');

        $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
        redirect(base_url() . 'index.php?student_fee/student_fee_detail/', 'refresh');
    }

    /*     * ***Student Sponsor End **** */

    /*     * ***Students fee transactions**** */

    function student_transaction($param1 = '', $param2 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if ($param1 == 'create') {
            $month = $this->input->post('month');
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['student_id'] = $this->input->post('student_id');
            $data['branch_id'] = $this->db->get_where('class', array('class_id' => $data['class_id']))->row()->branch_id;
            $data['amount'] = $this->input->post('amount');
            $data['year'] = $running_year;
            $data['date'] = date('Y-m-d');

            foreach ($month as $data1) {
                $data['month'] = $data1;
                $this->db->insert('student_transaction', $data);
            }

            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?student_fee/student_transaction', 'refresh');
        }
        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/student_transaction';
        $page_data['page_title'] = get_phrase('paid_payment');
        $this->load->view('backend/index', $page_data);
    }

    function get_class_students_parents($value) {
        $branch_id = $this->session->userdata('branch_id');
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if (is_numeric($value)) {
            $students = $this->db->get_where('enroll', array('status' => 1, 'year' => $year, 'teacher_id' => $value))->result_array();
        } else {
            $students = $this->db->get_where('enroll', array('status' => 1, 'year' => $year, 'branch_id' => $branch_id))->result_array();
        }

        echo '<option value="" selected>' . 'Select Student' . '</option>';
        foreach ($students as $row) {
            $name = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
            $parent_name = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->father_name;
            echo '<option value="' . $row['student_id'] . '">' . $name . ' / ' . $parent_name . '</option>';
        }
    }

    function get_student_fee_info($student_id) {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $payment_info = $this->db->get_where('student_transaction', array('student_id' => $student_id, 'year' => $running_year))->result_array();
        $student_fee = $this->db->get_where('student_fee', array('student_id' => $student_id, 'year' => $running_year))->row()->amount;
        $branch_fee = $this->db->get_where('monthly_fee', array('branch_id' => $this->session->userdata('branch_id'), 'year' => $running_year))->row()->amount;

        $no = 0;
        echo '<table><tr>'
        . '<td><h4>' . 'نام:' . $this->db->get_where('student', array('student_id' => $student_id))->row()->name . ' / ' .
        'ماہانہ فیس' . ' : ' . $branch_fee . ' / ' . ' ماہانہ ذاتی تعاون : ' . $student_fee . '</h4></td>' .
        '</tr> </table>';
        echo '<table style="width:100%; border:1px solid black; text-align:center;" border="1"><tr>' .
        '<td>نمبر شمار</td> <td>مہینہ</td> <td>تاریخ</td> <td>ذاتی تعاون</td><td>اذادارہ</td><tr>';
        foreach ($payment_info as $payment) {
            $no++;
            $date = '';
            $amount = 0;
            $month = '';
            $amount = $payment ['amount'];
            $date = date("d-m-Y", strtotime($payment ['date']));
            $month = $this->studentfee_model->get_month_name($payment['month']);

            $where1 = array();
            $where1['student_id'] = $student_id;
            $where1['year'] = $running_year;
            $where1['month'] = $payment['month'];
            $paid_month_scholarship = $this->studentfee_model->get_transactions_sum('scholorship_transaction', $where1, 'amount');

            echo "<tr> <td>$no</td> <td>$month</td> <td>$date</td> <td>$amount</td> <td>$paid_month_scholarship</td></tr>";
        }
        echo '</table>';
        echo '<br><h4 align="center">اضافی فیس</h4>';
        $additional_fee = $this->db->get_where('additional_student_fee', array('student_id' => $student_id, 'year' => $running_year))->result();
        if (!empty($additional_fee)) {
            echo '<table style="width:100%; border:1px solid black; text-align:center;" border="1"><tr>' .
            '<td>نمبر شمار</td> <td>مہینہ</td> <td>تاریخ</td> <td>رقم</td><tr>';
            foreach ($additional_fee as $a_fee) {
                $no1++;
                $date1 = '';
                $ad_amount = 0;
                $month1 = '';
                $ad_amount = $a_fee->amount;
                $date1 = date("d-m-Y", strtotime($a_fee->date));
                $month1 = $this->studentfee_model->get_month_name($a_fee->month);

                echo "<tr> <td>$no1</td> <td>$month1</td> <td>$date1</td> <td>$ad_amount</td></tr>";
            }
            echo '</table>';
        }
    }

    function add_student_transation() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $month = $this->input->post('month');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['student_id'] = $this->input->post('student_id');
        $data['branch_id'] = $this->session->userdata('branch_id');
        $data['amount'] = $this->input->post('amount');
        $data['year'] = $running_year;
        $data['date'] = date('Y-m-d');

        $data_a['teacher_id'] = $this->input->post('teacher_id');
        $data_a['student_id'] = $this->input->post('student_id');
        $data_a['branch_id'] = $this->session->userdata('branch_id');
        $data_a['amount'] = $this->input->post('additional_amount');
        $data_a['year'] = $running_year;
        $data_a['date'] = date('Y-m-d');

        if (!empty($this->input->post('additional_amount'))) {
            foreach ($month as $data1) {
                $data['month'] = $data1;
                $this->db->insert('student_transaction', $data);

                $data_a['month'] = $data1;
                $this->db->insert('additional_student_fee', $data_a);
            }
        } else {
            foreach ($month as $data1) {
                $data['month'] = $data1;
                $this->db->insert('student_transaction', $data);
            }
        }
    }

    function add_scholarship_transation() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $month = $this->input->post('month');
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['student_id'] = $this->input->post('student_id');
        $data['branch_id'] = $this->session->userdata('branch_id');
        $data['amount'] = $this->input->post('amount');
        $data['year'] = $running_year;
        $data['date'] = date('Y-m-d');


        foreach ($month as $data1) {
            $data['month'] = $data1;
            $this->db->insert('scholorship_transaction', $data);
        }
    }

    //******* Student Fee Slip *******//
    function student_fee_invoice($param1 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/student_fee_invoice';
        $page_data['page_title'] = get_phrase('fee_invoice');
        $this->load->view('backend/index', $page_data);
    }

    function student_invoice() {
        //        $month_s = explode('_', $this->input->post('month_s'));
//        $month_s_id = $month_s[0];
//        $month_s_name = $month_s[1];

        $page_data['teacher_id'] = $this->input->post('teacher_id');
        $page_data['student_id'] = $this->input->post('student_id');
        $page_data['due_date'] = $this->input->post('due_date');
        $page_data['months'] = $this->input->post('month_s');

//        $page_data['month_name'] = $month_s_name;
//        $page_data['month_id'] = $month_s_id;
        $this->load->view('backend/admin/accounting/_invoice', $page_data);
    }

    function sum_student_transaction($month, $student_id, $teacher_id) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->select('amount , sum(amount) AS payment');
        $this->db->from('student_transaction');
        $this->db->where("month BETWEEN 1 AND $month");
        $this->db->where(array('student_id' => $student_id, 'teacher_id' => $teacher_id, 'year' => "$year"));

        $query = $this->db->get();

        return $query->row()->payment;
    }

    function class_student_invoice() {
//        $month_c = explode('_', $this->input->post('month_c'));
//        $month_c_id = $month_c[0];
//        $month_c_name = $month_c[1];

        $page_data['teacher_id'] = $this->input->post('teacher_id_c');
        $page_data['due_date'] = $this->input->post('due_date_c');
        $page_data['months'] = $this->input->post('month_c');
        $this->load->view('backend/admin/accounting/_class_invoice', $page_data);
    }

    //******* Student Fee Slip *******//

    function get_class_students_mass($teacher_id) {
        $page_data['teacher_id'] = $teacher_id;
        $this->load->view('backend/admin/accounting/get_students', $page_data);
    }

    function selected_student_invoice() {
        $month_s = explode('_', $this->input->post('month_s'));
        $month_s_id = $month_s[0];
        $month_s_name = $month_s[1];

        $page_data['teacher_id'] = $this->input->post('teacher_id_s');
        $page_data['month_name'] = $month_s_name;
        $page_data['month_id'] = $month_s_id;
        $page_data['students'] = $this->input->post('student_id');
        $this->load->view('backend/admin/accounting/_selected_student_invoice', $page_data);
    }

    //********* Fee Reports ********//

    function class_fee_record() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('teacher_id') != '') {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['branch_id'] = $this->session->userdata('branch_id');

            $class_fee_record_data = array($page_data['teacher_id'], $page_data['branch_id']);
            $this->session->set_userdata('class_fee_record_data', $class_fee_record_data);
        } else {
            $page_data['teacher_id'] = '';
            $page_data['branch_id'] = '';
        }

        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['page_name'] = 'accounting/class_fee_record';
        $page_data['page_title'] = get_phrase('class_fee_record');
        $this->load->view('backend/index', $page_data);
    }

    function class_fee_record_print() {
        $class_fee_record_data = $this->session->userdata('class_fee_record_data');
        $page_data['teacher_id'] = $class_fee_record_data[0];
        $page_data['branch_id'] = $class_fee_record_data[1];
        $this->load->view('backend/admin/accounting/class_fee_record_print', $page_data);
    }

    function student_paid_fee_record() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('teacher_id') != '') {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['month'] = $this->input->post('month');
            $page_data['branch_id'] = $this->session->userdata('branch_id');


            $class_fee_record_data = array($page_data['teacher_id'], $page_data['branch_id'], $page_data['month']);
            $this->session->set_userdata('class_fee_record_data', $class_fee_record_data);
        } else {
            $page_data['teacher_id'] = '';
            $page_data['branch_id'] = '';
        }

        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['page_name'] = 'accounting/student_paid_fee_record';
        $page_data['page_title'] = get_phrase('student_paid_fee_record');
        $this->load->view('backend/index', $page_data);
    }

    function student_paid_fee_record_print() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $class_fee_record_data = $this->session->userdata('class_fee_record_data');
        $page_data['teacher_id'] = $class_fee_record_data[0];
        $page_data['branch_id'] = $class_fee_record_data[1];
        $page_data['month'] = $class_fee_record_data[2];
        $page_data['page_title'] = get_phrase('student_paid_fee_record');
        $this->load->view('backend/admin/accounting/student_paid_fee_record_print', $page_data);
    }

    function beneficiary_report() {
        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/beneficiary_report';
        $page_data['page_title'] = get_phrase('beneficiary_report');
        $this->load->view('backend/index', $page_data);
    }

    function beneficiary_report_print() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_title'] = get_phrase('beneficiary_report');
        $this->load->view('backend/admin/accounting/beneficiary_report_print', $page_data);
    }

    //Kafalat shuda students Fee Report

    function beneficiary_student_fee_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($this->input->post('teacher_id') != '') {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['month'] = $this->input->post('month');
        } else {
            $page_data['branch_id'] = '';
            $page_data['month'] = '';
        }
        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['page_name'] = 'accounting/beneficiary_student_fee_report';
        $page_data['page_title'] = get_phrase('beneficiary_report');
        $this->load->view('backend/index', $page_data);
    }

    function beneficiary_student_fee_report_print($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['branch_id'] = $param1;
        $page_data['month'] = $param2;
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_title'] = get_phrase('beneficiary_report');
        $this->load->view('backend/admin/accounting/beneficiary_student_fee_report_print', $page_data);
    }

    //empty months report for student fee 
    function empty_months_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('teacher_id') != '') {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['month'] = $this->input->post('month');
        } else {
            $page_data['teacher_id'] = '';
            $page_data['section_id'] = '';
            $page_data['month'] = '';
        }
        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/empty_months_report';
        $page_data['page_title'] = get_phrase('empty_months_report');
        $this->load->view('backend/index', $page_data);
    }

    function empty_months_report_print($param1 = '', $param3 = '') {
        $page_data['teacher_id'] = $param1;
        $page_data['month'] = $param3;
        $this->load->view('backend/admin/accounting/empty_months_report_print', $page_data);
    }

    function total_class_fee_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($this->input->post('teacher_id') != '') {
            $page_data['teacher_id'] = $this->input->post('teacher_id');
            $page_data['month_start'] = $this->input->post('month_start');
            $page_data['month_end'] = $this->input->post('month_end');
            $page_data['months'] = ($page_data['month_end'] - $page_data['month_start']) + 1;
            if ($page_data['months'] < 1) {
                $page_data['teacher_id'] = '';
                $page_data['month_start'] = '';
                $page_data['month_end'] = '';
                $this->session->set_flashdata('error_message', get_phrase('اپ نے مہینوں کا غلط انتخاب کیا ہوا ہے'));
                redirect(base_url() . 'index.php?student_fee/total_class_fee_report/', 'refresh');
            }
        } else {
            $page_data['teacher_id'] = '';
            $page_data['month_start'] = '';
            $page_data['month_end'] = '';
        }

        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/total_class_fee_report';
        $page_data['page_title'] = get_phrase('total_class_fee_report');
        $this->load->view('backend/index', $page_data);
    }

    function individual_student_fee_add() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $student_id = $this->input->post('student_id');
        $amount = $this->input->post('amount');

        $enroll_data = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $year))->row();
        $data['student_id'] = $student_id;
        $data['teacher_id'] = $enroll_data->teacher_id;
        $data['section_id'] = $enroll_data->section_id;
        $data['branch_id'] = $enroll_data->branch_id;
        $data['year'] = $year;
        $data['amount'] = $amount;

        $this->db->insert('student_fee', $data);
        $this->session->set_flashdata('flash_message', 'فیس کو کامیابی سے داخل کر دیا گیا۔۔۔');
        redirect(base_url() . 'index.php?student_fee/manage_student_fee/', 'refresh');
    }

    /*
      |--------------------------------------------------------------------------
      | Scholarship Transactions
      |--------------------------------------------------------------------------
     */

    function scholarship_transaction() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'scholarship/scholarship_transaction';
        $page_data['page_title'] = get_phrase('scholarship_transaction');
        $this->load->view('backend/index', $page_data);
    }

    function sector_report() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['page_name'] = 'accounting/sector_report';
        $page_data['page_title'] = get_phrase('sector_report');
        $this->load->view('backend/index', $page_data);
    }

    function sector_report_view() {
        $page_data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['months'] = $this->input->post('month');
        $this->load->view('backend/admin/accounting/sector_report_view', $page_data);
    }

    function tamleek_paid_fee_record() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['login_user_branch'] = $this->session->userdata('branch_id');
        $page_data['user_login_id'] = $this->session->userdata('admin_id');
        $page_data['page_name'] = 'accounting/tamleek_paid_fee_record';
        $page_data['page_title'] = get_phrase('tamleek_paid_fee_record');
        $this->load->view('backend/index', $page_data);
    }

    function tamleek_paid_fee_record_print() {
        $page_data['teacher_id'] = $this->input->post('teacher_id');
        $page_data['month'] = $this->input->post('month');
        $page_data['branch_id'] = $this->db->get_where('teacher', array('teacher_id' => $page_data['teacher_id']))->row()->branch_id;
        $this->load->view('backend/admin/accounting/tamleek_paid_fee_record_print', $page_data);
    }

}
