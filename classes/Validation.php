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
        $passwordValidation = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
        if(strlen($password) < 8){
            $error = 'Password must be at least 8 characters';
        } 
        elseif (!preg_match("$passwordValidation", $password)) {
            $error = 'Password must have at least one numeric value and one'. "<br>" .  'uppercase and lowercase letter';
        }
        return $error;
    }

    public function validateConfirmPassword($password, $confirmPassword){
        $error = "";
        if ($password != $confirmPassword) {
            $error = 'Passwords do not match, please try again';
        }
        return $error;
    }

    public function validatePhoneNumber($phoneNum){
        $error = "";
        $phone_length = strlen($phoneNum);
        if($phone_length != 10 || !(is_numeric($phoneNum))) {
            $error = 'Please enter a valid phone number (ex: 0712233444)';
        }
        return $error;
    }

    public function validateNIC($nic){
        $error = "";
        $nic_length = strlen($nic);
        $oldNicValidation = "/^([0-9]{9}[v|V|x|X])/";
        $newNicValidation =  "/^([0-9]{12})/";
        if(!($nic_length <= 10) || !(preg_match($oldNicValidation, $nic))) {
            if(($nic_length > 12) || !(preg_match($newNicValidation, $nic))) {
                $error = 'Please enter a valid NIC (ex: 199800111222 or 980011222v/V/x/X)';
            }  
        }
        return $error;
    }

    public function validateGender($gender){
        $error = "";
        
        if($gender != "Male" || $gender != "Female") {
            $error = 'Please select the gender';
        }
        return $error;
    }

    
    public function validateName($name){
        $error = "";
        $nameValidation =  "/^[a-zA-z]*$/";
        if (!preg_match($nameValidation, $name)) {
            $error = 'Names should contain only alphabets (ex: John)';
        }
        
        return $error;
    }

}

?>