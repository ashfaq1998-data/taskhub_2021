<?php

require_once ROOT . "/Database.php";

class CustomerModel extends Database {

  //for now for profile section
  public function getCustomerByUserID($user_id) {
    $sql = "SELECT * FROM customer WHERE user_id='$user_id'"; 
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    return $data;
  }

  public function addNewCustomer($customerDetails) {
    $customerId = $customerDetails['CustomerID'];
    $firstName = $customerDetails['FirstName'];
    $lastName = $customerDetails['LastName'];
    $nic = $customerDetails['NIC'];
    $phoneNum = $customerDetails['Contact_No'];
    $gender = $customerDetails['Gender'];
    $address = $customerDetails['Address'];
    $userId = $customerDetails['user_id'];

    $sql = "INSERT INTO customer (CustomerID, FirstName, LastName, NIC, Address, Contact_No, Gender, user_id) 
            VALUES ('$customerId', '$firstName', '$lastName', '$nic', '$address', '$phoneNum', '$gender', '$userId')";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }

  }

  public function generateCustomerID(){
    $str_part = "cust";
    $customer_id = "";
    
    while(true){
      $num_part = rand(100, 999);
      $customer_id = $str_part . strval($num_part);

      $sql = "SELECT * FROM customer WHERE CustomerID='$customer_id'";
      $query = $this->con->query($sql);
      $query->execute();

      if ($query->rowCount() == 0){
        break;
      }
    }
    return $customer_id;
  }


  public function search($dataEdit) {
    $search = "";
    $search = $_POST['search'];
    
    // $sql = "SELECT * FROM employee WHERE FirstName LIKE '%$search%' ";
    
    // $query = $this->con->query($sql);
    // $query->execute();
    // $data = $query->fetch(PDO::FETCH_OBJ);

    // if(!empty($dataEdit) && $dataEdit=='submitted') {
    //   return $data;
    // }
    // else {
    //   return false;
    //   echo ('No keyword founded!!');
    // }



    // $query = $_GET['query']; 
	// gets value sent over search form
	// $min_length = 10;
	// you can set minimum length of the query if you want
	
	// if(strlen($search) >= $min_length){ // if query length is more or equal minimum length then
		
		// $query = htmlspecialchars($query); 
		// changes characters used in html to their equivalents, for example: < to &gt;
		
		// $search = mysql_real_escape_string($search);
		// makes sure nobody uses SQL injection
		
		$row_results = "SELECT * FROM employee WHERE ((`FirstName` LIKE '%".$dataEdit."%') OR (`LastName` LIKE '%".$dataEdit."%') 
                    OR (`Specialized_area` LIKE '%".$dataEdit."%'))";
                    // "SELECT * FROM contractors WHERE ((`FirstName` LIKE '%".$search."%') OR (`LastName` LIKE '%".$search."%'))".
                    // "SELECT * FROM manpower_agency WHERE ((`Company_Name` LIKE '%".$search."%') OR (`owner` LIKE '%".$search."%'))"];
    $query = $this->con->query($row_results);
    $query->execute();
    $rows = $query->rowCount();
    echo "<br>";    

		// * means that it selects all fields, you can also write: `id`, `title`, `text`
		// articles is the name of our table
		
		// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
		// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
		// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
		
		if($rows > 0){ // if one or more rows are returned do following
			
			while($data = $query->fetch(PDO::FETCH_ASSOC)){
			// $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop				
        
        // $data = $query->fetch(PDO::FETCH_ASSOC);
        echo ($data['FirstName'] . "&nbsp&nbsp" . $data['LastName'] . "&nbsp&nbsp&nbsp&nbsp" . $data['Specialized_area'] . "<pre></pre>");
        echo "<br>";
				// posts results gotten from database(title and text) you can also show id ($results['id'])
			}
      return true;
			
		}
		else{ // if there is no matching rows do following
			echo "No results";
      return false;
		}
		
	// }
	// else{ // if query length is less than minimum
	// 	echo "Minimum length is ".$min_length;
	// }

  }


  //post advertisement model
  public function customerPostad($customerPostad){
    $adID = $customerPostad['AdvertisementID'];
    $title = $customerPostad['Title'];
    $des = $customerPostad['Description'];
    $loc = $customerPostad['City'];
    $email = $customerPostad['Email'];
    $customerID = $customerPostad['CustomerID'];

    $sql = "INSERT INTO customeradvertisement (Title, Description, City, Email, CustomerID, AdvertisementID) 
            VALUES ('$title', '$des', '$loc', '$email', '$customerID', '$adID')";
    
    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }   
  }

  public function generateCustomerAdID(){
    $str_part = "ad";
    $ad_id = "";

    while(true){
        $num_part = rand(000,999);
        $ad_id = $str_part.strval($num_part);

        $sql = "SELECT * FROM customeradvertisement WHERE AdvertisementID = '$ad_id'";
        $query = $this->con->query($sql);
        $query->execute();

        if($query->rowCount() == 0){
            break;
        }
    }
    return  $ad_id;
  }


  public function getMyAdByCustomerID($cuID){

    $sql = "SELECT * FROM customeradvertisement WHERE CustomerID = '$cuID'";
    $query = $this->con->query($sql);
    $query->execute();
    for($i=0; $i<$query->rowCount(); $i++){
      $data[$i] = $query->fetch(PDO::FETCH_OBJ);
    }
    // $data = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 0){
        die('No advertisements are posted by yourself');
    }
    return  $data;
  }



  //newly added
  public function deleteMyAdID($adIDNo, $cuID){

    $sql = "DELETE FROM customeradvertisement WHERE AdvertisementID = '$adIDNo'";
    $query = $this->con->query($sql);
    $err = "";

    if($query->rowCount() > 0){
        $query->execute();
    }
    else {
      $err = 'No advertisements are posted by yourself';
    }


    $sql = "SELECT * FROM customeradvertisement WHERE CustomerID = '$cuID'";
    $query = $this->con->query($sql);
    $query->execute();
    for($i=0; $i<$query->rowCount(); $i++){
      $data[$i] = $query->fetch(PDO::FETCH_OBJ);
    }
    // $data = $query->fetch(PDO::FETCH_OBJ);

    if($query->rowCount() == 0){
        $err = 'No advertisements are posted by yourself';
    }
    $data['error'] = $err;

    return  $data;
  }




}

