<?php

class Products
{
    public $product;
    public $location;
    public $phone;
    public $email;
    public $text;
    public $image;
    public $site;
    public $category_id;
    public $category_id_2;
    public $url;
    public $product_id;
    public $sort;

    public function getProducts($page)
    {
        if ($page > 0) {
            $start = $page * 10 - 10;
            $end = $page * 10;
            $result = Db::dbconnect()->query("SELECT * FROM products ORDER BY $this->sort DESC LIMIT $start, $end");
            return $result;
        } else {
            $result = Db::dbconnect()->query("SELECT * FROM products ORDER BY $this->sort DESC LIMIT 10");
            return $result;
        }
    }
    public function getProduct()
    {
        $result = Db::dbconnect()->query("SELECT * FROM products WHERE company_id = '$this->product_id'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result;
    }
    public function getProductsPages()
    {
        $result = Db::dbconnect()->query("SELECT COUNT(company_id) as value FROM products");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        $result = ceil($result['value'] / 10);
        return $result;
    }

    public function getProductUrl()
    {
        $result = Db::dbconnect()->query("SELECT `url` FROM urls WHERE product_id = '$this->product'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        return $result['url'];
    }

    public function setProduct($data)
    {

        if (empty($this->image) == false) {

            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string)finfo_file($fi, $data['userfile']['tmp_name']);
            if (strpos($mime, 'image') === false) {
                return false;
            }

            $uploaddir = '../images/';
            $uploadfile = $uploaddir . basename($data['userfile']['name']);
            move_uploaded_file($data['userfile']['tmp_name'], $uploadfile);
        } else {
            $this->image = 'noimage.jpg';
        }


        if ($this->category_id_2 > 1) {
            $this->category_id = $this->category_id_2;
        }
        if ($this->category_id < 1) {
            return false;
            exit;
        }

        $result = Db::dbconnect()->query("INSERT INTO `products`(`name`, `phone`, `location`, `email`, `text`, `image`, `category_id`, `date`, `site`, `rate`) VALUES ('" . Db::clear($this->product) . "','" . Db::clear($this->phone) . "','" . Db::clear($this->location) . "','" . Db::clear($this->email) . "','" . Db::clear($this->text) . "','" . Db::clear($this->image) . "','" . Db::clear($this->category_id) . "',NOW(), '" . Db::clear($this->site) . "', '0')");
        $result = Db::dbconnect()->query("INSERT INTO `urls`(`product_id`, `category_id`, `url`, `page_id`) VALUES ((SELECT `company_id` FROM products ORDER BY company_id DESC LIMIT 1),'0', '/admin/$this->url', '0');");

        return $result;

    }

    public function updateProduct($data)
    {
        if ($this->category_id > 0) {
            if ($this->category_id_2 > 0) {
                $this->category_id = $this->category_id_2;
            }
            $result = Db::dbconnect()->query("UPDATE `products` SET `category_id` = '" . Db::clear($this->category_id) . "' WHERE `company_id` = '$this->product_id'");
        }
        if (strlen($this->image) > 0) {
            echo strlen($this->image);
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string)finfo_file($fi, $data['userfile']['tmp_name']);
            if (strpos($mime, 'image') === false) {
                return false;
            }

            $uploaddir = '../images/';
            $uploadfile = $uploaddir . basename($data['userfile']['name']);
            move_uploaded_file($data['userfile']['tmp_name'], $uploadfile);

            $result = Db::dbconnect()->query("UPDATE `products` SET `image` = '" . Db::clear($this->image) . "' WHERE `company_id` = '$this->product_id'");

        }
        $result = Db::dbconnect()->query("UPDATE `products` SET `name` = '" . Db::clear($this->product) . "',  `phone` = '" . Db::clear($this->phone) . "', `location` = '" . Db::clear($this->location) . "', `email` = '" . Db::clear($this->email) . "', `text` = '" . Db::clear($this->text) . "', `site` = '" . Db::clear($this->site) . "' WHERE `company_id` = '$this->product_id'");
        return $result;
    }

    public function removeProduct($id)
    {
        $result = Db::dbconnect()->query("DELETE FROM `products` WHERE `company_id` = '$id'");
        $result = Db::dbconnect()->query("DELETE FROM `urls` WHERE `product_id` = '$id'");
        return $result;
    }

    public function updateProductsRate()
    {
        $result = Db::dbconnect()->query("SELECT * FROM products");
        $i=0;
        foreach($result as $value) {
            $rate = array(1000);
            $i++;
            if(strlen($value['location']) > 6) {array_push($rate, 100);}
            if(strlen($value['site']) > 6) {array_push($rate, 100);}
            if(strlen($value['text']) > 120) {array_push($rate, 100);}
            if($value['image'] !== 'noimage.jpg') {array_push($rate, 100);}
            $rate = array_sum($rate);
            $this->product_id = $value['company_id'];

            $result = Db::dbconnect()->query("SELECT SUM(`rate` / (SELECT COUNT(`rate`) FROM reviews WHERE `product_id` = '$this->product_id' AND status = 1)) as `val`  FROM reviews WHERE `product_id` = '$this->product_id' AND status = 1");
            $result = $result->fetch_array(MYSQLI_ASSOC);
            if($result['val'] > 4.5) {$point = $result['val'] * 100;}
            if($result['val'] > 4 AND $result['val'] < 4.5) {$point = $result['val'] * 50;}
            if($result['val'] > 3 AND $result['val'] < 4) {$point = $result['val'] * 20;}

            $point = $point + $rate;
            $result = Db::dbconnect()->query("UPDATE `products` SET `rate` = '$point' WHERE `company_id` = '$this->product_id'");
            unset($point);
            unset($rate);
        }

        return json_encode(array(
            'products_check' => $i,
            'status'         => $result,
        ));
    }
}

