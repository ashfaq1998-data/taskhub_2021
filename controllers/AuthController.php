<?php
// session_start();
require_once ROOT  . '/View.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AuthController {

  public function login() {  
    if(!empty($_POST['login'] && $_POST['login'] == 'submitted') ){

      $username = $_POST['username'];
      $password = $_POST['password'];
	    $loginError = "";

      //validate input fields
      if(empty($username)){
        $loginError = "Please enter a username.";
      }else if(empty($password)){
        $loginError = "Please enter a password.";
      }

      //checking inputs
      if($loginError == ""){
        if($username == "udesh" && $password == "udesh123"){
          $_SESSION['loggedin'] = ['user_type' => 'Customer','username' => $username];
          $loginError = "none";
          header('location: ' . fullURLfront . '/Customer/customer_dashboard');
        }else{
          $loginError = "Incorrect username or password";
        }
      }
      $data['loginError'] = $loginError;
    }
    $view = new View("auth/login", $data);
  }
  


  public function employeeRegister(){
    $view = new View("auth/employee_register");
  }

  public function customerRegister(){
    $view = new View("auth/customer_register");    //new
  }

  public function forgotPassword(){
    $view = new View("auth/forgot_password");
  }
  
}