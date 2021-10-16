<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/CustomerModel.php';
require_once ROOT . '/models/BookingModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CustomerController {

  public function customerDashboard() {
    $view = new View("Customer/customer_dashboard");
  }

  
  public function customerProfile(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);
    $view = new View("Customer/customer_profile",$data);
    
  }

  public function customerComplaint() {
    $complaintModel = new ComplaintModel();
    $customerModel = new CustomerModel();

    if(!empty($_POST['customer_complaint'] && $_POST['customer_complaint'] == 'submitted')){
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
        $complaintID = $complaintModel->generateCustomerComplaintID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $customerDetails = $customerModel->getCustomerByUserID($userID);


        $customerComplaints = [
          'ComplaintID' => $complaintID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $complaintmessage,
          'Rates' => $rating,
          'CustomerID' => $customerDetails->CustomerID
        ];

        $complaintModel-> addNewCustomerComplaint($customerComplaints);
        $ComplaintError = "none";

      }

      $data['ComplaintError'] = $ComplaintError;
    }
    $view = new View("Customer/customer_complaint",$data);
  }

  public function customerViewad(){
    $view = new View("Customer/customer_viewad");
  }

  public function customerService(){
    $view = new View("Customer/customer_services");
  }

  public function customerServicelist(){
    $view = new View("Customer/customer_servicelist");
  }

  public function customerBookingform(){
    $view = new View("Customer/customer_bookingform");
  }

  public function customerHelp() {
    
    $helpRequestModel = new HelpRequestModel();
    $customerModel = new CustomerModel();
    if(!empty($_POST['customer_help'] && $_POST['customer_help'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
		  $subject = $_POST['subject'];
		  $message = $_POST['message'];
      $HelpError = "";

      if(empty($subject) || empty($message))
      {
          $HelpError = "Please fill all the empty fields";
      }

      if($HelpError == ""){
        $requestID = $helpRequestModel->generateCustomerHelpID();
        $userID = $_SESSION['loggedin']['user_id'];
        $customerDetails = $customerModel->getCustomerByUserID($userID);
        $currentDateTime = date('Y-m-d H:i:s');
      
        $customerHelpDetails = [
          'RequestID' => $requestID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $message,
          'CustomerID' => $customerDetails->CustomerID
          
        ];

        $helpRequestModel->addNewCustomerHelp($customerHelpDetails);
        $HelpError = "none";
        
      }

      $data['HelpError'] = $HelpError;
      
    }

    $view = new View("Customer/customer_help",$data);
  }

  
  
 
}