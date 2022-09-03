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

        }
        if($result['product_id'] OR $result['category_id'] < 1) {
            return false;
        }

    }
}