<?php

require_once ROOT . "/Database.php";

class UsersModel extends Database {

    public function generateUserID(){
        $str_part = "user";
        $user_id = "";
        
        while(true){
            $num_part = rand(100, 999);
            $user_id = $str_part . strval($num_part);

            $sql = "SELECT * FROM users WHERE id='$user_id'";
            $query = $this->con->query($sql);
            $query->execute();

            if ($query->rowCount() == 0){
                break;
            }
        }
        return $user_id;
    }

    public function checkUserEmail($email){
        $sql = "SELECT * FROM users WHERE email='$email'";
        $query = $this->con->query($sql);
        $query->execute();

        if ($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}