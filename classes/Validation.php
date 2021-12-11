<?php 

class Validation{

    

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


}

?>
