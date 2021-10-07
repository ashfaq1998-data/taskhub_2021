<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/ContractorModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContractorController {

  public function contractorDashboard() {
    $view = new View("Contractor/contractor_dashboard");
  }



  public function contractorProfile(){
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['contractor_details'] = $contractorModel->getContractorByUserID($userID);
    $view = new View("Contractor/contractor_profile",$data);
    
  }
 



  public function contractorPostad(){
    $view = new View("contractor/contractor_postad");
  }

  public function contractorPaymentgateway(){
    $view = new View("contractor/contractor_paymentgateway");
  }

  public function contractorPaymentform(){
    $view = new View("contractor/contractor_paymentform");
  }

  public function contractorConfirmpayment(){
    $view = new View("contractor/contractor_confirmpayment");
  }
}