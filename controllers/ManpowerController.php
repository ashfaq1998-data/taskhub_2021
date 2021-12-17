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
    $manpowerModel = new ManpowerModel();

    $userID = $_SESSION['loggedin']['user_id'];

    $manpowerDetails = $manpowerModel->getManpowerByUserID($userID);
    $data['manpower_details'] = $manpowerDetails;

    $view = new View("Manpower/manpower_profile",$data);
    
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

    // $validation = new Validation();
    // $authModel = new AuthModel();
    // $manpowerModel = new ManpowerModel();
    // $usersModel = new UsersModel();


    // if (!empty($_POST['manpower_register'] && $_POST['manpower_register'] == 'submitted')) {
    //   $data['inputted_data'] = $_POST;
    //   $companyName = $_POST['company_name'];
    //   $companyRegister = $_POST['company_register'];
    //   $district = $_POST['district'];
    //   $phoneNum = $_POST['phone_num'];
    //   $address = $_POST['address'];
    //   $email = $_POST['email'];
    //   $password = $_POST['password'];
    //   $confirmPassword = $_POST['confirm_password'];
    //   $registerError = "";

    //   //validate input fields
    //   if (
    //     empty($companyName) || empty($companyRegister) || empty($district) || empty($phoneNum)  || empty($address)
    //     || empty($email) || empty($password) || empty($confirmPassword)
    //   ) {
    //     $registerError = "Please fill all the empty fields";
    //   }

    //   //validate phone number
    //   if ($registerError == "") {
    //     $registerError = $validation->validatePhoneNumber($phoneNum);
    //   }



    //   //validate email
    //   if ($registerError == "") {
    //     if (!$validation->validateEmail($email)) {
    //       $registerError = "Please enter a valid email format";
    //     } else {
    //       //Check if email exists.
    //       if ($usersModel->checkUserEmail($email)) {
    //         $registerError = 'This Email is already taken.';
    //       }
    //     }
    //   }

    //   //validate password
    //   if ($registerError == "") {
    //     $registerError = $validation->validatePassword($password);
    //   }

    //   //validate password
    //   if ($registerError == "") {
    //     $registerError = $validation->validateConfirmPassword($password, $confirmPassword);
    //   }








    //   //registration after validation
    //   if ($registerError == "") {
    //     $userId = $usersModel->generateUserID();
    //     $manpowerId = $manpowerModel->generateManpowerID();
    //     // Hashing the password to store password in db
    //     $password = password_hash($password, PASSWORD_DEFAULT);

    //     $userDetails = [
    //       'id' => $userId,
    //       'email' => $email,
    //       'password' => $password,
    //       'user_type_id' => 4,
    //     ];

    //     $manpowerDetails = [
    //       'Manpower_Agency_ID' => $manpowerId,
    //       'Company_Name' => $companyName,
    //       'Company_Registration_No' => $companyRegister,
    //       'District' => $district,
    //       'Contact_No' => $phoneNum,
    //       'Address' => $address,
    //       'user_id' => $userId
    //     ];

    //     if ($authModel->register($userDetails)) {
    //       //add new employee
    //       $manpowerModel->addNewManpower($manpowerDetails);
    //       header('location: ' . fullURLfront . '/auth/login');
    //     } else {
    //       die('Something went wrong.');
    //     }
    //   }
    //   $data['registerError'] = $registerError;
    // }
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