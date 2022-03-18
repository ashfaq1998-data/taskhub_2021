<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/AdminModel.php';
require_once ROOT . '/models/AdvertisementModel.php';
require_once ROOT . '/models/AuthModel.php';
require_once ROOT . '/models/EmployeeModel.php';
require_once ROOT . '/models/UsersModel.php';
require_once ROOT . '/models/ContractorModel.php';
require_once ROOT . '/models/CustomerModel.php';
require_once ROOT . '/models/ComplaintModel.php';
require_once ROOT . '/models/ManpowerModel.php';
require_once ROOT . '/models/PaymentModel.php';
require_once ROOT . '/models/ContactUsModel.php';
require_once ROOT . '/models/HelpRequestModel.php';
require_once ROOT . '/classes/Validation.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AdminController {

  public function adminDashboard() {
    $adminModel = new AdminModel();
    $data['totalcount'] =[
      'totalusers' => $adminModel->totalusers(),
      'totalprofit' => $adminModel->totalprofit() * 200,
      'totalcustomers' => $adminModel->totalcustomers(),
      'totaladvertisement' => $adminModel->totalcustomerads()+$adminModel->totalcontractorads()+$adminModel->totalmanpowerads(),
      'totalemployees' => $adminModel->totalemployees(),
      'totalmanpowers' => $adminModel->totalmanpowers(),
      'totalcontractors' => $adminModel->totalcontractors(),
      'totalcomplaints' => $adminModel->totalcustomercomplaint() + $adminModel->totalemployeecomplaint() + $adminModel->totalmanpowercomplaint() + $adminModel->totalcontractorcomplaint(),
      'totalhelprequest' => $adminModel->totalcustomerhelp() + $adminModel->totalemployeehelp() + $adminModel->totalmanpowerhelp() + $adminModel->totalcontractorhelp(),
      'totalbooking' => $adminModel->totalemployeebook() + $adminModel->totalmanpowerbook() + $adminModel->totalcontractorbook()

    ];
    $view = new View("Admin/admin_dashboard",$data);
  }

  public function adminManagePayment() {
    $adminModel = new AdminModel();
    $paymentModel = new PaymentModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $where['search'] = $_REQUEST['search'];
    $type = $_REQUEST['type'];
    
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;

    if($type == 1 || empty($type)){

      $total_pages = $paymentModel->getCustomerPayment(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['payment'] = $paymentModel->getCustomerPayment($num_results_on_page, $calc_page, false, $where);

    }else if($type == 2){

      $total_pages = $paymentModel->getManpowerPayment(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['payment'] = $paymentModel->getManpowerPayment($num_results_on_page, $calc_page, false, $where);

    }else if($type == 3){
      
      $total_pages = $paymentModel->getContractorPayment(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['payment'] = $paymentModel->getContractorPayment($num_results_on_page, $calc_page, false, $where);

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search']
      
    ];
    
    $view = new View("Admin/admin_managepayment",$data);
  }

  public function adminManageInquiry() {
    $adminModel = new AdminModel();
    $contactusModel = new ContactUsModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $where['search'] = $_REQUEST['search'];
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    $num_results_on_page = 8;
    $calc_page = ($page - 1) * $num_results_on_page;

    $total_pages = $contactusModel->getContactDetails(0, 0, true, $where);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['contact'] = $contactusModel->getContactDetails( $num_results_on_page, $calc_page, false, $where);
    $data['filters'] = [ 
      'search' => $where['search']
    ];


    $view = new View("Admin/admin_manageinquiry", $data);
  }

  public function adminManageAdvertisement() {
    $adminModel = new AdminModel();
    $advertisementModel = new AdvertisementModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $where['search'] = $_REQUEST['search'];
    $type = $_REQUEST['type'];
    
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 4;
    $calc_page = ($page - 1) * $num_results_on_page;

    if($type == 1 || empty($type)){

      $total_pages = $advertisementModel->getCustomerAd(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['advertisement'] = $advertisementModel->getCustomerAd($num_results_on_page, $calc_page, false, $where);

    }else if($type == 2){

      $total_pages = $advertisementModel->getManpowerAd(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['advertisement'] = $advertisementModel->getManpowerAd($num_results_on_page, $calc_page, false, $where);

    }else if($type == 3){
      
      $total_pages = $advertisementModel->getContractorAd(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['advertisement'] = $advertisementModel->getContractorAd($num_results_on_page, $calc_page, false, $where);

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search']
      
    ];
    
    $view = new View("Admin/admin_manageadvertisement",$data);
  }

  public function adminManageHelp() {
    $adminModel = new AdminModel();
    $helprequestModel = new HelpRequestModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $where['search'] = $_REQUEST['search'];
    $type = $_REQUEST['type'];
    
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;

    if($type == 1 || empty($type)){

      $total_pages = $helprequestModel->getCustomerHelp(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['help'] = $helprequestModel->getCustomerHelp($num_results_on_page, $calc_page, false, $where);

    }else if($type == 2){

      $total_pages = $helprequestModel->getManpowerHelp(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['help'] = $helprequestModel->getManpowerHelp($num_results_on_page, $calc_page, false, $where);

    }else if($type == 3){
      
      $total_pages = $helprequestModel->getContractorHelp(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['help'] = $helprequestModel->getContractorHelp($num_results_on_page, $calc_page, false, $where);

    }else if($type == 4){
      
      $total_pages = $helprequestModel->getEmployeeHelp(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['help'] = $helprequestModel->getEmployeeHelp($num_results_on_page, $calc_page, false, $where);

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search']
      
    ];
    
    $view = new View("Admin/admin_managehelp",$data);
  }

  

  

  public function adminManageComplaint() {
    $adminModel = new AdminModel();
    $complaintModel = new ComplaintModel();
    $userID = $_SESSION['loggedin']['user_id'];

    $where['search'] = $_REQUEST['search'];
    $type = $_REQUEST['type'];
    
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;

    if(empty($type)){
      $type = 1;
    }

    if($type == 1){

      $total_pages = $complaintModel->getCustomerComplaint(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['complaints'] = $complaintModel->getCustomerComplaint($num_results_on_page, $calc_page, false, $where);

    }else if($type == 2){

      $total_pages = $complaintModel->getManpowerComplaint(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['complaints'] = $complaintModel->getManpowerComplaint($num_results_on_page, $calc_page, false, $where);

    }else if($type == 3){
      
      $total_pages = $complaintModel->getContractorComplaint(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['complaints'] = $complaintModel->getContractorComplaint($num_results_on_page, $calc_page, false, $where);

    }else if($type == 4){
      
      $total_pages = $complaintModel->getEmployeeComplaint(0, 0, true, $where);
      $data['pagination'] = [
        'page' => $page, 
        'total_pages' => $total_pages, 
        'results_count' => $num_results_on_page
      ];

      $data['complaints'] = $complaintModel->getEmployeeComplaint($num_results_on_page, $calc_page, false, $where);

    }

    $data['filters'] = [
      'type' => $type, 
      'search' => $where['search']
      
    ];
    
    $view = new View("Admin/admin_managecomplaint",$data);
  }

  public function adminManageEmployee() {
    $adminModel = new AdminModel();
    $employeeModel = new EmployeeModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $where['search'] = $_REQUEST['search'];
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $adminModel->getEmployeeDetails(0, 0, true, $where);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['employees'] = $adminModel->getEmployeeDetails($num_results_on_page, $calc_page, false, $where);

    $data['filters'] = [ 
      'search' => $where['search']
    ];

    
    $view = new View("Admin/admin_manageemployee",$data);
  }

  public function adminManageCustomer() {
    $adminModel = new AdminModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $where['search'] = $_REQUEST['search'];
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $adminModel->getCustomerDetails(0, 0, true,$where);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['customers'] = $adminModel->getCustomerDetails($num_results_on_page, $calc_page, false, $where);
    $data['filters'] = [ 
      'search' => $where['search']
    ];

    
    $view = new View("Admin/admin_managecustomer",$data);
  }

  public function adminManageContractor() {
    $adminModel = new AdminModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $where['search'] = $_REQUEST['search'];
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $adminModel->getContractorDetails(0, 0, true, $where);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['contractors'] = $adminModel->getContractorDetails($num_results_on_page, $calc_page, false,$where);
    $data['filters'] = [ 
      'search' => $where['search']
    ];

    
    $view = new View("Admin/admin_managecontractor",$data);
  }


  public function adminManageManpower() {
    $adminModel = new AdminModel();
    $userID = $_SESSION['loggedin']['user_id'];
    $where['search'] = $_REQUEST['search'];
    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 10;
    $calc_page = ($page - 1) * $num_results_on_page;


    $total_pages = $adminModel->getManpowerDetails(0, 0, true, $where);
    $data['pagination'] = [
      'page' => $page, 
      'total_pages' => $total_pages, 
      'results_count' => $num_results_on_page
    ];

    $data['manpower'] = $adminModel->getManpowerDetails($num_results_on_page, $calc_page, false, $where);
    $data['filters'] = [ 
      'search' => $where['search']
    ];

    
    $view = new View("Admin/admin_managemanpower",$data);
  }


  public function adminProfile() {
    $view = new View("Admin/admin_profile");
  }

  public function adminAddEmployee(){
    $validation = new Validation();
    $authModel = new AuthModel();
    $employeeModel = new EmployeeModel();
    $usersModel = new UsersModel();
    $data['specialization_list'] = ['Specialized For', 'Plumbing', 'Carpentry', 'Electrical', 'Mason', 'Painting', 'Gardening'];
  
    if(!empty($_POST['admin_addemployee'] && $_POST['admin_addemployee'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
      $firstName = $_POST['f_name'];
      $lastName = $_POST['l_name'];
      $nic = $_POST['nic'];
      $phoneNum = $_POST['phone_num'];
      $specialization = $_POST['specialization'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];
      $registerError = "";
  
      //validate input fields
      if(empty($firstName) || empty($lastName) || empty($nic) || empty($phoneNum) || empty($specialization) 
        || empty($email) || empty($password) || empty($confirmPassword))
      {
        $registerError = "Please fill all the empty fields";
      }
  
      //validate phone number
      if($registerError == ""){
        $registerError = $validation->validatePhoneNumber($phoneNum);
      }
      
      
  
      //validate email
      if($registerError == ""){
        if(!$validation->validateEmail($email)){
          $registerError = "Please enter a valid email format";
        }else {
           //Check if email exists.
          if ($usersModel->checkUserEmail($email)) {
            $registerError = 'This Email is already taken.';
          }
        }
      }
      
      //validate password
      if($registerError == ""){
        $registerError = $validation->validatePassword($password);
      }
  
      //validate password
      if($registerError == ""){
        $registerError = $validation->validateConfirmPassword($password, $confirmPassword);
      }
  
      //validate firstname
      if($registerError == ""){
        $registerError = $validation->validateName($firstName);
      }
  
      if($registerError == ""){
        $registerError = $validation->validateName($lastName);
      }
  
      
  
  
      //registration after validation
      if($registerError == ""){
        $userId = $usersModel->generateUserID();
        $employeeId = $employeeModel->generateEmployeeID();
        // Hashing the password to store password in db
        $password = password_hash($password, PASSWORD_DEFAULT);
  
        $userDetails = [
          'id' => $userId,
          'email' => $email,
          'password' => $password,
          'user_type_id' => 3,
        ];
  
        $employeeDetails = [
          'EmployeeID' => $employeeId,
          'FirstName' => $firstName,
          'LastName' => $lastName,
          'NIC' => $nic,
          'Contact_No' => $phoneNum,
          'Specialized_area' => $specialization,
          'user_id' => $userId
        ];
  
        if ($authModel->register($userDetails)) {
          //add new employee
          $employeeModel->addNewEmployee($employeeDetails);
          header('location: ' . fullURLfront . '/Admin/admin_manageemployee');
          } else {
          die('Something went wrong.');
        }
      }
      $data['registerError'] = $registerError;
    }
    $view = new View("Admin/admin_addemployee", $data);
  }


  public function adminAddManpower(){
    $validation = new Validation();
    $authModel = new AuthModel();
    $manpowerModel = new ManpowerModel();
    $usersModel = new UsersModel();
    
  
    if(!empty($_POST['manpower_add'] && $_POST['manpower_add'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
      $companyName = $_POST['company_name'];
      $companyRegister = $_POST['company_register'];
      $district = $_POST['district'];
      $phoneNum = $_POST['phone_num'];
      $address = $_POST['address'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];
      $registerError = "";
  
      //validate input fields
      if(empty($companyName) || empty($companyRegister) || empty($district) || empty($phoneNum)  || empty($address)
        || empty($email) || empty($password) || empty($confirmPassword))
      {
        $registerError = "Please fill all the empty fields";
      }
  
      //validate phone number
      if($registerError == ""){
        $registerError = $validation->validatePhoneNumber($phoneNum);
      }
      
      
  
      //validate email
      if($registerError == ""){
        if(!$validation->validateEmail($email)){
          $registerError = "Please enter a valid email format";
        }else {
           //Check if email exists.
          if ($usersModel->checkUserEmail($email)) {
            $registerError = 'This Email is already taken.';
          }
        }
      }
      
      //validate password
      if($registerError == ""){
        $registerError = $validation->validatePassword($password);
      }
  
      //validate password
      if($registerError == ""){
        $registerError = $validation->validateConfirmPassword($password, $confirmPassword);
      }
  
      //registration after validation
      if($registerError == ""){
        $userId = $usersModel->generateUserID();
        $manpowerId = $manpowerModel->generateManpowerID();
        // Hashing the password to store password in db
        $password = password_hash($password, PASSWORD_DEFAULT);
  
        $userDetails = [
          'id' => $userId,
          'email' => $email,
          'password' => $password,
          'user_type_id' => 4,
        ];
  
        $manpowerDetails = [
          'Manpower_Agency_ID' => $manpowerId,
          'Company_Name' => $companyName,
          'Company_Registration_No' => $companyRegister,
          'District' => $district,
          'Contact_No' => $phoneNum,
          'Address' => $address,
          'user_id' => $userId
        ];
  
        if ($authModel->register($userDetails)) {
        //add new employee
          $manpowerModel->addNewManpower($manpowerDetails);
          header('location: ' . fullURLfront . '/Admin/admin_managemanpower');
        } else {
          die('Something went wrong.');
        }
      }
      $data['registerError'] = $registerError;
    }
    $view = new View("Admin/admin_addmanpower", $data);
  }


  public function adminAddContractor(){
    $validation = new Validation();
    $authModel = new AuthModel();
    $contractorModel = new ContractorModel();
    $usersModel = new UsersModel();
    $data['specialization_list'] = ['Specialized For', 'Plumbing', 'Carpentry', 'Electrical', 'Mason', 'Painting', 'Gardening'];
  
    if(!empty($_POST['add_contractor'] && $_POST['add_contractor'] == 'submitted') ){
      $data['inputted_data'] = $_POST;
      $firstName = $_POST['f_name'];
      $lastName = $_POST['l_name'];
      $nic = $_POST['nic'];
      $phoneNum = $_POST['phone_num'];
      $specialization = $_POST['specialization'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];
      $registerError = "";
  
      //validate input fields
      if(empty($firstName) || empty($lastName) || empty($nic) || empty($phoneNum) || empty($specialization) 
        || empty($email) || empty($password) || empty($confirmPassword))
      {
        $registerError = "Please fill all the empty fields";
      }
  
      //validate phone number
      if($registerError == ""){
        $registerError = $validation->validatePhoneNumber($phoneNum);
      }
      
      
  
      //validate email
      if($registerError == ""){
        if(!$validation->validateEmail($email)){
          $registerError = "Please enter a valid email format";
        }else {
           //Check if email exists.
          if ($usersModel->checkUserEmail($email)) {
            $registerError = 'This Email is already taken.';
          }
        }
      }
      
      //validate password
      if($registerError == ""){
        $registerError = $validation->validatePassword($password);
      }
  
      //validate password
      if($registerError == ""){
        $registerError = $validation->validateConfirmPassword($password, $confirmPassword);
      }
  
      //validate firstname
      if($registerError == ""){
        $registerError = $validation->validateName($firstName);
      }
  
      if($registerError == ""){
        $registerError = $validation->validateName($lastName);
      }
  
      
  
  
      //registration after validation
      if($registerError == ""){
        $userId = $usersModel->generateUserID();
        $contractorId = $contractorModel->generateContractorID();
        // Hashing the password to store password in db
              $password = password_hash($password, PASSWORD_DEFAULT);
  
        $userDetails = [
          'id' => $userId,
          'email' => $email,
          'password' => $password,
          'user_type_id' => 5,
        ];
  
        $contractorDetails = [
          'Contractor_ID' => $contractorId,
          'FirstName' => $firstName,
          'LastName' => $lastName,
          'NIC' => $nic,
          'Contact_No' => $phoneNum,
          'Specialized_area' => $specialization,
          'user_id' => $userId
        ];
  
        if ($authModel->register($userDetails)) {
        //add new employee
          $contractorModel->addNewContractor($contractorDetails);
          header('location: ' . fullURLfront . '/Admin/admin_managecontractor');
          } else {
          die('Something went wrong.');
        }
      }
      $data['registerError'] = $registerError;
    }
    $view = new View("Admin/admin_addcontractor", $data);
    }
  
  
    public function adminAddCustomer(){
      $validation = new Validation();
      $authModel = new AuthModel();
      $customerModel = new CustomerModel();
      $usersModel = new UsersModel();
      $data['gender'] = ['Male','Female'];
    
      if(!empty($_POST['add_customer'] && $_POST['add_customer'] == 'submitted') ){
        $data['inputted_data'] = $_POST;
        $firstName = $_POST['f_name'];
        $lastName = $_POST['l_name'];
        $nic = $_POST['nic'];
        $phoneNum = $_POST['phone_num'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $registerError = "";
    
        //validate input fields
        if(empty($firstName) || empty($lastName) || empty($nic) || empty($phoneNum) || empty($gender) || empty($address)
          || empty($email) || empty($password) || empty($confirmPassword))
        {
          $registerError = "Please fill all the empty fields";
        }
    
        //validate phone number
        if($registerError == ""){
          $registerError = $validation->validatePhoneNumber($phoneNum);
        }
        
        
    
        //validate email
        if($registerError == ""){
          if(!$validation->validateEmail($email)){
            $registerError = "Please enter a valid email format";
          }else {
             //Check if email exists.
            if ($usersModel->checkUserEmail($email)) {
              $registerError = 'This Email is already taken.';
            }
          }
        }
        
        //validate password
        if($registerError == ""){
          $registerError = $validation->validatePassword($password);
        }
    
        //validate password
        if($registerError == ""){
          $registerError = $validation->validateConfirmPassword($password, $confirmPassword);
        }
    
        //validate firstname
        if($registerError == ""){
          $registerError = $validation->validateName($firstName);
        }
    
        if($registerError == ""){
          $registerError = $validation->validateName($lastName);
        }
    
        
    
    
        //registration after validation
        if($registerError == ""){
          $userId = $usersModel->generateUserID();
          $customerId = $customerModel->generateCustomerID();
          // Hashing the password to store password in db
                $password = password_hash($password, PASSWORD_DEFAULT);
    
          $userDetails = [
            'id' => $userId,
            'email' => $email,
            'password' => $password,
            'user_type_id' => 2,
          ];
    
          $customerDetails = [
            'CustomerID' => $customerId,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'NIC' => $nic,
            'Contact_No' => $phoneNum,
            'Address' => $address,
            'Gender' => $gender,
            'user_id' => $userId
          ];
    
          if ($authModel->register($userDetails)) {
            //add new employee
            $customerModel->addNewCustomer($customerDetails);
            header('location: ' . fullURLfront . '/Admin/admin_managecustomer');
            } else {
            die('Something went wrong.');
          }
        }
        $data['registerError'] = $registerError;
      }
      $view = new View("Admin/admin_addcustomer", $data);
    }

    public function showEmployeeEdit() {

      $employeeModel = new EmployeeModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();
      
      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
    
      $data['profile_details'] = $employeeModel->getEmployeeByID($iid);
      $data['specialization_list'] = ['Specialized For', 'Plumbing', 'Carpentry', 'Electrical', 'Mason', 'Painting', 'Gardening'];

      if(!empty($_POST['employee_edit']) && $_POST['employee_edit'] == 'submitted' ){

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
        $ratehrs = $_POST['ratehrs'];
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
  
        
    
    
        //update after validation
        if($editError == ""){
  
          $updateEmployeeDetails = [
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
  
          $employeeModel->updateEmployee($data['profile_details']->EmployeeID, $updateEmployeeDetails);
          
          header('location: ' . fullURLfront . '/Admin/admin_manageemployee');
            
        }
        $data['editError'] = $editError;
      }

      $view = new View("Admin/admin_editemployee", $data);
    }

    public function showManpowerEdit() {

      $manpowerModel = new ManpowerModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();
      
      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
    
      $data['profile_details'] = $manpowerModel->getManpowerByID($iid);

      if(!empty($_POST['manpower_edit']) && $_POST['manpower_edit'] == 'submitted' ){

        $data['inputted_data'] = $_POST;
        $companyname = $_POST['company_name'];
        $regno = $_POST['regno'];
        $phoneNum = $_POST['phone_num'];
        $workers = $_POST['workers'];
        $payment = $_POST['"ratehrs'];
        $owner = $_POST['owner'];
        $address = $_POST['address'];
        $district = $_POST['district'];
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
          $editError = $validation->validateCompanyName($companyname);
        }
    
        if($editError == ""){
          $editError = $validation->validateName($owner);
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
  
        
    
    
        //update after validation
        if($editError == ""){
  
          $updateManpowerDetails = [
            'CompanyName' => $companyname,
            'Company_Registration_No' => $regno,
            'Contact_No' => $phoneNum,
            'Address' => $address,
            'District' => $district,
            'workers' => $workers,
            'Owner' => $owner,
            'Payment_for_2hours' => $payment,
            'Year_of_experience' => $experience,
            'Name_of_Bank' => $bank,
            'Account_Number' => $accnum,
            'bio' => $bio,
          ];
  
          $manpowerModel->updateManpower($data['profile_details']->Manpower_Agency_ID, $updateManpowerDetails);
          
          header('location: ' . fullURLfront . '/Admin/admin_managemanpower');
            
        }
        $data['editError'] = $editError;
      }

      $view = new View("Admin/admin_editmanpower", $data);
    }

    public function showCustomerEdit() {

      $customerModel = new CustomerModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();
      
      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
    
      $data['profile_details'] = $customerModel->getCustomerByID($iid);

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
            'Name_of_Bank' => $bank,
            'Account_Number' => $accnum,
            'bio' => $bio,
          ];
  
          $customerModel->updateCustomer($data['profile_details']->CustomerID, $updateCustomerDetails);
          
          header('location: ' . fullURLfront . '/Admin/admin_managecustomer');
            
        }
        $data['editError'] = $editError;
      }

      $view = new View("Admin/admin_editcustomer", $data);
    }

    

    public function showContractorEdit() {

      $contractorModel = new ContractorModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();
      
      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
    
      $data['profile_details'] = $contractorModel->getContractorByID($iid);
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
        $ratehrs = $_POST['ratehrs'];
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
  
          $contractorModel->updateContractor($data['profile_details']->Contractor_ID, $updateContractorDetails);
          
          header('location: ' . fullURLfront . '/Admin/admin_managecontractor');
            
        }
        $data['editError'] = $editError;
      }

      $view = new View("Admin/admin_editcontractor", $data);
    }

    public function EmployeeDelete() {

      $employeeModel = new EmployeeModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();

      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
      $deleteError = "";

      
      $data['profile_details'] = $employeeModel->getEmployeeByID($iid);
      $response = $employeeModel->deleteEmployee($data['profile_details']->EmployeeID);
      $employeeModel->deleteEmployeeFromUser($data['profile_details']->user_id);

      if($response){
        $data['response'] = 'Record has been deleted sucessfully';
      }
      
      $view = new View("Admin/admin_manageemployee", $data);
    }

    public function CustomerDelete() {

      $customerModel = new CustomerModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();

      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
      $deleteError = "";

      
      $data['profile_details'] = $customerModel->getCustomerByID($iid);
      $response = $customerModel->deleteCustomer($data['profile_details']->CustomerID);
      $customerModel->deleteCustomerFromUser($data['profile_details']->user_id);

      if($response){
        $data['response'] = 'Record has been deleted sucessfully';
      }
      
      $view = new View("Admin/admin_managecustomer", $data);
    }

    public function ContractorDelete() {

      $contractorModel = new ContractorModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();

      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
      $deleteError = "";

      
      $data['profile_details'] = $contractorModel->getContractorByID($iid);
      $response = $contractorModel->deleteContractor($data['profile_details']->Contractor_ID);
      $contractorModel->deleteContractorFromUser($data['profile_details']->user_id);

      if($response){
        $data['response'] = 'Record has been deleted sucessfully';
      }
      
      $view = new View("Admin/admin_managecontractor", $data);
    }

    public function ManpowerDelete() {

      $manpowerModel = new ManpowerModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();

      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
      $deleteError = "";

      
      $data['profile_details'] = $manpowerModel->getManpowerByID($iid);
      $response = $manpowerModel->deleteManpower($data['profile_details']->Manpower_Agency_ID);
      $manpowerModel->deleteManpowerFromUser($data['profile_details']->user_id);

      if($response){
        $data['response'] = 'Record has been deleted sucessfully';
      }
      
      $view = new View("Admin/admin_managemanpower", $data);
    }

    public function InquiryDelete() {

      $contactusModel = new ContactUsModel();
      $validation = new Validation();
      $usersModel = new UsersModel();
      $authModel = new AuthModel();
      $adminModel = new AdminModel();

      $userID = $_SESSION['loggedin']['user_id'];
  
      $iid = base64_decode($_REQUEST['iid']);
      $inquiryError = "";

      
      $response = $contactusModel->deleteContact($iid);

      if($response){
        $data['response'] = 'Record has been deleted sucessfully';
      }
      
      $view = new View("Admin/admin_manageinquiry", $data);
    }

    public function AdDelete() {
      $employeeModel = new EmployeeModel();
      $customerModel = new CustomerModel();
      $contractorModel = new ContractorModel();
      $manpowerModel = new ManpowerModel();
      $AdvertisementModel = new AdvertisementModel();

      $adid = base64_decode($_REQUEST['adid']);
      $iid = base64_decode($_REQUEST['iid']);

      $type = $_REQUEST['tp'];
      $deleteError = "";

      if($type == 1){

        $response = $AdvertisementModel->deleteCustomerAds($adid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        

      }
      if($type == 2){

        $response = $AdvertisementModel->deleteManpowerAds($adid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        

      }
      if($type == 3){

        $response = $AdvertisementModel->deleteContractorAds($adid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        
      
      }
      

      $view = new View("Admin/admin_manageadvertisement", $data);
    }

    public function ComplaintDelete() {
      $employeeModel = new EmployeeModel();
      $customerModel = new CustomerModel();
      $contractorModel = new ContractorModel();
      $manpowerModel = new ManpowerModel();
      $ComplaintModel = new ComplaintModel();

      $cid = base64_decode($_REQUEST['cid']);
      $iid = base64_decode($_REQUEST['iid']);

      $type = $_REQUEST['tp'];
      $deleteError = "";

      if($type == 1){
        $response = $ComplaintModel->deleteCustomerComplaint($cid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $customerModel->getCustomerUserDetailsbyID($iid);
        $this->sendComplaintDeleteMail($userDetails->email);
        
      }
      if($type == 2){

        $response = $ComplaintModel->deleteManpowerComplaint($cid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $manpowerModel->getManpowerUserDetailsbyID($iid);
        $this->sendComplaintDeleteMail($userDetails->email);

      }
      if($type == 3){

        $response = $ComplaintModel->deleteContractorComplaint($cid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $contractorModel->getContractorUserDetailsbyID($iid);
        $this->sendComplaintDeleteMail($userDetails->email);
      
      }
      if($type == 4){

        $response = $ComplaintModel->deleteEmployeeComplaint($cid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $employeeModel->getEmployeeUserDetailsbyID($iid);
        $this->sendComplaintDeleteMail($userDetails->email);
      }

      $view = new View("Admin/admin_managecomplaint", $data);
    }

    public function HelpDelete() {
      $employeeModel = new EmployeeModel();
      $customerModel = new CustomerModel();
      $contractorModel = new ContractorModel();
      $manpowerModel = new ManpowerModel();
      $HelpRequestModel = new HelpRequestModel();

      $hid = base64_decode($_REQUEST['hid']);
      $iid = base64_decode($_REQUEST['iid']);

      $type = $_REQUEST['tp'];
      $deleteError = "";

      if($type == 1){
        $response = $HelpRequestModel->deleteCustomerHelp($hid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $customerModel->getCustomerUserDetailsbyID($iid);
        $this->sendHelpDeleteMail($userDetails->email);
        
      }
      if($type == 2){

        $response =  $HelpRequestModel->deleteManpowerHelp($hid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $manpowerModel->getManpowerUserDetailsbyID($iid);
        $this->sendHelpDeleteMail($userDetails->email);

      }
      if($type == 3){

        $response = $HelpRequestModel->deleteContractorHelp($hid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $contractorModel->getContractorUserDetailsbyID($iid);
        $this->sendHelpDeleteMail($userDetails->email);
      
      }
      if($type == 4){

        $response =  $HelpRequestModel->deleteEmployeeHelp($hid);
        if($response){
          $data['response'] = 'Record has been deleted sucessfully';
        }

        $userDetails = $employeeModel->getEmployeeUserDetailsbyID($iid);
        $this->sendHelpDeleteMail($userDetails->email);
      }

      $view = new View("Admin/admin_managehelp", $data);
    }

    public function sendComplaintDeleteMail($email){

      require './PHPMailer/src/Exception.php';
      require './PHPMailer/src/PHPMailer.php';
      require './PHPMailer/src/SMTP.php';

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
        $mail->Subject = 'The Complaint on Taskhub';
        $mail->Body    = "<h1>Response of your complaint</h1>
                          <p>Dear Customer,</p><br>
                          <p>We are sorry to hear about your complaint. One of our customer agent will contact you soon</p><br>
                          <p>Thank you</p><br>
                          <p>Taskhub Team</p>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
      }catch(Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }


    public function sendHelpDeleteMail($email){

      require './PHPMailer/src/Exception.php';
      require './PHPMailer/src/PHPMailer.php';
      require './PHPMailer/src/SMTP.php';

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
        $mail->Subject = 'The Request on Taskhub';
        $mail->Body    = "<h1>Response of your help request</h1>
                          <p>Dear Customer,</p><br>
                          <p>We always ready to help our valuable customers. Within few minutes our agent will contact you to solve your problems. Untill that be in touch with our Taskhub</p><br>
                          <p>Thank you</p><br>
                          <p>Taskhub Team</p>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
      }catch(Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
  
 
}