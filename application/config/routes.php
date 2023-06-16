<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['kontak'] = 'kontak';
$route['periksa'] = 'periksa';

$route['login'] = 'login';
$route['logout'] = 'login/logout';
$route['login/check'] = 'login/chek_login';
$route['dashboard'] = 'dashboard/index';

$route['penyakit'] = 'dashboard/penyakit';
$route['penyakit/insert'] = 'dashboard/penyakit/insert';
$route['penyakit/ubah/(:any)'] = 'dashboard/penyakit/edit/$1';
$route['penyakit/delete/(:any)'] = 'dashboard/penyakit/delete/$1';

$route['gejala'] = 'dashboard/gejala';
$route['gejala/insert'] = 'dashboard/gejala/insert';
$route['gejala/ubah/(:any)'] = 'dashboard/gejala/edit/$1';
$route['gejala/delete/(:any)'] = 'dashboard/gejala/delete/$1';

$route['bobot'] = 'dashboard/bobot';
$route['bobot/insert'] = 'dashboard/bobot/insert';
$route['bobot/ubah/(:any)'] = 'dashboard/bobot/edit/$1';
$route['bobot/delete/(:any)'] = 'dashboard/bobot/delete/$1';

$route['admin'] = 'dashboard/admin';
$route['admin/insert'] = 'dashboard/admin/insert';
$route['admin/ubah/(:any)'] = 'dashboard/admin/edit/$1';
$route['admin/delete/(:any)'] = 'dashboard/admin/delete/$1';

$route['pasien'] = 'dashboard/pasien';
$route['pasien/detail/(:any)'] = 'dashboard/pasien/detail/$1';
$route['pasien/delete/(:any)'] = 'dashboard/pasien/delete/$1';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
