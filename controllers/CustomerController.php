<?php

session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/model/HelpRequestModel.php';
require_once ROOT . '/model/customerHelpModel.php';
require_once ROOT . '/model/ComplaintModel.php';
require_once ROOT . '/model/CustomerModel.php';
require_once ROOT . '/model/BookingModel.php';
require_once ROOT . '/model/CustomerProfileModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CustomerController {

  //customer functions
  public function customerBooking() {
    $view = new View("Customer/customer_booking");
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

      if(empty($subject) && empty($complaintmessage) && empty($rating))
      {
          $ComplaintError = "Please fill all the empty fields";
      }

      if($ComplaintError == ""){
        $complaintID = $complaintModel->generateCustomerComplaintID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $customerDetails = $customerModel->getCustomerByUserID($userID);


        $customerComplaint = [
          'ComplaintID' => $complaintID,
          'Date' => $currentDateTime,
          'Subject' => $subject,
          'Content' => $complaintmessage,
          'Rates' => $rating,
          'CustomerID' => $customerDetails->CustomerID
        ];

        $complaintModel-> addNewCustomerComplaint($customerComplaint);
        $ComplaintError = "none";

      }

      $data['ComplaintError'] = $ComplaintError;
    }
    $view = new View("Customer/customer_complaint", $data);
  }



  public function customerHelp() {
    $helpModel = new customerHelpModel();
    $customerModel = new CustomerModel();

    if(!empty($_POST['submit'] && $_POST['submit'] == 'submitted')){
      $data['inputted_data'] = $_POST;
		  $email = $_POST['email'];
		  $helpmessage = $_POST['message'];
      $name = $_POST['name'];
      $HelpError = "";

      if(empty($subject) && empty($helpmessage) && empty($rating))
      {
          $HelpError = "Please fill all the empty fields";
      }

      if($HelpError == ""){
        $helpID = $helpModel->generateCustomerHelpID();
        $currentDateTime = date('Y-m-d H:i:s');
        $userID = $_SESSION['loggedin']['user_id'];
        $customerDetails = $customerModel->getCustomerByUserID($userID);


        $customerHelp = [
          'RequestID' => $helpID,
          'Date' => $currentDateTime,
          'Email' => $email,
          'Content' => $helpmessage,
          'Name' => $name,
          'CustomerID' => $customerDetails->CustomerID
        ];

        $helpModel-> addNewCustomerHelp($customerHelp);
        $HelpError = "none";

      }

      $data['HelpError'] = $HelpError;
    }
    $view = new View("Customer/customer_help",$data);
  }


  public function customerDashboard() {
    $view = new View("Customer/customer_dashboard");
  }

  public function customerCalender() {
    $view = new View("Customer/customer_calender");
  }

  public function customerHistory() {
    $view = new View("Customer/customer_history");
  }

  public function customerViewad(){
    $view = new View("Customer/customer_viewad");
  }

  public function customerPayment(){
    $view = new View("Customer/customer_payment");
  }

  public function customerProfile(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);
    $view = new View("Customer/customer_profile",$data);
  }



  public function customerProfileEd(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);

    $view = new View("Customer/customer_profileEd",$data);

     
       
  } 
  
  public function customerProfileEdUp(){
    $dataEdit = $_POST['customer_edit'];
    $fn = $_POST['f_name'];
    $ln = $_POST['l_name'];
    $nic = $_POST['nic'];
    $addr = $_POST['address'];
    $cont = $_POST['phone_num'];
    $bio = $_POST['bio'];
    $dob = $_POST['dob'];
    $cardno = $_POST['card_num'];
    $cvv = $_POST['cvv'];
    $exp = $_POST['expiry'];
    
    $edit = new CustomerProfileModel();

    if ($edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit)) {
      $edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
      header('location: ' . fullURLfront . '/Customer/customer_profile');
    } 
    else {
      die('Something went wrong dsghjgdsahjdga.');
    }


    $view = new View("Customer/customer_profile");
  }


  public function customerPostad(){
    $customerModel = new CustomerModel();
    if(!empty($_POST['customer_postad'] && $_POST['customer_postad'] == 'submitted')){
      $postad['inputted_data'] = $_POST;
		  $title = $_POST['title'];
      $des = $_POST['description'];
      $loc = $_POST['location'];
      $email = $_POST['email'];

      $postadError = "";

      if(empty($title) && empty($des) && empty($loc) && empty($email))
      {
          $postadError = "Please fill all the empty fields";
      }

      if($postadError == ""){
        $userID = $_SESSION['loggedin']['user_id'];
        $adID = $customerModel->generateCustomerAdID();
        $customerDetails = $customerModel->getCustomerByUserID($userID);

        $customerPostad = [
          'AdvertisementID' => $adID,
          'Title' => $title,
          'Description' => $des,
          'City' => $loc,
          'Email' => $email,
          'CustomerID' => $customerDetails->CustomerID
        ];

        $customerModel-> customerPostad($customerPostad);
        $postadError = "none";

      }
      $data['postadError'] = $postadError;
    }
    $view = new View("Customer/customer_postad", $data);
  }



  public function customerViewmyad(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $customerDetails = $customerModel->getCustomerByUserID($userID);
    $data['ad_details'] = $customerModel->getMyAdByCustomerID($customerDetails->CustomerID);
    $view = new View("Customer/customer_viewmyad",$data);
  }



  //newly added
  public function customerDeletemyad(){
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $customerDetails = $customerModel->getCustomerByUserID($userID);

    if(isset($_POST['submit'])) {
      $adIDNo = $_POST['submit'];
    }
    $data['ad_details'] = $customerModel->deleteMyAdID($adIDNo, $customerDetails->CustomerID);
    
    $view = new View("Customer/customer_viewmyad",$data);
  }


  public function customerSearch(){
    $customerModel = new CustomerModel();
    $keyword = $_GET['search'];
    if(isset($_GET['search']) && ($_GET['search'] != null)) {
      $data['results'] = $customerModel->searchResults($keyword);
    }
    else {
      die("Type a keyword!!");
    }
    
    $view = new View("Customer/customer_serviceList",$data);
  }





  public function customerService(){
    $view = new View("Customer/customer_service");
  }

  public function customerServiceLocation(){
    $view = new View("Customer/customer_serviceLocation");
  }

  public function customerServiceList(){
    $view = new View("Customer/customer_serviceList");
  }
 
}