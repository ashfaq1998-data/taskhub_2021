<?php

require_once ROOT . "/Database.php";

class HelpRequestModel extends Database {

  //for now for profile section
  public function generateEmployeeHelpID() {
   $str_part = "emreq";
   $request_id = "";

   while(true){
       $num_part = rand(100,999);
       $request_id = $str_part.strval($num_part);

       $sql = "SELECT * FROM employee_help_request WHERE RequestID='$request_id'";
       $query = $this->con->query($sql);
       $query->execute();

       if ($query->rowCount() == 0){
         break;
      }
   }
   return $request_id;
  }


  public function addNewEmployeeHelp($employeeHelp) {
    $RequestId = $employeeHelp['RequestID'];
    $date = $employeeHelp['Date'];
    $subject = $employeeHelp['Subject'];
    $message = $employeeHelp['Content'];
    $empID = $employeeHelp['EmployeeID'];
    
    
    $sql = " INSERT INTO employee_help_request (RequestID, Date, Subject , Content, EmployeeID) 
            VALUES ('$RequestId', '$date', '$subject', '$message', '$empID')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }


  public function generateCustomerHelpID() {
    $str_part = "custreq";
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
    $subject = $customerHelp['Subject'];
    $message = $customerHelp['Content'];
    $customerID = $customerHelp['CustomerID'];
    
    
    $sql = " INSERT INTO customer_help_request (RequestID, Date, Subject , Content, CustomerID) 
            VALUES ('$RequestId', '$date', '$subject', '$message', '$customerID')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  public function generateContractorHelpID() {
    $str_part = "conreq";
    $request_id = "";

    while(true){
        $num_part = rand(100,999);
        $request_id = $str_part.strval($num_part);

        $sql = "SELECT * FROM contractor_help WHERE RequestID='S$request_id'";
        $query = $this->con->query($sql);
        $query->execute();

        if ($query->rowCount() == 0){
          break;
      }
    }
    return $request_id;
  }

  public function addNewContractorHelp($contractorHelp) {
    $RequestId = $contractorHelp['RequestID'];
    $date = $contractorHelp['Date'];
    $subject = $contractorHelp['subject'];
    $description = $contractorHelp['description'];
    $contractorID = $contractorHelp['Contractor_ID'];
    
    
    $sql = " INSERT INTO contractor_help (RequestID, Date, Subject , description, Contractor_ID) 
            VALUES ('$RequestId', '$date', '$subject', '$description', '$contractorID')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

}