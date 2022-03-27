<?php

require_once ROOT . "/Database.php";

class MyrequestModel extends Database {

    // public function Getmyrequestdetails($userID){
    
    //     //  $sql="SELECT * FROM customer_jobrequest AND manpower_jobrequest WHERE RequestedBy='$userID'";
    //     // $sql="SELECT manpower_jobrequest.*,customer_jobrequest.* from manpower_jobrequest,customer_jobrequest where
    //     // customer_jobrequest.RequestedBy=manpower_jobrequest.RequestedBy AND customer_jobrequest.RequestedBy='user841' ORDER BY customer_jobrequest.requestID";
    //     $sql="SELECT manpower_jobrequest.requestID AS MRequestID, manpower_jobrequest.AdvertisementID AS manpID, manpower_jobrequest.RequestDate AS Mreqdate, customer_jobrequest.* from manpower_jobrequest,customer_jobrequest where 
    //     customer_jobrequest.RequestedBy=manpower_jobrequest.RequestedBy AND customer_jobrequest.RequestedBy='user841' ORDER BY customer_jobrequest.requestID " ;
    //     $query=$this->con->query($sql);
    //     $query->execute();
    //     $data=$query->fetchAll(PDO::FETCH_OBJ);
    //     return $data;
    // }

    public function GetmyCustomerRequestdetails($limit=0,$start=0,$count=false,$userID){
    
        if($count == true){
            $sql = "SELECT * FROM customer_jobrequest WHERE RequestedBy='$userID'";
            
            $query = $this->con->query($sql);
            $query->execute();
            return $query->rowCount();
        }
    
        $sql="SELECT * FROM customer_jobrequest WHERE RequestedBy='$userID' LIMIT $start,$limit";
        
        $query=$this->con->query($sql);
        $query->execute();
        $data=$query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function GetmyManpowerRequestdetails($limit=0,$start = 0, $count = false,$userID){
    
        if($count == true){
            $sql = "SELECT * FROM manpower_jobrequest WHERE RequestedBy='$userID'";
            
            $query = $this->con->query($sql);
            $query->execute();
            print($query->rowCount);
            return $query->rowCount();
        }
    

        $sql="SELECT * FROM manpower_jobrequest WHERE RequestedBy='$userID' LIMIT $start,$limit";
        
        $query=$this->con->query($sql);
        $query->execute();
        $data=$query->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}