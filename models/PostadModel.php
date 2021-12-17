<?php

require_once ROOT . "/Database.php";

class PostadModel extends Database {

    public function generateContractorPostadID() {
        $str_part= "cpos";
        $postad_id="";

        while(true) {
            $num_part =rand(100,999);
            $postad_id=$str_part.strval($num_part);

            $sql="SELECT * FROM contractor_postad WHERE PostadID= '$postad_id' ";
            $query=$this->con->query($sql);
            $query->execute();
            
            if($query->rowCount()==0) {
                break;
            }

        }
        return $postad_id;
    }

    public function addNewContractorPostAd($contractorPostad) {
        
        $postadID=$contractorPostad['postadID'];
        $currentDateTime= $contractorPostad['Date'];
        $title=$contractorPostad['title'];
        $name=$contractorPostad['name'];
        $email=$contractorPostad['email'];
        $address=$contractorPostad['address'];
        $zipcode=$contractorPostad['zipcode'];
        $image=$contractorPostad['image'];
        $district=$contractorPostad['district'];
        $description=$contractorPostad['description'];
        $contractor_ID=$contractorPostad['Contractor_ID'];
    
    
        $sql="INSERT INTO contractor_postad (postadID,date,title,name,email,address,zipcode,district,description,contractor_ID)
        VALUES ('$postadID','$currentDateTime','$title','$name','$email','$address','$zipcode','$district','$description','$contractor_ID')";
        
        
        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }
}