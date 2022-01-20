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

  

  public function searchResults($keyword) {
    $sql = "SELECT * FROM employee WHERE ((`FirstName` LIKE '%".$keyword."%') OR (`LastName` LIKE '%".$keyword."%') 
            OR (`Specialized_area` LIKE '%".$keyword."%'))";
    $query = $this->con->query($sql);
    $query->execute();
    for($i=0; $i<$query->rowCount(); $i++){
      $data[$i] = $query->fetch(PDO::FETCH_OBJ);
    }
    // $data = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 0){
        die('No results found for the keyword!!');
    }
    return  $data;
  }



  
  //post advertisement model
  public function customerPostad($customerPostad){
      $adID = $customerPostad['AdvertisementID'];
      $title = $customerPostad['Title'];
      $des = $customerPostad['Description'];
      $loc = $customerPostad['City'];
      $email = $customerPostad['Email'];
      $customerID = $customerPostad['CustomerID'];
  
      $sql = "INSERT INTO customeradvertisement (Title, Description, City, Email, CustomerID, AdvertisementID) 
              VALUES ('$title', '$des', '$loc', '$email', '$customerID', '$adID')";
      
      if($this->con->query($sql)){
          return true;
      }else{
          return false;
      }   
  }

  public function generateCustomerAdID(){
    $str_part = "ad";
    $ad_id = "";

    while(true){
        $num_part = rand(000,999);
        $ad_id = $str_part.strval($num_part);

        $sql = "SELECT * FROM customeradvertisement WHERE AdvertisementID = '$ad_id'";
        $query = $this->con->query($sql);
        $query->execute();

        if($query->rowCount() == 0){
            break;
        }
    }
    return  $ad_id;
  }

  public function getMyAdByCustomerID($cuID){

    $sql = "SELECT * FROM customeradvertisement WHERE CustomerID = '$cuID'";
    $query = $this->con->query($sql);
    $query->execute();
    for($i=0; $i<$query->rowCount(); $i++){
      $data[$i] = $query->fetch(PDO::FETCH_OBJ);
    }
    // $data = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 0){
        die('No advertisements are posted by yourself');
    }
    return  $data;
  }



  //newly added
  public function deleteMyAdID($adIDNo, $cuID){

    $sql = "DELETE FROM customeradvertisement WHERE AdvertisementID = '$adIDNo'";
    $query = $this->con->query($sql);
    $err = "";

    if($query->rowCount() > 0){
        $query->execute();
    }
    else {
      $err = 'No advertisements are posted by yourself';
    }


    $sql = "SELECT * FROM customeradvertisement WHERE CustomerID = '$cuID'";
    $query = $this->con->query($sql);
    $query->execute();
    for($i=0; $i<$query->rowCount(); $i++){
      $data[$i] = $query->fetch(PDO::FETCH_OBJ);
    }
    // $data = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 0){
        $err = 'No advertisements are posted by yourself';
    }
    $data['error'] = $err;

    return  $data;
  }




}

