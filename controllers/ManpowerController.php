<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/ManpowerModel.php';

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
        
      }

      $data['HelpError'] = $HelpError;
      
    }

    $view = new View("Employee/employee_help",$data);
  }

  public function employeeHistory() {
    $view = new View("Employee/employee_history");
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

      }

      $data['ComplaintError'] = $ComplaintError;
    }
    $view = new View("Employee/employee_complaint",$data);
  }

  public function employeeBooking() {
    $view = new View("Employee/employee_booking");
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