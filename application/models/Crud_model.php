<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function clear_cache() {

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {

        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    function get_column_name_by_id($table, $table_id = '', $id) {

        return $this->db->get_where($table, array($table_id => $id))->row()->name;
    }

    public function hash($string) {
        return hash('sha1', $string . config_item('encryption_key'));
    }

    public function get_table_data($table, $where) {
        if ($where):
            $this->db->where($where);
        endif;
        $query = $this->db->get("$table")->result();

        if (!empty($query)) {
            return $query;
        }
    }

    public function upload_image($path, $type) {
        $config['upload_path'] = './uploads/' . $path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($type)) {
            echo $this->upload->display_errors();
            exit();
        } else {
            $data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/' . $path . '/' . $data["file_name"];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 350;
            $config['height'] = 390;
            $config['new_image'] = './uploads/' . $path . '/' . $data["file_name"];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            return $image_data = array('image' => $data["file_name"]);
        }
    }

    public function upload_file($path, $file_name) {
        $config['upload_path'] = './uploads/' . $path;
        $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf|inp|xlsx|xlsm|xlsb|xltx|xls';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($file_name)) {
            echo $this->upload->display_errors();
            exit();
        } else {
            $data = $this->upload->data();
            $config['source_image'] = './uploads/' . $path . '/' . $data["file_name"];
            $config['new_image'] = './uploads/' . $path . '/' . $data["file_name"];


            return $image_data = array('file' => $data["file_name"]);
        }
    }

//    public function Encrypt($string) {
//        $cryptKey = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
//        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $string, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
//        return( $qEncoded );
//    }
//
//    public function Decrypt($string) {
//        $cryptKey = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
//        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
//        return( $qDecoded );
//    }

    public function Encrypt($string) {
        $cryptKey = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $string, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return( $qEncoded );
    }

    public function Decrypt($string) {
        $cryptKey = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return( $qDecoded );
    }

    public function Encryptor($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'hitenVkuld%:bTXz,3r>6|FW#!7eSs>vM~n+48~{Mh$#A4p).)#wV3^_y-B.6WCar=b4.';
        $secret_iv = '3w8XD|r@n:nxp|oml]nw$-KEc|rT$H).(~ &`gnV!vD0vs|?r]#Zdr-qRlOV@&#6';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, $iv);
        }

        return $output;
    }

    public function update($table_name, $data, $where) {
        $this->db->where($where);
        $this->db->update($table_name, $data);
    }

    function delete_image($table, $where, $path) {
        $image = $this->db->get_where("$table", $where)->row()->image;
        if (!empty($image)) {
            $this->unlink($path, $image);
        }
    }

    function unlink($url, $file) {

        $unlink_url = './uploads/' . $url . '/' . $file;
        if (file_exists($unlink_url)) {
            unlink($unlink_url);
        }
    }

    function get_islamic_date($date) {
        $day = date('d', strtotime($date));
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $islamic_date = Greg2Hijri($day, $month, $year);
        $islamic_month = $this->get_arabic_month_name($islamic_date['month']);
        $islamic_date1 = $islamic_date['day'] . $islamic_month . $islamic_date['year'] . 'ھ';
        return $islamic_date1;
    }

    function get_arabic_month_name($month) {
        if ($month == 10)
            $m = 'شوال';
        else if ($month == 11)
            $m = 'ذوالقعدۃ';
        else if ($month == 12)
            $m = 'ذوالحجۃ';
        else if ($month == 1)
            $m = 'محرم';
        else if ($month == 2)
            $m = 'صفر';
        else if ($month == 3)
            $m = 'ر بیع الاول';
        else if ($month == 4)
            $m = 'ر بیع الثانی';
        else if ($month == 5)
            $m = 'جمادی الاول';
        else if ($month == 6)
            $m = 'جمادی الثانی';
        else if ($month == 7)
            $m = 'رجب';
        else if ($month == 8)
            $m = 'شعبان';
        else if ($month == 9)
            $m = 'رمضان';
        return $m;
    }

    function get_urdu_month_name($month) {
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

    function get_user_image($param1) {
        if ($param1 == 'mujeeb') {
            $user_id = $this->session->userdata('mujeeb_id');
            $image = $this->db->get_where('ifta_users', array('user_id' => $user_id))->row()->image;
            return base_url('uploads/user_image/' . $image);
        } else {
            $admin_id = $this->session->userdata('admin_id');
            $image = $this->db->get_where('ifta_admin', array('admin_id' => $admin_id))->row()->image;
            return base_url('uploads/admin_image/' . $image);
        }
    }
    public function insert($table,$data){
    
    $this->db->insert($table,$data);
    }
}
