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

    public function getManPowerAd($limit = 0, $start = 0, $count = false){

        $where_cls = "MAPAD.AdvertisementID IS NOT NULL";

        


        if($count == true){
            $sql = "SELECT MAPAD.* FROM manpoweradvertisement MAPAD WHERE $where_cls";
        
            $query = $this->con->query($sql);
            $query->execute();
            return $query->rowCount();
        }
    
        $sql = "SELECT MAPAD.*, CONCAT(M.FirstName, ' ', M.LastName) AS MapFullName FROM manpoweradvertisement MAPAD
                INNER JOIN manpower_agency M ON MAPAD.Manpower_Agency_ID=M.Manpower_Agency_ID 
                WHERE $where_cls 
                ORDER by MAPAD.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }


    public function getCurrentAdvertisement($conID) {

    }

    public function getcontractormyadvertisements($conId,$limit=0, $start = 0, $count = false){
        
        if($count==true){
            $sql = "SELECT CONAD.* FROM contractoradvertisement CONAD WHERE Contractor_ID='$conId'";
            $query = $this->con->query($sql);
            $query->execute();
            return $query->rowCount();
        }
        
        $sql = "SELECT CONAD.* FROM contractor_postad CONAD
                INNER JOIN contractors C ON CONAD.Contractor_ID=C.Contractor_ID 
                WHERE CONAD.Contractor_ID='$conId'
                ORDER by CONAD.Date DESC "; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    // public function contractorEditOwnAd($title,$name,$email,$addr,$zipcode,$image,$district,$description,$adEdit,$conID){
    //     if(!empty($adEdit) && $adEdit=='submitted') {
        
    //     }
    // }
}
?>