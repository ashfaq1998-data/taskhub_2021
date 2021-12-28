<?php 

require_once ROOT . "/Database.php";
class AdvertisementModel extends Database {
    public function getCustomerAd($limit = 0, $start = 0, $count = false){

        $where_cls = "CUSAD.AdvertisementID IS NOT NULL";

        


        if($count == true){
            $sql = "SELECT CUSAD.* FROM customeradvertisement CUSAD WHERE $where_cls";
        
            $query = $this->con->query($sql);
            $query->execute();
            return $query->rowCount();
        }
    
        $sql = "SELECT CUSAD.*, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM customeradvertisement CUSAD
                INNER JOIN customer C ON CUSAD.CustomerID=C.CustomerID 
                WHERE $where_cls 
                ORDER by CUSAD.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }
}

?>