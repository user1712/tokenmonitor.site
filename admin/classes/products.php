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

    public function getProducts()
    {
        $result = Db::dbconnect()->query("SELECT * FROM products");
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

        $result = Db::dbconnect()->query("INSERT INTO `products`(`name`, `phone`, `location`, `email`, `text`, `image`, `category_id`, `date`, `site`) VALUES ('".Db::clear($this->product)."','".Db::clear($this->phone)."','".Db::clear($this->location)."','".Db::clear($this->email)."','".Db::clear($this->text)."','".Db::clear($this->image)."','".Db::clear($this->category_id)."',NOW(), '".Db::clear($this->site)."')");
        $result = Db::dbconnect()->query("INSERT INTO `urls`(`product_id`, `category_id`, `url`) VALUES ((SELECT `company_id` FROM products ORDER BY company_id DESC LIMIT 1),'0', '/admin/$this->url');");

        return $result;

    }

    public function updateProduct($data) {
        if($this->category_id > 0) {
            if($this->category_id_2 > 0) {
                $this->category_id = $this->category_id_2;
            }
            $result = Db::dbconnect()->query("UPDATE `products` SET `category_id` = '$this->category_id' WHERE `company_id` = '$this->product_id'");
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

            $result = Db::dbconnect()->query("UPDATE `products` SET `image` = '$this->image' WHERE `company_id` = '$this->product_id'");

        }
        $result = Db::dbconnect()->query("UPDATE `products` SET `name` = '$this->product', `phone` = '$this->phone', `location` = '$this->location', `email` = '$this->email', `text` = '$this->text', `site` = '$this->site' WHERE `company_id` = '$this->product_id'");
        return $result;
    }

}

