<?php

session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/model/HelpRequestModel.php';
require_once ROOT . '/model/ComplaintModel.php';
require_once ROOT . '/model/CustomerModel.php';
require_once ROOT . '/model/BookingModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CustomerController {

  //customer functions
  public function customerBooking() {
    $view = new View("Customer/customer_booking");
  }

  public function customerComplaint() {
    $view = new View("Customer/customer_complaint");
  }

  public function customerDashboard() {
    $view = new View("Customer/customer_dashboard");
  }

  public function customerHelp() {
    $view = new View("Customer/customer_help");
  }

  public function customerCalender() {
    $view = new View("Customer/customer_calender");
  }

  public function customerHistory() {
    $view = new View("Customer/customer_history");
  }

  public function customerViewad(){
    $view = new View("Customer/customer_viewad");
  }

  public function customerProfile(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);
    $view = new View("Customer/customer_profile",$data);
  }

  public function customerProfileEd(){
    $view = new View("Customer/customer_profileEd");
  }

  // public function customerProfileEdit(){
  //   $view = new View("Customer/customer_profileEdit");
  // }

  public function customerService(){
    $view = new View("Customer/customer_service");
  }

  public function customerServiceLocation(){
    $view = new View("Customer/customer_serviceLocation");
  }

  public function customerServiceList(){
    $view = new View("Customer/customer_serviceList");
  }
 
}