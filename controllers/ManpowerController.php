<?php
// session_start();
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
  
  public function ManpowerViewad(){
    $view = new View("Manpower/manpower_viewad");
  }

  public function ManpowerSearch(){
    $view = new View("Manpower/manpower_search");
  }

  public function ManpowerWorker(){
    $view = new View("Manpower/manpower_worker");
  }

  public function ManpowerAddWorker(){
    $view = new View("Manpower/manpower_addworker");
  }

  public function ManpowerBooking(){
    $view = new View("Manpower/manpower_booking");
  }

  public function ManpowerHelp(){
    $view = new View("Manpower/manpower_help");
  }

  public function ManpowerComplaint(){
    $view = new View("Manpower/manpower_complaint");
  }

  public function ManpowerWorkerProfile(){
    $view = new View("Manpower/manpower_workerprofile");
  }

  public function ManpowerHistory(){
    $view = new View("Manpower/manpower_history");
  }

}