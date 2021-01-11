<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function get_month_name($month) {
        if ($month == 1)
            $m = 'جنوری';
        else if ($month == 2)
            $m = 'فروری';
        else if ($month == 3)
            $m = 'مارچ';
        else if ($month == 4)
            $m = 'اپریل';
        else if ($month == 5)
            $m = 'مئی';
        else if ($month == 6)
            $m = 'جون';
        else if ($month == 7)
            $m = 'جولائی';
        else if ($month == 8)
            $m = 'اگست';
        else if ($month == 9)
            $m = 'ستمبر';
        else if ($month == 10)
            $m = 'اکتوبر';
        else if ($month == 11)
            $m = 'نومبر';
        else if ($month == 12)
            $m = 'دسمبر';
        return $m;
    }

}
