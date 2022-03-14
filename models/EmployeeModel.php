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
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getEmployeeByID($id) {
    $sql =  "SELECT *, EmployeeID AS IID, CONCAT(FirstName, ' ', LastName) AS ProfileFullName FROM employee WHERE EmployeeID ='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }


  public function getEmployeeProfiles($limit = 0, $start = 0, $count = false, $where = array()){

    $where_cls = "E.EmployeeID IS NOT NULL";

    if($where['search'] != ""){
        $search = strtolower($where['search']);
        $where_cls .= " AND LOWER(E.FirstName) LIKE '%$search%' OR LOWER(E.LastName) LIKE '%$search%'";
    }
    if($where['area'] != ""){
      $area = strtolower($where['area']);
      $where_cls .= " AND LOWER(E.District) = '" . $area . "'";
    }

    if($where['role'] != ""){
      $role = strtolower($where['role']);
      $where_cls .= " AND LOWER(E.Specialized_area) = '" . $role . "'";
    }
    
    if($count == true){
      $sql = "SELECT E.* FROM employee E WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT E.*, E.EmployeeID AS IID, CONCAT(E.FirstName, ' ', E.LastName) AS ProfileFullName FROM employee E 
            WHERE $where_cls 
            ORDER by E.EmployeeID ASC
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function updateEmployee($id, $updateEmployeeDetails){

    $firstName = $updateEmployeeDetails['FirstName'];
    $lastName = $updateEmployeeDetails['LastName'];
    $nic = $updateEmployeeDetails['NIC'];
    $phoneNum = $updateEmployeeDetails['Contact_No'];
    $specialization = $updateEmployeeDetails['Specialized_area'];
    $gender = $updateEmployeeDetails['Gender'];
    $dob = $updateEmployeeDetails['Date_of_Birth'];
    $address = $updateEmployeeDetails['Address'];
    $district = $updateEmployeeDetails['District'];
    $ratehrs = $updateEmployeeDetails['Payment_for_2hours'];
    $experience = $updateEmployeeDetails['Year_of_experience'];
    $bank = $updateEmployeeDetails['Name_of_Bank'];
    $accnum = $updateEmployeeDetails['Account_Number'];
    $bio = $updateEmployeeDetails['bio'];

    $sql = "UPDATE employee
            SET FirstName = '$firstName',
            LastName = '$lastName',
            NIC = '$nic',
            Address = '$address',
            District = '$district',
            Specialized_area = '$specialization',
            Year_of_experience = $experience,
            Gender = '$gender',
            Date_of_Birth = '$dob',
            Payment_for_2hours = $ratehrs,
            Contact_No = '$phoneNum',
            Name_of_Bank = '$bank',
            Account_Number = '$accnum',
            bio = '$bio'
            WHERE EmployeeID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteEmployee($id){
    $sql = "DELETE FROM employee
            WHERE EmployeeID = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function deleteEmployeeFromUser($id){
    $sql = "DELETE FROM users
            WHERE id = '$id'";
            
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function updateProfileImage($id, $imgContent){
    $sql = "UPDATE employee 
            SET image='$imgContent' 
            WHERE EmployeeID='$id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function getEmployeeUserDetailsbyID($id) {
    $sql = "SELECT U.* FROM users U
            INNER JOIN employee E ON U.id=E.user_id
            WHERE E.EmployeeID='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function updateRating($user_id, $rating){
    $sql = "UPDATE employee
            SET rating= $rating
            WHERE user_id='$user_id'";

    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  



}

