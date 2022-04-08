<?php

require_once ROOT . "/Database.php";

class CustomerProfileModel extends Database {

    public function customerProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit){
        
        if(!empty($dataEdit) && $dataEdit=='submitted'){

            // echo('Hello.');

            $userID = $_SESSION['loggedin']['user_id'];
        
            $sql = "UPDATE customer SET FirstName = '$fn', LastName = '$ln', NIC = '$nic', Address = '$addr', Contact_No = '$cont', bio = '$bio', 
                    Date_of_Birth = '$dob', Card_Number = '$cardno', Expiry_Date = '$exp', CVN = '$cvv' WHERE user_id = '$userID'";
            
            if($this->con->query($sql)){
                return true;
            }else{
                return false;
            } 
        }
    }

    public function UpdateImage($imgContent, $userID){
    
        $sql = "UPDATE customer SET image = '$imgContent' WHERE user_id = '$userID'";
        
        if($this->con->query($sql)){

            return true;
        }else{
            return false;
        }
    }
}