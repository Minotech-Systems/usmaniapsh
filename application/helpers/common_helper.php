<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  @author   : softsunny
 *  date      : 2020
 *  Jamia Usmania Peshawar
 *  http://usmaniapsh.com
 *  http://softsunny.com
 */



// RANDOM NUMBER GENERATOR FOR ELSEWHERE
if (!function_exists('random')) {

    function random($length_of_string) {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

}

// ELLIPSIS A TEXT
if (!function_exists('ellipsis')) {

    // Checks if a video is youtube, vimeo or any other
    function ellipsis($long_string, $max_character = 30) {
        $short_string = strlen($long_string) > $max_character ? substr($long_string, 0, $max_character) . "..." : $long_string;
        return $short_string;
    }

}

if (!function_exists('route')) {

    function route($path = '') {
        $CI = & get_instance();
        $controller = "";
        if ($CI->session->userdata('user_type') == 'parent') {
            $controller = 'parents';
        } else {
            $controller = $CI->session->userdata('user_type');
        }
        return site_url($controller . '/' . $path);
    }

}


if (!function_exists('slugify')) {

    function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
            return 'n-a';
        return $text;
    }

}

// Human readable time
if (!function_exists('readable_time_for_humans')) {

    function readable_time_for_humans($duration) {
        if ($duration) {
            $duration_array = explode(':', $duration);
            $hour = $duration_array[0];
            $minute = $duration_array[1];
            $second = $duration_array[2];
            if ($hour > 0) {
                $duration = $hour . ' ' . get_phrase('hr') . ' ' . $minute . ' ' . get_phrase('min');
            } elseif ($minute > 0) {
                if ($second > 0) {
                    $duration = ($minute + 1) . ' ' . get_phrase('min');
                } else {
                    $duration = $minute . ' ' . get_phrase('min');
                }
            } elseif ($second > 0) {
                $duration = $second . ' ' . get_phrase('sec');
            } else {
                $duration = '00:00';
            }
        } else {
            $duration = '00:00';
        }
        return $duration;
    }

}



// ------------------------------------------------------------------------
/* End of file common_helper.php */
