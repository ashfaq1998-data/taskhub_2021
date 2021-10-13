<?php

require_once ROOT . "/Database.php";

class BookingModel extends Database {

    public function generateEmployeeBookingID(){
        $str_part = "ebook";
        $emp_booking_id = "";

        while(true){
            $num_part = rand(100,999);
            $emp_booking_id = $str_part . strval($num_part);

            $sql = "SELECT * FROM employee_booking WHERE BookingID='$emp_booking_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return $emp_booking_id;
    }

    public function getEmployeeBookings($emp_id) {
        $sql = "SELECT EB.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM employee_booking EB
                INNER JOIN customer C ON EB.CustomerID=C.CustomerID 
                WHERE EB.EmployeeID='$emp_id' AND EB.Is_work_done='No'"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    
  
}