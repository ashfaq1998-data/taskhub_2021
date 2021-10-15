<?php
session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/model/AuthModel.php';

require_once ROOT . '/model/EmployeeModel.php';
require_once ROOT . '/model/UsersModel.php';
require_once ROOT . '/model/ContractorModel.php';
require_once ROOT . '/model/CustomerModel.php';
require_once ROOT . '/model/ManpowerModel.php';
require_once ROOT . '/classes/Validation.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// class AuthController {

//   public function login() {  
//     if(!empty($_POST['login'] && $_POST['login'] == 'submitted') ){

//       $username = $_POST['username'];
//       $password = $_POST['password'];
// 	    $loginError = "";

//       //validate input fields
//       if(empty($username)){
//         $loginError = "Please enter a username.";
//       }else if(empty($password)){
//         $loginError = "Please enter a password.";
//       }

//       //checking inputs
//       if($loginError == ""){
//         if($username == "udesh" && $password == "udesh123"){
//           $_SESSION['loggedin'] = ['user_type' => 'Customer','username' => $username];
//           $loginError = "none";
//           header('location: ' . fullURLfront . '/Customer/customer_dashboard');
//         }else{
//           $loginError = "Incorrect username or password";
//         }
//       }
//       $data['loginError'] = $loginError;
//     }
//     $view = new View("auth/login", $data);
//   }
  


//   public function employeeRegister(){
//     $view = new View("auth/employee_register");
//   }

//   public function customerRegister(){
//     $view = new View("auth/customer_register");
//   }

//   public function forgotPassword(){
//     $view = new View("auth/forgot_password");
//   }
  
// }



class AuthController {

  public function login() {  
	$authModel = new AuthModel();
	$employeeModel = new EmployeeModel();
	$contractorModel = new ContractorModel();
	$customerModel = new CustomerModel();

    if(!empty($_POST['login'] && $_POST['login'] == 'submitted') ){

		$data['inputted_data'] = $_POST;
    	$email = $_POST['email'];
      	$password = $_POST['password'];
	    $loginError = "";

		//validate input fields
		if(empty($email)){
			$loginError = "Please enter a email.";
		}else if(empty($password)){
			$loginError = "Please enter a password.";
		}

		//checking inputs
		if($loginError == ""){
			$loggedInUser = $authModel->login($email, $password);			
			if($loggedInUser){
				if ($loggedInUser->user_type_id == 1) { 
					
					$_SESSION['loggedin'] = [
					'user_type' => 'ADMIN', 
					'user_id' => $loggedInUser->id, 
					'username' => '', 
					'email' => $loggedInUser->email
					];
					$loginError = "none";
					header('location: ../nutritionist/dashboard');

				}else if ($loggedInUser->user_type_id == 2) {
					$loggedInCustomer = $customerModel->getCustomerByUserID($loggedInUser->id);
					$_SESSION['loggedin'] = [
					'user_type' => 'CUSTOMER', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInCustomer->FirstName." ".$loggedInCustomer->LastName, 
					'email' => $loggedInUser->email
					];
					$loginError = "none";
					header('location: ' . fullURLfront . '/Customer/customer_profile');

				}else if ($loggedInUser->user_type_id == 3) {
					$loggedInEmployee = $employeeModel->getEmployeeByUserID($loggedInUser->id);
				
					$_SESSION['loggedin'] = [
					'user_type' => 'EMPLOYEE', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInEmployee->FirstName. " ".$loggedInEmployee->LastName, 
					'email' => $loggedInUser->email
					];
					$loginError = "none";
					header('location: ' . fullURLfront . '/Employee/employee_profile');

				}else if ($loggedInUser->user_type_id == 4) {
					
					$_SESSION['loggedin'] = [
					'user_type' => 'MANPOWER', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInUser->email, 
					'email' => $loggedInUser->email
					];
					$loginError = "none";
					header('location: ../nutritionist/dashboard');

				}else if ($loggedInUser->user_type_id == 5) {
					$loggedInContractor = $contractorModel->getContractorByUserID($loggedInUser->id);
					$_SESSION['loggedin'] = [
					'user_type' => 'CONTRACTOR', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInContractor->FirstName. " ".$loggedInContractor->LastName, 
					'email' => $loggedInUser->email
					];
					$loginError = "none";
					header('location: ../Contractor/contractor_profile');

				}
				return;
			}else{
				$loginError = "Incorrect email or password";
			}
		}
    	$data['loginError'] = $loginError;
    }
    $view = new View("auth/login", $data);
  }



  public function employeeRegister(){
	$validation = new Validation();
	$authModel = new AuthModel();
	$employeeModel = new EmployeeModel();
	$usersModel = new UsersModel();
	$data['specialization_list'] = ['Specialized For', 'Plumbing', 'Carpentry', 'Electrical', 'Mason', 'Painting', 'Gardening'];

	if(!empty($_POST['employee_register'] && $_POST['employee_register'] == 'submitted') ){
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
                header('location: ' . fullURLfront . '/auth/login');
            } else {
                die('Something went wrong.');
            }
		}
		$data['registerError'] = $registerError;
	}
	$view = new View("auth/employee_register", $data);
  }


  public function contractorRegister(){
	$validation = new Validation();
	$authModel = new AuthModel();
	$contractorModel = new ContractorModel();
	$usersModel = new UsersModel();
	$data['specialization_list'] = ['Specialized For', 'Plumbing', 'Carpentry', 'Electrical', 'Mason', 'Painting', 'Gardening'];

	if(!empty($_POST['contractor_register'] && $_POST['contractor_register'] == 'submitted') ){
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
                header('location: ' . fullURLfront . '/auth/login');
            } else {
                die('Something went wrong.');
            }
		}
		$data['registerError'] = $registerError;
	}
	$view = new View("auth/contractor_register", $data);
  }

  public function customerRegister(){
	$validation = new Validation();
	$authModel = new AuthModel();
	$customerModel = new CustomerModel();
	$usersModel = new UsersModel();
	$data['gender'] = ['Male','Female'];

	if(!empty($_POST['customer_register'] && $_POST['customer_register'] == 'submitted') ){
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
                header('location: ' . fullURLfront . '/auth/login');
            } else {
                die('Something went wrong.');
            }
		}
		$data['registerError'] = $registerError;
	}
	$view = new View("auth/customer_register", $data);
  }

  public function manpowerRegister(){
	$validation = new Validation();
	$authModel = new AuthModel();
	$manpowerModel = new ManpowerModel();
	$usersModel = new UsersModel();
	

	if(!empty($_POST['manpower_register'] && $_POST['manpower_register'] == 'submitted') ){
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
                header('location: ' . fullURLfront . '/auth/login');
            } else {
                die('Something went wrong.');
            }
		}
		$data['registerError'] = $registerError;
	}
	$view = new View("auth/manpower_register", $data);
  }


  public function forgotPassword(){
    $view = new View("auth/forgot_password");
  }

  
  
}