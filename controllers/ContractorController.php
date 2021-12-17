<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/ContractorModel.php';
require_once ROOT . '/models/BookingModel.php';
require_once ROOT . '/models/PaymentModel.php';
require_once ROOT . '/models/PostadModel.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContractorController {

  public function contractorDashboard() {
    $view = new View("Contractor/contractor_dashboard");
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
        'title'  => $booking->title,
      ];
      
      array_push($allEvents, $event);
    
    }
    
    $data['bookingEvents'] = $allEvents;
    $view = new View("Contractor/contractor_booking",$data);
  }

  public function contractorHistory() {
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];
  
    
    $contractorDetails = $contractorModel->getContractorByUserID($userID);
    // print($contractorDetails->Contractor_ID);
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    
    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;
    
    $data['work_history'] = $contractorModel->getContractorWorkHistory($contractorDetails->Contractor_ID, $num_results_on_page, $calc_page, false);
    
    $total_pages = $contractorModel->getContractorWorkHistory($contractorDetails->Contractor_ID, 0, 0, true);
    
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];
  
    $view = new View("Contractor/contractor_history", $data);
    
  }

  public function contractorSearch(){
    // $contractorModel = new ContractorModel();
    // $userID = $_SESSION['loggedin']['user_id'];
    // $contractorDetails=$contractorModel->getContractorByUserID($userID);
    // $resultdetails=$this->$contractorModel->availableListTable();
    // $allEvents = array();
    // foreach($resultdetails as $result){
    //   $event = [
    //     'ename'  => $result->e_name,
    //     'email'  => $result->email,
    //     'District' => $result->district,
    //     'type' => $result->type
        
    //   ];
    // } 
    // array_push($allEvents, $event);
    // $data['searchworkers']=$allEvents;
    //$this->view->render("Contractor/contractor_search",$data);
    $view = new View("Contractor/contractor_search");
  }

  public function contractorPostad() {
    $contractorModel=new ContractorModel();
    $postadModel=new PostadModel(); 
    $userID = $_SESSION['loggedin']['user_id'];
  
    if(!empty($_POST['contractor_postad'] && $_POST['contractor_postad'] == 'submitted') ){
    
      $data['inputted_data'] = $_POST;
      $title= $_POST['title'];
      $name = $_POST['name'];
      $email = $_POST['Email'];
      $address = $_POST['address'];
      $zipcode = $_POST['zipcode'];
      $image = $_POST['image'];
      $district = $_POST['district'];
      $description = $_POST['description'];
      $postadError="";
      
      if($postadError==""){
    
        $postadID=$postadModel->generateContractorPostadID();
    
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        
        $contractorDetails = $contractorModel->getContractorByUserID($userID);
      
        $contractorPostad = [
          'postadID'=> $postadID,
          'Date' => $currentDateTime,
          'title' => $title,
          'name' => $name,
          'email'=> $email,
          'address'=> $address,
          'zipcode'=>$zipcode,
          'image'=>$image,
          'district'=>$district,
          'description'=>$description,
          'Contractor_ID'=>$contractorDetails->Contractor_ID
        ];
      
        $postadModel->addNewContractorPostAd($contractorPostad);
        
        $postadError="none";
        header('location: ' . fullURLfront . '/Contractor/contractor_paymentform');
      }
      
      $data['postadError'] = $postadError;
    
    }
    $view = new View("Contractor/contractor_postad");
  }

  public function contractorViewad() {
    $view = new View("Contractor/contractor_viewad");
  }

  public function contractorViewadmyad() {
    $view = new View("Contractor/contractor_viewadmyad");
  }

  public function contractorConfirmpayment() {
    $view = new View("Contractor/contractor_confirmpayment");
  }

  public function contractorConfirmeditad() {
    $view = new View("Contractor/contractor_confirmeditad");
  }

  public function contractorMyadedit() {
    $view = new View("Contractor/contractor_Myadedit");
  }


  public function contractorPaymentform() {
    $contractorModel = new ContractorModel();
    $paymentmodel=new PaymentModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $payment=1000;

    if(!empty($_POST['contractor_paymentform'] && $_POST['contractor_paymentform']=='submitted')){
        $data['inputted_data']= $_POST;
        $cardnumber = $_POST['cardnumber'];
        $date= $_POST['date'];
        $name= $_POST['name'];
        $cvv= $_POST['cvv'];
        $paymentformError= "";
      
      if($paymentformError == ""){
        
        $paymentformID=$paymentmodel->generateContractorPaymentformID();
      
      
        $currentdatetime= date('Y-m-d H:i:s');
        $contractorDetails = $contractorModel->getContractorByUserID($userID);
        

        $contractorPaymentform = [
          'paymentID'=> $paymentformID,
          'cardnumber'=> $cardnumber,
          'paymentdate' => $currentdatetime,
          'cvv' => $cvv,
          'name' => $name,
          'expiredate'=> $date,
          'paymentamount'=> $payment,
          'Contractor_ID'=>$contractorDetails->Contractor_ID
        ];

      }
    
      $paymentmodel->addNewContractorPaymentForm($contractorPaymentform);
    
      $postadError="none";
      header('location: ' . fullURLfront . '/Contractor/contractor_paymentgateway');
    }
    $view = new View("Contractor/contractor_paymentform");
  }

  public function contractorPaymentgateway() {
    $contractorModel= new ContractorModel();
    $paymentModel=new PaymentModel();
    $userID= $_SESSION['loggedin']['user_id'];
    
    if(!empty($_POST['contractor_paymentgateway'] && $_POST['contractor_paymentgateway'] == 'submitted')){

      $data['inputted_data']=$_POST;
      $username= $_POST['username'];
      $password = $_POST['password'];
      $paymentgatewayError="";
      if($paymentgatewayError == ""){
      
        $userdetails= $paymentModel->getContractorLoginDetails($userID);
      
        if($username == $userdetails->email && password_verify($password,$userdetails->password)){
          header('location: ' . fullURLfront . '/Contractor/contractor_confirmpayment');
        }
        else{
          $paymentgatewayError="Invalid username or password";
        }
      }
        
      $data['paymentgatewayError'] = $paymentgatewayError;
    }
    $view = new View("Contractor/contractor_paymentgateway");
  }

  public function contractorPaymentdone() {
    $view = new View("Contractor/contractor_paymentdone");
  }

  public function contractorHelp() {
    $view = new View("Contractor/contractor_help");
  }

  public function contractorEditprofile() {
    $view = new View("Contractor/contractor_editprofile");
  }

  public function contractorFavouritelist() {
    $view = new View("Contractor/contractor_favouritelist");
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

}