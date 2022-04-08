<?php

require_once ROOT . "/Database.php";

class TestModel extends Database {

    public function customerTest($name, $select, $CuID){
        
        // if($select == 'High'){        
        //     $sql = "SELECT * FROM customer_paymentgatway WHERE (payment > 1350 AND cardholdername = '$name')";
        //     $query = $this->con->query($sql);
        //     $query->execute();
        //     for($i=0; $i<$query->rowCount(); $i++){
        //         $data[$i] = $query->fetch(PDO::FETCH_OBJ);
        //     }
        //     // $data = $query->fetch(PDO::FETCH_OBJ);
        //     $data['num_rows'] = $query->rowCount();
        //     if($query->rowCount() == 0){
        //     $err = ('Sorry!! No results found for the keyword...');
        //     $data['error'] = $err;
        //     }
        //     return  $data;  
        // }

        // if($select == 'Low'){        
        //     $sql = "SELECT * FROM customer_paymentgatway WHERE (payment < 1350 AND cardholdername = '$name')";
        //     $query = $this->con->query($sql);
        //     $query->execute();
        //     for($i=0; $i<$query->rowCount(); $i++){
        //         $data[$i] = $query->fetch(PDO::FETCH_OBJ);
        //     }
        //     // $data = $query->fetch(PDO::FETCH_OBJ);
        //     $data['num_rows'] = $query->rowCount();
        //     if($query->rowCount() == 0){
        //     $err = ('Sorry!! No results found for the keyword...');
        //     $data['error'] = $err;
        //     }
        //     return  $data; 
        // }


        if(!empty($name) && !empty($select)){        
            $sql = "INSERT INTO customertest(Name, Grade) VALUES('$name', '$select')";
            if($this->con->query($sql)){
                return true;
            }else{
                return false;
            }
        }
    }


    public function customerTest2($val){

        if(true){ 
            $sql = "SELECT * FROM customertest Where Grade IN('High', 'Medium', 'LOW') ORDER BY Name";
            $query = $this->con->query($sql);
            $query->execute();
            for($i=0; $i<$query->rowCount(); $i++){
                $data[$i] = $query->fetch(PDO::FETCH_OBJ);
            }
            // // $data = $query->fetch(PDO::FETCH_OBJ);
            // $data['num_rows'] = $query->rowCount();
            // if($query->rowCount() == 0){
            // $err = ('Sorry!! No results found for the keyword...');
            // $data['error'] = $err;
            // }
            return  $data;
        }
    }
}