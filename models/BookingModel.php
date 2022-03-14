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
        $sql = "SELECT EB.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName, DATE(EB.Date) AS EventDate, TIME(EB.Date) AS EventTime, EB.Description FROM employee_booking EB
                INNER JOIN customer C ON EB.CustomerID=C.CustomerID 
                WHERE EB.EmployeeID='$emp_id' AND EB.Is_work_done='No'"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function generateManpowerBookingID(){
        $str_part = "manbook";
        $man_booking_id = "";

        while(true){
            $num_part = rand(100,999);
            $man_booking_id = $str_part . strval($num_part);

            $sql = "SELECT * FROM manpower_booking WHERE BookingID='$man_booking_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return $man_booking_id;
    }

    public function getManpowerBookings($man_id) {
        $sql = "SELECT MANB.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName, DATE(MANB.Date) AS EventDate, TIME(MANB.Date) AS EventTime, MANB.Description FROM manpower_booking MANB
                INNER JOIN customer C ON MANB.CustomerID=C.CustomerID 
                WHERE MANB.Manpower_Agency_ID='$man_id' AND MANB.Is_work_done='No'"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function generateContractorBookingID(){
        $str_part = "conbook";
        $contractor_booking_id = "";

        while(true){
            $num_part = rand(100,999);
            $contractor_booking_id = $str_part . strval($num_part);

            $sql = "SELECT * FROM contractor_booking WHERE BookingID='$contractor_booking_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return $contractor_booking_id;
    }

    public function getContractorBookings($contractor_id) {
        $sql = "SELECT CONB.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName, DATE(CONB.Date) AS EventDate, TIME(CONB.Date) AS EventTime FROM contractor_booking CONB
                INNER JOIN customer C ON CONB.CustomerID=C.CustomerID 
                WHERE CONB.Contractor_ID='$contractor_id' AND CONB.Is_work_done='No'"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function generateCustomerBookingID(){
        $str_part = "cusbook";
        $contractor_booking_id = "";

        while(true){
            $num_part = rand(100,999);
            $customer_booking_id = $str_part . strval($num_part);

            $sql = "SELECT * FROM customer_booking WHERE BookingID='$customer_booking_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return $customer_booking_id;
    }

    public function getCustomerBookingEmployee($customer_id) {
        $sql = "SELECT EB.*, CONCAT(E.FirstName, ' ', E.LastName) AS EmpFullName, DATE(EB.Date) AS EventDate, TIME(EB.Date) AS EventTime, Description 
                FROM employee_booking EB
                INNER JOIN employee E ON EB.EmployeeID=E.EmployeeID 
                WHERE EB.CustomerID='$customer_id' AND EB.Is_work_done='No'";
         
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function getCustomerBookingContractor($customer_id) {
        $sql = "SELECT CONB.*, CONCAT(CON.FirstName, ' ', CON.LastName) AS ConFullName, DATE(CONB.Date) AS EventDate, TIME(CONB.Date) AS EventTime, Description 
                FROM contractor_booking CONB
                INNER JOIN contractors CON ON CONB.Contractor_ID=CON.Contractor_ID 
                WHERE CONB.CustomerID='$customer_id' AND CONB.Is_work_done='No'";
         
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function addNewEmployeeBooking($bookingDetails){
        $bookingId = $bookingDetails['bookingId'];
        $address = $bookingDetails['address'];
        $customerId = $bookingDetails['customerId'];
        $employeeId = $bookingDetails['employeeId'];
        $description = $bookingDetails['description'];
        $title = $bookingDetails['title'];
        $payment = $bookingDetails['payment'];

        $sql = " INSERT INTO employee_booking (BookingID, Address, Is_work_done, CustomerID, EmployeeID, Description, title, payment) 
            VALUES ('$bookingId', '$address', 'No', '$customerId', '$employeeId', '$description', '$title', $payment)";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function addNewManpowerBooking($bookingDetails){
        $bookingId = $bookingDetails['bookingId'];
        $address = $bookingDetails['address'];
        $customerId = $bookingDetails['customerId'];
        $manpowerId = $bookingDetails['manpowerId'];
        $description = $bookingDetails['description'];
        $title = $bookingDetails['title'];
        $payment = $bookingDetails['payment'];

        $sql = " INSERT INTO manpower_booking (BookingID, Address, Is_work_done, CustomerID, Manpower_Agency_ID, Description, title, payment) 
            VALUES ('$bookingId', '$address', 'No', '$customerId', '$manpowerId', '$description', '$title', $payment)";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function addNewContractorBooking($bookingDetails){
        $bookingId = $bookingDetails['bookingId'];
        $address = $bookingDetails['address'];
        $customerId = $bookingDetails['customerId'];
        $contractorId = $bookingDetails['contractorId'];
        $description = $bookingDetails['description'];
        $title = $bookingDetails['title'];
        $payment = $bookingDetails['payment'];

        $sql = " INSERT INTO contractor_booking (BookingID, Address, Is_work_done, CustomerID, Contractor_ID, Description, title, payment) 
            VALUES ('$bookingId', '$address', 'No', '$customerId', '$contractorId', '$description', '$title', $payment)";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }
    }
}