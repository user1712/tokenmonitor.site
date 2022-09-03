<?php

class Products
{
    public $product;
    public $location;
    public $phone;
    public $email;
    public $text;
    public $image;
    public $category_id;
    public $category_id_2;

    public function getProducts()
    {
        $result = Db::dbconnect()->query("SELECT * FROM products");
        return $result;
    }

    public function setProduct($data)
    {
        var_dump(isset($this->image));     // FALSE


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

        $result = Db::dbconnect()->query("INSERT INTO `products`(`name`, `phone`, `location`, `email`, `text`, `image`, `category_id`, `date`) VALUES ('$this->product','$this->phone','$this->location','$this->email','$this->text','$this->image','$this->category_id',NOW())");
        return $result;

    }

}

