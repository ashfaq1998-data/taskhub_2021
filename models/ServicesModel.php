<?php

require_once ROOT . "/Database.php";

class ServicesModel extends Database {

    public function getCustomerProfiles(){


    
        // if($count == true){
        //   $sql = "SELECT C.* FROM customer C ";
        
        //   $query = $this->con->query($sql);
        //   $query->execute();
        //   return $query->rowCount();
        // }
    
        $sql = "SELECT * FROM Customer ORDER BY CustomerID"; 
    
        $query = $this->con->query($sql);
        $query->execute();
        for($i=0;$i<$query->rowCount(); $i++){
            $data[$i] = $query->fetch(PDO::FETCH_OBJ);
        }
        return $data;
    }
}