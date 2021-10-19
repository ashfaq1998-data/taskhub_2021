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
        $str_part = "cucom";
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

    public function addNewCustomerComplaint($customerComplaint){
        $ComplaintId = $customerComplaint['ComplaintID'];
        $date = $customerComplaint['Date'];
        $subject = $customerComplaint['Subject'];
        $message = $customerComplaint['Content'];
        $customerID = $customerComplaint['CustomerID'];
        $rating = $customerComplaint['Rates'];

        $sql = " INSERT INTO customer_complaint (ComplaintID, Date, Subject , Content, Rates, CustomerID) 
            VALUES ('$ComplaintId', '$date', '$subject', '$message','$rating', '$customerID')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }
  
}