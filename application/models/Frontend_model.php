<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function count_question($where, $like = NULL) {
        if ($where):
            $this->db->where($where);
        endif;
        if ($like):
            $this->db->like($like);
        endif;

        $query = $this->db->get('ifta_question');

        return $query->num_rows();
    }

    function search_question($where = NULL, $like = NULL, $limit, $order = NULL) {

        
        if ($where):
            $this->db->where($where);
        endif;
        if ($like):
            $this->db->like($like);
        endif;
        if ($order):
            $this->db->order_by($order);
        endif;
        $this->db->limit($limit['param1'], $limit['param2']);
        $query = $this->db->get('ifta_question')->result();

        if (!empty($query)) {
            return $query;
        }
    }

    function get_table_data($table, $where = NULL, $like = NULL, $order = NULL, $limit = NULL, $type = NUll) {
        $this->db->select('*');
        $this->db->from("$table");
        if ($where):
            $this->db->where($where);
        endif;
        if ($like):
            $this->db->like($like);
        endif;
        if ($order):
            $this->db->order_by($order);
        endif;
        if ($limit):
            $this->db->limit($limit['param1'], $limit['param2']);
        endif;

        $query = $this->db->get();


        if (!empty($query)) {
            if ($type == 'row') {
                return $query->row();
            } else {
                return $query->result();
            }
        }
    }

    function get_fatwa_data($question_id) {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_question.question_id', $question_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    function get_tatest_question($limit = NUll) {
        $this->db->select('ifta_question.*, ifta_question.date_added as q_date, ifta_answer.*, ifta_answer.date_added as an_date');
        $this->db->from('ifta_question');
        $this->db->join('ifta_answer', 'ifta_answer.question_id = ifta_question.question_id', 'left')->distinct();
        $this->db->where('ifta_question.status', 1);
        $this->db->where('ifta_question.show_no_site', 1);
        $this->db->order_by('ifta_question.question_id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result();
        }
    }

    public function upload_image($file_name, $path) {

        $config['upload_path'] = './uploads/' . $path;

        $config['allowed_types'] = 'jpeg|jpg|png|gif';

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($file_name)) {

            echo $this->upload->display_errors();
        } else {

            $data = $this->upload->data();





            return $image_data = array('file' => $data["file_name"]);
        }
    }

    public function upload_file($file_name, $path) {

        $config['upload_path'] = './uploads/' . $path;

        $config['allowed_types'] = 'doc|docx|pdf|jpg|png|jpeg|inp';

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($file_name)) {

            echo $this->upload->display_errors();
        } else {

            $data = $this->upload->data();





            return $image_data = array('file' => $data["file_name"]);
        }
    }

    //FRONTEND GALLERY
    public function get_photos_by_gallery_id($frontend_gallery_id = "") {
        $this->db->where('frontend_gallery_id', $frontend_gallery_id);
        return $this->db->get('frontend_gallery_image')->result_array();
    }

    public function get_gallery_image($image = "") {
        if (file_exists('uploads/images/gallery_images/' . $image))
            return base_url() . 'uploads/images/gallery_images/' . $image;
        else
            return base_url() . 'uploads/images/gallery_images/placeholder.png';
    }

    // Add Image in gallery
    public function upload_gallery_photo($gallery_id) {
        if (isset($_FILES['gallery_photo']) && !empty($_FILES['gallery_photo']['name'])) {
            $data['frontend_gallery_id'] = $gallery_id;
            $data['image'] = random(20) . '.jpg';
            move_uploaded_file($_FILES['gallery_photo']['tmp_name'], 'uploads/images/gallery_images/' . $data['image']);

            $this->db->insert('frontend_gallery_image', $data);

            $response = array(
                'status' => true,
                'notification' => get_phrase('gallery_image_has_been_added_successfully')
            );
        } else {
            $response = array(
                'status' => false,
                'notification' => get_phrase('no_image_found')
            );
        }
        return json_encode($response);
    }

    function update_frontend_gallery($gallery_id) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['show_on_website'] = $this->input->post('show_on_website');

        if ($_FILES['cover_image']['name'] != '') {
            $cover_image = $this->db->get_where('frontend_gallery', array('frontend_gallery_id' => $gallery_id))->row()->image;
            if (!empty($cover_image)) {
                $this->remove_image('gallery_cover', $cover_image);
            }
            $data['image'] = random(15) . '.jpg';

            move_uploaded_file($_FILES['cover_image']['tmp_name'], 'uploads/images/gallery_cover/' . $data['image']);
        }
        $this->db->where('frontend_gallery_id', $gallery_id);
        $this->db->update('frontend_gallery', $data);
    }

    function add_frontend_gallery() {

        $data['title'] = html_escape($this->input->post('title'));
        $data['description'] = html_escape($this->input->post('description'));
        $data['show_on_website'] = $this->input->post('show_on_website');
        $data['school_id'] = $this->school_id;
        $data['date_added'] = time();

        if ($_FILES['cover_image']['name'] != '') {
            $data['image'] = random(15) . '.jpg';
            move_uploaded_file($_FILES['cover_image']['tmp_name'], 'uploads/images/gallery_cover/' . $data['image']);
        }
        $this->db->insert('frontend_gallery', $data);
        $response = array(
            'status' => true,
            'notification' => get_phrase('gallery_added')
        );
        return json_encode($response);
    }

    //DELETE PHOTO FROM GALLERY
    public function delete_gallery_photo($gallery_photo_id) {
        $gallery_photo_previous_data = $this->db->get_where('frontend_gallery_image', array('frontend_gallery_image_id' => $gallery_photo_id))->row_array();
        $this->db->where('frontend_gallery_image_id', $gallery_photo_id);
        $this->db->delete('frontend_gallery_image');
        $this->remove_image('gallery_images', $gallery_photo_previous_data['image']);
        $response = array(
            'status' => true,
            'notification' => get_phrase('gallery_photo_deleted')
        );
        return json_encode($response);
    }

    public function delete_frontend_gallery($gallery_id = "") {
        $cover_image = $this->db->get_where('frontend_gallery', array('frontend_gallery_id' => $gallery_id))->row();
        $cov_image = $cover_image->image;
        if (!empty($cov_image)) {
            $this->remove_image('gallery_cover', $cov_image);
        }

        $gallery_images = $this->db->get_where('frontend_gallery_image', array('frontend_gallery_id' => $gallery_id))->result();
        foreach ($gallery_images as $images) {
            if (!empty($images->image)) {
                $this->remove_image('gallery_images', $images->image);
            }
        }
        $this->db->where('frontend_gallery_id', $gallery_id);
        $this->db->delete('frontend_gallery_image');

        $this->db->where('frontend_gallery_id', $gallery_id);
        $this->db->delete('frontend_gallery');
    }

    function get_gallery_info_by_id($gallery_id) {
        $this->db->where('frontend_gallery_id', $gallery_id);
        $result = $this->db->get('frontend_gallery')->result_array();
        return $result;
    }

    public function remove_image($type = "", $photo = "") {
        $path = 'uploads/images/' . $type . '/' . $photo;
        if (file_exists($path)) {
            unlink($path);
        }
    }

}
