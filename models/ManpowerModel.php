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

  public function getManpowerOwnAd($ManID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT MANAD.* FROM manpoweradvertisement MANAD 
              WHERE MANAD.Manpower_Agency_ID='$ManID'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT * FROM manpoweradvertisement MANAD
            WHERE MANAD.Manpower_Agency_ID='$ManID'
            ORDER BY Date DESC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
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


  
  public function getManpowerByID($id) {
    $sql = "SELECT *, Manpower_Agency_ID AS IID, Company_Name AS ProfileFullName FROM manpower_agency WHERE Manpower_Agency_ID='$id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }
  
  public function getManPowerProfiles($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "MP.Manpower_Agency_ID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(MP.Company_Name) LIKE '%$search%'";
    }

    if($where['area'] != ""){
      $area = strtolower($where['area']);
      $where_cls .= " AND LOWER(MP.District) = '" . $area . "'";
    }

    if($where['role'] != ""){
      $role = strtolower($where['role']);
      $where_cls .= " AND LOWER(MP.specialization) = '" . $role . "'";
    }
    
    if($count == true){
      $sql = "SELECT MP.* FROM manpower_agency MP WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT MP.*, MP.Manpower_Agency_ID AS IID, MP.Company_Name AS ProfileFullName FROM manpower_agency MP 
            WHERE $where_cls 
            ORDER by MP.Manpower_Agency_ID ASC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getManpowerWorkHistory($ManID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT MB.* FROM manpower_booking MB 
              WHERE MB.Manpower_Agency_ID='$ManID' AND MB.Is_work_done='Yes'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT MB.*, M.Company_Name AS CusFullName FROM manpower_booking MB
            INNER JOIN manpower_agency M ON MB.Manpower_Agency_ID=M.Manpower_Agency_ID 
            WHERE MB.Manpower_Agency_ID='$ManID' AND MB.Is_work_done='Yes'
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function updateManpower($id, $updateManpowerDetails){

    $CompanyName = $updateManpowerDetails['CompanyName'];
    $regno = $updateManpowerDetails['Company_Registration_No'];
    $phoneNum = $updateManpowerDetails['Contact_No'];
    $address = $updateManpowerDetails['Address'];
    $district = $updateManpowerDetails['District'];
    $ratehrs = $updateManpowerDetails['Payment_for_2hours'];
    $experience = $updateManpowerDetails['Year_of_experience'];
    $bank = $updateManpowerDetails['Name_of_Bank'];
    $accnum = $updateManpowerDetails['Account_Number'];
    $workers = $updateManpowerDetails['workers'];
    $bio = $updateManpowerDetails['bio'];
    $owner = $updateManpowerDetails['Owner'];


    $sql = "UPDATE manpower_agency
            SET Company_Name = '$CompanyName',
            Company_Registration_No = '$regno',
            Address = '$address',
            District = '$district',
            years_of_experience = '$experience',
            Payment_for_2hours = '$ratehrs',
            Contact_No = '$phoneNum',
            No_of_workers = '$workers',
            bank = '$bank',
            owner = '$owner',
            Account_No = '$accnum',
            bio = '$bio'
            WHERE Manpower_Agency_ID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function updateProfileImage($id, $imgContent){
    $sql = "UPDATE manpower_agency 
            SET image='$imgContent' 
            WHERE Manpower_Agency_ID='$id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteManpower($id){
    $sql = "DELETE FROM manpower_agency
            WHERE Manpower_Agency_ID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteManpowerFromUser($id){
    $sql = "DELETE FROM users
            WHERE id = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function getManpowerUserDetailsbyID($id) {
    $sql = "SELECT U.* FROM users U
            INNER JOIN manpower_agency MA ON U.id=MA.user_id
            WHERE MA.Manpower_Agency_ID ='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function updateRating($user_id, $rating){
    $sql = "UPDATE manpower_agency
            SET rating= $rating
            WHERE user_id='$user_id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

}