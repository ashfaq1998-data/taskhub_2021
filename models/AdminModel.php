<?php

require_once ROOT . "/Database.php";

class AdminModel extends Database {

  //for now for profile section
  

  public function getEmployeeDetails($limit = 0, $start = 0, $count = false, $where = array()){
    $where_cls = "E.EmployeeID IS NOT NULL";

    if($where['search'] != ""){
      $search = strtolower($where['search']);
      $where_cls .= " AND LOWER(E.Specialized_area) LIKE '%" . $search . "%'";
    }

    if($count == true){
      $sql = "SELECT * FROM employee E WHERE $where_cls";
      
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT E.*, E.EmployeeID AS IID FROM employee E
            WHERE $where_cls 
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function totalusers(){
    $sql = "SELECT * FROM users";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalcustomers(){
    $sql = "SELECT * FROM customer";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalcontractors(){
    $sql = "SELECT * FROM contractors";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalmanpowers(){
    $sql = "SELECT * FROM manpower_agency";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalemployees(){
    $sql = "SELECT * FROM employee";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalemployeecomplaint(){
    $sql = "SELECT * FROM employee_complaint";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalmanpowercomplaint(){
    $sql = "SELECT * FROM manpower_complaint";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalcontractorcomplaint(){
    $sql = "SELECT * FROM contractor_complaint";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalcustomercomplaint(){
    $sql = "SELECT * FROM customer_complaint";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalcustomerhelp(){
    $sql = "SELECT * FROM customer_help_request";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalemployeehelp(){
    $sql = "SELECT * FROM employee_help_request";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalcontractorhelp(){
    $sql = "SELECT * FROM contractor_help_request";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalmanpowerhelp(){
    $sql = "SELECT * FROM manpower_help_request";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalmanpowerbook(){
    $sql = "SELECT * FROM manpower_booking";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalemployeebook(){
    $sql = "SELECT * FROM employee_booking";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function totalcontractorbook(){
    $sql = "SELECT * FROM contractor_booking";
      
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->rowCount();
    
    return $data;
  }

  public function getCustomerDetails($limit = 0, $start = 0, $count = false, $where = array()){
    $where_cls = "C.CustomerID IS NOT NULL";

    if($where['search'] != ""){
      $search = strtolower($where['search']);
      $where_cls .= " AND LOWER(C.FirstName) LIKE '%" . $search . "%'";
    }

    if($count == true){
      $sql = "SELECT * FROM customer C WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT C.*, C.CustomerID AS IID FROM customer C
            WHERE $where_cls 
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getContractorDetails($limit = 0, $start = 0, $count = false, $where = array()){
    $where_cls = "C.Contractor_ID IS NOT NULL";

    if($where['search'] != ""){
      $search = strtolower($where['search']);
      $where_cls .= " AND LOWER(C.specialization) LIKE '%" . $search . "%'";
    }

    if($count == true){
      $sql = "SELECT * FROM contractors C WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT C.*, C.Contractor_ID AS IID FROM contractors C
            WHERE $where_cls 
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }


  public function getManpowerDetails($limit = 0, $start = 0, $count = false, $where = array()){
    $where_cls = "M.Manpower_Agency_ID IS NOT NULL";

    if($where['search'] != ""){
      $search = strtolower($where['search']);
      $where_cls .= " AND LOWER(M.Company_Name) LIKE '%" . $search . "%'";
    }

    if($count == true){
      $sql = "SELECT * FROM manpower_agency M WHERE $where_cls";
      
      $query = $this->con->query($sql);
      $query->execute();
      return $query->rowCount();
    }

    $sql = "SELECT M.*, M.Manpower_Agency_ID AS IID FROM manpower_agency M
            WHERE $where_cls 
            LIMIT $start,$limit"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

}

