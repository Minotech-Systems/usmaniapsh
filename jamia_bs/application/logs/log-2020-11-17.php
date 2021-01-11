<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-11-17 08:25:00 --> Severity: error --> Exception: Call to undefined function school_id() C:\xampp\htdocs\jamia_bs\application\views\backend\admin\teacher\list.php 2
ERROR - 2020-11-17 08:42:10 --> Query error: Table 'jamia_bs.classes' doesn't exist - Invalid query: SELECT *
FROM `classes`
WHERE `id` = '1'
ERROR - 2020-11-17 08:42:10 --> Severity: error --> Exception: Call to a member function row() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\teacher\permission_overview.php 14
ERROR - 2020-11-17 08:52:52 --> Severity: error --> Exception: Call to undefined function school_id() C:\xampp\htdocs\jamia_bs\application\views\backend\admin\permission\index.php 23
ERROR - 2020-11-17 09:21:51 --> Severity: error --> Exception: Call to undefined function school_id() C:\xampp\htdocs\jamia_bs\application\views\backend\admin\teacher\create.php 4
ERROR - 2020-11-17 12:23:19 --> Query error: Table 'jamia_bs.teachers' doesn't exist - Invalid query: INSERT INTO `teachers` (`user_id`, `about`, `social_links`, `department_id`, `designation`, `school_id`, `show_on_website`, `batch_id`, `semester_id`) VALUES (11, 'this is my profile', '{\"facebook\":\"facebook.com\",\"twitter\":\"twitter.com\",\"linkedin\":\"linkedin\"}', '1', 'Teacher', NULL, '1', '1', '1')
ERROR - 2020-11-17 12:23:19 --> Severity: Warning --> Illegal offset type C:\xampp\htdocs\jamia_bs\system\database\DB_query_builder.php 667
ERROR - 2020-11-17 12:30:17 --> Query error: Table 'jamia_bs.teachers' doesn't exist - Invalid query: INSERT INTO `teachers` (`user_id`, `name`, `about`, `phone`, `gender`, `blood_group`, `address`, `social_links`, `department_id`, `designation`, `show_on_website`, `batch_id`, `semester_id`) VALUES (12, 'Safyan Khan', 'this is about', '03152288722', 'Male', 'a+', 'Villlage kakad P.O Wari District Dir Upper KPK Pakistan', '{\"facebook\":\"facebook.com\",\"twitter\":\"twitter.com\",\"linkedin\":\"linkedin\"}', '1', 'Teacher', '1', '1', '1')
ERROR - 2020-11-17 12:30:17 --> Severity: Warning --> Illegal offset type C:\xampp\htdocs\jamia_bs\system\database\DB_query_builder.php 667
ERROR - 2020-11-17 12:32:35 --> Query error: Unknown column 'gender' in 'field list' - Invalid query: INSERT INTO `teacher` (`user_id`, `name`, `about`, `phone`, `gender`, `blood_group`, `address`, `social_links`, `department_id`, `designation`, `show_on_website`, `batch_id`, `semester_id`) VALUES (13, 'Safyan Khan', 'this is about me', '03152288722', 'Male', 'a+', 'Villlage kakad P.O Wari District Dir Upper KPK Pakistan', '{\"facebook\":\"facebook.com\",\"twitter\":\"twitter.com\",\"linkedin\":\"linkedin\"}', '1', 'Teacher', '1', '1', '1')
ERROR - 2020-11-17 12:32:35 --> Severity: Warning --> Illegal offset type C:\xampp\htdocs\jamia_bs\system\database\DB_query_builder.php 667
ERROR - 2020-11-17 12:36:15 --> Query error: Duplicate entry '0' for key 'PRIMARY' - Invalid query: INSERT INTO `teacher_class_info` (`teacher_id`, `department_id`, `batch_id`, `semester_id`) VALUES (2, '1', '1', '1')
ERROR - 2020-11-17 12:36:15 --> Severity: Warning --> Illegal offset type C:\xampp\htdocs\jamia_bs\system\database\DB_query_builder.php 667
ERROR - 2020-11-17 12:36:27 --> Query error: Table 'jamia_bs.teachers' doesn't exist - Invalid query: SELECT *
FROM `teachers`
WHERE `user_id` = '5'
ERROR - 2020-11-17 12:36:27 --> Severity: error --> Exception: Call to a member function row_array() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\teacher\edit.php 4
ERROR - 2020-11-17 20:06:22 --> Query error: Table 'jamia_bs.classes' doesn't exist - Invalid query: SELECT *
FROM `classes`
WHERE `school_id` IS NULL
ERROR - 2020-11-17 20:06:22 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\subject\index.php 25
