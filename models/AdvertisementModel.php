<?php

require_once ROOT . "/Database.php";

class AdvertisementModel extends Database {

    public function generateCustomerAdvertisementID(){
        $str_part = "cusad";
        $advertisement_id = "";

        while(true){
            $num_part = rand(100,999);
            $advertisement_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM customeradvertisement WHERE AdvertisementID='$advertisement_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return  $advertisement_id;
    }

    public function addNewManpowerAdvertisement($manpowerad){
        $AdId = $manpowerad['AdvertisementID'];
        $date = $manpowerad['Date'];
        $title = $manpowerad['Title'];
        $email = $manpowerad['Email'];
        $image = $manpowerad['images'];
        $description = $manpowerad['Description'];
        $address = $manpowerad['Address'];
        $district = $manpowerad['District'];
        $manID = $manpowerad['Manpower_Agency_ID'];

        $sql = " INSERT INTO manpoweradvertisement (AdvertisementID, Date, Title , Description, Address, Email, images, District, Manpower_Agency_ID) 
            VALUES ('$AdId', '$date', '$title', '$description','$address', '$email', '$image', '$district', '$manID' )";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function addNewCustomerAdvertisement($customerad){
        $AdId = $customerad['AdvertisementID'];
        $date = $customerad['Date'];
        $title = $customerad['Title'];
        $email = $customerad['Email'];
        $image = $customerad['images'];
        $description = $customerad['Description'];
        $address = $customerad['Address'];
        $district = $customerad['District'];
        $cusID = $customerad['CustomerID'];

        $sql = " INSERT INTO customeradvertisement (AdvertisementID, Date, Title , Description, Address, Email, images, District, CustomerID) 
            VALUES ('$AdId', '$date', '$title', '$description','$address', '$email', '$image', '$district', '$cusID' )";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function addNewContractorAdvertisement($contractorad){
        $AdId = $contractorad['AdvertisementID'];
        $date = $contractorad['Date'];
        $title = $contractorad['Title'];
        $email = $contractorad['Email'];
        $image = $contractorad['images'];
        $description = $contractorad['Description'];
        $address = $contractorad['Address'];
        $district = $contractorad['District'];
        $conID = $contractorad['Contractor_ID'];

        $sql = " INSERT INTO contractoradvertisement (AdvertisementID, Date, Title , Description, Address, Email, images, District, Contractor_ID) 
            VALUES ('$AdId', '$date', '$title', '$description','$address', '$email', '$image', '$district', '$conID' )";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function generateContractorAdvertisementID(){
        $str_part = "conad";
        $advertisement_id = "";

        while(true){
            $num_part = rand(100,999);
            $advertisement_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM contractoradvertisement WHERE AdvertisementID='$advertisement_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return  $advertisement_id;
    }

    public function generateManPowerAdvertisementID(){
        $str_part = "manad";
        $advertisement_id = "";

        while(true){
            $num_part = rand(100,999);
            $advertisement_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM manpoweradvertisement WHERE AdvertisementID='$advertisement_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return  $advertisement_id;
    }

    

    public function getCustomerAd($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "CUSAD.AdvertisementID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CUSAD.Title) LIKE '%" . $search . "%'";
        }
        if($where['area'] != ""){
            $area = strtolower($where['area']);
            $where_cls .= " AND LOWER(CUSAD.District) = '" . $area . "'";
        }


        if($count == true){
          $sql = "SELECT CUSAD.* FROM customeradvertisement CUSAD WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT CUSAD.*, C.CustomerID AS IID, CUSAD.AdvertisementID AS ADID, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM customeradvertisement CUSAD
                INNER JOIN customer C ON CUSAD.CustomerID=C.CustomerID 
                WHERE $where_cls 
                ORDER by CUSAD.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getContractorAd($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "CTAD.AdvertisementID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CTAD.Title) LIKE '%" . $search . "%'";
        }
        if($where['area'] != ""){
            $area = strtolower($where['area']);
            $where_cls .= " AND LOWER(CTAD.District) = '" . $area . "'";
        }


        if($count == true){
          $sql = "SELECT CTAD.* FROM contractoradvertisement CTAD WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT CTAD.*, C.Contractor_ID AS IID, CTAD.AdvertisementID AS ADID, CONCAT(C.FirstName, ' ', C.LastName) AS CusFullName FROM contractoradvertisement CTAD
                INNER JOIN contractors C ON CTAD.Contractor_ID=C.Contractor_ID 
                WHERE $where_cls 
                ORDER by CTAD.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getManPowerAd($limit = 0, $start = 0, $count = false, $where = array()){

        $where_cls = "MPAD.AdvertisementID IS NOT NULL";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(MPAD.Title) LIKE '%" . $search . "%'";
        }
        if($where['area'] != ""){
            $area = strtolower($where['area']);
            $where_cls .= " AND LOWER(MPAD.District) = '" . $area . "'";
        }


        if($count == true){
          $sql = "SELECT MPAD.* FROM manpoweradvertisement MPAD WHERE $where_cls";
          
          $query = $this->con->query($sql);
          $query->execute();
          return $query->rowCount();
        }
    
        $sql = "SELECT MPAD.*, MP.Manpower_Agency_ID AS IID, MPAD.AdvertisementID AS ADID, MP.Company_Name AS CusFullName FROM manpoweradvertisement MPAD
                INNER JOIN manpower_agency MP ON MPAD.Manpower_Agency_ID=MP.Manpower_Agency_ID 
                WHERE $where_cls 
                ORDER by MPAD.Date DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function deleteCustomerAds($id){
        $sql = "DELETE FROM customeradvertisement
                WHERE AdvertisementID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function deleteManpowerAds($id){
        $sql = "DELETE FROM manpoweradvertisement
                WHERE AdvertisementID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function deleteContractorAds($id){
        $sql = "DELETE FROM contractoradvertisement
                WHERE AdvertisementID = '$id'";
                
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

   

    
  
}