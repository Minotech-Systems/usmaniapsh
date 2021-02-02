<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author 	: Ijaz Sunny
 * 	date		: 27 september, 2016
 * 	iTkoor School Management System Pro
 * 	http://itkoor.com
 * 	imsunny37@gmail.com
 */

class LibraryController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
//        $this->load->library('database');
//        $this->load->model('admin_model');
        $this->load->model('Crud_model');
//

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        echo 'test';
        die;
    }

    public function add_aurther() {
          if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post()):

            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $data = array('name' => $name,'phone'=>$phone,'address'=>$address, 'create_by' => $this->session->userdata('user'), 'create_datetime' => date('Y-m-d H:i:s'));
            $this->Crud_model->insert('lib_authors', $data);

        endif;


        $page_data['page_name'] = 'add_aurthor_v';
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('front_end/index', $page_data);
    }

    public function all_aurther() {
            if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');


        $where = array();
        $where['questioner_id'] = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('lib_authors');
        $page_data['Query'] = $this->db->get()->result();

        $page_data['page_name'] = 'all_aurthor_v';
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('front_end/index', $page_data);
    }

    public function edit_aurther() {
//            if ($this->session->userdata('user_login') != 1)
//            redirect(base_url(), 'refresh');

        if ($this->input->post()):

            $name = $this->input->post('name');
            $phone=$this->input->post('phone');
            $address= $this->input->post('address');
            $autr_id = $this->input->post('atur_id');
            $set = array('name' => $name,'address'=>$address,'phone'=>$phone,'update_datetime' => date('Y-m-d H:i:s'));
            $where = array('autr_id' => $autr_id);
            $this->db->where($where);
            $this->db->update('lib_authors', $set);
            redirect('AddAurther');
        endif;
        $id = $this->uri->segment(3);
        $this->db->where('autr_id', $id);
        $page_data['result'] = $this->db->get('lib_authors')->row();

        $page_data['page_name'] = 'edit_aurthor_v';
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('front_end/index', $page_data);
    }

    public function delete_aurther() {
        $id = $this->uri->segment(3);
        $this->db->where('autr_id', $id);
        $this->db->delete('lib_authors');
        redirect('AddAurther');
    }

}
