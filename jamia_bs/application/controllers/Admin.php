<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  @author   : Ijaz sunny
 *  date      : 1st November 2020
 *  Jamia Usmania Peshawar
 *  http:usmaniapsh.com
 *  http://softsunny.com
 *  imsunny37@gmail.com
 */

class Admin extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->library('session');

        /* LOADING ALL THE MODELS HERE */
        $this->load->model('Crud_model', 'crud_model');
        $this->load->model('User_model', 'user_model');
        $this->load->model('api/Admin_model', 'admin_model');
        $this->load->model('Settings_model', 'settings_model');

        /* cache control */
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");

        /* SET DEFAULT TIMEZONE */
        timezone();

        /* LOAD EXTERNAL LIBRARIES */
        $this->load->library('pdf');

        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
    }

    //dashboard
    public function index() {
        redirect(route('dashboard'), 'refresh');
    }

    public function dashboard() {

        // $this->msg91_model->clickatell();
        $page_data['page_title'] = 'Dashboard';
        $page_data['folder_name'] = 'dashboard';

        $this->load->view('backend/index', $page_data);
    }

    //END CLASS_ROOM section
    //START SUBJECT section
    public function subject($param1 = '', $param2 = '') {

        if ($param1 == 'create') {
            $response = $this->crud_model->subject_create();
            echo $response;
        }

        if ($param1 == 'update') {
            $response = $this->crud_model->subject_update($param2);
            echo $response;
        }

        if ($param1 == 'delete') {
            $response = $this->crud_model->subject_delete($param2);
            echo $response;
        }

        if ($param1 == 'list') {
            $this->load->view('backend/admin/subject/list');
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'subject';
            $page_data['page_title'] = 'subject';
            $this->load->view('backend/index', $page_data);
        }
    }

    public function class_wise_subject($class_id) {

        // PROVIDE A LIST OF SUBJECT ACCORDING TO CLASS ID
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/subject/dropdown', $page_data);
    }

    //END SUBJECT section
    //START DEPARTMENT section
    public function department($param1 = '', $param2 = '') {

        if ($param1 == 'create') {
            $response = $this->crud_model->department_create();
            echo $response;
        }

        if ($param1 == 'update') {
            $response = $this->crud_model->department_update($param2);
            echo $response;
        }

        if ($param1 == 'delete') {
            $response = $this->crud_model->department_delete($param2);
            echo $response;
        }

        // Get the data from database
        if ($param1 == 'list') {
            $this->load->view('backend/admin/department/list');
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'department';
            $page_data['page_title'] = 'department';
            $this->load->view('backend/index', $page_data);
        }
    }

    //END DEPARTMENT section
    //START SEMESTER section
    public function semester($param1 = '', $param2 = '') {

        if ($param1 == 'create') {
            $response = $this->crud_model->semester_create();
            echo $response;
        }

        if ($param1 == 'update') {
            $response = $this->crud_model->semester_update($param2);
            echo $response;
        }

        if ($param1 == 'delete') {
            $response = $this->crud_model->semester_delete($param2);
            echo $response;
        }

        // Get the data from database
        if ($param1 == 'list') {
            $this->load->view('backend/admin/semester/list');
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'semester';
            $page_data['page_title'] = 'semester';
            $this->load->view('backend/index', $page_data);
        }
    }

    // START SECTION
    public function section($param1 = '', $param2 = '') {

        if ($param1 == 'create') {
            $response = $this->crud_model->section_create();
            echo $response;
        }

        if ($param1 == 'update') {
            $response = $this->crud_model->section_update($param2);
            echo $response;
        }

        if ($param1 == 'delete') {
            $response = $this->crud_model->section_delete($param2);
            echo $response;
        }

        // Get the data from database
        if ($param1 == 'list') {
            $this->load->view('backend/admin/section/list');
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'section';
            $page_data['page_title'] = 'section';
            $this->load->view('backend/index', $page_data);
        }
    }

    //END SEMESTER section
    //START BATCH section
    public function batch($param1 = '', $param2 = '') {

        if ($param1 == 'create') {
            $response = $this->crud_model->batch_create();
            echo $response;
        }

        if ($param1 == 'update') {
            $response = $this->crud_model->batch_update($param2);
            echo $response;
        }

        if ($param1 == 'delete') {
            $response = $this->crud_model->department_delete($param2);
            echo $response;
        }

        // Get the data from database
        if ($param1 == 'list') {
            $this->load->view('backend/admin/batch/list');
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'batch';
            $page_data['page_title'] = 'batch';
            $this->load->view('backend/index', $page_data);
        }
    }

    //START DEGREE/CERTIFICATION section
    public function degree($param1 = '', $param2 = '') {

        if ($param1 == 'create') {
            $response = $this->crud_model->degree_create();
            echo $response;
        }

        if ($param1 == 'update') {
            $response = $this->crud_model->degree_update($param2);
            echo $response;
        }

        if ($param1 == 'delete') {
            $response = $this->crud_model->degree_delete($param2);
            echo $response;
        }

        // Get the data from database
        if ($param1 == 'list') {
            $this->load->view('backend/admin/degree/list');
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'degree';
            $page_data['page_title'] = 'degree/certification';
            $this->load->view('backend/index', $page_data);
        }
    }

    //END SYLLABUS section
    //START TEACHER section
    public function teacher($param1 = '', $param2 = '', $param3 = '') {


        if ($param1 == 'create') {
            $response = $this->user_model->create_teacher();
            echo $response;
        }

        if ($param1 == 'update') {
            $response = $this->user_model->update_teacher($param2);
            echo $response;
        }

        if ($param1 == 'delete') {
            $user_id = $this->db->get_where('teachers', array('user_id' => $param2))->row('user_id');
            $response = $this->user_model->delete_teacher($param2, $user_id);
            echo $response;
        }

        if ($param1 == 'list') {
            $this->load->view('backend/admin/teacher/list');
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'teacher';
            $page_data['page_title'] = 'techers';
            $this->load->view('backend/index', $page_data);
        }
    }

    //END TEACHER section
    //START TEACHER PERMISSION section
    public function permission($param1 = '', $param2 = '', $param3 = '', $param4 = '') {

        if ($param1 == 'filter') {
            $page_data['department_id'] = $param2;
            $page_data['batch_id'] = $param3;
            $page_data['semester_id'] = $param4;
            $this->load->view('backend/admin/permission/list', $page_data);
        }

        if ($param1 == 'modify_permission') {
            $page_data['department_id'] = $this->input->post('department_id');
            $page_data['batch_id'] = $this->input->post('batch_id');
            $page_data['semester_id'] = $this->input->post('semester_id');
            $this->user_model->teacher_permission();
            $this->load->view('backend/admin/permission/list', $page_data);
        }

        if (empty($param1)) {
            $page_data['folder_name'] = 'permission';
            $page_data['page_title'] = 'teacher_permissions';
            $this->load->view('backend/index', $page_data);
        }
    }

    //END TEACHER PERMISSION section
    //START PARENT section
    public function parent($param1 = '', $param2 = '') {
    if($param1 == 'create') {
//    $response = $this-> user_model->parent_create();
//    echo $response;
    }

    if($param1 == 'update') {
//    $response = $this-> user_model->parent_update($param2);
//    echo $response;
    }

    if($param1 == 'delete') {
    $response = $this-> user_model->parent_delete($param2);
    echo $response;
}

// show data from database
if ($param1 == 'list') {
    $this->load->view('backend/admin/parent/list');
}

if (empty($param1)) {
    $page_data['folder_name'] = 'parent';
    $page_data['page_title'] = 'parent';
    $this->load->view('backend/index', $page_data);
}
}

//END DAILY ATTENDANCE section
//START EVENT CALENDAR section
public function event_calendar($param1 = '', $param2 = '') {

if ($param1 == 'create') {
    $response = $this->crud_model->event_calendar_create();
    echo $response;
}

if ($param1 == 'update') {
    $response = $this->crud_model->event_calendar_update($param2);
    echo $response;
}

if ($param1 == 'delete') {
    $response = $this->crud_model->event_calendar_delete($param2);
    echo $response;
}

if ($param1 == 'all_events') {
    echo $this->crud_model->all_events();
}

if ($param1 == 'list') {
    $this->load->view('backend/admin/event_calendar/list');
}

if (empty($param1)) {
    $page_data['folder_name'] = 'event_calendar';
    $page_data['page_title'] = 'event_calendar';
    $this->load->view('backend/index', $page_data);
}
}

//END EVENT CALENDAR section
//START STUDENT ADN ADMISSION section
public function student($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {

if ($param1 == 'create') {
    $page_data['aria_expand'] = 'single';
    $page_data['working_page'] = 'create';
    $page_data['folder_name'] = 'student';
    $page_data['page_title'] = 'add_student';
    $this->load->view('backend/index', $page_data);
}

//create to database
if ($param1 == 'create_single_student') {
    $response = $this->user_model->single_student_create();
    echo $response;
}


// form view
if ($param1 == 'edit') {
    $page_data['student_id'] = $param2;
    $page_data['working_page'] = 'edit';
    $page_data['folder_name'] = 'student';
    $page_data['page_title'] = 'update_student_information';
    $this->load->view('backend/index', $page_data);
}

//updated to database
if ($param1 == 'updated') {
    $response = $this->user_model->student_update($param2, $param3);
    $this->session->set_flashdata('info_message', 'Student data has been updated Successfully...');
    redirect(route('student/edit/' . $param2), 'refresh');
}
//updated to database
if ($param1 == 'id_card') {
    $page_data['student_id'] = $param2;
    $page_data['folder_name'] = 'student';
    $page_data['page_title'] = 'identity_card';
    $page_data['page_name'] = 'id_card';
    $this->load->view('backend/index', $page_data);
}

if ($param1 == 'delete') {
    $response = $this->user_model->delete_student($param2, $param3);
    echo $response;
}

if ($param1 == 'filter') {
    $page_data['department_id'] = $param2;
    $page_data['batch_id'] = $param3;
    $page_data['semester_id'] = $param4;
    $page_data['section_id'] = $param5;
    if ($param2 != '' && $param3 == '' && $param4 == '' && $param5 == '') {
        $page_data['content'] = '_department_list.php';
        $page_data['student_data'] = $this->admin_model->student_data('department', $param2);
    } elseif ($param2 != '' && $param3 != '' && $param4 == '' && $param5 == '') {
        $page_data['content'] = '_batch_list.php';
        $page_data['student_data'] = $this->admin_model->student_data('batch', $param3);
    } elseif ($param2 != '' && $param3 != '' && $param4 != '' && $param5 == '') {
        $page_data['content'] = '_semester_list.php';
        $page_data['student_data'] = $this->admin_model->student_data('semester', $param4);
    } elseif ($param2 != '' && $param3 != '' && $param4 != '' && $param5 != '') {
        $page_data['content'] = '_section_list.php';
    }
    $this->load->view('backend/admin/student/list', $page_data);
}

if (empty($param1)) {
    $page_data['working_page'] = 'filter';
    $page_data['folder_name'] = 'student';
    $page_data['page_title'] = 'student_list';
    $this->load->view('backend/index', $page_data);
}
}

//EXPORT STUDENT FEES
public function export($param1 = "", $date_from = "", $date_to = "", $selected_class = "", $selected_status = "") {
//RETURN EXPORT URL
if ($param1 == 'url') {
    $type = $this->input->post('type');
    $date = explode('-', $this->input->post('dateRange'));
    $date_from = strtotime($date[0] . ' 00:00:00');
    $date_to = strtotime($date[1] . ' 23:59:59');
    $selected_class = $this->input->post('selectedClass');
    $selected_status = $this->input->post('selectedStatus');
    echo route('export/' . $type . '/' . $date_from . '/' . $date_to . '/' . $selected_class . '/' . $selected_status);
}
// EXPORT AS PDF
if ($param1 == 'pdf' || $param1 == 'print') {
    $page_data['action'] = $param1;
    $page_data['date_from'] = $date_from;
    $page_data['date_to'] = $date_to;
    $page_data['selected_class'] = $selected_class;
    $page_data['selected_status'] = $selected_status;
    $html = $this->load->view('backend/admin/invoice/export', $page_data, true);

    $this->pdf->loadHtml($html);
    $this->pdf->set_paper("a4", "landscape");
    $this->pdf->render();

    // FILE DOWNLOADING CODES
    if ($selected_status == 'all') {
        $paymentStatusForTitle = 'paid-and-unpaid';
    } else {
        $paymentStatusForTitle = $selected_status;
    }
    if ($selected_class == 'all') {
        $classNameForTitle = 'all_class';
    } else {
        $class_details = $this->crud_model->get_classes($selected_class)->row_array();
        $classNameForTitle = $class_details['name'];
    }
    $fileName = 'Student_fees-' . date('d-M-Y', $date_from) . '-to-' . date('d-M-Y', $date_to) . '-' . $classNameForTitle . '-' . $paymentStatusForTitle . '.pdf';

    if ($param1 == 'pdf') {
        $this->pdf->stream($fileName, array("Attachment" => 1));
    } else {
        $this->pdf->stream($fileName, array("Attachment" => 0));
    }
}
// EXPORT AS CSV
if ($param1 == 'csv') {
    $date_from = $date_from;
    $date_to = $date_to;
    $selected_class = $selected_class;
    $selected_status = $selected_status;

    $invoices = $this->crud_model->get_invoice_by_date_range($date_from, $date_to, $selected_class, $selected_status)->result_array();
    $csv_file = fopen("assets/csv_file/invoices.csv", "w");
    $header = array('Invoice-no', 'Student', 'Class', 'Invoice-Title', 'Total-Amount', 'Paid-Amount', 'Creation-Date', 'Payment-Date', 'Status');
    fputcsv($csv_file, $header);
    foreach ($invoices as $invoice) {
        $student_details = $this->user_model->get_student_details_by_id('student', $invoice['student_id']);
        $class_details = $this->crud_model->get_class_details_by_id($invoice['class_id'])->row_array();
        if ($invoice['updated_at'] > 0) {
            $payment_date = date('d-M-Y', $invoice['updated_at']);
        } else {
            $payment_date = get_phrase('not_found');
        }
        $lines = array(sprintf('%08d', $invoice['id']), $student_details['name'], $class_details['name'], $invoice['title'], currency($invoice['total_amount']), currency($invoice['paid_amount']), date('d-M-Y', $invoice['created_at']), $payment_date, ucfirst($invoice['status']));
        fputcsv($csv_file, $lines);
    }

    // FILE DOWNLOADING CODES
    if ($selected_status == 'all') {
        $paymentStatusForTitle = 'paid-and-unpaid';
    } else {
        $paymentStatusForTitle = $selected_status;
    }
    if ($selected_class == 'all') {
        $classNameForTitle = 'all_class';
    } else {
        $class_details = $this->crud_model->get_classes($selected_class)->row_array();
        $classNameForTitle = $class_details['name'];
    }
    $fileName = 'Student_fees-' . date('d-M-Y', $date_from) . '-to-' . date('d-M-Y', $date_to) . '-' . $classNameForTitle . '-' . $paymentStatusForTitle . '.csv';
    $this->download_file('assets/csv_file/invoices.csv', $fileName);
}
}

/* FUNCTION FOR DOWNLOADING A FILE */

function download_file($path, $name) {
// make sure it's a file before doing anything!
if (is_file($path)) {
    // required for IE
    if (ini_get('zlib.output_compression')) {
        ini_set('zlib.output_compression', 'Off');
    }

    // get the file mime type using the file extension
    $this->load->helper('file');

    $mime = get_mime_by_extension($path);

    // Build the headers to push out the file properly.
    header('Pragma: public');     // required
    header('Expires: 0');         // no cache
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
    header('Cache-Control: private', false);
    header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
    header('Content-Disposition: attachment; filename="' . basename($name) . '"');  // Add the file name
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($path)); // provide file size
    header('Connection: close');
    readfile($path); // push it out
    exit();
}
}

// NOTICEBOARD MANAGER
public function noticeboard($param1 = "", $param2 = "", $param3 = "") {
// adding notice
if ($param1 == 'create') {
    $response = $this->crud_model->create_notice();
    echo $response;
}

// update notice
if ($param1 == 'update') {
    $response = $this->crud_model->update_notice($param2);
    echo $response;
}

// deleting notice
if ($param1 == 'delete') {
    $response = $this->crud_model->delete_notice($param2);
    echo $response;
}
// showing the list of notice
if ($param1 == 'list') {
    $this->load->view('backend/admin/noticeboard/list');
}

// showing the all the notices
if ($param1 == 'all_notices') {
    $response = $this->crud_model->get_all_the_notices();
    echo $response;
}

// showing the index file
if (empty($param1)) {
    $page_data['folder_name'] = 'noticeboard';
    $page_data['page_title'] = 'noticeboard';
    $this->load->view('backend/index', $page_data);
}
}

// SETTINGS MANAGER
public function settings($param1 = "", $param2 = "") {
if ($param1 == 'update') {
    $response = $this->settings_model->update_settings();
    echo $response;
}

// showing the System Settings file
if (empty($param1)) {
    $page_data['folder_name'] = 'settings';
    $page_data['page_title'] = 'school_settings';
    $page_data['settings_type'] = 'school_settings';
    $this->load->view('backend/index', $page_data);
}
}

// SETTINGS MANAGER
//MANAGE PROFILE STARTS
public function profile($param1 = "", $param2 = "") {
if ($param1 == 'update_profile') {
    $response = $this->user_model->update_profile();
    echo $response;
}
if ($param1 == 'update_password') {
    $response = $this->user_model->update_password();
    echo $response;
}

// showing the Smtp Settings file
if (empty($param1)) {
    $page_data['folder_name'] = 'profile';
    $page_data['page_title'] = 'manage_profile';
    $this->load->view('backend/index', $page_data);
}
}

//MANAGE PROFILE ENDS
// GET BRANCH BATCH
public function get_department_batch($department_id = '') {
$departments = $this->db->get_where('batch', array(
            'department_id' => $department_id
        ))->result();
echo '<option value="">Select Batch</option>';
foreach ($departments as $row) {
    echo '<option value="' . $row->batch_id . '">' . $row->name . '</option>';
}
}

public function get_batch_semester($batch_id = '') {
$semesters = $this->db->get_where('semester', array(
            'batch_id' => $batch_id
        ))->result();
echo '<option value="">Select Semester</option>';
foreach ($semesters as $row) {
    echo '<option value="' . $row->id . '">' . $row->name . '</option>';
}
}

public function get_semester_section($semester_id = '') {
$sections = $this->db->get_where('section', array(
            'semester_id' => $semester_id
        ))->result();
echo '<option value="">Select Section</option>';
foreach ($sections as $row) {
    echo '<option value="' . $row->section_id . '">' . $row->name . '</option>';
}
}

public function get_provinces($country_id = '') {
$provinces = $this->db->get_where('province', array(
            'country_id' => $country_id
        ))->result();
echo '<option value="">Select Province</option>';
foreach ($provinces as $row) {
    echo '<option value="' . $row->country_id . '">' . $row->name . '</option>';
}
}

function get_district($province_id = '') {
$districts = $this->db->get_where('district', array(
            'prov_id' => $province_id
        ))->result();
echo '<option value="">Select District</option>';
foreach ($districts as $row) {
    echo '<option value="' . $row->dist_id . '">' . $row->name . '</option>';
}
}

}
