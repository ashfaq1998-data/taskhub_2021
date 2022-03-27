<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();
require_once ROOT  . '/View.php';
require_once ROOT . '/models/AuthModel.php';
require_once ROOT . '/models/EmployeeModel.php';
require_once ROOT . '/models/UsersModel.php';
require_once ROOT . '/models/ContractorModel.php';
require_once ROOT . '/models/CustomerModel.php';
require_once ROOT . '/models/ManpowerModel.php';
require_once ROOT . '/classes/Validation.php';
class AuthController {

  public function login() {  
	$authModel = new AuthModel();
	$employeeModel = new EmployeeModel();
	$contractorModel = new ContractorModel();
	$customerModel = new CustomerModel();
	$manpowerModel = new ManpowerModel();

    if(!empty($_POST['login']) && $_POST['login'] == 'submitted' ){

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
					$split = explode("@", $loggedInUser->email);
					$username = $split[0];
					
					$_SESSION['loggedin'] = [
					'user_type' => 'ADMIN', 
					'user_id' => $loggedInUser->id, 
					'username' => $username, 
					'email' => $loggedInUser->email,
					'dashboard_link' => fullURLfront . '/Admin/admin_dashboard'
					];
					$loginError = "none";
					header('location: ' . fullURLfront . '/Admin/admin_dashboard');

				}else if ($loggedInUser->user_type_id == 2) {
					$loggedInCustomer = $customerModel->getCustomerByUserID($loggedInUser->id);
					$_SESSION['loggedin'] = [
					'user_type' => 'CUSTOMER', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInCustomer->FirstName." ".$loggedInCustomer->LastName, 
					'email' => $loggedInUser->email,
					'dashboard_link' => fullURLfront . '/Customer/customer_profile'
					];
					$loginError = "none";
					header('location: ' . fullURLfront . '/Customer/customer_profile');

				}else if ($loggedInUser->user_type_id == 3) {
					$loggedInEmployee = $employeeModel->getEmployeeByUserID($loggedInUser->id);
				
					$_SESSION['loggedin'] = [
					'user_type' => 'EMPLOYEE', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInEmployee->FirstName. " ".$loggedInEmployee->LastName, 
					'email' => $loggedInUser->email,
					'dashboard_link' => fullURLfront . '/Employee/employee_profile'
					];
					$loginError = "none";
					header('location: ' . fullURLfront . '/Employee/employee_profile');

				}else if ($loggedInUser->user_type_id == 4) {
					$loggedInManpower = $manpowerModel->getManpowerByUserID($loggedInUser->id);
					$_SESSION['loggedin'] = [
					'user_type' => 'MANPOWER', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInManpower->Company_Name,  
					'email' => $loggedInUser->email,
					'dashboard_link' => fullURLfront . '/Manpower/manpower_profile'
					];
					$loginError = "none";
					header('location: ' . fullURLfront . '/Manpower/manpower_profile');

				}else if ($loggedInUser->user_type_id == 5) {
					$loggedInContractor = $contractorModel->getContractorByUserID($loggedInUser->id);
					$_SESSION['loggedin'] = [
					'user_type' => 'CONTRACTOR', 
					'user_id' => $loggedInUser->id, 
					'username' => $loggedInContractor->FirstName. " ".$loggedInContractor->LastName, 
					'email' => $loggedInUser->email,
					'dashboard_link' => fullURLfront . '/Contractor/contractor_profile'
					];
					$loginError = "none";
					header('location: ' . fullURLfront . '/Contractor/contractor_profile');

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

	if(!empty($_POST['employee_register']) && $_POST['employee_register'] == 'submitted' ){
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

	if(!empty($_POST['contractor_register']) && $_POST['contractor_register'] == 'submitted' ){
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
				'user_id' => $userId,
				
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

	if(!empty($_POST['customer_register']) && $_POST['customer_register'] == 'submitted' ){
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
	

	if(!empty($_POST['manpower_register']) && $_POST['manpower_register'] == 'submitted'){
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
	require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

	$authModel = new AuthModel();

	if(!empty($_POST['forgot_password']) && $_POST['forgot_password'] == 'submitted'){

		$data['inputted_data'] = $_POST;
    	$email = $_POST['email'];
	    $error = "";

		//validate input fields
		if(empty($email)){
			$error = "Please enter an email";
		}else if(!$authModel->findUserByEmail($email)){
			$error = "Email not found";
		}

		if($error == ""){
        	$code = uniqid(true);

			if($authModel->updateVerificationCode($code,$email)){
				//Instantiation and passing `true` enables exceptions
				$mail = new PHPMailer(true);
				try {
					//Server settings
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
					
                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

					//Recipients
					$mail->setFrom('taskhub21@gmail.com', 'Taskhub');
					$mail->addAddress("$email");     //Add a recipient             

					//Content
					$url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/auth/reset_password?code=$code&email=$email";
					$mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = 'Your Password reset link';
					$mail->Body    = "<h1>You requested the password reset</h1>
										Click <a href=$url>this link</a> to reset password";
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->send();
					$data['success'] = 'Reset link is successfully send to your email.Please Check!';
				}catch (Exception $e){
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}           
			}
			
		}
		$data['error'] = $error;
	}
    $view = new View("auth/forgot_password", $data);
  }

  public function logout(){
	unset($_SESSION['loggedin']);
	header('Location: ' . fullURLfront . '/main/index');
	die();
  }

  public function resetPassword(){
	
	$authModel = new AuthModel();
	$validation = new Validation();
	
	if(!isset($_GET['code'])){
		exit("Cant Find Page");
	}
  
	$code = $_GET['code'];
	$email = $_GET['email'];

	$user = $authModel->getUserByEmail($email);
	if($user->verification_code != $code){
		exit("Cant Find Page");
	}
	
	if(!empty($_POST['reset_password']) && $_POST['reset_password'] == 'submitted'){

		$password = $_POST['password'];
		$confirmPassword = $_POST['confirm_password'];
		$error = "";

		//validate password
		if($error == ""){
			$error = $validation->validatePassword($password);
		}

		//validate password
		if($error == ""){
			$error = $validation->validateConfirmPassword($password, $confirmPassword);
		}

		if($error == ""){
			// Hashing the password to store password in db
            $password = password_hash($password, PASSWORD_DEFAULT);
			if($authModel->resetPassword($password,$email)){
				header('Location: ' . fullURLfront . '/main/index');
			}else {
				die('Something went wrong.');
			}
		}
		$data['error'] = $error;
	}

	$data['details'] = [
		'code' => $code,
		'email' => $email,
	];  

	$view = new View("auth/reset_password", $data);
  }
}