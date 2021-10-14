<?php

require_once ROOT . "/Database.php";

class EmployeeModel extends Database {

  //for now for profile section
  public function getEmployeeByUserID($user_id) {
    $sql = "SELECT * FROM employee WHERE user_id='$user_id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function addNewEmployee($employeeDetails) {
    $employeeId = $employeeDetails['EmployeeID'];
    $firstName = $employeeDetails['FirstName'];
    $lastName = $employeeDetails['LastName'];
    $nic = $employeeDetails['NIC'];
    $phoneNum = $employeeDetails['Contact_No'];
    $specialization = $employeeDetails['Specialized_area'];
    $userId = $employeeDetails['user_id'];

    $sql = "INSERT INTO employee (EmployeeID, FirstName, LastName, NIC, Contact_No, Specialized_area, user_id) 
            VALUES ('$employeeId', '$firstName', '$lastName', '$nic', '$phoneNum', '$specialization', '$userId')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  public function generateEmployeeID(){
    $str_part = "emp";
    $emp_id = "";
    
    while(true){
      $num_part = rand(100, 999);
      $emp_id = $str_part . strval($num_part);

      $sql = "SELECT * FROM employee WHERE EmployeeID='$emp_id'";
      $query = $this->con->query($sql);
      $query->execute();

      if ($query->rowCount() == 0){
        break;
      }
    }
    return $emp_id;
  }

  public function getEmployeeWorkHistory($EmpID, $limit = 0, $start = 0, $count = false){
    if($count == true){
      $sql = "SELECT EB.* FROM employee_booking EB 
              WHERE EB.EmployeeID='$EmpID' AND EB.Is_work_done='Yes'";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT EB.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM employee_booking EB
            INNER JOIN customer C ON EB.CustomerID=C.CustomerID 
            WHERE EB.EmployeeID='$EmpID' AND EB.Is_work_done='Yes'
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }


  

  



}

