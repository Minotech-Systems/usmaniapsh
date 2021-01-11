<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  @author   : Creativeitem
 *  date      : November, 2019
 *  Ekattor School Management System With Addons
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

require APPPATH . 'third_party/PHPExcel/IOFactory.php';

class Crud_model extends CI_Model {

//    protected $school_id;
//    protected $active_session;

    public function __construct() {
        parent::__construct();
//        $this->school_id = school_id();
//        $this->active_session = active_session();
    }

    //START CLASS section
    //get Class details by id
    public function get_department_details_by_id($id) {
        $dep_details = $this->db->get_where('departments', array('id' => $id));
        return $dep_details;
    }

    //END CLASS section
    //END SUBJECT section
    //START DEPARTMENT section
    public function department_create() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['comment'] = html_escape($this->input->post('comment'));
        $this->db->insert('departments', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('department_has_been_added_successfully')
        );

        return json_encode($response);
    }

    public function department_update($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['comment'] = html_escape($this->input->post('comment'));
        $this->db->where('id', $param1);
        $this->db->update('departments', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('department_has_been_updated_successfully')
        );

        return json_encode($response);
    }

    public function department_delete($param1 = '') {
        $this->db->where('id', $param1);
        $this->db->delete('departments');

        $response = array(
            'status' => true,
            'notification' => get_phrase('department_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    //END DEPARTMENT section
    //START BATCH section
    // Get section details by class and section id
    public function get_batch_details_by_id($type = "", $id = "") {
        $batch_details = array();
        if ($type == 'department') {
            $batch_details = $this->db->get_where('batch', array('department_id' => $id));
        } elseif ($type == 'batch') {
            $batch_details = $this->db->get_where('batch', array('batch_id' => $id));
        }
        return $batch_details;
    }

    public function batch_create() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['numeric_name'] = html_escape($this->input->post('numeric_name'));
        $data['department_id'] = html_escape($this->input->post('department_id'));
        $data['start_year'] = html_escape($this->input->post('start_year'));
        $data['end_year'] = html_escape($this->input->post('end_year'));
        $data['timestamp'] = time();
        $data['remarks'] = html_escape($this->input->post('comment'));
        $this->db->insert('batch', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('batch_has_been_added_successfully')
        );

        return json_encode($response);
    }

    public function batch_update($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['numeric_name'] = html_escape($this->input->post('numeric_name'));
        $data['department_id'] = html_escape($this->input->post('department_id'));
        $data['start_year'] = html_escape($this->input->post('start_year'));
        $data['end_year'] = html_escape($this->input->post('end_year'));
        $data['remarks'] = html_escape($this->input->post('comment'));
        $this->db->where('batch_id', $param1);
        $this->db->update('batch', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('batch_has_been_updated_successfully')
        );

        return json_encode($response);
    }

    public function batch_delete($param1 = '') {
        $this->db->where('id', $param1);
        $this->db->delete('departments');

        $response = array(
            'status' => true,
            'notification' => get_phrase('department_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    //START SEMESTER section
    public function semester_create() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['numeric_name'] = html_escape($this->input->post('numeric_name'));
        $data['department_id'] = html_escape($this->input->post('department_id'));
        $data['batch_id'] = html_escape($this->input->post('batch_id'));
        $data['timestamp'] = time();
        $data['comment'] = html_escape($this->input->post('comment'));
        $this->db->insert('semester', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('semester_has_been_added_successfully')
        );

        return json_encode($response);
    }

    public function semester_update($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['numeric_name'] = html_escape($this->input->post('numeric_name'));
        $data['department_id'] = html_escape($this->input->post('department_id'));
        $data['batch_id'] = html_escape($this->input->post('batch_id'));
        $data['comment'] = html_escape($this->input->post('comment'));
        $this->db->where('id', $param1);
        $this->db->update('semester', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('semester_has_been_updated_successfully')
        );

        return json_encode($response);
    }

    public function semester_delete($param1 = '') {
        $this->db->where('id', $param1);
        $this->db->delete('semester');

        $response = array(
            'status' => true,
            'notification' => get_phrase('semester_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    // START SECTION 
    public function section_create() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['numeric_name'] = html_escape($this->input->post('numeric_name'));
        $data['department_id'] = html_escape($this->input->post('department_id'));
        $data['batch_id'] = html_escape($this->input->post('batch_id'));
        $data['semester_id'] = html_escape($this->input->post('semester_id'));
        $data['timestamp'] = time();
        $data['comment'] = html_escape($this->input->post('comment'));
        $this->db->insert('section', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('section_has_been_added_successfully')
        );

        return json_encode($response);
    }

    public function section_update($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['numeric_name'] = html_escape($this->input->post('numeric_name'));
        $data['department_id'] = html_escape($this->input->post('department_id'));
        $data['batch_id'] = html_escape($this->input->post('batch_id'));
        $data['semester_id'] = html_escape($this->input->post('semester_id'));
        $data['timestamp'] = time();
        $data['comment'] = html_escape($this->input->post('comment'));
        $this->db->where('section_id', $param1);
        $this->db->update('section', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('section_has_been_updated_successfully')
        );

        return json_encode($response);
    }

    public function section_delete($param1 = '') {
        $this->db->where('section_id', $param1);
        $this->db->delete('section');

        $response = array(
            'status' => true,
            'notification' => get_phrase('section_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    //START SUBJECT section
    public function subject_create() {
        $data['name'] = html_escape($this->input->post('name'));
        $data['code'] = html_escape($this->input->post('code'));
        $this->db->insert('subject', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('subject_has_been_added_successfully')
        );

        return json_encode($response);
        
    }

    public function subject_update($param1 = '') {
        $data['name'] = html_escape($this->input->post('name'));
        $data['code'] = html_escape($this->input->post('code'));
        $this->db->where('subject_id', $param1);
        $this->db->update('subject', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('subject_has_been_updated_successfully')
        );

        return json_encode($response);
    }

    public function subject_delete($param1 = '') {
        $this->db->where('subject_id', $param1);
        $this->db->delete('subject');

        $response = array(
            'status' => true,
            'notification' => get_phrase('subject_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    //END DAILY ATTENDANCE section
    //START EVENT CALENDAR section
    public function event_calendar_create() {
        $data['title'] = html_escape($this->input->post('title'));
        $data['starting_date'] = $this->input->post('starting_date') . ' 00:00:1';
        $data['ending_date'] = $this->input->post('ending_date') . ' 23:59:59';

        $this->db->insert('event_calendars', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('event_has_been_added_successfully')
        );

        return json_encode($response);
    }

    public function event_calendar_update($param1 = '') {
        $data['title'] = html_escape($this->input->post('title'));
        $starting_date = strtotime(date('d/m/Y')) + 1;
        $ending_date = strtotime(date('d/m/Y')) - 1;
        $data['starting_date'] = $this->input->post('starting_date') . ' 00:00:1';
        $data['ending_date'] = $this->input->post('ending_date') . ' 23:59:59';
        $this->db->where('id', $param1);
        $this->db->update('event_calendars', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('event_has_been_updated_successfully')
        );

        return json_encode($response);
    }

    public function event_calendar_delete($param1 = '') {
        $this->db->where('id', $param1);
        $this->db->delete('event_calendars');

        $response = array(
            'status' => true,
            'notification' => get_phrase('event_has_been_deleted_successfully')
        );

        return json_encode($response);
    }

    public function all_events() {

        $event_calendars = $this->db->get('event_calendars')->result_array();
        return json_encode($event_calendars);
    }

    public function get_current_month_events() {
//		$this->db->where('school_id', $this->school_id);
//		$this->db->where('session', $this->active_session);
        $events = $this->db->get('event_calendars');
        return $events;
    }

    //END EVENT CALENDAR section
    // START OF NOTICEBOARD SECTION
    public function create_notice() {
        $data['notice_title'] = html_escape($this->input->post('notice_title'));
        $data['notice'] = html_escape($this->input->post('notice'));
        $data['show_on_website'] = $this->input->post('show_on_website');
        $data['date'] = $this->input->post('date') . ' 00:00:1';
        if ($_FILES['notice_photo']['name'] != '') {
            $data['image'] = random(15) . '.jpg';
            move_uploaded_file($_FILES['notice_photo']['tmp_name'], 'uploads/images/notice_images/' . $data['image']);
        } else {
            $data['image'] = 'placeholder.png';
        }
        $this->db->insert('noticeboard', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('notice_has_been_created')
        );

        return json_encode($response);
    }

    public function update_notice($notice_id) {
        $data['notice_title'] = html_escape($this->input->post('notice_title'));
        $data['notice'] = html_escape($this->input->post('notice'));
        $data['show_on_website'] = $this->input->post('show_on_website');
        $data['date'] = $this->input->post('date') . ' 00:00:1';
        if ($_FILES['notice_photo']['name'] != '') {
            $data['image'] = random(15) . '.jpg';
            move_uploaded_file($_FILES['notice_photo']['tmp_name'], 'uploads/images/notice_images/' . $data['image']);
        }
        $this->db->where('id', $notice_id);
        $this->db->update('noticeboard', $data);

        $response = array(
            'status' => true,
            'notification' => get_phrase('notice_has_been_updated')
        );

        return json_encode($response);
    }

    public function delete_notice($notice_id) {
        $this->db->where('id', $notice_id);
        $this->db->delete('noticeboard');

        $response = array(
            'status' => true,
            'notification' => get_phrase('notice_has_been_deleted')
        );

        return json_encode($response);
    }

    public function get_all_the_notices() {
        $notices = $this->db->get('noticeboard')->result_array();
        return json_encode($notices);
    }

    public function get_noticeboard_image($image) {
        if (file_exists('uploads/images/notice_images/' . $image))
            return base_url() . 'uploads/images/notice_images/' . $image;
        else
            return base_url() . 'uploads/images/notice_images/placeholder.png';
    }

    // Grade ends
    // Student Promotion section Starts
    public function get_student_list() {
        $session_from = $this->input->post('session_from');
        $session_to = $this->input->post('session_to');
        $class_id_from = $this->input->post('class_id_from');
        $class_id_to = $this->input->post('class_id_to');
        $checker = array(
            'class_id' => $class_id_from,
            'session' => $session_from,
        );
        return $this->db->get_where('enrols', $checker);
    }

    // Student Promotion section Ends
    // A function to convert excel to csv
    public function excel_to_csv($file_path = "", $rename_to = "") {
        //read file from path
        $inputFileType = PHPExcel_IOFactory::identify($file_path);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($file_path);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $index = 0;
        if ($objPHPExcel->getSheetCount() > 1) {
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $objPHPExcel->setActiveSheetIndex($index);
                $fileName = strtolower(str_replace(array("-", " "), "_", $worksheet->getTitle()));
                $outFile = str_replace(".", "", $fileName) . ".csv";
                $objWriter->setSheetIndex($index);
                $objWriter->save("assets/csv_file/" . $outFile);
                $index++;
            }
        } else {
            $outFile = $rename_to;
            $objWriter->setSheetIndex($index);
            $objWriter->save("assets/csv_file/" . $outFile);
        }

        return true;
    }

    /**
     * CURL CALL FOR PURCHASE CODE VALIDATION
     */
    function curl_request($code = '') {

        $product_code = $code;

        $personal_token = "FkA9UyDiQT0YiKwYLK3ghyFNRVV9SeUn";
        $url = "https://api.envato.com/v3/market/author/sale?code=" . $product_code;
        $curl = curl_init($url);

        //setting the header for the rest of the api
        $bearer = 'bearer ' . $personal_token;
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:' . $product_code . '.json';
        $ch_verify = curl_init($verify_url . '?code=' . $product_code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        $response = json_decode($cinit_verify_data, true);

        if (count($response['verify-purchase']) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function unlink($type, $image) {

        $unlink_url = './uploads/' . $type . '_image/' . $image;
        unlink($unlink_url);
    }

    public function upload_image($path, $type) {
        $config['upload_path'] = './uploads/images/' . $path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($type)) {
            echo $this->upload->display_errors();
            exit();
        } else {
            $data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/images/' . $path . '/' . $data["file_name"];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 350;
            $config['height'] = 390;
            $config['new_image'] = './uploads/images/' . $path . '/' . $data["file_name"];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            return $image_data = array('image' => $data["file_name"]);
        }
    }

    public function update($table_name, $data, $where) {
        $this->db->where($where);
        $this->db->update($table_name, $data);
    }

}
