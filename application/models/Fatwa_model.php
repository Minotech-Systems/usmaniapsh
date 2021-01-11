<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fatwa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_fatwas() {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_answer.admin_approval', 1);
        $this->db->order_by('ifta_question.date_added', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_fatwas_detail($where = NULL, $order = NULL, $date_from = NULL, $date_to = NULL) {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'left')->distinct();
        
        if ($date_from && $date_to) {
            $this->db->where('ifta_question.date_added >=', $date_from);
            $this->db->where('ifta_question.date_added <=', $date_to);
        }
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_fatwa_data($fatwa_id) {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_answer.answer_id', $fatwa_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_unsolved_fatwa() {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_answer.admin_approval', 0);
        $this->db->order_by('ifta_question.date_added', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function update_fatwa($id, $question_id = NULL) {
        $islamic_date = Greg2Hijri(date('d'), date('m'), date('Y'));

        $data['fatwa_num'] = $this->input->post('fatwa_num');
        $data['selsela_num'] = $this->input->post('selsela_num');
        $data['fatwa_num'] = $this->input->post('fatwa_num');
        $data['answer'] = $this->input->post('fitwa');
        $data['updated_date'] = date('Y-m-d');
        $data['up_islamic_date'] = $islamic_date['year'] . '-' . $islamic_date['month'] . '-' . $islamic_date['day'];
        $editors = $this->input->post('jawab_u_sahi');

        $ques_editors = array();
        foreach ($editors as $edit) {
            $edit['name'] = $edit;
            array_push($ques_editors, $edit);
        }

        $data['editors'] = json_encode($ques_editors, JSON_UNESCAPED_UNICODE);
        $this->db->where('answer_id', $id);
        $this->db->update('ifta_answer', $data);

        //Update question
        if (!empty($question_id)) {
            $this->db->where('question_id', $question_id);
            $this->db->update('ifta_question', array('question' => $this->input->post('question'), 'title' => $this->input->post('question_title')));
        }
        return TRUE;
    }

    function send_response_email($fatwa_id) {
        $fatwa_data = $this->db->get_where('ifta_answer', array('answer_id' => $fatwa_id))->row();

        $question_detail = $this->db->get_where('ifta_question', array('question_id' => $fatwa_data->question_id))->row();

        $questioner_deatil = $this->db->get_where('ifta_questioner', array('questioner_id' => $question_detail->questioner_id))->row();
        $data['email'] = $questioner_deatil->email;
        $data['title'] = $question_detail->title;
        $data['question_no'] = $question_detail->question_no;
        $data['book'] = $this->db->get_where('ifta_books', array('book_id' => $question_detail->book_id))->row()->name;

        if (!empty($question_detail->chapter_id)) {
            $data['chapter'] = $this->db->get_where('ifta_books_chapters', array('chapter_id' => $question_detail->chapter_id))->row()->name;
        } else {
            $data['chapter'] = '';
        }
        if (!empty($question_detail->lesson)) {
            $data['lesson'] = $this->db->get_where('ifta_chapter_lessons', array('lesson_id' => $question_detail->lesson))->row()->name;
        } else {
            $data['lesson'] = '';
        }
        $data['question'] = $question_detail->question;
        $data['answer'] = $fatwa_data->answer;
        $data['selsela_num'] = $fatwa_data->selsela_num;
        $data['fatwa_num'] = $fatwa_data->fatwa_num;
        $data['date_addded'] = date('d/m/Y', strtotime($fatwa_data->date_added));
        $result = $this->send_user_email('fatwa_response', $data['email'], $data);
    }

    function send_user_email($type, $email, $data) {
        switch ($type) {
            case 'ask_question':
                return $this->send_askquestion_email($email, $data);
                break;
            case 'fatwa_response':
                return $this->fatwa_response_email($email, $data);
                break;
            case 'reset_password':
                return $this->send_email_reset_password($email, $data);
                break;
        }
    }

    function fatwa_response_email($email, $data) {

        $email_template = $this->check_by(array('email_group' => 'fatwa_response'), 'tbl_email_templates');

        $email_body = str_replace("{title}", $data['title'], $email_template->template_body);
        $user_email = str_replace("{question_no}", $data['question_no'], $email_body);
        $message = str_replace("{book}", $data['book'], $user_email);
        $message = str_replace("{chapter}", $data['chapter'], $message);
        $message = str_replace("{lesson}", $data['lesson'], $message);
        $message = str_replace("{silsila_num}", $data['selsela_num'], $message);
        $message = str_replace("{fatwa_num}", $data['fatwa_num'], $message);
        $message = str_replace("{date_added}", $data['date_addded'], $message);
        $message = str_replace("{question}", $data['question'], $message);
        $message = str_replace("{answer}", $data['answer'], $message);

        $params['recipient'] = $email;
        $params['subject'] = ' جواب' . ' : ' . $data['question_no'];
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        return $result = $this->email_model->send_email($params);
    }

    public function check_by($where, $tbl_name) {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    //Update Admin view status to remove from notification
    function update_admin_view_status($fatwa_id) {
        $question_id = $this->db->get_where('ifta_answer', array('answer_id' => $fatwa_id))->row()->question_id;
        $this->db->where('question_id', $question_id);
        $this->db->update('ifta_user_question', array('admin_view_status' => 1));
    }

    function get_last_ten_records($admin = NULL) {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_answer.admin_approval', 1);
        if ($admin != 'admin') {
            $this->db->where('ifta_question.show_no_site', 1);
        }

        $this->db->order_by('ifta_question.question_id', 'DESC');
        $this->db->limit('20');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function search_fatwa() {
        $match = $this->input->get('search');
        if ($match == '') {
            return NULL;
        } else {

            $this->db->like('fatwa_num', $match);
            $this->db->or_like('selsela_num', $match);
            $this->db->or_like('answer', $match);
            $this->db->or_like('ifta_question.question_no', $match);
            $this->db->or_like('ifta_question.title', $match);
            $this->db->or_like('ifta_question.question', $match);
            $this->db->join('ifta_question', 'ifta_answer.question_id = ifta_question.question_id');
            $query = $this->db->get('ifta_answer');
            return $query->result();
        }
    }

    function import_to_word($book_id) {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'inner')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_question.book_id', $book_id);
        $this->db->order_by('ifta_question.question_id', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $ques_no = 1;
            $fatwa_detail = '';
            $answers = $query->result();

            $data1 = '<html dir="rtl">' . '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' .
                    '<head><style>p{text-align:justify;}</style></head>' . '<body style="font-size:14px">';
            foreach ($answers as $data) {
                $fatwa_detail .= '<b><p>' . 'سوال نمبر' . '(' . $ques_no . ') :</p></b>' . '<p>' . $data->question . '</p><br>'
                        . '<b><span class="marker">الجوابوباللہ التوفیق:</span></b>' . '<br>' . $data->answer . '<hr>';
                $ques_no++;
            }
        }
        $data1 .= $fatwa_detail;
        $data1 .= '</body></hmtl>';
        return $data1;
    }

}
