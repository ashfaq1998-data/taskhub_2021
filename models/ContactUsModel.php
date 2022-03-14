<?php

require_once ROOT . "/Database.php";

class ContactUsModel extends Database {
    public function generateContactUsID() {
        $str_part = "contact";
        $contact_id = "";
     
        while(true){
            $num_part = rand(100,999);
            $contact_id = $str_part.strval($num_part);
     
            $sql = "SELECT * FROM contactus WHERE contactID='$contact_id'";
            $query = $this->con->query($sql);
            $query->execute();
     
            if ($query->rowCount() == 0){
              break;
           }
        }
        return $contact_id;
    }

    public function addNewContactDetails($contactDetails) {
        $contactID = $contactDetails['contactID'];
        $Date = $contactDetails['Date'];
        $name = $contactDetails['name'];
        $message = $contactDetails['description'];
        $email = $contactDetails['email'];
        
        
        $sql = " INSERT INTO contactus (contactID, Date, name , description, email) 
                VALUES ('$contactID', '$Date', '$name', '$message', '$email')";
    
        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }
    
    }

    public function getContactDetails($limit = 0, $start = 0, $count = false, $where = array()){
        $where_cls = "contactus.contactID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(contactus.name) LIKE '%" . $search . "%'";
        }
        
        if($count == true){
          $sql = "SELECT * FROM contactus WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT *, contactus.ContactID AS IID FROM contactus
                WHERE $where_cls
                ORDER by contactus.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    

    public function deleteContact($id){
        $sql = "DELETE FROM contactus
                WHERE contactID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
      }




    




    

    
  
}