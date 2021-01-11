<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function send_email($params, $test = null) {

        $config = array();
        $config['useragent'] = 'UniqueCoder LTD';
        $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = "html";
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $config['protocol'] = config_item('protocol');
        $config['smtp_host'] = config_item('smtp_host');
        $config['smtp_port'] = config_item('smtp_port');
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = config_item('smtp_user');
        $config['smtp_pass'] = config_item('smtp_pass');
        //$config['smtp_crypto'] = config_item('smtp_encryption');

        $this->load->library('email', $config);
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->from(config_item('company_email'), config_item('company_name'));
        $this->email->to($params['recipient']);

        $this->email->subject($params['subject']);
        $this->email->message($params['message']);
        if ($params['resourceed_file'] != '') {
            $this->email->attach($params['resourceed_file']);
        }
        $send = $this->email->send();
        if (!empty($test)) {
            if ($send) {
                return $send;
            } else {
                $error = show_error($this->email->print_debugger());
                return $error;
            }
        } else {
            return true;
        }
        return true;
    }

}
