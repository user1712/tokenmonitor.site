<?php
class Settings{
    public $name;
    public $email;

    public function getSetting() {
        $result = Db::dbconnect()->query("SELECT * FROM settings");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result;
    }

    public function setSetting() {
        $result = Db::dbconnect()->query("UPDATE `settings` SET `name` = '".Db::clear($this->name)."', `email` = '".Db::clear($this->email)."'");
        return $result;
    }
}