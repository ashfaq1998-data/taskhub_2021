<?php

session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/model/HelpRequestModel.php';
require_once ROOT . '/model/customerHelpModel.php';
require_once ROOT . '/model/ComplaintModel.php';
require_once ROOT . '/model/CustomerModel.php';
require_once ROOT . '/model/BookingModel.php';
require_once ROOT . '/model/CustomerProfileModel.php';
require_once ROOT . '/classes/Validation.php';
require_once ROOT . '/model/AuthModel.php';

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

      if(empty($subject) && empty($helpmessage) && empty($email))
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
    $validation = new Validation();
    $authModel = new AuthModel();
    $edit = new CustomerProfileModel();
    if(!empty($_POST['customer_edit'] && $_POST['customer_edit'] == 'submitted')) {
      echo ($_POST['customer_edit']);
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
      $currentpw = $_POST['current_password'];
      $pw = $_POST['password'];
      $con_pw = $_POST['confirm_password'];
      $userID = $_SESSION['loggedin']['user_id'];
      $email = $_SESSION['loggedin']['email'];
      $registerError = "";

      //validate firstname
      if($registerError == ""){
        $registerError = $validation->validateName($fn);
      }

      //validate last name
      if($registerError == ""){
        $registerError = $validation->validateName($ln);
      }

      //validate NIC
      if($registerError == ""){
        $registerError = $validation->validateNIC($nic);
      }

      //validate phone number
      if($registerError == ""){
        $registerError = $validation->validatePhoneNumber($cont);
      }

      if(!empty($currentpw)) {
        $err1 = $authModel->login2($email, $currentpw);
        if($err1==false){
          // die('     Current password is wrong');
          $registerError = 'Current password is invalid!!';
        }

        //validate password
        if($pw!=NULL) {
          if($registerError == ""){
            $registerError = $validation->validateConfirmPassword($pw, $con_pw);
          }

          //validate password
          if($registerError == ""){
            $registerError = $validation->validatePassword($pw);
          }
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

      if($registerError == ""){
        if(!empty($imgContent)) {
          $edit->UpdateImage($imgContent, $userID);
        }

        // if($currentpw==NULL) {
        //   if ($edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit)) {
        //     $edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
        //     header('location: ' . fullURLfront . '/Customer/customer_profile');
        //   }else {
        //       die('Something went wrong.null');
        //   }
        // }
        
          // Hashing the password to store password in db
        if($pw==NULL) {
          if ($edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit)) {
            $edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
            header('location: ' . fullURLfront . '/Customer/customer_profile');
          }else {
              die('Something went wrong.null');
          }
        }
        // $err1 = $authModel->login2($email, $currentpw);
        if($pw!=NULL && $err1) {
    
            $password = password_hash($pw, PASSWORD_DEFAULT);

            if ($authModel->user_update($password)) {
              $edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
              header('location: ' . fullURLfront . '/Customer/customer_profile');
            }else {
                die('Something went wrong.notnull111111');
            }
        }
        else if($err1==false){
          // die('     Current password is wrong');
          $registerError = 'Current password is invalid!!';
        }
        else {
          $edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
          header('location: ' . fullURLfront . '/Customer/customer_profile');
        }
        
          
        
      }
      $data['registerError'] = $registerError;
      // if($data['registerError'] == "") {
      //   if ($edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit)) {
      //     $edit->customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit);
      //     header('location: ' . fullURLfront . '/Customer/customer_profile');
      //   } 
      //   else {
      //     header('location: ' . fullURLfront . '/Customer/customer_profileEdUp');
      //   }
      // }
      
    }
    $customerModel = new CustomerModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $data['customer_details'] = $customerModel->getCustomerByUserID($userID);

    $view = new View("Customer/customer_profileEd", $data);
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

      //image upload processing 
      if(!empty($_FILES["upload"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["upload"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        //Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['upload']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image));
            //$imgContent = base64_encode(file_get_contents(addslashes($image)));
        }
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

        if(!empty($imgContent)) {
          $customerModel->customerPostadImage($imgContent, $customerPostad['AdvertisementID']);
        }

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

    $ser_type = $_REQUEST['service_type'];
    $area = $_REQUEST['location'];
    $emp_type = $_REQUEST['employee_type'];


    $data['type'] = $emp_type;
    if((isset($_GET['search']) && ($_GET['search'] != null)) || isset($ser_type) || isset($emp_type) || isset($area)) {
      $data['results'] = $customerModel->searchResults($keyword, $ser_type, $area, $emp_type);
    }
    // $data['results'] = $customerModel->searchResults($keyword, $ser_type, $area, $emp_type);

    $data['filters'] = [
      'ser_type' => $ser_type,
      'area' => $area,
      'emp_type' => $emp_type,
      'keyword' => $keyword
    ];
    
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