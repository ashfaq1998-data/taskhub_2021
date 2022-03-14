<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/CustomerModel.php';
require_once ROOT . '/models/ContractorModel.php';
require_once ROOT . '/models/ManpowerModel.php';
require_once ROOT . '/models/BookingModel.php';
require_once ROOT . '/models/AdvertisementModel.php';
require_once ROOT . '/models/EmployeeModel.php';
require_once ROOT . '/models/UsersModel.php';
require_once ROOT . '/models/AuthModel.php';
require_once ROOT . '/models/JobRequestModel.php';
require_once ROOT . '/classes/Validation.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContractorController {

  public function contractorDashboard() {
    $view = new View("Contractor/contractor_dashboard");
  }

  public function contractorRequest() {
    $contractorModel = new ContractorModel();
    $jobRequestModel = new JobRequestModel();

    $data['manpowerModel'] = new ManpowerModel();
    $data['customerModel'] = new CustomerModel();
    $data['employeeModel'] = new EmployeeModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $contractor_details = $contractorModel->getContractorByUserID($userID);

    $where['conId'] = $contractor_details->Contractor_ID;
    $where['search'] = $_REQUEST['search'];
    if(empty($_REQUEST['type'])){
      $where['type'] = 2;  //customer
    }else{
      $where['type'] = $_REQUEST['type'];
    }

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;

    $total_pages = $jobRequestModel->getContractorJobRequests(0, 0, true, $where);
    $data['job_requests'] = $jobRequestModel->getContractorJobRequests($num_results_on_page, $calc_page, false, $where);

    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['filters'] = [
      'type' => $where['type'], 
      'search' => $where['search'],
    ];

    $view = new View("Contractor/contractor_requestjob", $data);
  }

  

  public function contractorPostad(){
    $contractorModel = new ContractorModel();
    $validation = new Validation();
    $advertisementModel = new AdvertisementModel();
    $usersModel = new UsersModel();
    $authModel = new AuthModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $typeid = $_SESSION['loggedin']['typeid'];
    $email = $_SESSION['loggedin']['email'];
    $data['contractor_details'] = $contractorModel->getContractorByUserID($userID);

    if(!empty($_POST['postad-confirm']) && $_POST['postad-confirm'] == 'submitted' ){
      $data['inputted_data'] = $_POST;
      $title = $_POST['title'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $district = $_POST['district'];
      $description = $_POST['description'];

      $editError = "";

      if(empty($title) || empty($email) || empty($address) || empty($district) || empty($description))
      {
          $editError = "Please fill all the empty fields";
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

      if($editError == ""){
        $advertisementID = $advertisementModel->generateContractorAdvertisementID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $contractorDetails = $contractorModel->getContractorByUserID($userID);


        $contractorAdvertisement = [
          'AdvertisementID' => $advertisementID,
          'Date' => $currentDateTime,
          'Title' => $title,
          'Description' => $description,
          'Email' => $email,
          'images' => $imgContent,
          'Address' => $address,
          'District' => $district,
          'Contractor_ID' => $contractorDetails->Contractor_ID
        ];

        $advertisementModel-> addNewContractorAdvertisement($contractorAdvertisement);
        $editError = "none";
        
      }

      $data['editError'] = $editError;
  
      
      

    }


    $view = new View("Contractor/contractor_postad", $data);
  }


  public function contractorSearch(){
    
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
      
      $total_pages = $ManpowerModel->getManpowerProfiles(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['profiles'] = $ManpowerModel->getManpowerProfiles($num_results_on_page, $calc_page, false, $where);

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search'] 
    ];

    $view = new View("Contractor/contractor_search", $data);
  }

  public function contractorEditprofile(){
    $contractorModel = new ContractorModel();
    $validation = new Validation();
    $usersModel = new UsersModel();
    $authModel = new AuthModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $email = $_SESSION['loggedin']['email'];
    $data['contractor_details'] = $contractorModel->getContractorByUserID($userID);
    $data['specialization_list'] = ['Specialized For', 'Plumbing', 'Carpentry', 'Electrical', 'Mason', 'Painting', 'Gardening'];

    if(!empty($_POST['contractor_edit']) && $_POST['contractor_edit'] == 'submitted' ){

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
      $ratehrs = $_POST['payment'];
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

        $updateContractorDetails = [
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

        $response = $contractorModel->updateContractor($data['contractor_details']->Contractor_ID, $updateContractorDetails);
        if($response){
          if(!empty($imgContent)){
            $contractorModel->updateProfileImage($data['contractor_details']->Contractor_ID, $imgContent);
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
            header('location: ' . fullURLfront . '/Contractor/contractor_profile');
            die(); 
          }
        }else{
          $editError = "update failed, Try again!";
        }
      }
      $data['editError'] = $editError;
    }

    $view = new View("Contractor/contractor_editprofile",$data);
  }

  public function contractorMyadedit() {
    $view = new View("Contractor/contractor_myadedit");
  }

  public function contractorConfirmpayment() {
    $view = new View("Contractor/contractor_confirmpayment");
  }

  public function contractorPaymentform() {
    $view = new View("Contractor/contractor_paymentform");
  }

  public function contractorPayment() {
    $view = new View("Contractor/contractor_payment");
  }

  public function contractorPaymentdone() {
    $view = new View("Contractor/contractor_paymentdone");
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
        $requestID = $helpRequestModel->generateCustomerHelpID();
        $userID = $_SESSION['loggedin']['user_id'];
        $contractorDetails = $contractorModel->getContractorByUserID($userID);
        $currentDateTime = date('Y-m-d H:i:s');
      
        $contractorHelpDetails = [
          'RequestID' => $requestID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $message,
          'Contractor_ID' => $contractorDetails->Contractor_ID
          
        ];

        $helpRequestModel->addNewContractorHelp($contractorHelpDetails);
        $HelpError = "none";
        
      }

      $data['HelpError'] = $HelpError;
      
    }

    $view = new View("Contractor/contractor_help",$data);
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
  


  public function contractorProfile(){
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['contractor_details'] = $contractorModel->getContractorByUserID($userID);
    $view = new View("Contractor/contractor_profile",$data);
    
  }

  public function contractorBooking() {
    $contractorModel = new ContractorModel();
    $bookingModel = new BookingModel();

    $userID = $_SESSION['loggedin']['user_id'];
    $contractorDetails = $contractorModel->getContractorByUserID($userID);
    $bookingsDetails = $bookingModel->getContractorBookings($contractorDetails->Contractor_ID);

    $allEvents = array();
    foreach($bookingsDetails as $booking){
      $event = [
        'title'  => $booking->title,
        'start'  => $booking->EventDate,
        'customerName' => $booking->CusFullName,
        'address' => $booking->Address,
        'time' => $booking->EventTime,
        'payment' => $booking->payment,
        
      ];
      array_push($allEvents, $event);
    }
    $data['bookingEvents'] = $allEvents;
  
    $view = new View("Contractor/contractor_booking", $data);
  }

  public function contractorHistory() {
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $contractorDetails = $contractorModel->getContractorByUserID($userID);

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $contractorModel->getContractorWorkHistory($contractorDetails->Contractor_ID, 0, 0, true);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['work_history'] = $contractorModel->getContractorWorkHistory($contractorDetails->Contractor_ID, $num_results_on_page, $calc_page, false);

    
    $view = new View("Contractor/contractor_history",$data);
  }

  public function contractorViewad() {
    $contractorModel = new ContractorModel();
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

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search'], 
      'area' => $where['area']
    ];
    
    $view = new View("Contractor/contractor_viewad",$data);
  }

  public function contractorOwnad() {
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $contractorDetails = $contractorModel->getContractorByUserID($userID);

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 3;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $contractorModel->getContractorOwnAd($contractorDetails->Contractor_ID, 0, 0, true);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['contractor_ownad'] = $contractorModel->getContractorOwnAd($contractorDetails->Contractor_ID, $num_results_on_page, $calc_page, false);

    
    $view = new View("Contractor/contractor_ownad",$data);
  }

  public function showSearchProfile() {

    $customerModel = new CustomerModel();
    $employeeModel = new EmployeeModel();
    $ManpowerModel = new ManpowerModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $iid = base64_decode($_REQUEST['iid']);
    $type = $_REQUEST['tp'];

    if($type == 1 || empty($type)){

      $data['profile_details'] = $customerModel->getCustomerByID($iid);
      
    }else if($type == 2){

      $data['profile_details'] = $employeeModel->getEmployeeByID($iid);

    }else if($type == 3){
      
      $data['profile_details'] = $ManpowerModel->getManpowerByID($iid);
    }

    $view = new View("Contractor/contractor_view_profile", $data);
  }

  public function contractorJobApply(){

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

      $requestId = $jobRequestModel->generateManpowerJobRequestID();
      $jobRequestData = [
        'requestID' => $requestId,
        'AdvertisementID' => $ad,
        'RequestedBy' => $userID,
      ];
      $response = $jobRequestModel->addNewManpowerJobRequest($jobRequestData);

    }

    if($response){
      $data['response'] = 'Your job request submitted successfully';
    }

    $view = new View("Contractor/contractor_viewad", $data);

    
  }


  
 
}