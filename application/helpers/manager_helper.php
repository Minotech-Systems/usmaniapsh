<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('manager')) {

    function manager($total_rows, $per_page_item) {
        $config['per_page'] = $per_page_item;
        $config['num_links'] = 2;
        $config['total_rows'] = $total_rows;
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '<span class="page-link">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<span class="page-link">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        // $config['first_tag_open']  = '<span class="page-link">';
        // $config['first_tag_close'] = '</span>';
        // $config['last_tag_open']   = '<span class="page-link">';
        // $config['last_tag_close']  = '</span>';
        // $config['first_link']      = 'First';
        // $config['last_link']       = 'Last';
        $config['first_link'] = false;
        $config['last_link'] = false;
        return $config;
    }

    if (!function_exists('pagination')) {

        function pagination($base_url, $total_rows, $per_page, $uri_segment) {
            $config = array();
            $config["base_url"] = base_url() . "$base_url";
            $config["total_rows"] = $total_rows;
            $config["per_page"] = $per_page;
            $config["uri_segment"] = 3;

            $config['next_link'] = '<span><i class="fa fa-angle-left"></i></span>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '<span><i class="fa fa-angle-right"></i></span>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['last_link'] = TRUE;


            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            return $config;
        }

    }
}
