<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function send_combine_exam_sms($student_id, $teacher_id, $exam_id1, $exam_id2, $exam_id3, $exam_id4) {
        $total_obt_marks = 0;
        $in_total_marks = 0;
        $tests_obt_marks = 0;
        $test_total_marks = 0;
        $grand_total_in = 0;
        $grand_total_obt = 0;
//        $otherdb = $this->load->database('otherdb', TRUE);

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $year = explode('-', $running_year);
        $student_data = $this->db->get_where('student', array('student_id' => $student_id))->row();
        $student_enroll_data = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->row();
        $parent_name = $student_data->father_name;
        $receiver = $student_data->phone;
        $class_name = $this->db->get_where('branches', array('branch_id' => $student_enroll_data->branch_id))->row()->name;
        $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id4))->row()->name;

        $posi = $this->db->get_where('mark_summery_total', array('student_id' => $student_id,
                    'teacher_id' => $teacher_id,
                    'exam_id_4' => $exam_id4,
                    'year' => $running_year))->row()->position;
        $position = $this->get_position($posi);
        $position_l = $posi . $position;
        // $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'status' => 1, 'year' => $running_year))->result_array();
        //  foreach ($subjects as $subject) {
        $obtained_mark_query = $this->db->get_where('mark', array(
                    'exam_id' => $exam_id4,
                    'teacher_id' => $teacher_id,
                    'student_id' => $student_id,
                    'year' => $running_year))->row();

        $obtain_exam_marks = $obtained_mark_query->mark_obtained;
        $total_exam_marks = $obtained_mark_query->mark_total;
        // }
        $tests_obt_marks_1 = $this->get_monthly_test_sum($exam_id1, $student_id, 'mark_obtained');
        $tests_obt_marks_2 = $this->get_monthly_test_sum($exam_id2, $student_id, 'mark_obtained');
        $tests_obt_marks_3 = $this->get_monthly_test_sum($exam_id3, $student_id, 'mark_obtained');

        $test_total_marks_1 = $this->get_monthly_test_sum($exam_id1, $student_id, 'mark_total');
        $test_total_marks_2 = $this->get_monthly_test_sum($exam_id2, $student_id, 'mark_total');
        $test_total_marks_3 = $this->get_monthly_test_sum($exam_id3, $student_id, 'mark_total');

        $exam_name1 = $this->get_exam_name($exam_id1);
        $exam_name2 = $this->get_exam_name($exam_id2);
        $exam_name3 = $this->get_exam_name($exam_id3);

        $total_obt_marks = ($obtain_exam_marks + $tests_obt_marks_1 + $tests_obt_marks_2 + $tests_obt_marks_3);
        $grand_total_in = ($total_exam_marks + $test_total_marks_1 + $test_total_marks_2 + $test_total_marks_3);

        $mark_message = 'نام:' . $student_data->name . "  " . 'ولدیت:' . $parent_name . "  " . "  " .
                'امتحان' . ' : ' . $exam_name . "   " . 'سال:' . $year[1] . '-' . $year[0] . "  " .
                $exam_name1 . ' : ' . $tests_obt_marks_1 . "  " . $exam_name2 . ' : ' . $tests_obt_marks_2 . "  " . $exam_name3 . ' : ' . $tests_obt_marks_3 . "  " .
                $exam_name . ' : ' . $obtain_exam_marks . "  " .
                'حاصل کردہ نمبرات' . ' :' . $total_obt_marks . "  " .
                'مجموعی نمبرات ' . ' : ' . $grand_total_in . "  " .
                'پوزیشن' . ' : ' . $position_l . "  " . $class_name;


        $phone = $this->clean_number($receiver);
        $this->Send_Message_Api($phone, $mark_message);
    }

    function get_monthly_test_sum($exam_id, $student_id, $filed) {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->select("sum($filed) AS total_mark");
        $this->db->from('mark');
        $this->db->where('year', $year);
        $this->db->where('exam_tag', 1);
        $this->db->where('student_id', $student_id);
        $this->db->where('exam_id', $exam_id);

        $query = $this->db->get();

        return $query->row()->total_mark;
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

    function send_admission_sms() {
        $students = $this->input->post('student_id');
        $message = $this->input->post('message');
        foreach ($students as $data) {
            $receiver = $this->db->get_where('new_students', array('new_student_id' => $data))->row()->phone;
            $phone = $this->clean_number($receiver);
            $this->Send_Message_Api($phone, $message);
        }
    }

    function get_exam_name($exam_id) {
        return $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
    }

    function send_new_select_student_sms() {
        $otherdb = $this->load->database('otherdb', TRUE);
        $students = $this->input->post('student_id');
        $message = $this->input->post('message');

        foreach ($students as $row) {
            $student_data = $this->db->get_where('student', array('student_id' => $row))->row();
            $receiver = $student_data->phone;
            $msg = $student_data->name . "  " . 'ولد : ' . $student_data->father_name . "  ";
            $message_data = $msg . $message . "  " . 'جامعہ عثمانیہ پشاور';
            $phone = $this->clean_number($receiver);
            $this->Send_Message_Api($phone, $message_data);
        }
    }

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
