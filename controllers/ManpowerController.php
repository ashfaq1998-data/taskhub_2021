<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/ManpowerModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ManpowerController {

  public function manpowerDashboard() {
    $view = new View("Manpower/manpower_dashboard");
  }

  public function ManpowerProfile(){
    $view = new View("Manpower/manpower_profile");
    
  }
  
}