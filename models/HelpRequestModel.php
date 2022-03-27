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
    $str_part = "contreq";
    $request_id = "";
 
    while(true){
        $num_part = rand(100,999);
        $request_id = $str_part.strval($num_part);

        $sql = "SELECT * FROM contractor_help_request WHERE RequestID='$request_id'";
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
    $subject = $contractorHelp['Subject'];
    $message = $contractorHelp['Content'];
    $contractorID = $contractorHelp['Contractor_ID'];
    
    
    $sql = " INSERT INTO contractor_help_request (RequestID, Date, Subject , Content, Contractor_ID) 
            VALUES ('$RequestId', '$date', '$subject', '$message', '$contractorID')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  public function generateManpowerHelpID() {
      $str_part = "manreq";
      $request_id = "";
   
      while(true){
          $num_part = rand(100,999);
          $request_id = $str_part.strval($num_part);
   
          $sql = "SELECT * FROM manpower_help_request WHERE RequestID='$request_id'";
          $query = $this->con->query($sql);
          $query->execute();
   
          if ($query->rowCount() == 0){
            break;
         }
      }
      return $request_id;
  }
   
   
  public function addNewManpowerHelp($manpowerHelp) {
       $RequestId = $manpowerHelp['RequestID'];
       $date = $manpowerHelp['Date'];
       $subject = $manpowerHelp['Subject'];
       $message = $manpowerHelp['Content'];
       $manID = $manpowerHelp['Manpower_Agency_ID'];
       
       
       $sql = " INSERT INTO manpower_help_request (RequestID, Date, Subject , Content, Manpower_Agency_ID) 
               VALUES ('$RequestId', '$date', '$subject', '$message', '$manID')";
   
       if($this->con->query($sql)){
           return true;
       }else{
           return false;
       }
   
  }

  public function getCustomerHelp($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "CUSHELP.RequestID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(CUSHELP.Subject) LIKE '%" . $search . "%'";
    }
    


    if($count == true){
      $sql = "SELECT CUSHELP.* FROM customer_help_request CUSHELP WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT CUSHELP.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName , C.CustomerID AS IID, CUSHELP.RequestID AS HID, C.Contact_No AS phone FROM customer_help_request CUSHELP
            INNER JOIN customer C ON CUSHELP.CustomerID=C.CustomerID 
            WHERE $where_cls 
            ORDER by CUSHELP.Date DESC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getEmployeeHelp($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "EMPHELP.RequestID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(EMPHELP.Subject) LIKE '%" . $search . "%'";
    }
    


    if($count == true){
      $sql = "SELECT EMPHELP.* FROM employee_help_request EMPHELP WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT EMPHELP.*, CONCAT(E.FirstName, ' ', E.LastName) AS CusFullName, E.EmployeeID AS IID, EMPHELP.RequestID AS HID, E.Contact_No AS phone FROM employee_help_request EMPHELP
            INNER JOIN employee E ON EMPHELP.EmployeeID=E.EmployeeID 
            WHERE $where_cls 
            ORDER by EMPHELP.Date DESC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getManpowerHelp($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "MANHELP.RequestID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(MANHELP.Subject) LIKE '%" . $search . "%'";
    }
    


    if($count == true){
      $sql = "SELECT MANHELP.* FROM manpower_help_request MANHELP WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT MANHELP.*, M.Company_Name AS CusFullName, M.Manpower_Agency_ID AS IID, MANHELP.RequestID AS HID, M.Contact_No AS phone FROM manpower_help_request MANHELP
            INNER JOIN manpower_agency M ON MANHELP.Manpower_Agency_ID=M.Manpower_Agency_ID 
            WHERE $where_cls 
            ORDER by MANHELP.Date DESC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getContractorHelp($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "CONHELP.RequestID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(CONHELP.Subject) LIKE '%" . $search . "%'";
    }
    


    if($count == true){
      $sql = "SELECT CONHELP.* FROM contractor_help_request CONHELP WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT CONHELP.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName, C.Contractor_ID AS IID, CONHELP.RequestID AS HID, C.phone AS phone FROM contractor_help_request CONHELP
            INNER JOIN contractors C ON CONHELP.Contractor_ID=C.Contractor_ID 
            WHERE $where_cls 
            ORDER by CONHELP.Date DESC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function deleteCustomerHelp($id){
    $sql = "DELETE FROM customer_help_request
            WHERE RequestID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
}

public function deleteManpowerHelp($id){
    $sql = "DELETE FROM manpower_help_request
            WHERE RequestID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
}

public function deleteContractorHelp($id){
    $sql = "DELETE FROM contractor_help_request
            WHERE RequestID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
}

public function deleteEmployeeHelp($id){
    $sql = "DELETE FROM employee_help_request
            WHERE RequestID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
}


}