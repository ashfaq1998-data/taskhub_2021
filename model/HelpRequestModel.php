<?php

require_once ROOT . "/Database.php";

class HelpRequestModel extends Database {

  //for now for profile section
  public function generateEmployeeHelpID() {
   $str_part = "req";
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
}