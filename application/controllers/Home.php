<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 *  @author   : Creativeitem
 *  date    : 14 september, 2017
 *  Ekattor School Management System Pro
 *  http://codecanyon.net/user/Creativeitem
 *  http://support.creativeitem.com
 */

class Home extends CI_Controller {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // default function
    public function index() {
        if (empty($this->session->userdata('system_lang')) || $this->session->userdata('system_lang') == 'urdu') {
            $this->session->set_userdata('system_lang', 'urdu');
        }

        $page_data['page_name'] = 'home';
        $page_data['page_title'] = get_phrase('home');
        $page_data['latest_question'] = $this->frontend_model->get_tatest_question(7);
        $this->load->view('front_end/index', $page_data);
    }

    function switchLang($language) {

        if (!empty($language)) {
            if ($language == 'urdu') {
                $this->session->set_userdata('system_lang', $language);
            } else {
                $this->session->set_userdata('system_lang', $language);
            }
        }
    }

    function books() {
        $page_data['page_name'] = 'books';
        $page_data['page_title'] = get_phrase('books');
        $this->load->view('front_end/index', $page_data);
    }

    function alasr_resala() {
        $total_rows = $this->db->get('web_alasr_resala')->num_rows();
        $config = pagination('home/alasr_resala', $total_rows, 10, 3);

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $limit['param1'] = 10;
        $limit['param2'] = $page;
        $order = 'year  desc';
        $page_data["alasr_resla"] = $this->frontend_model->get_table_data('web_alasr_resala', '', '', $order, $limit);
//        $page_data["links"] = $this->pagination->create_links();
        $page_data['page_name'] = 'alasr_resala';
        $page_data['page_title'] = get_phrase('alasr_resala');
        $this->load->view('front_end/index', $page_data);
    }

    function pages() {
        $page = urldecode($this->uri->segment(2));
        if ($page == 'تعارف') {
            $page_data['page_name'] = 'about_jamia';
            $page_data['page_title'] = 'تعارف';
        }
        if ($page == 'جامعہ-کی-تاسیس') {
            $page_data['page_name'] = 'jamia_tasees';
            $page_data['page_title'] = 'جامعہ تاسیس';
        }
        if ($page == 'تاریخی-سفر') {
            $page_data['page_name'] = 'historical_travel';
            $page_data['page_title'] = 'تاریخی سفر';
        }
        if ($page == 'اغراض-و-مقاصد') {
            $page_data['page_name'] = 'jamia_aim';
            $page_data['page_title'] = 'اغراض ومقاصد';
        }
        if ($page == 'ضروری-اعلانات') {
            $page_data['page_name'] = 'news_updates';
            $page_data['page_title'] = 'ضروری اعلانات';
        }

        if ($page == 'جامعہ-شعبہ-جات') {
            $page_data['page_name'] = 'jamia_departments';
            $page_data['page_title'] = 'جامعہ کے شعبہ جات';
        }
        if ($page == 'اعلان-داخلہ') {
            $page_data['page_name'] = 'admission_notice';
            $page_data['page_title'] = 'اعلان داخلہ';
        }

        $this->load->view('front_end/index', $page_data);
    }

    function gallery() {
        $page_data['page_name'] = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('front_end/index', $page_data);
    }

    function gallery_view() {
        $gallery_id = $this->uri->segment(2);
        $count_images = $this->db->get_where('frontend_gallery_image', array(
                    'frontend_gallery_id' => $gallery_id
                ))->num_rows();
        $config = array();
        $config = manager($count_images, 9);
        $config['base_url'] = site_url('home/gallery_view/' . $gallery_id . '/');
        $this->pagination->initialize($config);

        $page_data['per_page'] = $config['per_page'];
        $page_data['gallery_id'] = $gallery_id;
        // $page_data['page_name'] = 'gallery_view1';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('front_end/gallery_view', $page_data);
    }

    function position_holders() {
        $page_data['page_name'] = 'position_holders';
        $page_data['page_title'] = get_phrase('position_holders');
        $this->load->view('front_end/index', $page_data);
    }

    function position_holder_view() {
        $page_data['session'] = $this->uri->segment(2);
        $page_data['page_name'] = 'position_holder_view';
        $page_data['page_title'] = get_phrase('position_holders') . ' - <span dir="ltr">' . $this->uri->segment(2) . '</span>';
        $this->load->view('front_end/index', $page_data);
    }

    function contact() {
        $page_data['page_name'] = 'contact';
        $page_data['page_title'] = get_phrase('contact');
        $this->load->view('front_end/index', $page_data);
    }

    function cooperation() {
        $page_data['page_name'] = 'cooperation';
        $page_data['page_title'] = get_phrase('cooperation');
        $this->load->view('front_end/index', $page_data);
    }

}
