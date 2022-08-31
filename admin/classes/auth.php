<?php
require ''.$_SERVER['DOCUMENT_ROOT'].'/classes/mysql.php';

class Auth {
    public $email;
    public $password;

    public function login()
    {
        $result = Db::dbconnect()->query("SELECT email FROM users WHERE email = '".Db::clear($this->email)."'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        if($result['email'] == $this->email) {
            $result = Db::dbconnect()->query("SELECT pass FROM users WHERE email = '".Db::clear($this->email)."'");
            $result = $result->fetch_array(MYSQLI_ASSOC);
            if (password_verify(Db::clear($this->password), $result['pass'])) {
                $_SESSION['auth'] = 1;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function security()
    {
        $round = htmlspecialchars($_COOKIE["auth"]);
        if($_COOKIE["auth"] > 0) {
            setcookie("auth", $round + 1, time()+3600);
        } else {
            setcookie("auth", 1, time()+3600);
        }
        if($round > 5) {
            return true;
        }
    }

}

