<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//-------------- admin
// $route['admin-login'] = 'admin_login';
$route['karakover-admin'] = 'admin_login';
$route['logout'] = 'admin_login/logout';


// Website ROUTES //
$route['/'] = 'home/index/';
$route['About'] = 'home/about/';
$route['Instruments'] = 'home/instruments';
$route['Tutorials'] = 'home/tutorials';
$route['Chat_Room'] = 'home/chatroom';
$route['Terms'] = 'home/terms';
$route['Privacy'] = 'home/privacy';
$route['delete-account'] = 'home/delete_account';
