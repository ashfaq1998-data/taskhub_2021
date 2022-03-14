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

  public function getContractorWorkHistory($ConID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT CONB.* FROM contractor_booking CONB 
              WHERE CONB.Contractor_ID='$ConID' AND CONB.Is_work_done='Yes'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT CONB.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM contractor_booking CONB
            INNER JOIN customer C ON CONB.CustomerID=C.CustomerID 
            WHERE CONB.Contractor_ID='$ConID' AND CONB.Is_work_done='Yes'
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getContractorOwnAd($ConID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT CONAD.* FROM contractoradvertisement CONAD 
              WHERE CONAD.Contractor_ID='$ConID'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT * FROM contractoradvertisement CONAD
            WHERE CONAD.Contractor_ID='$ConID'
            ORDER BY Date DESC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }


  public function getContractorByID($id) {
    $sql = "SELECT *, Contractor_ID AS IID, CONCAT(FirstName, ' ', LastName) AS ProfileFullName FROM contractors WHERE Contractor_ID ='$id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function getContractorProfiles($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "CT.Contractor_ID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(CT.FirstName) LIKE '%$search%' OR LOWER(CT.LastName) LIKE '%$search%'";
    }

    if($where['area'] != ""){
      $area = strtolower($where['area']);
      $where_cls .= " AND LOWER(CT.District) = '" . $area . "'";
    }

    if($where['role'] != ""){
      $role = strtolower($where['role']);
      $where_cls .= " AND LOWER(CT.specialization) = '" . $role . "'";
    }
    
    if($count == true){
      $sql = "SELECT CT.* FROM contractors CT WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT CT.*, CT.Contractor_ID AS IID, CONCAT(CT.FirstName, ' ', CT.LastName) AS ProfileFullName FROM contractors CT 
            WHERE $where_cls 
            ORDER by CT.Contractor_ID ASC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }  

  public function updateContractor($id, $updateContractorDetails){

    $firstName = $updateContractorDetails['FirstName'];
    $lastName = $updateContractorDetails['LastName'];
    $nic = $updateContractorDetails['NIC'];
    $phoneNum = $updateContractorDetails['Contact_No'];
    $specialization = $updateContractorDetails['Specialized_area'];
    $gender = $updateContractorDetails['Gender'];
    $dob = $updateContractorDetails['Date_of_Birth'];
    $address = $updateContractorDetails['Address'];
    $district = $updateContractorDetails['District'];
    $ratehrs = $updateContractorDetails['Payment_for_2hours'];
    $experience = $updateContractorDetails['Year_of_experience'];
    $bank = $updateContractorDetails['Name_of_Bank'];
    $accnum = $updateContractorDetails['Account_Number'];
    $bio = $updateContractorDetails['bio'];

    $sql = "UPDATE contractors
            SET FirstName = '$firstName',
            LastName = '$lastName',
            NIC = '$nic',
            Address = '$address',
            District = '$district',
            specialization = '$specialization',
            years_of_experience = $experience,
            Gender = '$gender',
            Date_of_birth = '$dob',
            Payment_for_2hours = '$ratehrs',
            phone = '$phoneNum',
            BankName = '$bank',
            Account_No = '$accnum',
            bio = '$bio'
            WHERE Contractor_ID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function updateProfileImage($id, $imgContent){
    $sql = "UPDATE contractors 
            SET image='$imgContent' 
            WHERE Contractor_ID='$id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteContractor($id){
    $sql = "DELETE FROM contractors
            WHERE Contractor_ID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteContractorFromUser($id){
    $sql = "DELETE FROM users
            WHERE id = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function getContractorUserDetailsbyID($id) {
    $sql = "SELECT U.* FROM users U
            INNER JOIN contractors C ON U.id=C.user_id
            WHERE C.Contractor_ID='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function updateRating($user_id, $rating){
    $sql = "UPDATE contractors
            SET rating= $rating
            WHERE user_id='$user_id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }
}