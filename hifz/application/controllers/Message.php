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

class Message extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('exam_model');
        $this->load->model('sms_model');

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function sending_sms($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == '' || $param1 == 'send_general_sms') {
            $page_data['page_content'] = 'send_general_sms';
        }
        if ($param1 == 'mark_sms') {
            $page_data['page_content'] = 'mark_sms';
        }
        if ($param1 == 'combine_exam_sms') {
            $page_data['page_content'] = 'combine_exam_sms';
        }
        if ($param1 == 'parent_login_sms') {
            $page_data['page_content'] = 'parent_login_sms';
        }
        $page_data['login_user_level'] = $this->session->userdata('login_user_level');
        $page_data['login_user_branch'] = $this->session->userdata('login_user_branch');
        $page_data['page_name'] = 'messages/sending_sms';
        $page_data['page_title'] = get_phrase('pages');
        $this->load->view('backend/index', $page_data);
    }

    function get_class_students_mass($teacher_id) {

        $page_data['teacher_id'] = $teacher_id;
        $this->load->view('backend/admin/messages/get_students_for_sms', $page_data);
    }

    function get_branch_teachers() {
        $page_data['branch_id'] = $this->session->userdata('branch_id');
        $this->load->view('backend/admin/messages/get_branch_teachers', $page_data);
    }

    function send_general_sms() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $otherdb = $this->load->database('otherdb', TRUE);
        $message = $this->input->post('general_message');
        $value = $this->input->post('relation');
//        $otherdb->truncate('sms_numbers');

        switch ($value) {
            case 'class_wise':
                $students = $this->input->post('student_id');
                foreach ($students as $row) {
                    $receiver = $this->db->get_where('student', array('student_id' => $row))->row()->phone;
                    $mark_message = $message;
                    $phone = $this->clean_number($receiver);
                    $this->Send_Message_Api($phone, $mark_message);
                }
                break;
        }

        //$this->sendPushNotification('General SMS');
        $this->session->set_flashdata('flash_message', get_phrase('message_send'));
        redirect(base_url() . 'index.php?message/sending_sms/', 'refresh');
    }

    function send_parent_login_sms() {
        $otherdb = $this->load->database('otherdb', TRUE);
        $students = $this->input->post('student_id');
        $message = $this->input->post('message');
        foreach ($students as $row) {
            $info = $this->db->get_where('student', array('student_id' => $row))->row();
            $student_name = $info->name;
            $parent_name = $info->father_name;
            $receiver = $info->phone;
            $message .= "  " . 'نام ' . ' : ' . $student_name . "  " . 'ولد' . ' : ' . $parent_name . "  " .
                    'لاگ ان نمبر' . ' : ' . 'H' . $row . '-' . $info->reg_no . "  " . 'طریقہ :' . "  " .
                    'لنک پر کلک کریں' . "  " . 'http://usmaniapsh.com/hifz/index.php?parent_login';

            $phone = $this->clean_number($receiver);
            $this->Send_Message_Api($phone, $message);
        }
        $this->sendPushNotification('Parent Login SMS');
        $this->session->set_flashdata('flash_message', get_phrase('message_send'));
        redirect(base_url() . 'index.php?message/sending_sms/parent_login_sms', 'refresh');
    }

    function send_marks_sms() {
        $otherdb = $this->load->database('otherdb', TRUE);
        $branch_id = $this->session->userdata('branch_id');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $year = explode('-', $running_year);
        $teacher_id = $this->input->post('teacher_id');
        $exam_id = $this->input->post('exam_id');
        $students = $this->input->post('student_id');

        $this->exam_model->validate_exam_marks($teacher_id, $exam_id, $running_year);

        $class_name = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->name;
        $class_id = $this->db->get_where('class', array('branch_id' => $branch_id))->row()->class_id;
        $section_name = $this->db->get_where('section', array('class_id' => $class_id))->row()->name;
        $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;

        $otherdb->truncate('sms_numbers');

        foreach ($students as $row) {
            $total_obt_marks = 0;
            $in_total_marks = 0;
            $student_name = $this->db->get_where('student', array('student_id' => $row))->row()->name;
            $parent_name = $this->db->get_where('student', array('student_id' => $row))->row()->father_name;
            $receiver = $this->db->get_where('student', array('student_id' => $row))->row()->phone;

            $marks_data = $this->db->get_where('mark_summery', array('student_id' => $row,
                        'teacher_id' => $teacher_id,
                        'exam_id' => $exam_id,
                        'year' => $running_year))->row();

            $posi = $marks_data->class_position;
            $position = $this->get_position($posi);
            $position = $posi . $position;

            $obt_marks = $marks_data->obt_marks;
            $total_marks = $marks_data->total_marks;


            $mark_message = 'نام:' . $student_name . "  " . 'ولدیت:' . $parent_name . "  " .
                    'کلاس:' . $class_name . '(' . $section_name . ')' . "  " .
                    'مجموعی نمبرات: ' . $total_marks . "  " .
                    'حاصل کردہ نمبرات:' . $obt_marks . "  " .
                    'پوزیشن:' . $position . "  " . 'امتحان:' . $exam_name . "  " .
                    'سال:' . $year[1] . '-' . $year[0] . "  " . 'جامعہ عثمانیہ پشاور';

            
            $phone = $this->clean_number($receiver);
            $this->Send_Message_Api($phone, $mark_message);
        }
        //$this->sendPushNotification('Exam SMS');
        $this->session->set_flashdata('flash_message', get_phrase('message_send'));
        redirect(base_url() . 'index.php?message/sending_sms/' . 'mark_sms', 'refresh');
    }

    function send_combine_exam_sms() {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $exams = $this->input->post('exam_id');
        $teacher_id = $this->input->post('teacher_id');
        $students = $this->input->post('student_id');
        $exam_id1 = $exams[0];
        $exam_id2 = $exams[1];
        $exam_id3 = $exams[2];
        $exam_id4 = $exams[3];

        $array_size = sizeof($exams);
        if ($array_size < 4 || $array_size > 4) {
            $this->session->set_flashdata('error_message', get_phrase('آپ صرف چار امتحانات کلیے نتیجہ پیغام ارسال کر سکتے ہیں  ۔۔۔'));
            redirect(base_url() . 'index.php?message/sending_sms/combine_exam_sms', 'refresh');
        } else {

            foreach ($exams as $exam) {

                $this->exam_model->validate_exam_marks($teacher_id, $exam, $running_year);
            }
            $this->exam_model->validate_combine_exam_marks($exam_id1, $exam_id2, $exam_id3, $exam_id4, $teacher_id, $running_year);
        }
        foreach ($students as $data) {
            $this->sms_model->send_combine_exam_sms($data, $teacher_id, $exam_id1, $exam_id2, $exam_id3, $exam_id4);
        }
        $this->sendPushNotification('Exam SMS');
        $this->session->set_flashdata('flash_message', get_phrase('message_send'));
        redirect(base_url() . 'index.php?message/sending_sms/combine_exam_sms', 'refresh');
    }

    function send_enrolled_sms() {
        if ($this->session->userdata('admin_admission_id') != 1)
            redirect(base_url(), 'refresh');

        $this->sms_model->send_new_select_student_sms();
        $this->sendPushNotification('Exam SMS');
        $this->session->set_flashdata('flash_message', get_phrase('message_send_succesfully'));
        redirect(base_url() . 'index.php?newadmission/enrolled_student_sms/', 'refresh');
    }

    function get_position($position) {
        if ($position > 3) {

            $post_posi = 'th';
        } else {
            switch ($position) {
                case $position == 1:

                    $post_posi = 'st';
                    break;

                case $position == 2:
                    $post_posi = 'nd';
                    break;

                case $position == 3:
                    $post_posi = 'rd';
                    break;
            }
        }
        return $post_posi;
    }

//    function sendPushNotification($message) {
//
//        require_once __DIR__ . '/firebase.php';
//        require_once __DIR__ . '/push.php';
//
//        $firebase = new Firebase();
//        $push = new Push();
//
//        // optional payload
//        $payload = array();
//        $payload['team'] = 'India';
//        $payload['score'] = '5.6';
//
//        // notification title
//        $title = "";
//        $push_type = "individual";
//        // whether to include to image or not
//        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;
//
//
//        $push->setTitle($title);
//        $push->setMessage($message);
//        if ($include_image) {
//            $push->setImage('http://api.androidhive.info/images/minion.jpg');
//        } else {
//            $push->setImage('');
//        }
//        $push->setIsBackground(FALSE);
//        $push->setPayload($payload);
//
//        $json = '';
//        $response = '';
//
//        if ($push_type == 'topic') {
//            $json = $push->getPush();
//            $response = $firebase->sendToTopic('global', $json);
//        } else if ($push_type == 'individual') {
//            $json = $push->getPush();
//            $regId = "ezP5kx2KXB4:APA91bElhKZk43nIcNCo8_wUZRwU3FO68inLLquOUsTT-o7qXWJep1qYOGvgDaql6G9k_IlNxu2RjGKWXwl-LvKEinFmMF5NIUDOUPoKAdarjrVwa80LjUKJMN1wv4ntkzUq7kslzg1B";
//
//            $response = $firebase->send($regId, $json);
//        }
//    }

    public function Send_Message_Api($receiver, $Message) {
        echo $receiver . '   ' . $Message . '<br/>';
        $url = "http://famzsolutions.com/websms/api.php?accesstoken=DSAADS4138929PADSKEWK&user=usmania&mask=InfoSMS&number=" . urlencode($this->clean_number($receiver)) . "&message=" . urlencode($Message);
        #----CURL Request Start
        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            print "Error: " . curl_error($ch);
            exit();
        }
        curl_close($ch);
        #----CURL Request End, Output Response
        return $response;
    }

    public function clean_number($sender_number) {

        $sender_number = preg_replace('/[^0-9]/', '', $sender_number);

        $first_check = substr($sender_number, 0, 2);
        $return_number = '';
        if ($first_check == 92):
            $return_number = $sender_number;
        else:

            $check_two = substr($sender_number, 0, 1);
            if ($check_two == 0):

                $sender_number = substr($sender_number, 1, 999);

            endif;

            $return_number = '92' . $sender_number;
        endif;
        return $return_number;
    }

}
