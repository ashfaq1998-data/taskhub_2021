<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/EmployeeModel.php';
require_once ROOT . '/models/BookingModel.php';
require_once ROOT . '/models/AdvertisementModel.php';
require_once ROOT . '/models/CustomerModel.php';
require_once ROOT . '/models/ContractorModel.php';
require_once ROOT . '/models/ManpowerModel.php';
require_once ROOT . '/models/UsersModel.php';
require_once ROOT . '/models/AuthModel.php';
require_once ROOT . '/models/JobRequestModel.php';
require_once ROOT . '/classes/Validation.php';

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


    $total_pages = $employeeModel->getEmployeeWorkHistory($employeeDetails->EmployeeID, 0, 0, true);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['work_history'] = $employeeModel->getEmployeeWorkHistory($employeeDetails->EmployeeID, $num_results_on_page, $calc_page, false);

    
    $view = new View("Employee/employee_history",$data);
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
        'payment' => $booking->payment,
        'description' => $booking->Description
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
    
    $employeeModel = new EmployeeModel();
    $customerModel = new CustomerModel();
    $contractorModel = new ContractorModel();
    $ManpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['inputted_data'] = $_POST;

    $where['search'] = $_REQUEST['search'];
    $type = $_REQUEST['type'];

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 3;
    $calc_page = ($page - 1) * $num_results_on_page;

    if($type == 1 || empty($type)){

      $total_pages = $customerModel->getCustomerProfiles(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['profiles'] = $customerModel->getCustomerProfiles($num_results_on_page, $calc_page, false, $where);

    }else if($type == 2){

      $total_pages = $ManpowerModel->getManPowerProfiles(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['profiles'] = $ManpowerModel->getManPowerProfiles($num_results_on_page, $calc_page, false, $where);

    }else if($type == 3){
      
      $total_pages = $contractorModel->getContractorProfiles(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['profiles'] = $contractorModel->getContractorProfiles($num_results_on_page, $calc_page, false, $where);

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search'] 
    ];

    $view = new View("Employee/employee_search", $data);
  }

  public function employeeEditprofile(){
    $employeeModel = new EmployeeModel();
    $validation = new Validation();
    $usersModel = new UsersModel();
    $authModel = new AuthModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $email = $_SESSION['loggedin']['email'];
    $data['employee_details'] = $employeeModel->getEmployeeByUserID($userID);
    $data['specialization_list'] = ['Specialized For', 'Plumbing', 'Carpentry', 'Electrical', 'Mason', 'Painting', 'Gardening'];

    if(!empty($_POST['employee_edit']) && $_POST['employee_edit'] == 'submitted' ){

      $data['inputted_data'] = $_POST;
      $firstName = $_POST['f_name'];
      $lastName = $_POST['l_name'];
      $nic = $_POST['nic'];
      $phoneNum = $_POST['phone_num'];
      $specialization = $_POST['specialization'];
      $gender = $_POST['gender'];
      $dob = $_POST['dob'];
      $address = $_POST['address'];
      $district = $_POST['district'];
      $ratehrs = $_POST['ratehrs'];
      $experience = $_POST['experience'];
      $bank = $_POST['bank'];
      $accnum = $_POST['accnum'];
      $bio = $_POST['bio'];

      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];
      $editError = "";
  
      //validate phone number
      if($editError == ""){
        $editError = $validation->validatePhoneNumber($phoneNum);
      }
  
      //validate firstname
      if($editError == ""){
        $editError = $validation->validateName($firstName);
      }
  
      if($editError == ""){
        $editError = $validation->validateName($lastName);
      }

      if(!empty($password)){
        //validate password
        if($editError == ""){
          $editError = $validation->validatePassword($password);
        }
        //validate confirm password
        if($editError == ""){
          $editError = $validation->validateConfirmPassword($password, $confirmPassword);
        }
      }

      //image upload processing 
      if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        //Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image));
            //$imgContent = base64_encode(file_get_contents(addslashes($image)));
        }
      }
  
  
      //update after validation
      if($editError == ""){

        $updateEmployeeDetails = [
          'FirstName' => $firstName,
          'LastName' => $lastName,
          'NIC' => $nic,
          'Contact_No' => $phoneNum,
          'Specialized_area' => $specialization,
          'Gender' => $gender,
          'Date_of_Birth' => date('Y-m-d', strtotime($dob)),
          'Address' => $address,
          'District' => $district,
          'Payment_for_2hours' => $ratehrs,
          'Year_of_experience' => $experience,
          'Name_of_Bank' => $bank,
          'Account_Number' => $accnum,
          'bio' => $bio,
        ];

        $response = $employeeModel->updateEmployee($data['employee_details']->EmployeeID, $updateEmployeeDetails);
        if($response){
          if(!empty($imgContent)){
            $employeeModel->updateProfileImage($data['employee_details']->EmployeeID, $imgContent);
          }

          if(!empty($password)){
            // Hashing the password to store password in db
            $password = password_hash($password, PASSWORD_DEFAULT);
            if($authModel->resetPassword($password, $email)){
              unset($_SESSION['loggedin']);
              header('Location: ' . fullURLfront . '/main/index');
              die();
            }else {
              $editError = "update failed, Try again!";
            }
          }else{
            header('location: ' . fullURLfront . '/Employee/employee_profile');
            die(); 
          }
        }else{
          $editError = "update failed, Try again!";
        }
      }
      $data['editError'] = $editError;
    }

    $view = new View("Employee/employee_editprofile",$data);
  }

  public function employeeViewad() {
    $employeeModel = new EmployeeModel();
    $advertisementModel = new AdvertisementModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $where['search'] = $_REQUEST['search'];
		$where['area'] = $_REQUEST['area'];
    $type = $_REQUEST['type'];
    
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 3;
    $calc_page = ($page - 1) * $num_results_on_page;

    if($type == 1 || empty($type)){

      $total_pages = $advertisementModel->getCustomerAd(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['advertisements'] = $advertisementModel->getCustomerAd($num_results_on_page, $calc_page, false, $where);

    }else if($type == 2){

      $total_pages = $advertisementModel->getManPowerAd(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['advertisements'] = $advertisementModel->getManPowerAd($num_results_on_page, $calc_page, false, $where);

    }else if($type == 3){
      
      $total_pages = $advertisementModel->getContractorAd(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['advertisements'] = $advertisementModel->getContractorAd($num_results_on_page, $calc_page, false, $where);

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search'], 
      'area' => $where['area']
    ];
    
    $view = new View("Employee/employee_viewad",$data);
  }

  public function showSearchProfile() {

    $customerModel = new CustomerModel();
    $contractorModel = new ContractorModel();
    $ManpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $iid = base64_decode($_REQUEST['iid']);
    $type = $_REQUEST['tp'];

    if($type == 1 || empty($type)){

      $data['profile_details'] = $customerModel->getCustomerByID($iid);
      
    }else if($type == 2){

      $data['profile_details'] = $ManpowerModel->getManpowerByID($iid);

    }else if($type == 3){
      
      $data['profile_details'] = $contractorModel->getContractorByID($iid);
    }

    $view = new View("Employee/employee_view_profile", $data);
  } 

  public function employeeJobApply(){

    $jobRequestModel = new JobRequestModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $ad = base64_decode($_REQUEST['ad']);
    $type = $_REQUEST['tp'];

    if($type == 1 || empty($type)){

      $requestId = $jobRequestModel->generateCustomerJobRequestID();
      $jobRequestData = [
        'requestID' => $requestId,
        'AdvertisementID' => $ad,
        'RequestedBy' => $userID,
      ];
      $response = $jobRequestModel->addNewCustomerJobRequest($jobRequestData);
      
    }else if($type == 2){

      $requestId = $jobRequestModel->generateManPowerJobRequestID();
      $jobRequestData = [
        'requestID' => $requestId,
        'AdvertisementID' => $ad,
        'RequestedBy' => $userID,
      ];
      $response = $jobRequestModel->addNewManpowerJobRequest($jobRequestData);

    }else if($type == 3){
      
      $requestId = $jobRequestModel->generateContractorJobRequestID();
      $jobRequestData = [
        'requestID' => $requestId,
        'AdvertisementID' => $ad,
        'RequestedBy' => $userID,
      ];
      $response = $jobRequestModel->addNewContractorJobRequest($jobRequestData);
    }

    if($response){
      $data['response'] = 'Your job request submitted successfully';
    }

    $view = new View("Employee/employee_viewad", $data);

    
  }

  
 
}