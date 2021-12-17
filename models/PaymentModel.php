<?php

require_once ROOT . "/Database.php";

class PaymentModel extends Database{
    public function generateContractorPaymentformID() {
        $str_part= "cpay";
        $payment_id="";
        
        while(true) {
            $num_part =rand(100,999);
            $payment_id=$str_part.strval($num_part);

            $sql="SELECT * FROM contractor_paymentform WHERE PaymentID= '$payment_id' ";
            $query=$this->con->query($sql);
            $query->execute();
            
            if($query->rowCount()==0) {
                break;
            }

        }
        return $payment_id;
    }

    public function addNewContractorPaymentForm($contractorPaymentform) {
        
        $paymentID=$contractorPaymentform['paymentID'];
        $currentDateTime= $contractorPaymentform['paymentdate'];
        $cardnumber=$contractorPaymentform['cardnumber'];
        $expiredate=$contractorPaymentform['expiredate'];
        $contractor_ID=$contractorPaymentform['Contractor_ID'];
        $name=$contractorPaymentform['name'];
        $cvv=$contractorPaymentform['cvv'];
        $amount = $contractorPaymentform['paymentamount'];
    
        $sql="INSERT INTO contractor_paymentform (paymentID,paymentdate,cardnumber,cvv,expiredate,name,amount,contractor_ID)
        VALUES ('$paymentID','$currentDateTime','$cardnumber','$cvv','$expiredate','$name','$amount','$contractor_ID')";
        
        
        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function getContractorLoginDetails($userID){
        $sql="SELECT *FROM users WHERE id = '$userID'";
        $query= $this->con->query($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data;
    }

}
