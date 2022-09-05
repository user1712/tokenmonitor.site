<?php
class Rout{
    public function Routs($url) {
        $result = Db::dbconnect()->query("SELECT * FROM urls WHERE `url` = '".Db::clear($url)."'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        if($result['product_id'] > 0) {
            $id = $result['product_id'];
            $result = Db::dbconnect()->query("SELECT * FROM products WHERE `company_id` = '$id'");
            $result = $result->fetch_array(MYSQLI_ASSOC);
            return array(
                'type' => 'product',
                'arr' => $result
            );

        }
        if($result['category_id'] > 0) {
            $id = $result['category_id'];
            $result = Db::dbconnect()->query("SELECT * FROM categories WHERE `id` = '$id'");
            $result = $result->fetch_array(MYSQLI_ASSOC);
            return array(
                'type' => 'category',
                'arr' => $result
            );
        }
        if($result['page_id'] > 0) {
            $id = $result['page_id'];
            $result = Db::dbconnect()->query("SELECT * FROM pages WHERE `id` = '$id'");
            $result = $result->fetch_array(MYSQLI_ASSOC);
            return array(
                'type' => 'page',
                'arr' => $result
            );
        }

        if($result['product_id'] OR $result['category_id'] < 1) {
            return false;
        }

    }
}