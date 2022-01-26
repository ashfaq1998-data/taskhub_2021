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
    
        $sql = "SELECT *, CONCAT(FirstName, ' ', LastName) AS CusFullName FROM Customer ORDER BY CustomerID"; 
    
        $query = $this->con->query($sql);
        $query->execute();
        for($i=0;$i<$query->rowCount(); $i++){
            $data[$i] = $query->fetch(PDO::FETCH_OBJ);
        }
        return $data;
    }


    public function getEmployeeProfiles(){
        
        $sql = "SELECT *, CONCAT(FirstName, ' ', LastName) AS CusFullName FROM employee ORDER BY EmployeeID"; 

        $query = $this->con->query($sql);
        $query->execute();
        for($i=0;$i<$query->rowCount(); $i++){
            $data[$i] = $query->fetch(PDO::FETCH_OBJ);
        }
        return $data;
    }

    public function getManpowerProfiles(){
    
        $sql = "SELECT *, Company_Name AS CusFullName FROM manpower_agency ORDER BY Manpower_Agency_ID"; 

        $query = $this->con->query($sql);
        $query->execute();
        for($i=0;$i<$query->rowCount(); $i++){
            $data[$i] = $query->fetch(PDO::FETCH_OBJ);
        }
        return $data;
}
}