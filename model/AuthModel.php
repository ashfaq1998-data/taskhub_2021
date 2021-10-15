<?php

require_once ROOT . "/Database.php";

class AuthModel extends Database {
  
  public function login($email, $password) {
    $sql = "SELECT * FROM users WHERE email='$email'"; //what if the relevant email is not found also will code execute after email not found
    $query = $this->con->query($sql); //doubt have
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    if (password_verify($password, $data->password)) {
        return $data;
    }else {
        return false;
    }
  } 

  public function register($userDetails) {
    $id = $userDetails['id'];
    $email = $userDetails['email'];
    $password = $userDetails['password'];
    $user_type_id = $userDetails['user_type_id'];

    $sql = "INSERT INTO users (id, email, password, user_type_id) 
            VALUES ('$id', '$email', '$password', $user_type_id)";

    if($this->con->query($sql)){
        return true;
    }else{
        return false;
    }
  }

}