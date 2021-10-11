<?php

require_once ROOT  . '/View.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MainController {
  public function index() {
    $view = new View("main/index");
  }
}
