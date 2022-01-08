<?php
require_once ROOT . "/Database.php";

class ContractorProfileModel extends Database {

    public function contractorProfileEdUp($fn,$ln,$nic,$addr,$cont,$bio,$dob,$cardno,$cvv,$exp,$dataEdit){
        print("Are we there 22");
        if(!empty($dataEdit) && $dataEdit=='submitted'){

            echo('Hello.');

            $userID = $_SESSION['loggedin']['user_id'];
        
            $sql = "UPDATE contractors SET FirstName = '$fn', LastName = '$ln', NIC = '$nic', Address = '$addr', phone = '$cont', bio = '$bio', 
                    Date_of_Birth = '$dob', Account_No = '$cardno', Expiry_Date = '$exp', CVN = '$cvv' WHERE user_id = '$userID'";
            print($sql);
            if($this->con->query($sql)){
                return true;
            }else{
                return false;
            } 
        }    
    } 
}