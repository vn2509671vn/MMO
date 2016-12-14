<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signup'] = 'site/dangky';
$route['logout'] = 'home/get_dangxuat';
$route['infomation'] = 'site/thongtin/index';
$route['current-level'] = 'site/thongtin/nguoiduoi';
$route['list-of-present'] = 'site/thongtin/nguoiduocgioithieu';
$route['with-draw-cash'] = 'site/ruttien/index';
$route['active-acount'] = 'site/kichhoat/index';
$route['tranfer-history'] = 'site/lichsu/index';
$route['change-password'] = 'site/doimatkhau/index';
$route['income-info'] = 'site/thongtinthunhap/index';
$route['history-info'] = 'site/thongtinthunhap/get_history';
$route['create-account'] = 'site/taotaikhoan/index';
$route['captcha'] = 'site/dangky/create_captcha';


$route['admin'] = 'admin/quanly/index';
$route['admin/user-list'] = 'admin/danhsachnguoidung/index';
$route['admin/approve-register'] = 'admin/kichhoat/index';
$route['admin/approve-register/(:num)'] = 'admin/kichhoat/get_kichhoat/$1';
$route['admin/approve-register-remove/(:num)'] = 'admin/kichhoat/remove/$1';
$route['admin/approve-withdraw'] = 'admin/ruttien/index';
$route['admin/approve-withdraw-user'] = 'admin/ruttien/get_ruttien';
$route['admin/change-password'] = 'admin/doimatkhau/index';
$route['admin/lock-account'] = 'admin/lockaccount/index';
$route['admin/lock-account/(:num)'] = 'admin/lockaccount/get_lock/$1';

$route['admin/tranfer-history/(:num)'] = 'admin/lichsu/get_lichsu/$1';
$route['admin/income-info/(:num)'] = 'admin/thongtinthunhap/get_income/$1';
$route['admin/childs/(:num)'] = 'admin/nguoiduocgioithieu/get_childs/$1';