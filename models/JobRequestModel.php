<?php

require_once ROOT . "/Database.php";

class JobRequestModel extends Database {

    public function generateCustomerJobRequestID(){
        $str_part = "cusjr";
        $job_request_id = "";

        while(true){
            $num_part = rand(100,999);
            $job_request_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM customer_jobrequest WHERE requestID='$job_request_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return $job_request_id;
    }

    public function generateContractorJobRequestID(){
        $str_part = "conjr";
        $job_request_id = "";

        while(true){
            $num_part = rand(100,999);
            $job_request_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM contractor_jobrequest WHERE requestID='$job_request_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return $job_request_id;
    }

    public function generateManPowerJobRequestID(){
        $str_part = "manjr";
        $job_request_id = "";

        while(true){
            $num_part = rand(100,999);
            $job_request_id = $str_part.strval($num_part);

            $sql = "SELECT * FROM manpower_jobrequest WHERE requestID='$job_request_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if($query->rowCount() == 0){
                break;
            }
        }
        return $job_request_id;
    }

    

    public function addNewCustomerJobRequest($jobRequestData){
        $jobRequestId = $jobRequestData['requestID'];
        $advertisementId = $jobRequestData['AdvertisementID'];
        $requestedBy = $jobRequestData['RequestedBy'];

        $sql = " INSERT INTO customer_jobrequest (requestID, AdvertisementID, RequestedBy) 
            VALUES ('$jobRequestId', '$advertisementId', '$requestedBy')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function addNewContractorJobRequest($jobRequestData){
        $jobRequestId = $jobRequestData['requestID'];
        $advertisementId = $jobRequestData['AdvertisementID'];
        $requestedBy = $jobRequestData['RequestedBy'];

        $sql = " INSERT INTO contractor_jobrequest (requestID, AdvertisementID, RequestedBy) 
            VALUES ('$jobRequestId', '$advertisementId', '$requestedBy')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function addNewManpowerJobRequest($jobRequestData){
        $jobRequestId = $jobRequestData['requestID'];
        $advertisementId = $jobRequestData['AdvertisementID'];
        $requestedBy = $jobRequestData['RequestedBy'];

        $sql = " INSERT INTO manpower_jobrequest (requestID, AdvertisementID, RequestedBy) 
            VALUES ('$jobRequestId', '$advertisementId', '$requestedBy')";

        if($this->con->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function getCustomerJobRequests($limit = 0, $start = 0, $count = false, $where = array()){

        $cusId = $where['cusId'];
        $type = $where['type'];

        $where_cls = "C.CustomerID = '$cusId' AND U.user_type_id = $type";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CUSAD.Title) LIKE '%" . $search . "%'";
        }

        if($count == true){
            $sql = "SELECT CUSJR.* FROM customer_jobrequest CUSJR
            INNER JOIN customeradvertisement CUSAD ON CUSJR.AdvertisementID=CUSAD.AdvertisementID
            INNER JOIN customer C ON CUSAD.CustomerID=C.CustomerID  
            INNER JOIN users U ON CUSJR.RequestedBy=U.id
            WHERE $where_cls";
          
            $query = $this->con->query($sql);
            $query->execute();
            return $query->rowCount();
        }
    
        $sql = "SELECT CUSJR.*, CUSAD.Title, CUSAD.Description, CUSAD.Date FROM customer_jobrequest CUSJR
                INNER JOIN customeradvertisement CUSAD ON CUSJR.AdvertisementID=CUSAD.AdvertisementID
                INNER JOIN customer C ON CUSAD.CustomerID=C.CustomerID  
                INNER JOIN users U ON CUSJR.RequestedBy=U.id
                WHERE $where_cls 
                ORDER by CUSJR.RequestDate DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getManpowerJobRequests($limit = 0, $start = 0, $count = false, $where = array()){

        $manId = $where['manId'];
        $type = $where['type'];

        $where_cls = "M.Manpower_Agency_ID = '$manId' AND U.user_type_id = $type";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(MANAD.Title) LIKE '%" . $search . "%'";
        }

        if($count == true){
            $sql = "SELECT MANJR.* FROM manpower_jobrequest MANJR
            INNER JOIN manpoweradvertisement MANAD ON MANJR.AdvertisementID=MANAD.AdvertisementID
            INNER JOIN manpower_agency M ON MANAD.Manpower_Agency_ID=M.Manpower_Agency_ID  
            INNER JOIN users U ON MANJR.RequestedBy=U.id
            WHERE $where_cls";
          
            $query = $this->con->query($sql);
            $query->execute();
            return $query->rowCount();
        }
    
        $sql = "SELECT MANJR.*, MANAD.Title, U.email, MANAD.Description, MANAD.Date FROM manpower_jobrequest MANJR
                INNER JOIN manpoweradvertisement MANAD ON MANJR.AdvertisementID=MANAD.AdvertisementID
                INNER JOIN manpower_agency M ON MANAD.Manpower_Agency_ID=M.Manpower_Agency_ID 
                INNER JOIN users U ON MANJR.RequestedBy=U.id
                WHERE $where_cls 
                ORDER by MANJR.RequestDate DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }

    public function getContractorJobRequests($limit = 0, $start = 0, $count = false, $where = array()){

        $conId = $where['conId'];
        $type = $where['type'];

        $where_cls = "C.Contractor_ID = '$conId' AND U.user_type_id = $type";

        if($where['search'] != ""){
            $search = strtolower($where['search']);
            $where_cls .= " AND LOWER(CONAD.Title) LIKE '%" . $search . "%'";
        }

        if($count == true){
            $sql = "SELECT CONJR.* FROM contractor_jobrequest CONJR
            INNER JOIN contractoradvertisement CONAD ON CONJR.AdvertisementID=CONAD.AdvertisementID
            INNER JOIN contractors C ON CONAD.Contractor_ID=C.Contractor_ID  
            INNER JOIN users U ON CONJR.RequestedBy=U.id
            WHERE $where_cls";
          
            $query = $this->con->query($sql);
            $query->execute();
            return $query->rowCount();
        }
    
        $sql = "SELECT CONJR.*, CONAD.Title, U.email, CONAD.Description, CONAD.Date FROM contractor_jobrequest CONJR
                INNER JOIN contractoradvertisement CONAD ON CONJR.AdvertisementID=CONAD.AdvertisementID
                INNER JOIN contractors C ON CONAD.Contractor_ID=C.Contractor_ID 
                INNER JOIN users U ON CONJR.RequestedBy=U.id
                WHERE $where_cls 
                ORDER by CONJR.RequestDate DESC
                LIMIT $start,$limit"; 
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $data;
    }


   

    
  
}