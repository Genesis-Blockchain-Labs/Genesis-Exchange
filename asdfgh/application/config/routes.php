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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Login';
/* $route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; */
$route['recover'] = 'Login/recoverpassword';
$route['setting'] = 'dashboard/progress_bar';
$route['save_setting'] = 'dashboard/save_progress_bar';

$route['ico'] = 'dashboard/ico';
$route['save_ico'] = 'dashboard/save_ico';
$route['authentication'] = 'dashboard/google_auth';
$route['enable'] = 'dashboard/enable_google_auth';
$route['disable'] = 'dashboard/disable_google_auth';

$route['user_list'] = 'User/get_users';
$route['userdetail/(:num)'] = 'User/user_detail/$1';
$route['update_userdetail'] = 'User/update_userdetail';
$route['update_token'] = 'User/update_token';
$route['invested'] = 'User/get_invest_users';
$route['kyc_detail/(:num)'] = 'Kyc/get_kyc/$1';

$route['kyc'] = 'Kyc/get_all_kyc';
$route['kyc_status'] = 'Kyc/change_status';
$route['contribution'] = 'contribution/update_contribution';
$route['referrals/(:num)'] = 'Kyc/get_referel_user/$1';
$route['ico_setup'] = 'icosetup/index';
$route['ico_setting'] = 'icosetup/ico_setting';
$route['pre_ico_setting'] = 'icosetup/pre_ico_setting';
$route['referral'] = 'referalmanage';
$route['save_referral'] = 'referalmanage/save_referral';

$route['ip'] = 'ip/ip';
$route['blockip'] = 'ip/blockip';
$route['block_ip'] = 'blockip/index';
$route['block_ip_user'] = 'blockip/block_ip';
$route['changepassword'] = 'ip/changepassword';
$route['passwordrecover'] = 'ip/passwordrecover';
$route['transaction'] = 'transaction/transaction_detail';
$route['transaction/(:num)'] = 'transaction/transaction_details/$1';
$route['website_setup'] = 'icosetup/website_setup';
$route['website_setup_update'] = 'icosetup/website_setup_update';
$route['login_setup'] = 'icosetup/login_setup';
$route['login_setup_update'] = 'icosetup/login_setup_update';
$route['register_setup'] = 'icosetup/register_setup';
$route['register_setup_update'] = 'icosetup/register_setup_update';
$route['activate_setup'] = 'icosetup/activate_setup';
$route['activate_setup_update'] = 'icosetup/activate_setup_update';
$route['attempt_setup'] = 'icosetup/attempt_setup';
$route['attempt_setup_update'] = 'icosetup/attempt_setup_update';
$route['support'] = 'Support/support_request';
$route['supportdetail/(:num)'] = 'Support/support_detail/$1';
$route['reply'] = 'Support/support_reply';
$route['logs_detail'] = 'Logs/log_detail';
$route['admin_logs_detail'] = 'admin_log/adminlog';
$route['safeada_log'] = 'admin_log/safeada_log';
$route['event'] = 'Eventmanage/event_request';
$route['broadcast'] = 'Broadcast/index';
$route['save_message'] = 'Broadcast/save_message';
$route['update_message'] = 'Broadcast/update_message';
$route['addevent'] = 'Eventmanage/add_event';
$route['saveevent'] = 'Eventmanage/save_event';
$route['eventdetail/(:num)'] = 'Eventmanage/event_detail/$1';
$route['update_event'] = 'Eventmanage/update_event';
$route['partner'] = 'Partnermanage/partner_request';
$route['addpartner'] = 'Partnermanage/add_partner';
$route['savepartner'] = 'Partnermanage/save_partner';
$route['partnerdetail/(:num)'] = 'Partnermanage/partner_detail/$1';
$route['update_partner'] = 'Partnermanage/update_partner';