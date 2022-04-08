<?php

require_once ROOT . "/Database.php";

class customerHelpModel extends Database {

  //for now for profile section
  public function generateCustomerHelpID() {
   $str_part = "req";
   $request_id = "";

   while(true){
       $num_part = rand(100,999);
       $request_id = $str_part.strval($num_part);

       $sql = "SELECT * FROM customer_help_request WHERE RequestID='$request_id'";
       $query = $this->con->query($sql);
       $query->execute();

       if ($query->rowCount() == 0){
         break;
      }
   }
   return $request_id;
  }


  public function addNewCustomerHelp($customerHelp) {
    $RequestId = $customerHelp['RequestID'];
    $date = $customerHelp['Date'];
    $email = $customerHelp['Email'];
    $message = $customerHelp['Content'];
    $name = $customerHelp['Name'];
    $cuID = $customerHelp['CustomerID'];
    
    
    $sql = "INSERT INTO customer_help_request (RequestID, Date, Email , Content, Subject, CustomerID) 
            VALUES ('$RequestId', '$date', '$email', '$message', '$name', '$cuID')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    } 

  }
}