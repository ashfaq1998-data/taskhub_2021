<?php

require_once ROOT . "/Database.php";

class PaymentModel extends Database {

    public function addNewCustomerPayment($paymentDetails){
        $paymentId = $paymentDetails['paymentId'];
        $cardNo = $paymentDetails['cardNo'];
        $payee = $paymentDetails['payee'];
        $expiryDate = $paymentDetails['expiryDate'];
        $cardHolderName = $paymentDetails['cardHolderName'];
        $customerId = $paymentDetails['customerId'];
        $paymentMethod = $paymentDetails['paymentMethod'];
        $payment = $paymentDetails['payment'];

        $sql = " INSERT INTO customer_paymentgatway (paymentID, cardnumber, expirydate, cardholdername, CustomerID, payment, PaymentMethod, payee) 
            VALUES ('$paymentId', '$cardNo', '$expiryDate', '$cardHolderName', '$customerId', $payment, '$paymentMethod','$payee')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function getCustomerLastPayment($customerId){
        $sql = "SELECT * FROM customer_paymentgatway WHERE CustomerID ='$customerId' ORDER BY Date DESC"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getCustomerPayment($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "CUSPAY.PaymentID IS NOT NULL";
    
        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CUSPAY.payee) LIKE '%" . $search . "%'";
        }
        
    
    
        if($count == true){
          $sql = "SELECT CUSPAY.* FROM customer_paymentgatway CUSPAY WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT CUSPAY.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName , C.CustomerID AS IID, CUSPAY.PaymentID AS PID, C.Contact_No AS phone FROM customer_paymentgatway CUSPAY
                INNER JOIN customer C ON CUSPAY.CustomerID=C.CustomerID 
                WHERE $where_cls 
                ORDER by CUSPAY.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getManpowerPayment($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "MANPAY.PaymentID IS NOT NULL";
    
        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(MANPAY.payee) LIKE '%" . $search . "%'";
        }
        
    
    
        if($count == true){
          $sql = "SELECT MANPAY.* FROM manpower_paymentgatway MANPAY WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT MANPAY.*, M.Company_Name AS CusFullName, M.Manpower_Agency_ID AS IID, MANPAY.PaymentID AS PID, M.Contact_No AS phone FROM manpower_paymentgatway MANPAY
            INNER JOIN manpower_agency M ON MANPAY.Manpower_Agency_ID=M.Manpower_Agency_ID 
            WHERE $where_cls 
            ORDER by MANPAY.Date DESC
            LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function getContractorPayment($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "CONPAY.PaymentID IS NOT NULL";
    
        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CONPAY.payee) LIKE '%" . $search . "%'";
        }
        
    
    
        if($count == true){
          $sql = "SELECT CONPAY.* FROM contractor_paymentgatway CONPAY WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT CONPAY.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName, C.Contractor_ID AS IID, CONPAY.PaymentID AS PID, C.phone AS phone FROM contractor_paymentgatway CONPAY
            INNER JOIN contractors C ON CONPAY.Contractor_ID=C.Contractor_ID 
            WHERE $where_cls 
            ORDER by CONPAY.Date DESC
            LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    
}