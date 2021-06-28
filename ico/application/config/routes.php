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
| my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'User';
/* $route['404_override'] = 'page_not_found';
$route['translate_uri_dashes'] = FALSE; */
$route['mantainance'] = 'user/mantainance';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['signup'] = 'user/registration';
$route['registration'] = 'user/registration';
$route['poc'] = 'user/registration';
$route['referrel_link'] = 'user/referrel_link'; 
$route['proof'] = 'user/proof';
$route['dashboard'] = 'dashboard/dashboard';
$route['forgot'] = 'user/forgot';
$route['Terms-and-Conditions'] = 'user/Terms_and_condition';
$route['verify'] = 'user/verify_mail';
$route['do_log'] = 'user/do_login';
$route['loged'] = 'user/proof_do_log';
$route['resetpass'] = 'user/reset_pass';
$route['tokensale'] = 'user/landing';
$route['whitepaper'] = 'user/whitepaper';
$route['bounty/:num'] = 'user/bounty/$1';


$route['us_coustomer'] = 'kyc/kyc_us';
$route['nonus_coustomer'] = 'kyc/kyc_nonus';
$route['us_submit'] = 'kyc/submit_kyc_us';
$route['nonus_submit'] = 'kyc/submit_kyc_nonus';
$route['edit_us'] = 'kyc/edit_kyc_us';
$route['edit_nonus'] = 'kyc/edit_kyc_nonus'; 

$route['profile'] = 'dashboard/profile_view';
$route['contribution'] = 'dashboard/contribution_view';
$route['referral'] = 'Referral/get_referral';
$route['authentication'] = 'authentication/index';
$route['google_auth'] = 'authentication/save_google_auth';
$route['verification/(:num)'] = 'authentication/auth/$1';
$route['authenticate/(:num)'] = 'authentication/auth/$1';
$route['authenticates/(:num)'] = 'authentication/save_google_auths/$1';   

$route['twilio_auth'] = 'authentication/save_twilio_auth';
$route['authenticateTwilio/(:num)'] = 'authentication/twilio_authenticate/$1';
$route['veryficationCode'] = 'authentication/check_twilio_auth';

$route['update_profile'] = 'dashboard/update_profile';
$route['security_setting'] = 'dashboard/setting';
$route['update_personal_info'] = 'dashboard/update_info';
$route['check_password'] = 'dashboard/check_password';
$route['btc'] = 'invest/save_btc';  
$route['eth'] = 'invest/save_eth';  
$route['ripple'] = 'invest/save_ripple';  
$route['litecoin'] = 'invest/save_litecoin';  
$route['dash'] = 'invest/save_dash';
$route['transaction_detail'] = 'transaction/index'; 
$route['transaction_detail/(:num)'] = 'transaction/index/$1'; 
$route['access_history'] = 'access_history/index';
$route['access_history/(:num)'] = 'access_history/index/$1'; 
$route['support'] = 'dashboard/support_page';
$route['save_contact'] = 'contact_us/save_contact';

$route['logout'] = 'user/logout';
$route['ip_address'] = 'verify/verify_ip';
$route['verifyip'] = 'verify/verifing';
$route['twiliomessage/(:num)'] = 'authentication/twiliomessage/$1';

$route['verifyaccount'] = 'user/verify_acc';  
$route['supports'] = 'dashboard/supports';  
$route['sendSupports'] = 'dashboard/sendSupports'; 

$route['supports/(:num)'] = 'dashboard/supports/$1';  
$route['supportDetail/(:num)'] = 'dashboard/supportDetail/$1'; 
$route['sendReply'] = 'dashboard/sendReply';  

$route['message/(:num)'] = 'Dashboard/broadcast_message/$1';
$route['ipblocked'] = 'user/ipBlocked'; 
$route['broadcastlist'] = 'Dashboard/broadcast_list'; 
$route['broadcastlist/(:num)'] = 'Dashboard/broadcast_list/$1'; 
$route['bedge'] = 'Dashboard/hide_bedge'; 