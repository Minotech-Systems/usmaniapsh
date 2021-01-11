<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fulladmin_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function admin_table_data(){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->order_by('branch_id');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
}
