<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/ContractorModel.php';
require_once ROOT . '/models/BookingModel.php';
require_once ROOT . '/models/PaymentModel.php';
require_once ROOT . '/models/PostadModel.php';
require_once ROOT . '/models/AdvertisementModel.php';
require_once ROOT . '/models/ContractorProfileModel.php';
require_once ROOT . '/models/ServicesModel.php';
// require_once ROOT . 'models/ManpowerModel.php';
// require_once ROOT . 'models/EmployeeModel.php';
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

    
    // $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    // Number of results to show on each page.
    // $num_results_on_page = 10;
    // $calc_page = ($page - 1) * $num_results_on_page;
    $historydetails = $contractorModel->getContractorWorkHistory($contractorDetails->Contractor_ID);
    // print($historydetails->Date);
    // print($historydetails->CusFullName);
    // print($historydetails->payment);
    // print($historydetails->Is_job_done);
    // print($historydetails->title);
    
    // $allEvents = array();

    // foreach($historydetails as $history){
    //   $event = [
    //     'Date'  => $history->Date,
    //     'Name'  => $history->CusFullName,
    //     'Location' => $history->Address,
    //     'payment' => $history->payment,
    //     'Is_job_done' => $history->Is_job_done,
    //     'Description' => $history->Description,
    
    //   ];
    //   print($event['Date']);
    //   array_push($allEvents, $event);
    
    // }
    
    $data['HistoryEvents'] = $historydetails;
    
    $view = new View("Contractor/contractor_history", $data);
  }

  public function contractorSearch(){
   
    $contractorModel=new ContractorModel();
    $userID=$_SESSION['loggedin']['user_id'];
    $servicesModel=new ServicesModel();
 
    $data['inputted_data']=$_POST;
    $type = $_REQUEST['type'];
    $customerdetails=$servicesModel->getCustomerProfiles();
  
    $data['customerSearch']=$customerdetails;

    $view = new View("Contractor/contractor_search",$data);
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    // $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // // Number of results to show on each page.
    // $num_results_on_page = 3;
    // $calc_page = ($page - 1) * $num_results_on_page;
    // print("Are we there");
    // if($type == 1 || empty($type)){

    //   $total_pages = $customerModel->getCustomerProfiles(0, 0, true);
    //   $data['pagination'] = [
    //     'page' => $page, 
    //     'total_pages' => $total_pages, 
    //     'results_count' => $num_results_on_page
    //   ];
    
    //   $data['profiles'] = $customerModel->getCustomerProfiles($num_results_on_page, $calc_page, false);

    // }else if($type == 2){

    //   $total_pages = $manpowerModel->getManPowerProfiles(0, 0, true);
    //   $data['pagination'] = [
    //     'page' => $page, 
    //     'total_pages' => $total_pages, 
    //     'results_count' => $num_results_on_page
    //   ];

    //   $data['profiles'] = $manpowerModel->getManPowerProfiles($num_results_on_page, $calc_page, false);

    // }else if($type == 3){
      
    //   $total_pages = $employeeModel->getEmployeeProfiles(0, 0, true);
    //   $data['pagination'] = [
    //     'page' => $page, 
    //     'total_pages' => $total_pages, 
    //     'results_count' => $num_results_on_page
    //   ];

    //   $data['profiles'] = $employeeModel->getEmployeeProfiles($num_results_on_page, $calc_page, false);

    // }

   

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

    if(!empty($_POST['search_filter']) &&  $_POST['search_filter'] == 'submitted'){
      $data['inputted_data']=$_POST;
      $selectvalue=$_POST['search_value'];
      // $selectvalue=$_POST['search_value'];
      
      $advertisementModel = new AdvertisementModel();
      $userID = $_SESSION['loggedin']['user_id'];
      
      // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
      // $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    
      // // Number of results to show on each page.
      // $num_results_on_page = 3;
      // $calc_page = ($page - 1) * $num_results_on_page;
  
      
      if($selectvalue == 1 || empty($selectvalue)){
    
        // $total_pages = $advertisementModel->getCustomerAd(0, 0, true);
        // $data['pagination'] = [
        //   'page' => $page, 
        //   'total_pages' => $total_pages, 
        //   'results_count' => $num_results_on_page
        // ];
  
        $data['advertisements'] = $advertisementModel->getCustomerAd();
      }
  
      if($selectvalue == 2 || empty($selectvalue)){
      
        // $total_pages = $advertisementModel->getManPowerAd(0, 0, true);
        // $data['pagination'] = [
        //   'page' => $page, 
        //   'total_pages' => $total_pages, 
        //   'results_count' => $num_results_on_page
        // ];
      

        $data['advertisements'] = $advertisementModel->getManPowerAd();
      }

      // $total_pages = $advertisementModel->getCustomerAd(0, 0, true);
      // $data['pagination'] = [
      //   'page' => $page, 
      //   'total_pages' => $total_pages, 
      //   'results_count' => $num_results_on_page
      // ];

      
      // $type = $_REQUEST['type'];
    }
    
    
    $view = new View("Contractor/contractor_viewad",$data);
  }

  public function contractorViewadmyad() {
  
    $contractorModel = new ContractorModel();
    $advertisementModel=new AdvertisementModel();
    $userID=$_SESSION['loggedin']['user_id'];

     // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

     // Number of results to show on each page.
    $num_results_on_page = 3;
    $calc_page = ($page - 1) * $num_results_on_page;
    $contractorDetails = $contractorModel->getContractorByUserID($userID);
    
    $total_pages = $advertisementModel->getcontractormyadvertisements($contractorDetails->Contractor_ID,0, 0, true);
    $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
    ];
    
    $data['advertisements']=$advertisementModel->getcontractormyadvertisements($contractorDetails->Contractor_ID,$num_results_on_page,$calc_page,false);
    
    $view = new View("Contractor/contractor_viewadmyad",$data);
    
  }

  public function contractorConfirmpayment() {
    $view = new View("Contractor/contractor_confirmpayment");
  }

  public function contractorConfirmeditad() {
    $view = new View("Contractor/contractor_confirmeditad");
  }

  public function contractorMyadedit(){
    // $AdvertisementModel = new AdvertisementModel();
    // $userID = $_SESSION['loggedin']['user_id'];
    // $data['advertisement_details'] = $AdvertisementModel->getContractorByUserID($userID);

    // $view = new View("Contractor/contractor_editprofile",$data);
    $view= new View("Contractor/contractor_myadedit");
    
    
  } 

  public function contractorMyadeditUp() {
    // $adEdit = $_POST['contractor_editad'];
    // $title = $_POST['title'];
    // $name = $_POST['name'];
    // $email = $_POST['Email'];
    // $addr = $_POST['address'];
    // $zipcode = $_POST['zipcode'];
    // $image = $_POST['image'];
    // $district = $_POST['district'];
    // $description = $_POST['description'];
    // $contractoradedit = new AdvertisementModel();
    // $contractormodel=new ContractorModel();
    // $userID=$_SESSION['loggedin']['user_id'];
    
        
    // $contractorDetails = $contractormodel->getContractorByUserID($userID);
    // // if ($edit->contractorProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit)) {
    // //   $edit->contractorProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
    // //   header('location: ' . fullURLfront . '/Contractor/contractor_profile');
    // // } 
    // if($contractoradedit->contractorEditOwnAd($title,$name,$email,$addr,$zipcode,$image,$district,$description,$adEdit,$contractorDetails->Contractor_ID)){
  
    //   $contractoradedit->contractorEditOwnAd($title,$name,$email,$addr,$zipcode,$image,$district,$description,$adEdit,$contractorDetails->contractor_ID);
    //     header('location: ' . fullURLfront . '/Contractor/contractor_viewadmyad');
    // }

    // else {
    //   die('Something went wrong dsghjgdsahjdga.');
    // }
  
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
    
    $contractorModel = new ContractorModel();
    $helpmodel=new HelpRequestModel();
    $userID=$_SESSION['loggedin']['user_id'];
    
    if(!empty($_POST['contractor_help'] && $_POST['contractor_help'] == 'submitted')){
        $subject=$_POST['subject'];
        $helpmessage=$_POST['Description'];
    
        $helpID=$helpmodel->generateContractorHelpID();
        $currentDate=date('Y-m-d H:i:s');
        $contractorDetails=$contractorModel->getContractorByUserID($userID);
    
        $contractorHelp = [
          'RequestID' => $helpID,
          'Contractor_ID' =>$contractorDetails->Contractor_ID,
          'Date' =>$currentDate,
          'subject'=>$subject,
          'description'=>$helpmessage
        ];
    
        $helpmodel->addNewContractorHelp($contractorHelp);
    }
    
    $data['contractor_details'] = $contractorModel->getContractorByUserID($userID);
    $view = new View("Contractor/contractor_help");
    
    
  
  }

  public function contractorEditprofile(){
    $contractorModel = new ContractorModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['contractor_details'] = $contractorModel->getContractorByUserID($userID);

    $view = new View("Contractor/contractor_editprofile",$data);

    
    
  } 
  

  public function contractorEditprofileup() {
    
    $dataEdit = $_POST['contractor_edit'];
    $fn = $_POST['f_name'];
    $ln = $_POST['l_name'];
    $nic = $_POST['nic'];
    $addr = $_POST['address'];
    $cont = $_POST['phone_num'];
    $bio = $_POST['bio'];
    $dob = $_POST['dob'];
    $cardno = $_POST['accnum'];
    $cvv = $_POST['cvv'];
    $exp = $_POST['expiry'];
    $yearsexp=$_POST['experience'];
    $contractoredit = new ContractorProfileModel();
  
    // if ($edit->contractorProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit)) {
    //   $edit->contractorProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
    //   header('location: ' . fullURLfront . '/Contractor/contractor_profile');
    // } 
    if($contractoredit->contractorProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp, $yearsexp,$dataEdit)){
  
      $contractoredit->contractorProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$yearsexp,$dataEdit);
        header('location: ' . fullURLfront . '/Contractor/contractor_profile');
    }

    else {
      die('Something went wrong dsghjgdsahjdga.');
    }


    $view = new View("Contractor/contractor_profile");
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