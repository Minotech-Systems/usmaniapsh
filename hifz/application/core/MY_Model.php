<?php

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_result($where, $tbl_name) {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_any_field($table, $where_criteria, $table_field) {
        $query = $this->db->select($table_field)->where($where_criteria)->get($table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$table_field;
        }
    }

}

?>