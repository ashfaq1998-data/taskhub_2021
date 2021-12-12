<?php

require_once ROOT . "/Database.php";

class ManpowerModel extends Database {

  //for now for profile section
  public function getManpowerByUserID($user_id) {
    $sql = "SELECT * FROM manpower_agency WHERE user_id='$user_id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function addNewManpower($manpowerDetails) {
    $manpowerId = $manpowerDetails['Manpower_Agency_ID'];
    $companyName = $manpowerDetails['Company_Name'];
    $companyRegister = $manpowerDetails['Company_Registration_No'];
    $district = $manpowerDetails['District'];
    $address = $manpowerDetails['Address'];
    $phoneNum = $manpowerDetails['Contact_No'];
    $userId = $manpowerDetails['user_id'];

    $sql = "INSERT INTO manpower_agency (Manpower_Agency_ID, Company_Name, Company_Registration_No, District, Address, Contact_No, user_id) 
            VALUES ('$manpowerId', '$companyName', '$companyRegister', '$district', '$address', '$phoneNum', '$userId')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  

  public function generateManpowerID(){
    $str_part = "man";
    $manpower_id = "";
    
    while(true){
      $num_part = rand(100, 999);
      $manpower_id = $str_part . strval($num_part);

      $sql = "SELECT * FROM manpower_agency WHERE Manpower_Agency_ID='$manpower_id'";
      $query = $this->con->query($sql);
      $query->execute();

      if ($query->rowCount() == 0){
        break;
      }
    }
    return $manpower_id;
  }


  

  



}