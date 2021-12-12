<?php

require_once ROOT . "/Database.php";

class ContractorModel extends Database {

  //for now for profile section
  public function getContractorByUserID($user_id) {
    $sql = "SELECT * FROM contractors WHERE user_id='$user_id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function addNewContractor($contractorDetails) {
    $contractorId = $contractorDetails['Contractor_ID'];
    $firstName = $contractorDetails['FirstName'];
    $lastName = $contractorDetails['LastName'];
    $nic = $contractorDetails['NIC'];
    $phoneNum = $contractorDetails['Contact_No'];
    $specialization = $contractorDetails['Specialized_area'];
    $userId = $contractorDetails['user_id'];

    $sql = "INSERT INTO contractors (Contractor_ID, FirstName, LastName, NIC, phone, specialization, user_id) 
            VALUES ('$contractorId', '$firstName', '$lastName', '$nic', '$phoneNum', '$specialization', '$userId')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  

  public function generateContractorID(){
    $str_part = "con";
    $contractor_id = "";
    
    while(true){
      $num_part = rand(100, 999);
      $contractor_id = $str_part . strval($num_part);

      $sql = "SELECT * FROM contractors WHERE Contractor_ID='$contractor_id'";
      $query = $this->con->query($sql);
      $query->execute();

      if ($query->rowCount() == 0){
        break;
      }
    }
    return $contractor_id;
  }


  

  



}