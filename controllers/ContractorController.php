<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/ContractorModel.php';
require_once ROOT . '/models/BookingModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContractorController {

  public function contractorDashboard() {
    $view = new View("Contractor/contractor_dashboard");
  }

  
  public function contractorSearch(){
    $view = new View("Contractor/contractor_search");
  }

  public function contractorPostad() {
    $view = new View("Contractor/contractor_postad");
  }

  
  public function contractorViewad() {
    $view = new View("Contractor/contractor_viewad");
  }

  
  public function contractorPaymentgateway(){
    $view = new View("Contractor/contractor_paymentgateway");
  }

  public function contractorPaymentform(){
    $view = new View("Contractor/contractor_paymentform");
  }

  public function contractorConfirmpayment(){
    $view = new View("Contractor/contractor_confirmpayment");
  }

  public function contractorhistory(){
    $view = new View("Contractor/contractor_history");
  }

  public function contractorBooking(){
    $view = new View("Contractor/contractor_booking");
  }

  public function contractorComplaint() {
    $complaintModel = new ComplaintModel();
    $contractorModel = new ContractorModel();

    if(!empty($_POST['contractor_complaint'] && $_POST['contractor_complaint'] == 'submitted')){
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
        $complaintID = $complaintModel->generateContractorComplaintID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $contractorDetails = $contractorModel->getContractorByUserID($userID);


        $contractorComplaints = [
          'ComplaintID' => $complaintID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $complaintmessage,
          'Rates' => $rating,
          'Contractor_ID' => $contractorDetails->Contractor_ID
        ];

        $complaintModel-> addNewContractorComplaint($contractorComplaints);
        $ComplaintError = "none";

      }

      $data['ComplaintError'] = $ComplaintError;
    }
    $view = new View("Contractor/contractor_complaint",$data);
  }
  
  public function contractorHelp() {
    
    $helpRequestModel = new HelpRequestModel();
    $contractorModel = new ContractorModel();
    if(!empty($_POST['contractor_help'] && $_POST['contractor_help'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
		  $subject = $_POST['subject'];
		  $message = $_POST['message'];
      $HelpError = "";

      if(empty($subject) || empty($message))
      {
          $HelpError = "Please fill all the empty fields";
      }

      if($HelpError == ""){
        $requestID = $helpRequestModel->generateContractorHelpID();
        $userID = $_SESSION['loggedin']['user_id'];
        $conDetails = $contractorModel->getContractorByUserID($userID);
        $currentDateTime = date('Y-m-d H:i:s');
      
        $contractorHelpDetails = [
          'RequestID' => $requestID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $message,
          'EmployeeID' => $conDetails->EmployeeID
          
        ];

        $helpRequestModel->addNewContractorHelp($contractorHelpDetails);
        $HelpError = "none";
        
      }

      $data['HelpError'] = $HelpError;
      
    }

    $view = new View("Contractor/contractor_help",$data);
  }

  public function contractorProfile(){
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['contractor_details'] = $contractorModel->getContractorByUserID($userID);
    $view = new View("Contractor/contractor_profile",$data);
    
  }

  
 
}