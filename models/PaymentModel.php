<?php

require_once ROOT . "/Database.php";

class PaymentModel extends Database {

    public function addNewCustomerPayment($paymentDetails){
        $paymentId = $paymentDetails['paymentId'];
        $cardNo = $paymentDetails['cardNo'];
        $expiryDate = $paymentDetails['expiryDate'];
        $cardHolderName = $paymentDetails['cardHolderName'];
        $customerId = $paymentDetails['customerId'];
        $paymentMethod = $paymentDetails['paymentMethod'];
        $payment = $paymentDetails['payment'];

        $sql = " INSERT INTO customer_paymentgatway (paymentID, cardnumber, expirydate, cardholdername, CustomerID, payment, PaymentMethod) 
            VALUES ('$paymentId', '$cardNo', '$expiryDate', '$cardHolderName', '$customerId', $payment, '$paymentMethod')";

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

    
}