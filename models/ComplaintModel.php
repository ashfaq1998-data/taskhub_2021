<?php

require_once ROOT . "/Database.php";

class ComplaintModel extends Database {

    public function generateEmployeeComplaintID(){
        $str_part = "ecom";
        $complain_id = "";

        while(true){
            $num_part = rand(100,999);
            $complain_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM employee_complaint WHERE ComplaintID='$complain_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return  $complain_id;
    }

    public function addNewEmployeeComplaint($employeeComplaints){
        $ComplaintId = $employeeComplaints['ComplaintID'];
        $date = $employeeComplaints['Date'];
        $subject = $employeeComplaints['Subject'];
        $message = $employeeComplaints['Content'];
        $empID = $employeeComplaints['EmployeeID'];
        $rating = $employeeComplaints['Rates'];

        $sql = " INSERT INTO employee_complaint (ComplaintID, Date, Subject , Content, Rates, EmployeeID) 
            VALUES ('$ComplaintId', '$date', '$subject', '$message','$rating', '$empID')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function generateContractorComplaintID(){
        $str_part = "cocom";
        $complain_id = "";

        while(true){
            $num_part = rand(100,999);
            $complain_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM contractor_complaint WHERE ComplaintID='$complain_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return  $complain_id;
    }

    public function addNewContractorComplaint($contractorComplaints){
        $ComplaintId = $contractorComplaints['ComplaintID'];
        $date = $contractorComplaints['Date'];
        $subject = $contractorComplaints['Subject'];
        $message = $contractorComplaints['Content'];
        $contID = $contractorComplaints['Contractor_ID'];
        $rating = $contractorComplaints['Rates'];

        $sql = " INSERT INTO contractor_complaint (ComplaintID, Date, Subject , Content, Rates, Contractor_ID) 
            VALUES ('$ComplaintId', '$date', '$subject', '$message','$rating', '$contID')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }


    public function generateCustomerComplaintID(){
        $str_part = "cocom";
        $complain_id = "";

        while(true){
            $num_part = rand(100,999);
            $complain_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM customer_complaint WHERE ComplaintID='$complain_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return  $complain_id;
    }

    public function addNewCustomerComplaint($customerComplaints){
        $ComplaintId = $customerComplaints['ComplaintID'];
        $date = $customerComplaints['Date'];
        $subject = $customerComplaints['Subject'];
        $message = $customerComplaints['Content'];
        $custID = $customerComplaints['CustomerID'];
        $rating = $customerComplaints['Rates'];

        $sql = " INSERT INTO customer_complaint (ComplaintID, Date, Subject , Content, Rates, CustomerID) 
            VALUES ('$ComplaintId', '$date', '$subject', '$message','$rating', '$custID')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }


    public function generateManpowerComplaintID(){
        $str_part = "mancom";
        $complain_id = "";

        while(true){
            $num_part = rand(100,999);
            $complain_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM manpower_complaint WHERE ComplaintID='$complain_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return  $complain_id;
    }

    public function addNewManpowerComplaint($manpowerComplaints){
        $ComplaintId = $manpowerComplaints['ComplaintID'];
        $date = $manpowerComplaints['Date'];
        $subject = $manpowerComplaints['Subject'];
        $message = $manpowerComplaints['Content'];
        $manID = $manpowerComplaints['Manpower_Agency_ID'];
        $rating = $manpowerComplaints['Rates'];

        $sql = " INSERT INTO manpower_complaint (ComplaintID, Date, Subject , Content, Rates, Manpower_Agency_ID) 
            VALUES ('$ComplaintId', '$date', '$subject', '$message','$rating', '$manID')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function getCustomerComplaint($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "CUSCOM.ComplaintID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CUSCOM.Subject) LIKE '%" . $search . "%'";
        }
        


        if($count == true){
          $sql = "SELECT CUSCOM.* FROM customer_complaint CUSCOM WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT CUSCOM.*,CUSCOM.ComplaintID AS CID, CUSCOM.CustomerID AS IID, C.Contact_No AS phone, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM customer_complaint CUSCOM
                INNER JOIN customer C ON CUSCOM.CustomerID=C.CustomerID 
                WHERE $where_cls 
                ORDER by CUSCOM.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getContractorComplaint($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "CONCOM.ComplaintID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CONCOM.Subject) LIKE '%" . $search . "%'";
        }
        


        if($count == true){
          $sql = "SELECT CONCOM.* FROM contractor_complaint CONCOM WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT CONCOM.*,CONCOM.ComplaintID AS CID, CONCOM.Contractor_ID AS IID, C.phone as phone, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM contractor_complaint CONCOM
                INNER JOIN contractors C ON CONCOM.Contractor_ID=C.Contractor_ID 
                WHERE $where_cls 
                ORDER by CONCOM.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getManpowerComplaint($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "MANCOM.ComplaintID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(MANCOM.Subject) LIKE '%" . $search . "%'";
        }
        


        if($count == true){
          $sql = "SELECT MANCOM.* FROM manpower_complaint MANCOM WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT MANCOM.*,MANCOM.ComplaintID AS CID, MANCOM.Manpower_Agency_ID AS IID, M.Contact_No AS phone, M.Company_Name AS CusFullName FROM manpower_complaint MANCOM
                INNER JOIN manpower_agency M ON MANCOM.Manpower_Agency_ID=M.Manpower_Agency_ID 
                WHERE $where_cls 
                ORDER by MANCOM.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getEmployeeComplaint($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "EMPCOM.ComplaintID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(EMPCOM.Subject) LIKE '%" . $search . "%'";
        }
        


        if($count == true){
          $sql = "SELECT EMPCOM.* FROM employee_complaint EMPCOM WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT EMPCOM.*,EMPCOM.ComplaintID AS CID, EMPCOM.EmployeeID AS IID, E.Contact_No AS phone, CONCAT(E.FirstName, ' ', E.LastName) AS CusFullName FROM employee_complaint EMPCOM
                INNER JOIN employee E ON EMPCOM.EmployeeID=E.EmployeeID 
                WHERE $where_cls 
                ORDER by EMPCOM.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function deleteCustomerComplaint($id){
        $sql = "DELETE FROM customer_complaint
                WHERE ComplaintID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function deleteManpowerComplaint($id){
        $sql = "DELETE FROM manpower_complaint
                WHERE ComplaintID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function deleteContractorComplaint($id){
        $sql = "DELETE FROM contractor_complaint
                WHERE ComplaintID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function deleteEmployeeComplaint($id){
        $sql = "DELETE FROM employee_complaint
                WHERE ComplaintID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }
  
}