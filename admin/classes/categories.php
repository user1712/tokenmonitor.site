<?php

class Categories {
    public $category_id;

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

    public function getCategory()
    {
        $result = Db::dbconnect()->query("SELECT `category`  FROM categories WHERE id = '$this->category_id'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result['category'];
    }
}

