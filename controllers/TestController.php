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
require_once ROOT . '/model/TestModel.php';

class TestController {
    public function customerTest() {
        $testmodel = new TestModel();
        $customerModel = new CustomerModel();
        $userID = $_SESSION['loggedin']['user_id'];

        
        // if(!empty($_POST['search'] && $_POST['search'] == 'submitted') ){
            
        // $name = $_POST['name'];
        // $select = $_POST['select'];

        // $customerDetails = $customerModel->getCustomerByUserID($userID);
        // $CuID = $customerDetails->CustomerID;


        // if($_POST['search'] == 'submitted' && !empty($name) && !empty($select)) {
        //     $data['results'] = $testmodel->customerTest($name, $select, $userID);
        //     if(empty($data['error'])){
        //         // header('location: ' . fullURLfront . '/auth/login');
        //         $view = new View("Customer/test2", $data);
        //     }
            
        // }


        // if(!empty($_POST['search'] && $_POST['search'] == 'submitted') ){
            
        //     $name = $_POST['name'];
        //     $select = $_POST['select'];
    
        //     $customerDetails = $customerModel->getCustomerByUserID($userID);
        //     $CuID = $customerDetails->CustomerID;
        //     $testmodel->customerTest($name, $select, $userID);
        // }


        if($_POST['search'] == 'submitted') {
            $val = $_POST['search'];
            
            $data['results'] = $testmodel->customerTest2($val);
        }
        $view = new View("Customer/test2",$data);
    }
}
