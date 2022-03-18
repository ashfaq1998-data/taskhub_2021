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

class ManpowerController {

  public function manpowerDashboard() {
    $view = new View("Manpower/manpower_dashboard");
  }

  public function manpowerPostAd() {
    $advertisementModel = new AdvertisementModel();
    $manpowerModel = new ManpowerModel();

    if(!empty($_POST['postad-confirm'] && $_POST['postad-confirm'] == 'submitted')){
      $data['inputted_data'] = $_POST;
		  $title = $_POST['title'];
		  $email = $_POST['email'];
      $address = $_POST['address'];
      $district = $_POST['district'];
      $description = $_POST['description'];
      $AdError = "";

      if(empty($title) || empty($email) || empty($address) || empty($district) || empty($district) || empty($description))
      {
          $AdError = "Please fill all the empty fields";
      }

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

      if($AdError == ""){
        $advertisementID = $advertisementModel->generateManPowerAdvertisementID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $manpowerDetails = $manpowerModel->getManpowerByUserID($userID);


        $manpowerad = [
          'AdvertisementID' => $advertisementID,
          'Date' => $currentDateTime,
          'Title' => $title,
          'Email' => $email,
          'images' => $imgContent,
          'Description' => $description,
          'Address' => $address,
          'District' => $district,
          'Manpower_Agency_ID' => $manpowerDetails ->Manpower_Agency_ID
        ];

        $advertisementModel-> addNewManpowerAdvertisement($manpowerad);
        $AdError = "none";

      }

      $data['AdError'] = $AdError;
    }
    $view = new View("Manpower/manpower_postad",$data);
  }

  public function manpowerProfile(){
    $manpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['manpower_details'] = $manpowerModel->getManpowerByUserID($userID);
    $view = new View("Manpower/manpower_profile",$data);
    
  }

  public function manpowerEditprofile(){
    $manpowerModel = new ManpowerModel();
    $validation = new Validation();
    $usersModel = new UsersModel();
    $authModel = new AuthModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $email = $_SESSION['loggedin']['email'];
    $data['manpower_details'] = $manpowerModel->getManpowerByUserID($userID);
   

    if(!empty($_POST['manpower_edit']) && $_POST['manpower_edit'] == 'submitted' ){

      $data['inputted_data'] = $_POST;
      $companyName = $_POST['company_name'];
      $regno = $_POST['regno'];
      $phoneNum = $_POST['phone_num'];
      $address = $_POST['address'];
      $district = $_POST['district'];
      $ratehrs = $_POST['payment'];
      $experience = $_POST['experience'];
      $bank = $_POST['bank'];
      $accnum = $_POST['accnum'];
      $bio = $_POST['bio'];
      $workers = $_POST['workers'];
      $owner = $_POST['owner'];

      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];
      $editError = "";
  
      //validate phone number
     

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

        $updateManpowerDetails = [
          'CompanyName' => $companyName,
          'Company_Registration_No' => $regno,
          'Contact_No' => $phoneNum,
          'Address' => $address,
          'District' => $district,
          'Payment_for_2hours' => $ratehrs,
          'Year_of_experience' => $experience,
          'Name_of_Bank' => $bank,
          'Account_Number' => $accnum,
          'Owner' => $owner,
          'workers' => $workers,
          'bio' => $bio,
        ];

        $response = $manpowerModel->updateManpower($data['manpower_details']->Manpower_Agency_ID,  $updateManpowerDetails);
        if($response){
          if(!empty($imgContent)){
            $manpowerModel->updateProfileImage($data['manpower_details']->Manpower_Agency_ID, $imgContent);
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
            header('location: ' . fullURLfront . '/Manpower/manpower_profile');
            die(); 
          }
        }else{
          $editError = "update failed, Try again!";
        }
      }
      $data['editError'] = $editError;
    }

    $view = new View("Manpower/manpower_editprofile",$data);
  }

  public function manpowerHelp() {
    
    $helpRequestModel = new HelpRequestModel();
    $manpowerModel = new ManpowerModel();
    if(!empty($_POST['manpower_help'] && $_POST['manpower_help'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
		  $subject = $_POST['subject'];
		  $message = $_POST['message'];
      $HelpError = "";

      if(empty($subject) || empty($message))
      {
          $HelpError = "Please fill all the empty fields";
      }

      if($HelpError == ""){
        $requestID = $helpRequestModel->generateManpowerHelpID();
        $userID = $_SESSION['loggedin']['user_id'];
        $manDetails = $manpowerModel->getManpowerByUserID($userID);
        $currentDateTime = date('Y-m-d H:i:s');
      
        $manpowerHelpDetails = [
          'RequestID' => $requestID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $message,
          'Manpower_Agency_ID' => $manDetails->Manpower_Agency_ID
          
        ];

        $helpRequestModel->addNewManpowerHelp($manpowerHelpDetails);
        $HelpError = "none";
        
      }

      $data['HelpError'] = $HelpError;
      
    }

    $view = new View("Manpower/manpower_help",$data);
  }


  public function manpowerComplaint() {
    $complaintModel = new ComplaintModel();
    $manpowerModel = new ManpowerModel();

    if(!empty($_POST['manpower_complaint'] && $_POST['manpower_complaint'] == 'submitted')){
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
        $complaintID = $complaintModel->generateManpowerComplaintID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $manpowerDetails = $manpowerModel->getManpowerByUserID($userID);


        $manpowerComplaints = [
          'ComplaintID' => $complaintID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $complaintmessage,
          'Rates' => $rating,
          'Manpower_Agency_ID' => $manpowerDetails->Manpower_Agency_ID
        ];

        $complaintModel-> addNewManpowerComplaint($manpowerComplaints);
        $ComplaintError = "none";

      }

      $data['ComplaintError'] = $ComplaintError;
    }
    $view = new View("Manpower/manpower_complaint",$data);
  }

  public function manpowerBooking() {
    $manpowerModel = new ManpowerModel();
    $bookingModel = new BookingModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $manpowerDetails = $manpowerModel->getManpowerByUserID($userID);
    $bookingsDetails = $bookingModel->getManpowerBookings($manpowerDetails->Manpower_Agency_ID);

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
  
    $view = new View("Manpower/manpower_booking", $data);
  }
  

  public function manpowerViewad() {
    $manpowerModel = new ManpowerModel();
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
    
    $view = new View("Manpower/manpower_viewad",$data);
  }

  public function manpowerOwnad() {
    $manpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $manpowerDetails = $manpowerModel->getManpowerByUserID($userID);

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 3;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $manpowerModel->getManpowerOwnAd($manpowerDetails->Manpower_Agency_ID, 0, 0, true);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['manpower_ownad'] = $manpowerModel->getManpowerOwnAd($manpowerDetails->Manpower_Agency_ID, $num_results_on_page, $calc_page, false);

    
    $view = new View("Manpower/manpower_ownad",$data);
  }

  public function manpowerHistory() {
    $manpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $manpowerDetails = $manpowerModel->getManpowerByUserID($userID);

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $manpowerModel->getManpowerWorkHistory($manpowerDetails->Manpower_Agency_ID, 0, 0, true);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['work_history'] = $manpowerModel->getManpowerWorkHistory($manpowerDetails->Manpower_Agency_ID, $num_results_on_page, $calc_page, false);

    
    $view = new View("Manpower/manpower_history",$data);
  }

  public function manpowerSearch(){
    
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

      $total_pages = $employeeModel->getEmployeeProfiles(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['profiles'] = $employeeModel->getEmployeeProfiles($num_results_on_page, $calc_page, false, $where);

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

    $view = new View("Manpower/manpower_search", $data);
  }


  public function showSearchProfile() {

    $customerModel = new CustomerModel();
    $employeeModel = new EmployeeModel();
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $iid = base64_decode($_REQUEST['iid']);
    $type = $_REQUEST['tp'];

    if($type == 1 || empty($type)){

      $data['profile_details'] = $customerModel->getCustomerByID($iid);
      
    }else if($type == 2){

      $data['profile_details'] = $employeeModel->getEmployeeByID($iid);

    }else if($type == 3){
      
      $data['profile_details'] = $contractorModel->getContractorByID($iid);
    }

    $view = new View("Manpower/manpower_view_profile", $data);
  }

  public function manpowerRequest() {
    $manpowerModel = new ManpowerModel();
    $jobRequestModel = new JobRequestModel();

    $data['contractorModel'] = new ContractorModel();
    $data['customerModel'] = new CustomerModel();
    $data['employeeModel'] = new EmployeeModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $manpower_details = $manpowerModel->getManpowerByUserID($userID);

    $where['manId'] = $manpower_details->Manpower_Agency_ID;
    $where['search'] = $_REQUEST['search'];
    if(empty($_REQUEST['type'])){
      $where['type'] = 2;  //customer
    }else{
      $where['type'] = $_REQUEST['type'];
    }

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 5;
    $calc_page = ($page - 1) * $num_results_on_page;

    $total_pages = $jobRequestModel->getManpowerJobRequests(0, 0, true, $where);
    $data['job_requests'] = $jobRequestModel->getManpowerJobRequests($num_results_on_page, $calc_page, false, $where);

    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['filters'] = [
      'type' => $where['type'], 
      'search' => $where['search'],
    ];

    $view = new View("Manpower/manpower_requestjob", $data);
  }

  public function manpowerJobApply(){

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

    $view = new View("Manpower/manpower_viewad", $data);

    
  }


  public function manpowerManageWorkers() {
    $manpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $where['search'] = $_REQUEST['search'];
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $manpowerModel->getEmployeeDetails(0, 0, true, $where);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['employees'] = $manpowerModel->getEmployeeDetails($num_results_on_page, $calc_page, false, $where);

    $data['filters'] = [ 
      'search' => $where['search']
    ];

    
    $view = new View("Manpower/manpower_manageworkers",$data);
  }
 
}