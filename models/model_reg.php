<?php

require_once ROOT . "/Database.php";
if(isset($_POST['submit']))
{
    // $id=$_POST['id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $address=$_POST['address'];
    $gender=$_POST['gender'];
    $nic=$_POST['nic'];
    $phone_num=$_POST['phone_num'];
    $email=$_POST['email'];
    $password=$_POST['password'];
 $sql = 'INSERT INTO regCustomers '.
 '(First Name,Last Name,address,nic,phone_num,email,password) '.
 'VALUES ("'.$fname.'","'.$lname.'","'.$address.'","'.$gender.'","'.$nic.'","'.$phone_num.'","'.$email.'","'.$password.'")';

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
} 