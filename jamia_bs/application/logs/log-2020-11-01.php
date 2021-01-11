<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-11-01 00:02:50 --> Query error: Unknown column 'comment' in 'field list' - Invalid query: INSERT INTO `batch` (`name`, `numeric_name`, `department_id`, `start_year`, `end_year`, `comment`) VALUES ('Batch No 1', '1', '1', '2010', '2014', '')
ERROR - 2020-11-01 00:03:39 --> Query error: Unknown column 'comment' in 'field list' - Invalid query: INSERT INTO `batch` (`name`, `numeric_name`, `department_id`, `start_year`, `end_year`, `comment`) VALUES ('Batch No 1', '1', '1', '2010', '2014', '')
ERROR - 2020-11-01 00:03:54 --> Query error: Unknown column 'comment' in 'field list' - Invalid query: INSERT INTO `batch` (`name`, `numeric_name`, `department_id`, `start_year`, `end_year`, `comment`) VALUES ('Batch No 1', '1', '1', '2010', '2014', '')
ERROR - 2020-11-01 00:05:28 --> Query error: Unknown column 'comment' in 'field list' - Invalid query: INSERT INTO `batch` (`name`, `numeric_name`, `department_id`, `start_year`, `end_year`, `comment`) VALUES ('Batch No 1', '1', '1', '2010', '2014', '')
ERROR - 2020-11-01 00:07:21 --> Query error: Unknown column 'comment' in 'field list' - Invalid query: INSERT INTO `batch` (`name`, `numeric_name`, `department_id`, `start_year`, `end_year`, `comment`) VALUES ('Batch No 1', '1', '1', '2010', '2014', '')
ERROR - 2020-11-01 10:10:27 --> Query error: Unknown column 'id' in 'where clause' - Invalid query: UPDATE `batch` SET `name` = 'Batch No 1', `numeric_name` = '1', `department_id` = '1', `start_year` = '2011', `end_year` = '2015', `remarks` = ''
WHERE `id` = '1'
ERROR - 2020-11-01 10:11:23 --> Query error: Unknown column 'id' in 'where clause' - Invalid query: UPDATE `batch` SET `name` = 'Batch No 1', `numeric_name` = '1', `department_id` = '1', `start_year` = '2010', `end_year` = '2015', `remarks` = ''
WHERE `id` = '1'
ERROR - 2020-11-01 07:42:25 --> 404 Page Not Found: Admin/get_deparment_batch1
ERROR - 2020-11-01 07:42:29 --> 404 Page Not Found: Admin/get_deparment_batch2
ERROR - 2020-11-01 07:42:31 --> 404 Page Not Found: Admin/get_deparment_batch1
ERROR - 2020-11-01 07:42:56 --> 404 Page Not Found: Admin/get_deparment_batch2
ERROR - 2020-11-01 12:40:45 --> Query error: Unknown column 'numeric_name' in 'field list' - Invalid query: INSERT INTO `semester` (`name`, `numeric_name`, `department_id`, `batch_id`, `timestamp`, `comment`) VALUES ('1st Semester', '1', '1', '1', 1604216445, '')
ERROR - 2020-11-01 12:42:15 --> Query error: Unknown column 'id' in 'where clause' - Invalid query: SELECT `name`
FROM `batch`
WHERE `id` = '1'
ERROR - 2020-11-01 12:42:15 --> Severity: error --> Exception: Call to a member function row() on boolean C:\xampp\htdocs\jamia_bs\application\helpers\common_helper.php 309
ERROR - 2020-11-01 12:42:40 --> Query error: Unknown column 'id' in 'where clause' - Invalid query: SELECT `name`
FROM `batch`
WHERE `id` = '1'
ERROR - 2020-11-01 12:42:40 --> Severity: error --> Exception: Call to a member function row() on boolean C:\xampp\htdocs\jamia_bs\application\helpers\common_helper.php 309
ERROR - 2020-11-01 13:31:25 --> Query error: Column 'semester_id' cannot be null - Invalid query: INSERT INTO `section` (`name`, `numeric_name`, `department_id`, `batch_id`, `semester_id`, `timestamp`, `comment`) VALUES ('A', '1', '1', '1', NULL, 1604219485, '')
ERROR - 2020-11-01 13:33:03 --> Query error: Column 'semester_id' cannot be null - Invalid query: INSERT INTO `section` (`name`, `numeric_name`, `department_id`, `batch_id`, `semester_id`, `timestamp`, `comment`) VALUES ('B', '2', '1', '1', NULL, 1604219583, '')
ERROR - 2020-11-01 13:43:21 --> Severity: error --> Exception: Call to undefined function school_id() C:\xampp\htdocs\jamia_bs\application\views\backend\admin\student\index.php 25
ERROR - 2020-11-01 13:43:24 --> Severity: error --> Exception: Call to undefined function school_id() C:\xampp\htdocs\jamia_bs\application\views\backend\admin\student\single_student_admission.php 1
ERROR - 2020-11-01 20:21:42 --> Query error: Table 'jamia_bs.parents' doesn't exist - Invalid query: SELECT *
FROM `parents`
WHERE `school_id` IS NULL
ERROR - 2020-11-01 20:21:42 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\student\single_student_admission.php 31
ERROR - 2020-11-01 20:22:19 --> Query error: Table 'jamia_bs.parents' doesn't exist - Invalid query: SELECT *
FROM `parents`
WHERE `school_id` IS NULL
ERROR - 2020-11-01 20:22:19 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\student\single_student_admission.php 31
ERROR - 2020-11-01 20:22:35 --> Query error: Table 'jamia_bs.parents' doesn't exist - Invalid query: SELECT *
FROM `parents`
WHERE `school_id` IS NULL
ERROR - 2020-11-01 20:22:35 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\student\single_student_admission.php 31
ERROR - 2020-11-01 20:23:43 --> Query error: Table 'jamia_bs.parents' doesn't exist - Invalid query: SELECT *
FROM `parents`
WHERE `school_id` IS NULL
ERROR - 2020-11-01 20:23:43 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\jamia_bs\application\views\backend\admin\student\single_student_admission.php 31
