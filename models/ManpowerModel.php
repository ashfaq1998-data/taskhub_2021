<?php

require_once ROOT . "/Database.php";

class ManpowerModel extends Database {

  //for now for profile section
  public function getManpowerByUserID($user_id) {
    $sql = "SELECT * FROM manpower WHERE user_id='$user_id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function addNewManpower($manpowerDetails) {
    $manpowerId = $manpowerDetails['Manpower_ID'];
    $firstName = $manpowerDetails['FirstName'];
    $lastName = $manpowerDetails['LastName'];
    $nic = $manpowerDetails['NIC'];
    $phoneNum = $manpowerDetails['Contact_No'];
    $specialization = $manpowerDetails['Specialized_area'];
    $userId = $manpowerDetails['user_id'];

    $sql = "INSERT INTO manpowerAgency (Contractor_ID, FirstName, LastName, NIC, phone, specialization, user_id) 
            VALUES ('$manpowerId', '$firstName', '$lastName', '$nic', '$phoneNum', '$specialization', '$userId')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  

  public function generateManpowerID(){
    $str_part = "con";
    $manpower_id = "";
    
    while(true){
      $num_part = rand(100, 999);
      $manpower_id = $str_part . strval($num_part);

      $sql = "SELECT * FROM manpowerAgency WHERE Manpower_ID='$manpower_id'";
      $query = $this->con->query($sql);
      $query->execute();

      if ($query->rowCount() == 0){
        break;
      }
    }
    return $manpower_id;
  }


  

  



}