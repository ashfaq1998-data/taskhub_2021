<?php

require_once ROOT  . '/View.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmployeeController {

  public function employeeDashboard() {
    $view = new View("Employee/employee_dashboard");
  }

  public function employeeHelp() {
    $view = new View("Employee/employee_help");
  }

  public function employeeHistory() {
    $view = new View("Employee/employee_history");
  }

  public function employeeComplaint() {
    $view = new View("Employee/employee_complaint");
  }

  public function employeeBooking() {
    $view = new View("Employee/employee_booking");
  }

  public function employeeProfile(){
    $view = new View("Employee/employee_profile");
  }
  public function employeeSearch(){
    $view = new View("Employee/employee_search");
  }

  public function employeeViewad(){
    $view = new View("Employee/employee_viewad");
  }




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
    $view = new View("Customer/customer_profile");
  }

  public function customerProfileEdit(){
    $view = new View("Customer/customer_profileEdit");
  }

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