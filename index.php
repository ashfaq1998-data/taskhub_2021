<?php
ini_set('session.gc_maxlifetime', 60 * 2);
date_default_timezone_set('Asia/Colombo'); //Asia/Colombo
session_start();
$dir_name = dirname($_SERVER['SCRIPT_NAME']);

define('ROOT', __DIR__);

// url => http://localhost:81/mvcp/user/add-post
// url => user/add-post
$url = trim(substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($dir_name)), "?");
define("fullURLfront", "/taskhub");

// associative arrays
$routes = [

  //main controllers
    'main/index' => 'MainController@index',
    'main/contactus' => 'MainController@contactUs',

  //authentication controller
    'auth/login' => 'AuthController@login',
    'auth/employee_register' => 'AuthController@employeeRegister',
    'auth/contractor_register' => 'AuthController@contractorRegister',
    'auth/customer_register' => 'AuthController@customerRegister',
    'auth/manpower_register' => 'AuthController@manpowerRegister',
    'auth/forgot_password' => 'AuthController@forgotPassword',
    'auth/reset_password' => 'AuthController@resetPassword',
    'auth/logout' => 'AuthController@logout',

  //employee section
    'Employee/employee_dashboard' => 'EmployeeController@employeeDashboard',
    'Employee/employee_help' => 'EmployeeController@employeeHelp',
    'Employee/employee_history' => 'EmployeeController@employeeHistory',
    'Employee/employee_complaint' => 'EmployeeController@employeeComplaint',
    'Employee/employee_booking' => 'EmployeeController@employeeBooking',
    'Employee/employee_profile' => 'EmployeeController@employeeProfile',
    'Employee/employee_search' => 'EmployeeController@employeeSearch',
    'Employee/employee_viewad' => 'EmployeeController@employeeViewad',
    'Employee/employee_editprofile' => 'EmployeeController@employeeEditprofile',
    'Employee/employee_view_profile' => 'EmployeeController@showSearchProfile',
    'Employee/employee_job_apply' => 'EmployeeController@employeeJobApply',
    


  //contractor section
    'Contractor/contractor_profile' => 'ContractorController@contractorProfile',
    'Contractor/contractor_complaint' =>'ContractorController@contractorComplaint',
    'Contractor/contractor_postad' =>'ContractorController@contractorPostad',
    'Contractor/contractor_help' =>'ContractorController@contractorHelp',
    'Contractor/contractor_paymentform' =>'ContractorController@contractorPaymentform',
    'Contractor/contractor_payment' =>'ContractorController@contractorPayment',
    'Contractor/contractor_confirmpayment' =>'ContractorController@contractorConfirmpayment',
    'Contractor/contractor_paymentdone' =>'ContractorController@contractorPaymentdone',
    'Contractor/contractor_booking' =>'ContractorController@contractorBooking',
    'Contractor/contractor_history' =>'ContractorController@contractorHistory',
    'Contractor/contractor_viewad' =>'ContractorController@contractorViewad',
    'Contractor/contractor_viewmyad' =>'ContractorController@contractorViewmyad',
    'Contractor/contractor_myadedit' =>'ContractorController@contractorMyadedit',
    'Contractor/contractor_search' =>'ContractorController@contractorSearch',
    'Contractor/contractor_editprofile' => 'ContractorController@contractorEditprofile',
    'Contractor/contractor_ownad' => 'ContractorController@contractorOwnad',
    'Contractor/contractor_view_profile' => 'ContractorController@showSearchProfile',
    'Contractor/contractor_requestjob' => 'ContractorController@contractorRequest',
    'Contractor/contractor_requestjob' => 'ContractorController@contractorRequest',
    'Contractor/contractor_job_apply' => 'ContractorController@contractorJobApply',

  //customer section

    'Customer/customer_profile' => 'CustomerController@customerProfile',
    'Customer/customer_viewad' => 'CustomerController@customerViewad',
    'Customer/customer_history' => 'CustomerController@customerHistory',
    'Customer/customer_complaint' => 'CustomerController@customerComplaint',
    'Customer/customer_services' => 'CustomerController@customerService',
    'Customer/customer_servicelist' => 'CustomerController@customerServicelist',
    'Customer/customer_bookingform' => 'CustomerController@customerBookingform',
    'Customer/customer_help' => 'CustomerController@customerHelp',
    'Customer/customer_booking' => 'CustomerController@customerBooking',
    'Customer/customer_editprofile' => 'CustomerController@customerEditprofile',
    'Customer/customer_postad' =>'CustomerController@customerPostad',
    'Customer/customer_ownad' => 'CustomerController@customerOwnad',
    'Customer/customer_requestjob' => 'CustomerController@customerRequest',
    'Customer/customer_view_profile' => 'CustomerController@showSearchProfile',
    'Customer/customer_job_apply' => 'CustomerController@customerJobApply',

    //manpower section
    'Manpower/manpower_profile' => 'ManpowerController@manpowerProfile',
    'Manpower/manpower_complaint' => 'ManpowerController@manpowerComplaint',
    'Manpower/manpower_help' => 'ManpowerController@manpowerHelp',
    'Manpower/manpower_booking' => 'ManpowerController@manpowerBooking',
    'Manpower/manpower_editprofile' => 'ManpowerController@manpowerEditprofile',
    'Manpower/manpower_postad' => 'ManpowerController@manpowerPostAd',
    'Manpower/manpower_viewad' => 'ManpowerController@manpowerViewad',
    'Manpower/manpower_ownad' => 'ManpowerController@manpowerOwnad',
    'Manpower/manpower_history' => 'ManpowerController@manpowerHistory',
    'Manpower/manpower_search' => 'ManpowerController@manpowerSearch',
    'Manpower/manpower_view_profile' => 'ManpowerController@showSearchProfile',
    'Manpower/manpower_requestjob' => 'ManpowerController@manpowerRequest',
    'Manpower/manpower_job_apply' => 'ManpowerController@manpowerJobApply',




    //admin section
    'Admin/admin_dashboard' => 'AdminController@adminDashboard',
    'Admin/admin_manageemployee' => 'AdminController@adminManageEmployee',
    'Admin/admin_managecontractor' => 'AdminController@adminManageContractor',
    'Admin/admin_managemanpower' => 'AdminController@adminManageManpower',
    'Admin/admin_managecustomer' => 'AdminController@adminManageCustomer',
    'Admin/admin_manageinquiry' => 'AdminController@adminManageInquiry',
    'Admin/admin_profile' => 'AdminController@adminProfile',
    'Admin/admin_addemployee' => 'AdminController@adminAddEmployee',
    'Admin/admin_addcontractor' => 'AdminController@adminAddContractor',
    'Admin/admin_addmanpower' => 'AdminController@adminAddManpower',
    'Admin/admin_addcustomer' => 'AdminController@adminAddCustomer',
    'Admin/admin_managehelp' => 'AdminController@adminManageHelp',
    'Admin/admin_managecomplaint' => 'AdminController@adminManageComplaint',
    'Admin/admin_managepayment' => 'AdminController@adminManagePayment',
    'Admin/admin_manageadvertisement' => 'AdminController@adminManageAdvertisement',
    'Admin/admin_editemployee' => 'AdminController@showEmployeeEdit',
    'Admin/admin_deleteemployee' => 'AdminController@EmployeeDelete',
    'Admin/admin_editcustomer' => 'AdminController@showCustomerEdit',
    'Admin/admin_deletecustomer' => 'AdminController@CustomerDelete',
    'Admin/admin_editcontractor' => 'AdminController@showContractorEdit',
    'Admin/admin_deletecontractor' => 'AdminController@ContractorDelete',
    'Admin/admin_editmanpower' => 'AdminController@showManpowerEdit',
    'Admin/admin_deletemanpower' => 'AdminController@ManpowerDelete',
    'Admin/admin_deletecomplaint' => 'AdminController@ComplaintDelete',
    'Admin/admin_deleteinquiry' => 'AdminController@InquiryDelete',
    'Admin/admin_deletehelp' => 'AdminController@HelpDelete',
    'Admin/admin_deletead' => 'AdminController@AdDelete',

    //booking handling
    'Booking/booking_handle' => 'BookingController@bookingHandle',
    'Booking/booking_submit' => 'BookingController@bookingSubmit',
    'Booking/booking_success' => 'BookingController@bookingSuccess',

    //rate
    'Rate/rate_submit' => 'RateController@RateSubmit',
    

];

$found = false;
$request_path_only = explode("?", $url)[0];

foreach($routes as $route => $name) {
  if ($route === $request_path_only) {
    $found = true;
    // UserController@addPost
    $split = explode("@", $name);
    // [UserController, addPost]
    $controller_file = $split[0];
    $method = $split[1];

    require_once __DIR__ . "/controllers/" . $controller_file . ".php";
    $controller = new $controller_file();
    call_user_func([$controller, $method]);
  }
}



if ($found == false) {
  echo "404 Page Not Found";
}