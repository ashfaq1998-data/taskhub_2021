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
require_once ROOT . '/models/UsersModel.php';
require_once ROOT . '/models/ManpowerModel.php';
require_once ROOT . '/models/AuthModel.php';
require_once ROOT . '/models/JobRequestModel.php';
require_once ROOT . '/classes/Validation.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CustomerController {

  public function customerDashboard() {
    $view = new View("Customer/customer_dashboard");
  }

  public function customerPostAd() {
    $advertisementModel = new AdvertisementModel();
    $customerModel = new CustomerModel();

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
        $advertisementID = $advertisementModel->generateCustomerAdvertisementID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $customerDetails = $customerModel->getCustomerByUserID($userID);


        $customerad = [
          'AdvertisementID' => $advertisementID,
          'Date' => $currentDateTime,
          'Title' => $title,
          'Email' => $email,
          'images' => $imgContent,
          'Description' => $description,
          'Address' => $address,
          'District' => $district,
          'CustomerID' => $customerDetails ->CustomerID
        ];

        $advertisementModel-> addNewCustomerAdvertisement($customerad);
        $AdError = "none";

      }

      $data['AdError'] = $AdError;
    }
    $view = new View("Customer/customer_postad",$data);
  }

  public function customerRequest() {
    $customerModel = new CustomerModel();
    $jobRequestModel = new JobRequestModel();

    $data['contractorModel'] = new ContractorModel();
    $data['ManpowerModel'] = new ManpowerModel();
    $data['employeeModel'] = new EmployeeModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $customer_details = $customerModel->getCustomerByUserID($userID);

    $where['cusId'] = $customer_details->CustomerID;
    $where['search'] = $_REQUEST['search'];
    if(empty($_REQUEST['type'])){
      $where['type'] = 3;  //employee
    }else{
      $where['type'] = $_REQUEST['type'];
    }

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;

    $total_pages = $jobRequestModel->getCustomerJobRequests(0, 0, true, $where);
    $data['job_requests'] = $jobRequestModel->getCustomerJobRequests($num_results_on_page, $calc_page, false, $where);

    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['filters'] = [
      'type' => $where['type'], 
      'search' => $where['search'],
    ];

    $view = new View("Customer/customer_requestjob", $data);
  }

  
  public function customerProfile(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);
    $view = new View("Customer/customer_profile",$data);
    
  }

  public function customerEditprofile(){
    $customerModel = new CustomerModel();
    $validation = new Validation();
    $usersModel = new UsersModel();
    $authModel = new AuthModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $email = $_SESSION['loggedin']['email'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);
    
    if(!empty($_POST['customer_edit']) && $_POST['customer_edit'] == 'submitted' ){

      $data['inputted_data'] = $_POST;
      $firstName = $_POST['f_name'];
      $lastName = $_POST['l_name'];
      $nic = $_POST['nic'];
      $phoneNum = $_POST['phone_num'];
      $gender = $_POST['gender'];
      $dob = $_POST['dob'];
      $address = $_POST['address'];
      $district = $_POST['district'];
      $accnum = $_POST['accnum'];
      $expiry = $_POST['exp'];
      $bio = $_POST['bio'];
      $cvn = $_POST['cvn'];

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

        $updateCustomerDetails = [
          'FirstName' => $firstName,
          'LastName' => $lastName,
          'NIC' => $nic,
          'Contact_No' => $phoneNum,
          'Gender' => $gender,
          'Date_of_Birth' => date('Y-m-d', strtotime($dob)),
          'Address' => $address,
          'District' => $district,
          'Card_Number' => $accnum,
          'Expiry_Date' => date('Y-m-d', strtotime($dob)),
          'bio' => $bio,
          'cvn' => $cvn,
        ];

        $response = $customerModel->updateCustomer($data['customer_details']->CustomerID, $updateCustomerDetails);
        if($response){
          if(!empty($imgContent)){
            $customerModel->updateProfileImage($data['customer_details']->CustomerID, $imgContent);
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
            header('location: ' . fullURLfront . '/Customer/customer_profile');
            die(); 
          }
        }else{
          $editError = "update failed, Try again!";
        }
      }
      $data['editError'] = $editError;
    }

    $view = new View("Customer/customer_editprofile",$data);
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

  public function customerService(){
    
    $employeeModel = new EmployeeModel();
    $customerModel = new CustomerModel();
    $contractorModel = new ContractorModel();
    $ManpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['inputted_data'] = $_POST;

    $where['search'] = $_REQUEST['search'];
    $type = $_REQUEST['type'];
    $where['area'] = $_REQUEST['area'];
    $where['role'] = $_REQUEST['role'];

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 3;
    $calc_page = ($page - 1) * $num_results_on_page;

    if(empty($type)){
      $type = 1;
    }

    if($type == 1){

      $total_pages = $employeeModel->getEmployeeProfiles(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['profiles'] = $employeeModel->getEmployeeProfiles($num_results_on_page, $calc_page, false, $where);

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
      'role' => $where['role'],
      'area' => $where['area'],
      'search' => $where['search'] 
    ];
    $data['response'] = '';

    $view = new View("Customer/customer_services", $data);
  }

  public function customerServicelist(){
    $view = new View("Customer/customer_servicelist");
  }

  public function customerBookingform(){
    $employeeModel = new EmployeeModel();
    $contractorModel = new ContractorModel();
    $ManpowerModel = new ManpowerModel();
    $bookingModel = new BookingModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $iid = base64_decode($_REQUEST['iid']);
    $type = $_REQUEST['tp'];

    if($type == 1){
      $data['actordetails'] = $employeeModel->getEmployeeByID($iid);
    }
    else if($type == 2){
      $data['actordetails'] = $ManpowerModel->getManpowerByID($iid);
    }
    else if($type == 3){
      $data['actordetails'] = $contractorModel->getContractorByID($iid);
    }

    $data['bookingFormDetails'] = [
      'customerUserId' => $_SESSION['loggedin']['user_id'],
      'type' => $type,
      'actorId' => $iid
    ];



    $view = new View("Customer/customer_bookingform", $data);
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

  public function customerBooking() {
    $customerModel = new CustomerModel();
    $bookingModel = new BookingModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $customerDetails = $customerModel->getCustomerByUserID($userID);
    $bookingsDetailsEmployee = $bookingModel->getCustomerBookingEmployee($customerDetails->CustomerID);
    $bookingsDetailsContractor = $bookingModel->getCustomerBookingContractor($customerDetails->CustomerID);

    $allEvents = array();
    foreach($bookingsDetailsEmployee as $booking){
      $event = [
        'topic' => 'Employee',
        'title'  => $booking->title,
        'start'  => $booking->EventDate,
        'fullname' => $booking->EmpFullName,
        'address' => $booking->Address,
        'time' => $booking->EventTime,
        'payment' => $booking->payment,
        'description' => $booking->Description
      ];
      array_push($allEvents, $event);
    }

    foreach($bookingsDetailsContractor as $booking){
      $event = [
        'topic' => 'Contractor',
        'title'  => $booking->title,
        'start'  => $booking->EventDate,
        'fullname' => $booking->ConFullName,
        'address' => $booking->Address,
        'time' => $booking->EventTime,
        'payment' => $booking->payment,
        'description' => $booking->Description,

      ];
      array_push($allEvents, $event);
    }
    $data['bookingEvents'] = $allEvents;
  
    $view = new View("Customer/customer_booking", $data);
  }

  public function customerViewad() {
    $customerModel = new CustomerModel();
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

      $total_pages = $advertisementModel->getManPowerAd(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['advertisements'] = $advertisementModel->getManPowerAd($num_results_on_page, $calc_page, false, $where);

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
    
    $view = new View("Customer/customer_viewad",$data);
  }

  public function customerOwnad() {
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $customerDetails = $customerModel->getCustomerByUserID($userID);

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 3;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $customerModel->getCustomerOwnAd($customerDetails->CustomerID, 0, 0, true);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['customer_ownad'] = $customerModel->getCustomerOwnAd($customerDetails->CustomerID, $num_results_on_page, $calc_page, false);

    
    $view = new View("Customer/customer_ownad",$data);
  }

  public function customerHistory() {
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $customerDetails = $customerModel->getCustomerByUserID($userID);

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $employeehistory = $customerModel->getCustomerEmployeeWorkHistory($customerDetails->CustomerID, 0, 0, true);
    $contractorhistory = $customerModel->getCustomerContractorWorkHistory($customerDetails->CustomerID, 0, 0, true);
    $manpowerhistory = $customerModel->getCustomerManpowerWorkHistory($customerDetails->CustomerID, 0, 0, true);
    $total_pages = $employeehistory + $contractorhistory + $manpowerhistory;
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['employee_work_history'] = $customerModel->getCustomerEmployeeWorkHistory($customerDetails->CustomerID, $num_results_on_page, $calc_page, false);
    $data['contractor_work_history'] = $customerModel->getCustomerContractorWorkHistory($customerDetails->CustomerID, $num_results_on_page, $calc_page, false);
    $data['manpower_work_history'] = $customerModel->getCustomerManpowerWorkHistory($customerDetails->CustomerID, $num_results_on_page, $calc_page, false);

    
    
    $view = new View("Customer/customer_history",$data);
  }

  public function showSearchProfile() {

    $employeeModel = new EmployeeModel();
    $contractorModel = new ContractorModel();
    $ManpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $iid = base64_decode($_REQUEST['iid']);
    $type = $_REQUEST['tp'];

    if(empty($type)){
      $type = 1;
    }

    if($type == 1){

      $data['profile_details'] = $employeeModel->getEmployeeByID($iid);
      
    }else if($type == 2){

      $data['profile_details'] = $ManpowerModel->getManpowerByID($iid);

    }else if($type == 3){
      
      $data['profile_details'] = $contractorModel->getContractorByID($iid);
    }

    $data['type'] = $type;

    $view = new View("Customer/customer_view_profile", $data);
  }

  public function customerJobApply(){

    $jobRequestModel = new JobRequestModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $ad = base64_decode($_REQUEST['ad']);
    $type = $_REQUEST['tp'];

    if($type == 1 || empty($type)){

      $requestId = $jobRequestModel->generateManPowerJobRequestID();
      $jobRequestData = [
        'requestID' => $requestId,
        'AdvertisementID' => $ad,
        'RequestedBy' => $userID,
      ];
      $response = $jobRequestModel->addNewManpowerJobRequest($jobRequestData);
      
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

    $view = new View("Customer/customer_viewad", $data);

    
  }

  

  
  
 
}