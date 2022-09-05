<?php
class Pages{
    public $h1;
    public $desc;
    public $text;
    public $url;
    public $id;

    public function getPages() {
        $result = Db::dbconnect()->query("SELECT * FROM pages ORDER BY id DESC");
        return $result;
    }

    public function setPages() {
        $result = Db::dbconnect()->query("INSERT INTO `pages`(`h1`, `desc`, `text`, `status`, `date`) VALUES ('" . Db::clear($this->h1) . "','" . Db::clear($this->desc) . "','" . Db::clear($this->text) . "', '1', NOW())");
        $result = Db::dbconnect()->query("INSERT INTO `urls`(`product_id`, `category_id`, `page_id`, `url`) VALUES ('0','0', (SELECT `id` FROM pages ORDER BY id DESC LIMIT 1), '/admin/$this->url');");
        return $result;
    }

    public function getPageUrl($id) {
        $result = Db::dbconnect()->query("SELECT `url` FROM urls WHERE `page_id` = '$id'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result['url'];
    }

    public function updPages() {
        $result = Db::dbconnect()->query("UPDATE `pages` SET `h1` = '" . Db::clear($this->h1) . "', `desc` =  '" . Db::clear($this->desc) . "', `text` = '" . Db::clear($this->text) . "' WHERE `id` = '$this->id'");
        $result = Db::dbconnect()->query("UPDATE `urls` SET `url` = '" . Db::clear('/admin/'.$this->url.'') . "' WHERE `page_id` = '$this->id'");

        return $result;
    }

    public function deaPage($id) {
        $result = Db::dbconnect()->query("UPDATE `pages` SET `status` = '0' WHERE `id` = '$id'");
        return $result;
    }
    public function actPage($id) {
        $result = Db::dbconnect()->query("UPDATE `pages` SET `status` = '1' WHERE `id` = '$id'");
        return $result;
    }
    public function removePage($id) {
        $result = Db::dbconnect()->query("DELETE FROM `pages` WHERE `id` = '$id'");
        $result = Db::dbconnect()->query("DELETE FROM `urls` WHERE `page_id` = '$id'");
        return $result;
    }
}