<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lms_model extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
    }

    public function add_video() {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['video_overview_provider'] = $this->input->post('video_type');
        $data['video_url'] = $this->input->post('video_url');
        $data['section_id'] = $this->input->post('section_id');
        $data['duration'] = $this->input->post('video_time');
        $data['video_type'] = 'video';
        $data['status'] = 'active';
        $data['date_added'] = date('Y-m-d');

        $data['thumbnail'] = rand() . '.jpg';

        $this->db->insert('video_lectures', $data);

        move_uploaded_file($_FILES['video_thumbnail']['tmp_name'], 'uploads/video_thumbnail/' . $data['thumbnail']);
    }

    function video_edit($param1) {
        if (!empty($_FILES["video_thumbnail"]["name"])) {
            $image = $this->db->get_where('video_lectures', array('id' => $param1))->row()->video_thumbnail;
            if (!empty($image)) {
                $this->crud_model->unlink('video_thumbnail', $image);
            }
        }
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['video_overview_provider'] = $this->input->post('video_type');
        $data['video_url'] = $this->input->post('video_url');
        $data['section_id'] = $this->input->post('section_id');
        $data['duration'] = $this->input->post('video_time');
        $data['video_type'] = 'video';

        if (!empty($_FILES["video_thumbnail"]["name"])) {
            $data['thumbnail'] = rand() . '.jpg';
            move_uploaded_file($_FILES['video_thumbnail']['tmp_name'], 'uploads/video_thumbnail/' . $data['thumbnail']);
        }
        $this->db->where('id', $param1);
        $this->db->update('video_lectures', $data);
    }

    function delete_video($param1) {
        $image = $this->db->get_where('video_lectures', array('id' => $param1))->row()->video_thumbnail;
        if (!empty($image)) {
            $this->crud_model->unlink('video_thumbnail', $image);
        }
        $this->db->where('id', $param1);
        $this->db->delete('video_lectures');
    }

    function update_section($param1) {
        if (!empty($_FILES["section_thumbnail"]["name"])) {
            $image = $this->db->get_where('video_section', array('id' => $param1))->row()->tumbnail;
            if (!empty($image)) {
                $this->crud_model->unlink('section_thumbnail', $image);
            }
        }

        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        if (!empty($_FILES["section_thumbnail"]["name"])) {
            $data['thumbnail'] = rand() . '.jpg';
            move_uploaded_file($_FILES['section_thumbnail']['tmp_name'], 'uploads/section_thumbnail/' . $data['thumbnail']);
        }
        $this->db->where('id', $param1);
        $this->db->update('video_section', $data);
    }

}
