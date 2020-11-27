<?php
include 'database.php';

class Account {

    public static function IsExist($username) {
        $result = DB::Query("SELECT username FROM users WHERE username = :username;", array("username" => $username));
        return count($result) > 0;
    }

    public static function CheckLogin($username, $password) {
        $result = DB::Query("SELECT * FROM users WHERE username = :username;", array("username" => $username));
        if(count($result) > 0) {
            if(password_verify($password, $result[0]["password"])) {
                return $result[0];
            } else {
                return NULL;
            }
        }
        return NULL;
    }

    public static function Register($email, $username, $password) {
        $result = DB::Update("INSERT INTO users (email, username, password) VALUES (:email, :username, :password);", array("email" => $email, "username" => $username, "password" => password_hash($password, PASSWORD_DEFAULT)));
        return $result;        
    }

    public static function ChangePassword($username, $password) {
        $result = DB::Update("UPDATE users SET password = :password WHERE username = :username;", array("username" => $username, "password" => password_hash($password, PASSWORD_DEFAULT)));
        return $result;
    }

    public static function ChangeUsername($username, $newusername) {
        $result = DB::Update("UPDATE users SET username = :newusername WHERE username = :username;", array("username" => $username, "newusername" => $newusername));
        return $result;
    }

    public static function ChangeUserdata($username, $datapairs) {
        $sql = "UPDATE users SET";
        $i = 0;
        foreach($datapairs as $key => &$value) {
            $sql .= " " . $key . " = :" . $key;
            if($i + 1 < count($datapairs)) $sql .= ",";
            $i++;
        }
        $sql .= " WHERE username = :username;";
        $datapairs["username"] = $username;
        $result = DB::Update($sql, $datapairs);
        return $result;
    }

}

?>