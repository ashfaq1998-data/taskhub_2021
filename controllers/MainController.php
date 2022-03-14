<?php

require_once ROOT  . '/View.php';
require_once ROOT . '/models/ContactUsModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MainController {
  public function index() {
    $view = new View("main/index");
  }

  public function contactUs() {
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    $contactUsModel = new ContactUsModel();
    if(!empty($_POST['contactus'] && $_POST['contactus'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
		  $name = $_POST['name'];
      $email = $_POST['email'];
		  $message = $_POST['message'];
      $ContactError = "";

      if(empty($name) || empty($email) || empty($message))
      {
          $ContactError = "Please fill all the empty fields";
      }

      if($ContactError == ""){
        $contactID = $contactUsModel->generateContactUsID();
        $currentDateTime = date('Y-m-d H:i:s');
      
        $contactDetails = [
          'contactID' => $contactID,
          'Date' => $currentDateTime,
          'name' => $name,
          'email' => $email,
          'description' => $message
          
        ];

        $contactUsModel->addNewContactDetails($contactDetails);
        $ContactError = "none";

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

          $mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = 'The inuiry on Taskhub';
          $mail->Body    = "<h1>Thanks for Contacting Us</h1>
                            <p>Dear $name,</p><br>
										        <p>Your inquiry is really important for us. One of our customer agent will contact you soon</p><br>
                            <p>Thank you</p><br>
                            <p>Taskhub Team</p>";
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          $mail->send();
        }catch(Exception $e){
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
      }

      $data['ContactError'] = $ContactError;
      
    }

    $view = new View("main/index",$data);
  }
}
