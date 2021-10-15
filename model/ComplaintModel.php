<?php

require_once ROOT . "/Database.php";

class ComplaintModel extends Database {

    public function generateEmployeeComplaintID(){
        $str_part = "com";
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
  
}