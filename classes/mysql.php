<?php
class Db
{

    public static function dbconnect()
    {
        $connect = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Couldn't connect");
        $connect->set_charset("utf8");
        return $connect;
    }
    public function escape($value) {
        return Db::dbconnect()->real_escape_string($value);
    }
    public function getLastId() {
        return $this->connect->insert_id;
    }

}

