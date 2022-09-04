<?php
class Reviews{
    public $reviews_id;
    public $product_id;
    public $name;
    public $email;
    public $rate;
    public $text;

    public function getReviews() {
        $result = Db::dbconnect()->query("SELECT * FROM reviews ORDER BY status DESC");
        return $result;
    }

    public function setRate() {
        $result = Db::dbconnect()->query("SELECT `rate`,`product_id` FROM reviews WHERE id = '$this->reviews_id'");
        $result = $result->fetch_array(MYSQLI_ASSOC);
        $this->product_id = $result['product_id'];
        $result = Db::dbconnect()->query("UPDATE `reviews` SET `status` = 1 WHERE id = '$this->reviews_id'");
        return $result;
    }

    public function removeRate() {
        $result = Db::dbconnect()->query("DELETE FROM `reviews` WHERE `id` = '$this->reviews_id'");
        return $result;
    }

    public function addReview() {
        $result = Db::dbconnect()->query("INSERT INTO `reviews`(`product_id`, `name`, `email`, `rate`, `text`, `status`, `date`) VALUES ('$this->product_id', '$this->name', '$this->email', '$this->rate', '$this->text', '0', NOW());");
        return $result;

    }
}