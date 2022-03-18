<?php

require_once ROOT . "/Database.php";

class CustomerModel extends Database {

  //for now for profile section
  public function getCustomerByUserID($user_id) {
    $sql = "SELECT * FROM customer WHERE user_id='$user_id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function addNewCustomer($customerDetails) {
    $customerId = $customerDetails['CustomerID'];
    $firstName = $customerDetails['FirstName'];
    $lastName = $customerDetails['LastName'];
    $nic = $customerDetails['NIC'];
    $phoneNum = $customerDetails['Contact_No'];
    $gender = $customerDetails['Gender'];
    $address = $customerDetails['Address'];
    $userId = $customerDetails['user_id'];

    $sql = "INSERT INTO customer (CustomerID, FirstName, LastName, NIC, Address, Contact_No, Gender, user_id) 
            VALUES ('$customerId', '$firstName', '$lastName', '$nic', '$address', '$phoneNum', '$gender', '$userId')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  public function getCustomerOwnAd($CusID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT CUSAD.* FROM customeradvertisement CUSAD 
              WHERE CUSAD.CustomerID='$CusID'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT * FROM customeradvertisement CUSAD
            WHERE CUSAD.CustomerID='$CusID'
            ORDER BY Date DESC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  

  public function generateCustomerID(){
    $str_part = "cust";
    $customer_id = "";
    
    while(true){
      $num_part = rand(100, 999);
      $customer_id = $str_part . strval($num_part);

      $sql = "SELECT * FROM customer WHERE CustomerID='$customer_id'";
      $query = $this->con->query($sql);
      $query->execute();

      if ($query->rowCount() == 0){
        break;
      }
    }
    return $customer_id;
  }

  

  public function getCustomerByID($id) {
    $sql = "SELECT *, CONCAT(FirstName, ' ', LastName) AS ProfileFullName FROM customer WHERE CustomerID ='$id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }


  public function getCustomerProfiles($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "C.CustomerID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(C.FirstName) LIKE '%$search%' OR LOWER(C.LastName) LIKE '%$search%'";
    }
    
    if($count == true){
      $sql = "SELECT C.* FROM customer C WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT C.*, C.CustomerID AS IID, CONCAT(C.FirstName, ' ', C.LastName) AS ProfileFullName FROM customer C 
            WHERE $where_cls 
            ORDER by C.CustomerID ASC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getCustomerEmployeeWorkHistory($CusID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT EB.* FROM employee_booking EB 
              WHERE EB.CustomerID='$CusID' AND EB.Is_work_done='Yes'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT EB.*, CONCAT(E.FirstName, ' ', E.LastName) AS EmpFullName FROM employee_booking EB
            INNER JOIN employee E ON EB.EmployeeID=E.EmployeeID 
            WHERE EB.CustomerID='$CusID' AND EB.Is_work_done='Yes'
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getCustomerContractorWorkHistory($CusID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT ConB.* FROM contractor_booking ConB 
              WHERE ConB.CustomerID='$CusID' AND ConB.Is_work_done='Yes'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT ConB.*, CONCAT(Con.FirstName, ' ', Con.LastName) AS EmpFullName FROM contractor_booking ConB
            INNER JOIN contractors Con ON ConB.Contractor_ID=Con.Contractor_ID 
            WHERE ConB.CustomerID='$CusID' AND ConB.Is_work_done='Yes'
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getCustomerManpowerWorkHistory($CusID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT MB.* FROM manpower_booking MB 
              WHERE MB.CustomerID='$CusID' AND MB.Is_work_done='Yes'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT MB.*, M.Company_Name AS EmpFullName FROM manpower_booking MB
            INNER JOIN manpower_agency M ON MB.Manpower_Agency_ID=M.Manpower_Agency_ID
            WHERE MB.CustomerID='$CusID' AND MB.Is_work_done='Yes'
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function updateCustomer($id, $updateCustomerDetails){

    $firstName = $updateCustomerDetails['FirstName'];
    $lastName = $updateCustomerDetails['LastName'];
    $nic = $updateCustomerDetails['NIC'];
    $phoneNum = $updateCustomerDetails['Contact_No'];
    $gender = $updateCustomerDetails['Gender'];
    $dob = $updateCustomerDetails['Date_of_Birth'];
    $address = $updateCustomerDetails['Address'];
    $district = $updateCustomerDetails['District'];
    $accnum = $updateCustomerDetails['Card_Number'];
    $expdate = $updateCustomerDetails['Expiry_Date'];
    $bio = $updateCustomerDetails['bio'];
    $cvn = $updateCustomerDetails['cvn'];

    $sql = "UPDATE customer
            SET FirstName = '$firstName',
            LastName = '$lastName',
            NIC = '$nic',
            Address = '$address',
            District = '$district',
            Gender = '$gender',
            Date_of_Birth = '$dob',
            Contact_No = '$phoneNum',
            Card_Number = '$accnum',
            Expiry_Date = '$expdate',
            bio = '$bio',
            CVN = '$cvn'
            WHERE CustomerID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function updateProfileImage($id, $imgContent){
    $sql = "UPDATE customer
            SET image='$imgContent' 
            WHERE CustomerID='$id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteCustomer($id){
    $sql = "DELETE FROM customer
            WHERE CustomerID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteCustomerFromUser($id){
    $sql = "DELETE FROM users
            WHERE id = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function getCustomerUserDetailsbyID($id) {
    $sql = "SELECT U.* FROM users U
            INNER JOIN customer C ON U.id=C.user_id
            WHERE C.CustomerID='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }
  
  public function updateRating($user_id, $rating){
    $sql = "UPDATE customer
            SET rating= $rating
            WHERE user_id='$user_id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  



}

