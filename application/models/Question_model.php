<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_mujeeb_question($mujeeb_id) {
        $questions = $this->db->get_where('ifta_user_question', array('user_id' => $mujeeb_id))->result();

        $data = '<table dir="rtl" align="center" border="1" style="border-collapase:collapsed; border:1px solid black; text-align:center;" width="100%">';
        $data .= '<tr style="line-height:2; background:#ececec;"><td>#</td><td>' . 'سوال' . '</td><td>' . 'تاریخ' . '</td><td>' . 'کیفیت' . '</td></tr>';
        $no = 1;

        foreach ($questions as $ques_data) {
            $question = $this->db->get_where('ifta_question', array('question_id' => $ques_data->question_id))->row();
            $question_detail = substr($question->question, 0, 100);
            if ($ques_data->solved_status == 1) {
                $solved = 'حل شدہ';
            } else {
                $solved = 'غیر حل شدہ';
            }
            $data .= '<tr><td>' . $no++ . '</td><td>' . $question_detail . '</td><td>' . $ques_data->date_added . '</td><td>' . $solved . '</td></tr>';
        }

        return $data .= '</table>';
    }

    function create_question() {
        $day = date('d');
        $month = date('m');
        $year = date('Y');
//        $microtime = round($actual_micro_time = str_replace('.', '', microtime()), 0);
        $islamic_date = Greg2Hijri($day, $month, $year);



        $data['question'] = $this->input->post('question');
        $data['title'] = $this->input->post('title');
        $data['book_id'] = $this->input->post('book_id');
        $data['chapter_id'] = $this->input->post('chapter_id');
        $data['lesson_id'] = $this->input->post('lesson_id');
        $data['date_added'] = date('Y-m-d');
        $data['question_type'] = $this->input->post('question_type');
        $data['m_solved_date'] = date('Y-m-d', strtotime($this->input->post('return_date_questioner')));
        $data['mu_solved_date'] = date('Y-m-d', strtotime($this->input->post('return_date_mujeeb')));
        $data['islamic_date'] = $islamic_date['year'] . '-' . $islamic_date['month'] . '-' . $islamic_date['day'];
        $this->db->insert('ifta_question', $data);

        $question_id = $this->db->insert_id();

        $question_no = $islamic_date['year'] . $question_id;
        $this->db->where('question_id', $question_id);
        $this->db->update('ifta_question', array('question_no' => $question_no));

        if (!empty($this->input->post('questioner'))) {
            $data_q['name'] = $this->input->post('questioner');
            $data_q['email'] = $this->input->post('email');
            $data_q['address'] = $this->input->post('address');
            $data_q['phone'] = $this->input->post('phone');

            if (!empty($this->input->post('email'))) {
                $pass = explode('@', $this->input->post('email'));
                $check_email = $this->db->get_where('ifta_questioner', array('email' => $this->input->post('email')))->row();
                if (empty($check_email)) {
                    $this->db->insert('ifta_questioner', $data_q);
                    $questioner_id = $this->db->insert_id();
                    $password = $pass[0] . $questioner_id;
                    $encr_pass = $this->crud_model->hash($password);
                    $this->db->where('questioner_id', $questioner_id);
                    $this->db->update('ifta_questioner', array('password' => $encr_pass));
                } else {
                    $questioner_id = $check_email->questioner_id;
                }


                // Update questioner id in question table for relation
                $this->db->where('question_id', $question_id);
                $this->db->update('ifta_question', array('questioner_id' => $questioner_id));
            } else {
                $data_q2['name'] = $this->input->post('questioner');
                $data_q2['address'] = $this->input->post('address');
                $data_q2['phone'] = $this->input->post('phone');
                $this->db->insert('ifta_questioner', $data_q2);
                $questioner_id = $this->db->insert_id();
                $this->db->where('questioner_id', $questioner_id);
                $this->db->update('ifta_questioner', array('email' => 'jamia' . $questioner_id . '@jamia.com'));
                $password = 'jamia' . $questioner_id;
                $encr_pass = $this->crud_model->hash($password);
                $this->db->where('questioner_id', $questioner_id);
                $this->db->update('ifta_questioner', array('password' => $encr_pass));

                // Update questioner id in question table for relation
                $this->db->where('question_id', $question_id);
                $this->db->update('ifta_question', array('questioner_id' => $questioner_id));
            }
        }
        if (!empty($this->input->post('mujeeb_id'))) {
            $data_u['user_id'] = $this->input->post('mujeeb_id');
            $data_u['question_id'] = $question_id;
            $data_u['date_added'] = date('Y-m-d');
            $this->db->insert('ifta_user_question', $data_u);
        }


        return TRUE;
    }

    function get_question_user_data() {
        $this->db->select('ifta_question.*, ifta_question.question_id as ques_id, ifta_question.date_added as qdate,ifta_user_question.*, ifta_user_question.date_added as udate');
        $this->db->from('ifta_question');
        $this->db->join('ifta_user_question', 'ifta_user_question.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->order_by('ifta_question.date_added', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_unsolved_question_data() {
        $this->db->select('ifta_question.*, ifta_question.question_id as ques_id, ifta_question.date_added as qdate,ifta_user_question.*, ifta_user_question.date_added as udate');
        $this->db->from('ifta_question');
        $this->db->join('ifta_user_question', 'ifta_user_question.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->where('ifta_question.status', 0);
        $this->db->where('ifta_question.reject', 0);
        $this->db->order_by('ifta_question.date_added', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_table_column($table, $where, $column) {
        $this->db->select('*');
        $this->db->from("$table");
        $this->db->where($where);
        $result = $this->db->get()->row()->$column;
        return $result;
        // return $this->db->get_where("$table,array($where)")->row()->$column;
    }

    function update_question($question_id) {
        $data['title'] = $this->input->post('title');
        $data['question'] = $this->input->post('question');
        $data['book_id'] = $this->input->post('book_id');
        $data['chapter_id'] = $this->input->post('chapter_id');
        $data['lesson_id'] = $this->input->post('lesson_id');
        $data['update_date'] = date('Y-m-d');
        $data['question_type'] = $this->input->post('question_type');
        $data['m_solved_date'] = date('Y-m-d', strtotime($this->input->post('return_date_questioner')));
        $data['mu_solved_date'] = date('Y-m-d', strtotime($this->input->post('return_date_mujeeb')));

        $this->db->where('question_id', $question_id);
        $this->db->update('ifta_question', $data);
        //if questioner is added already with question during question creation
        //then only update his data
        $questioner_email = $this->db->get_where('ifta_questioner', array('questioner_id' => $this->input->post('questioner_id')))->row()->email;
        if (!empty($this->input->post('questioner_id')) && $questioner_email == $this->input->post('email')) {
            $data_q['name'] = $this->input->post('questioner');
            $data_q['email'] = $this->input->post('email');
            $data_q['address'] = $this->input->post('address');
            $data_q['phone'] = $this->input->post('phone');
            $this->db->where('questioner_id', $this->input->post('questioner_id'));
            $this->db->update('ifta_questioner', $data_q);
        } else {
            // if the questioner is not added during qestio creation and now to add questioner data
            $data_q['name'] = $this->input->post('questioner');
            $data_q['email'] = $this->input->post('email');
            $data_q['address'] = $this->input->post('address');
            $this->db->insert('ifta_questioner', $data_q);
            $pass = explode('@', $this->input->post('email'));
            $questioner_id = $this->db->insert_id();
            $password = $pass[0] . $questioner_id;
            $encr_pass = $this->crud_model->hash($password);
            $this->db->where('questioner_id', $questioner_id);
            $this->db->update('ifta_questioner', array('password' => $encr_pass));
            if (empty($this->input->post('email'))) {
                $this->db->where('questioner_id', $questioner_id);
                $this->db->update('ifta_questioner', array('email' => 'jamia' . $questioner_id . '@jamia.com'));
            }
            //Update for question
            $this->db->where('question_id', $question_id);
            $this->db->update('ifta_question', array('questioner_id' => $questioner_id));
        }

        // keeping mujeeb data with question for giving answer
        if (!empty($this->input->post('mujeeb_id'))) {
            //if mujeeb is already there with question then only update another mujeeb otherwise add new mujeeb
            $check_mujeeb = $this->db->get_where('ifta_user_question', array('question_id' => $question_id))->result();
            if (!empty($check_mujeeb)) {
                $data_u['user_id'] = $this->input->post('mujeeb_id');
                $this->db->where('question_id', $question_id);
                $this->db->update('ifta_user_question', array('user_id' => $data_u['user_id']));
            } else {
                $data_m['user_id'] = $this->input->post('mujeeb_id');
                $data_m['question_id'] = $question_id;
                $data_m['date_added'] = date('Y-m-d');
                $this->db->insert('ifta_user_question', $data_m);
            }
        }
        return TRUE;
    }

    function get_question_data($question_id) {
        $this->db->select('ifta_question.*');
        $this->db->from('ifta_question');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function check_user_question($question_id) {
        return $this->db->get_where('ifta_user_question', array('question_id' => $question_id))->result();
    }

    function check_unlink_file($question_id) {
        $question_file = $this->db->get_where('ifta_question', array('question_id' => $question_id))->row()->file;
        if (!empty($question_file)) {
            $unlink_url = './uploads/question_file/' . $question_file;
            if (file_exists($unlink_url)) {
                unlink($unlink_url);
            }
        }
    }

    function add_question_answer() {
        //First get last selsela number
        $last = $this->db->order_by('answer_id', "DESC")
                ->limit(1)
                ->get('ifta_answer')
                ->row();
        $selsela_num = $last->selsela_num;
        $check = $this->db->get_where('ifta_answer', array('question_id' => $this->input->post('question_id')))->result();
        if (!empty($check)) {
            return FALSE;
        } else {
            $data['question_id'] = $this->input->post('question_id');
            $data['answer'] = $this->input->post('fitwa');
            $data['fatwa_num'] = $this->input->post('fatwa_num');
            $data['selsela_num'] = $selsela_num; //$this->input->post('selsela_num');
            $data['date_added'] = date('Y-m-d');
            $islamic_date = Greg2Hijri(date('d'), date('m'), date('Y'));
            $data['islamic_date'] = $islamic_date['year'] . '-' . $islamic_date['month'] . '-' . $islamic_date['day'];

            $editors = $this->input->post('jawab_u_sahi');
            $array_size = sizeof($editors);
            $ques_editors = array();
            foreach ($editors as $edit) {
                $edit['name'] = $edit;
                array_push($ques_editors, $edit);
            }
            $data['editors'] = json_encode($ques_editors, JSON_UNESCAPED_UNICODE);
            $this->db->insert('ifta_answer', $data);

            // update question for completion

            $this->db->where('question_id', $data['question_id']);
            $this->db->update('ifta_question', array('status' => 1));

            // Update User profile for answering to question
            $this->update_user_question($data['question_id']);
            return TRUE;
        }
    }

    function update_user_question($question_id) {
        $query = $this->db->get_where('ifta_user_question', array('question_id' => $question_id))->result();
        if (!empty($query)) {
            $date = date('Y-m-d');
            $this->db->where('question_id', $question_id);
            $this->db->update('ifta_user_question', array('submitted_date' => $date, 'solved_status' => 1));
        }
    }

    function get_mustafti_data($mustafti_id) {
        return $this->db->get_where('ifta_questioner', array('questioner_id' => $mustafti_id))->row();
    }

    function get_questions($where = NULL) {
        $this->db->select('*');
        $this->db->from('ifta_question');
        if ($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('question_id', 'ASC');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function send_reject_email($question_id, $email) {
        $question_data = $this->db->get_where('ifta_question', array('question_id' => $question_id))->row();
        $email_template = $this->check_by(array('email_group' => 'question_reject'), 'tbl_email_templates');
        $questioner_email = $this->db->get_where('ifta_questioner', array('questioner_id' => $question_data->questioner_id))->row()->email;

        $email_body = str_replace("{title}", $question_data->title, $email_template->template_body);
        $user_question = str_replace("{question_no}", $question_data->question_no, $email_body);
        $message = str_replace("{question}", $question_data->question, $user_question);
        $message = str_replace("{email}", $email, $message);

        $params['recipient'] = $questioner_email;
        $params['subject'] = ' جواب' . ' : ' . $question_data->question_no;
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

    function count_user_question($where = NULL) {
        $this->db->select('*');
        $this->db->from('ifta_user_question');
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

}
