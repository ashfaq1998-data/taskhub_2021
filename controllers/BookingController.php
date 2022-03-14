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
require_once ROOT . '/models/PaymentModel.php';
require_once ROOT . '/classes/Validation.php';
require_once ROOT . './PHPMailer/src/Exception.php';
require_once ROOT . './PHPMailer/src/PHPMailer.php';
require_once ROOT . './PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class BookingController {

  public function bookingHandle() {
    
    $customerUserId = base64_decode($_POST['order_id']);
    $payhereAmount = $_POST['payhere_amount'];
    $statusCode = $_POST['status_code'];
    $paymentMethod = $_POST['method'];
    $type = $_POST['custom_1'];
    $actorId = $_POST['custom_2'];
    $paymentId = $_POST['payment_id'];
    $cardNo = $_POST['card_no'];
    $cardHolderName = $_POST['card_holder_name'];
    $cardExpiry = $_POST['card_expiry'];


    $bookingModel = new BookingModel();
    $customerModel = new CustomerModel();
    $paymentModel = new PaymentModel();
    $usersModel = new UsersModel();
    $employeeModel = new EmployeeModel();
    $contractorModel = new ContractorModel();
    $manpowerModel = new ManpowerModel();

    $customerDetails = $customerModel->getCustomerByUserID($customerUserId);
    $payeeDetails = [];
    
    if ($statusCode == 2){
      //TODO: Update your database as payment success

      if($type == 1){

        $payeeDetails = $employeeModel->getEmployeeByID($actorId);

        $bookingDetails = [
          'bookingId' => $bookingModel->generateEmployeeBookingID(),
          'address' => $customerDetails->Address,
          'customerId' => $customerDetails->CustomerID,
          'employeeId' => $actorId,
          'description' => 'please help to fix it',
          'title' => 'need help',
          'payment' => $payhereAmount
        ];
        $bookingAdded = $bookingModel->addNewEmployeeBooking($bookingDetails);

      }else if($type == 2){

        $payeeDetails = $manpowerModel->getManpowerByID($actorId);
        
        $bookingDetails = [
          'bookingId' => $bookingModel->generateManpowerBookingID(),
          'address' => $customerDetails->Address,
          'customerId' => $customerDetails->CustomerID,
          'manpowerId' => $actorId,
          'description' => 'please help to fix it',
          'title' => 'need help',
          'payment' => $payhereAmount
        ];
        $bookingAdded = $bookingModel->addNewManpowerBooking($bookingDetails);

      }else if($type == 3){

        $payeeDetails = $contractorModel->getContractorByID($actorId);
        
        $bookingDetails = [
          'bookingId' => $bookingModel->generateContractorBookingID(),
          'address' => $customerDetails->Address,
          'customerId' => $customerDetails->CustomerID,
          'contractorId' => $actorId,
          'description' => 'please help to fix it',
          'title' => 'need help',
          'payment' => $payhereAmount
        ];
        $bookingAdded = $bookingModel->addNewContractorBooking($bookingDetails);

      }    
      
      if($bookingAdded){

        $paymentDetails = [
          'paymentId' => $paymentId,
          'cardNo' => $cardNo,
          'expiryDate' => $cardExpiry,
          'cardHolderName' => $cardHolderName,
          'customerId' => $customerDetails->CustomerID,
          'paymentMethod' => $paymentMethod,
          'payment' => $payhereAmount
        ];

        $paymentDone = $paymentModel->addNewCustomerPayment($paymentDetails);

        if ($paymentDone) {
          //mail for customer
          $customerUserDetails = $usersModel->getUserDetails($customerUserId);
          $this->sendRatingMail($customerUserDetails->email, $payeeDetails->ProfileFullName, $type, base64_encode($payeeDetails->user_id));
          //$this->sendRatingMail('fahd@xgengroup.com.au', $payeeDetails->ProfileFullName, $type, base64_encode($payeeDetails->user_id));

          //mail for payee
          $payeeUserDetails = $usersModel->getUserDetails($payeeDetails->user_id);
          $this->sendRatingMail($payeeUserDetails->email, ($customerDetails->FirstName . ' ' . $customerDetails->LastName), 0, base64_encode($customerUserId));
          //$this->sendRatingMail('fahad.2019656@iit.ac.lk', ($customerDetails->FirstName . ' ' . $customerDetails->LastName), 0, base64_encode($customerUserId));
        }
      }
    }
  }

  public function bookingSubmit() {
    $merchantId = $_POST['merchant_id'];
    $orderId = $_POST['order_id'];
    $payhereAmount = $_POST['payhere_amount'];
    $payhereCurrency = $_POST['payhere_currency'];
    $statusCode = $_POST['status_code'];
    $paymentMethod = $_POST['status_code'];


    $bookingModel = new BookingModel();
    $result = $bookingModel->addNewEmployeeBooking('ebook351', 'no');

    if($result){
      echo "success";
    }else{
      echo "failed";
    }
  }

  public function bookingSuccess() {
    $customerUserId = base64_decode($_REQUEST['order_id']);
    $customerModel = new CustomerModel();
    $paymentModel = new PaymentModel();

    $customerDetails = $customerModel->getCustomerByUserID($customerUserId);
    $paymentConfirmation = $paymentModel->getCustomerLastPayment($customerDetails->CustomerID);

    if($paymentConfirmation){
      $data['response'] = 'Your Booking done successfully';
    }

    $data['filters'] = [
      'type' => 1,
      'role' => '',
      'area' => '',
      'search' => ''
    ];

    $view = new View("Customer/customer_services", $data);

  }

  public function sendRatingMail($email, $name, $type, $userId){

    $mail = new PHPMailer(true);
    try{
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'taskhub21@gmail.com';                     //SMTP username
      $mail->Password   = 'Zahiracollege98@';                               //SMTP password
      $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      $mail->setFrom('taskhub21@gmail.com', 'Taskhub');
      $mail->addAddress("$email");

      $url = "https://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/Rate/rate_submit?type=$type&iid=$userId&rateFor=$name";
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Rating Work';
      $mail->Body    = "<h1>Rate for $name</h1>
                        Click <a href=$url>this link</a> to register your honest rating";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();
    }catch(Exception $e){
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
 
}