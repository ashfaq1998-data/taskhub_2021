<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/EmployeeModel.php';
require_once ROOT . '/models/BookingModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmployeeController {

  public function employeeDashboard() {
    $view = new View("Employee/employee_dashboard");
  }

  public function employeeHelp() {
    
    $helpRequestModel = new HelpRequestModel();
    $employeeModel = new EmployeeModel();
    if(!empty($_POST['employee_help'] && $_POST['employee_help'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
		  $subject = $_POST['subject'];
		  $message = $_POST['message'];
      $HelpError = "";

      if(empty($subject) || empty($message))
      {
          $HelpError = "Please fill all the empty fields";
      }

      if($HelpError == ""){
        $requestID = $helpRequestModel->generateEmployeeHelpID();
        $userID = $_SESSION['loggedin']['user_id'];
        $empDetails = $employeeModel->getEmployeeByUserID($userID);
        $currentDateTime = date('Y-m-d H:i:s');
      
        $employeeHelpDetails = [
          'RequestID' => $requestID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $message,
          'EmployeeID' => $empDetails->EmployeeID
          
        ];

        $helpRequestModel->addNewEmployeeHelp($employeeHelpDetails);
        $HelpError = "none";
        
      }

      $data['HelpError'] = $HelpError;
      
    }

    $view = new View("Employee/employee_help",$data);
  }

  public function employeeHistory() {
    $employeeModel = new EmployeeModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $employeeDetails = $employeeModel->getEmployeeByUserID($userID);

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;

    $data['work_history'] = $employeeModel->getEmployeeWorkHistory($employeeDetails->EmployeeID, $num_results_on_page, $calc_page, false);

    $total_pages = $employeeModel->getEmployeeWorkHistory($employeeDetails->EmployeeID, 0, 0, true);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $view = new View("Employee/employee_history", $data);
  }

  public function employeeComplaint() {
    $complaintModel = new ComplaintModel();
    $employeeModel = new EmployeeModel();

    if(!empty($_POST['employee_complaint'] && $_POST['employee_complaint'] == 'submitted')){
      $data['inputted_data'] = $_POST;
		  $subject = $_POST['subject'];
		  $complaintmessage = $_POST['complaintmessage'];
      $rating = $_POST['rating'];
      $ComplaintError = "";

      if(empty($subject) || empty($complaintmessage) || empty($rating))
      {
          $ComplaintError = "Please fill all the empty fields";
      }

      if($ComplaintError == ""){
        $complaintID = $complaintModel->generateEmployeeComplaintID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $employeeDetails = $employeeModel->getEmployeeByUserID($userID);


        $employeeComplaints = [
          'ComplaintID' => $complaintID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $complaintmessage,
          'Rates' => $rating,
          'EmployeeID' => $employeeDetails->EmployeeID
        ];

        $complaintModel-> addNewEmployeeComplaint($employeeComplaints);
        $ComplaintError = "none";

      }

      $data['ComplaintError'] = $ComplaintError;
    }
    $view = new View("Employee/employee_complaint",$data);
  }

  public function employeeBooking() {
    $employeeModel = new EmployeeModel();
    $bookingModel = new BookingModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $employeeDetails = $employeeModel->getEmployeeByUserID($userID);
    $bookingsDetails = $bookingModel->getEmployeeBookings($employeeDetails->EmployeeID);

    $allEvents = array();
    foreach($bookingsDetails as $booking){
      $event = [
        'title'  => $booking->title,
        'start'  => $booking->EventDate,
        'customerName' => $booking->CusFullName,
        'address' => $booking->Address,
        'time' => $booking->EventTime,
        'payment' => $booking->payment
      ];
      array_push($allEvents, $event);
    }
    $data['bookingEvents'] = $allEvents;
  
    $view = new View("Employee/employee_booking", $data);
  }

  public function employeeProfile(){
    $employeeModel = new EmployeeModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['employee_details'] = $employeeModel->getEmployeeByUserID($userID);
    $view = new View("Employee/employee_profile",$data);
    
  }
  public function employeeSearch(){
    $view = new View("Employee/employee_search");
  }

  public function employeeViewad(){
    $view = new View("Employee/employee_viewad");
  }
 
}