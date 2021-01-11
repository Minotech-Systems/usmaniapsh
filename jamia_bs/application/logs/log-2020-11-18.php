<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-11-18 09:33:39 --> Query error: Table 'jamia_bs.teachers' doesn't exist - Invalid query: SELECT *
FROM `teachers`
WHERE `user_id` = '5'
ERROR - 2020-11-18 09:33:39 --> Severity: error --> Exception: Call to a member function row_array() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\teacher\edit.php 4
ERROR - 2020-11-18 11:43:41 --> Query error: Unknown column 'school_id' in 'where clause' - Invalid query: UPDATE `users` SET `name` = 'Ijaz Sunny', `email` = 'imsunny37@gmail.com', `phone` = '+923152288722', `gender` = 'Male', `blood_group` = 'a+', `address` = 'District dir upper tehsil wari village wari'
WHERE `id` = '1'
AND `school_id` IS NULL
ERROR - 2020-11-18 11:43:41 --> Query error: Table 'jamia_bs.teachers' doesn't exist - Invalid query: UPDATE `teachers` SET `department_id` = NULL, `designation` = 'Teacher', `about` = 'sadasda', `social_links` = '{\"facebook\":\"facebook.com\",\"twitter\":\"\",\"linkedin\":\"\"}', `show_on_website` = '1'
WHERE `school_id` IS NULL
AND `user_id` = '1'
ERROR - 2020-11-18 11:45:57 --> Query error: Unknown column 'school_id' in 'where clause' - Invalid query: UPDATE `users` SET `name` = 'Ijaz Sunny', `email` = 'imsunny3@gmail.com', `phone` = '+923152288722', `gender` = 'Male', `blood_group` = 'a+', `address` = 'District dir upper tehsil wari village wari'
WHERE `id` = '1'
AND `school_id` IS NULL
ERROR - 2020-11-18 11:45:57 --> Query error: Table 'jamia_bs.teachers' doesn't exist - Invalid query: UPDATE `teachers` SET `department_id` = NULL, `designation` = 'Teacher', `about` = 'about ', `social_links` = '{\"facebook\":\"facebook.com\",\"twitter\":\"\",\"linkedin\":\"\"}', `show_on_website` = '1'
WHERE `school_id` IS NULL
AND `user_id` = '1'
ERROR - 2020-11-18 11:54:52 --> Query error: Unknown column 'gender' in 'field list' - Invalid query: UPDATE `teacher` SET `name` = 'Ijaz Sunny', `email` = 'imsunny@gmail.com', `phone` = '+923152288722', `gender` = 'Male', `blood_group` = 'a+', `address` = 'District dir upper tehsil wari village wari', `designation` = 'Teacher', `about` = 'About', `social_links` = '{\"facebook\":\"facebook.com\",\"twitter\":\"\",\"linkedin\":\"\"}', `show_on_website` = '1'
WHERE `teacher_id` = '1'
ERROR - 2020-11-18 11:56:13 --> Query error: Unknown column 'gender' in 'field list' - Invalid query: UPDATE `teacher` SET `name` = 'Ijaz Sunny', `email` = 'imsunny33@gmail.com', `phone` = '+923152288722', `gender` = 'Male', `blood_group` = 'a+', `address` = 'District dir upper tehsil wari village wari', `designation` = 'Teacher', `about` = 'About', `social_links` = '{\"facebook\":\"facebook.com\",\"twitter\":\"\",\"linkedin\":\"\"}', `show_on_website` = '1'
WHERE `teacher_id` = '1'
ERROR - 2020-11-18 17:38:46 --> 404 Page Not Found: Admin/parent
ERROR - 2020-11-18 21:39:42 --> Severity: error --> Exception: Call to undefined function school_id() C:\xampp\htdocs\jamia_bs\application\views\backend\admin\parent\list.php 2
