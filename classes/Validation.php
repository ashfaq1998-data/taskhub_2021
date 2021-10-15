<?php 

class Validation{

    public function validateEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }

    public function validatePassword($password){
        $error = "";
        $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
        if(strlen($password) < 8){
            $error = 'Password must be at least 8 characters';
        } elseif (preg_match($passwordValidation, $password)) {
            $error = 'Password must be have at least one numeric value.';
        }
        return $error;
    }

    public function validateConfirmPassword($password, $confirmPassword){
        $error = "";
        if ($password != $confirmPassword) {
            $error = 'Passwords do not match, please try again.';
        }
        return $error;
    }

    public function validatePhoneNumber($phoneNum){
        $error = "";
        $phone_length = strlen($phoneNum);
        if($phone_length != 10 || !(is_numeric($phoneNum))) {
            $error = 'Please enter a valid phone number';
        }
        return $error;
    }

    public function validateGender($gender){
        $error = "";
        
        if($gender != "Male" || $gender != "Female") {
            $error = 'Please enter the gender';
        }
        return $error;
    }

    
    public function validateName($name){
        $error = "";
        $nameValidation =  "/^[a-zA-z]*$/";
        if (!preg_match($nameValidation, $name)) {
            $error = 'Names should contain only alphabets';
        }
        
        return $error;
    }

}

?>