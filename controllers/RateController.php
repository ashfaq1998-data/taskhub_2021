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

class RateController {

    public function RateSubmit(){

        $customerModel = new CustomerModel();
        $employeeModel = new EmployeeModel();
        $contractorModel = new ContractorModel();
        $manpowerModel = new ManpowerModel();

        $actorUserId = base64_decode($_REQUEST['iid']);
        $type = $_REQUEST['type'];
        $rateFor = $_REQUEST['rateFor'];

        if(!empty($_POST['confirm_rating']) && $_POST['confirm_rating'] == 'submitted') {
            
            $rating = $_POST['rating'];
            $type = $_POST['type'];
            $actorUserId = $_POST['actorUserId'];

            $response = false;
            if($type == 0){

                $customerDetails = $customerModel->getCustomerByUserID($actorUserId);
                if ($customerDetails->rating < 5) {
                    $newRating = $customerDetails->rating + (intVal($rating) / 5);
                    $response = $customerModel->updateRating($actorUserId, ($newRating < 5 ? round($newRating) : 5));
                }
                
            } else if ($type == 1) {

                $employeeDetails = $employeeModel->getEmployeeByUserID($actorUserId);
                if ($employeeDetails->rating < 5) {
                    $newRating = $employeeDetails->rating + (intVal($rating) / 5);
                    $response = $employeeModel->updateRating($actorUserId, ($newRating < 5 ? round($newRating) : 5));
                }

            } else if($type == 2) {

                $manpowerDetails = $manpowerModel->getManpowerByUserID($actorUserId);
                if ($manpowerDetails->rating < 5) {
                    $newRating = $manpowerDetails->rating + (intVal($rating) / 5);
                    $response = $manpowerModel->updateRating($actorUserId, ($newRating < 5 ? round($newRating) : 5));
                }

            } else if($type == 3) {
    
                $contractorDetails = $contractorModel->getContractorByUserID($actorUserId);
                if ($contractorDetails->rating < 5) {
                    $newRating = $contractorDetails->rating + (intVal($rating) / 5);
                    $response = $contractorModel->updateRating($actorUserId, ($newRating < 5 ? round($newRating) : 5));
                }

            }    

            if ($response) {
                header('location: ' . fullURLfront . '/main/index');
            }
        }

        $data['ratingFormDetails'] = [
            'actorUserId' => $actorUserId,
            'type' => $type,
            'rateFor' => $rateFor
        ];

        $view = new View("Rate/rate", $data);
    }

}
