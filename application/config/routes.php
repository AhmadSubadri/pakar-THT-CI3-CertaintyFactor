<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['kontak'] = 'kontak';
$route['periksa'] = 'periksa';

$route['login'] = 'login';
$route['logout'] = 'login/logout';
$route['login/check'] = 'login/chek_login';
$route['dashboard'] = 'dashboard/index';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
