<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'home';
$route['validate_adminlogin'] = 'admin_login/validate_login';
$route['adminlogout'] = 'admin_login/logout/';
$route['switch_lang'] = 'home/switchLang/';
$route['new_questions'] = 'darulifta/new_questions';
$route['ask_question'] = 'darulifta/ask_questions';
$route['user_question'] = 'darulifta/user_questions';
$route['search_question'] = 'darulifta/search_question';
$route['read_question/(:num)'] = 'darulifta/read_question/$1';
$route['bab_search/(:any)'] = 'darulifta/search_chapter_question/$1';
$route['search_individual/(:any)/(:any)'] = 'darulifta/search_individual_question/$1/$1';

$route['fasal_search/(:any)'] = 'darulifta/search_fasal_question/$1';

//Users routes

$route['dashboard'] = 'user/dashboard';
$route['validate_userlogin'] = 'login/validate_login';
$route['register'] = 'login/register';
$route['register_user'] = 'login/register_user';
$route['forgot-password'] = 'login/forgot_password';
$route['forgot_password'] = 'login/forgot_user_password';

$route['books'] = 'home/books/';
$route['update_web_settings/(:any)'] = 'website/update_web_settings/$1';

$route['page/(:any)'] = 'home/pages/$1';
$route['gallery'] = 'home/gallery';
$route['gallery_view/(:any)'] = 'home/gallery_view/$1';
$route['add_news'] = 'admin/add_news';
$route['add_position_holder'] = 'website/add_position_holder';

$route['position_holders'] = 'home/position_holders';
$route['position_holder_view/(:any)'] = 'home/position_holder_view/$1';
$route['contact'] = 'home/contact';
$route['cooperation'] = 'home/cooperation';




$route['alasr_resala'] ='home/alasr_resala/';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Library Routes

//$route['AddAurther'] = 'LibraryController/add_aurther';