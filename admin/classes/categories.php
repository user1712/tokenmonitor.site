<?php

class Categories {
    public $category_id;
    public $category_name;
    public $url;
    public $parent;

    /// Главные категории
    public function getParentCategory()
    {
        $result = Db::dbconnect()->query("SELECT `category`, `id` FROM categories WHERE parent = 0");
        return $result;
    }
    /// Получение категорий второго уровня
    public function getFinalCategories($parent)
    {
        $result = Db::dbconnect()->query("SELECT `category`, `id` FROM categories WHERE parent = '$parent'");
        return $result;
    }
    //// Блоки категорий
    public function getBlockCategories()
    {
        $result = Db::dbconnect()->query("SELECT DISTINCT (`parent`) FROM categories WHERE parent > 0");
        return $result;
    }
    public function getCategoryName($id)
    {
        $result = Db::dbconnect()->query("SELECT `category` FROM categories WHERE id = '$id'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result['category'];
    }
    public function getCategory()
    {
        $result = Db::dbconnect()->query("SELECT `category`  FROM categories WHERE id = '$this->category_id'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result;
    }
    public function getCategoryUrl($id)
    {
        $result = Db::dbconnect()->query("SELECT `url`  FROM urls WHERE category_id = '$id'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result['url'];
    }
    public function removeCategory()
    {
        $result = Db::dbconnect()->query("DELETE FROM `categories` WHERE `id` = '$this->category_id'");
        $result = Db::dbconnect()->query("SELECT `id`  FROM categories WHERE parent = '$this->category_id'");
        foreach ($result as $item) {
            $id = $item['id'];
            $result = Db::dbconnect()->query("DELETE FROM `categories` WHERE `id` = '$id'");
        }

    }

    public function setCategory()
    {
        $result = Db::dbconnect()->query("INSERT INTO `categories`(`category`, `parent`, `status`) VALUES ('" . Db::clear($this->category_name) . "','" . Db::clear($this->category_id) . "','1')");
        $result = Db::dbconnect()->query("INSERT INTO `urls`(`product_id`, `category_id`, `page_id`, `url`) VALUES ('0', (SELECT `id` FROM categories ORDER BY id DESC LIMIT 1), '0', '/admin/$this->url');");

        return $result;
    }

    public function updCategory()
    {
        if($this->parent == 'no') {
            $result = Db::dbconnect()->query("UPDATE `categories` SET `category` = '$this->category_name' WHERE id = '$this->category_id'");
            return $result;
        } else {
            $result = Db::dbconnect()->query("UPDATE `categories` SET `category` = '$this->category_name', `parent` = '$this->parent' WHERE id = '$this->category_id'");
            return $result;
        }
    }
}

