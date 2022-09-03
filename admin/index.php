<?php
session_start();
require '' . $_SERVER['DOCUMENT_ROOT'] . '/classes/mysql.php';

if (is_file('../config.php')) {
    require_once('../config.php');
}

if ($_SESSION['auth'] == 1) {
    if ($_SERVER['REQUEST_URI'] == '/admin/') {
        require 'classes/categories.php';
        require 'classes/products.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/home.php';
        require 'catalog/view/footer.php';
        exit;
    }

    if ($_SERVER['REQUEST_URI'] == '/admin/newproduct') {
        require 'classes/categories.php';
        require 'classes/products.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/newproduct.php';
        require 'catalog/view/footer.php';
        exit;
    }

    if ($_SERVER['REQUEST_URI']) {
        require 'classes/rout.php';
        $check = new Rout();
        $sbi = $check->Routs($_SERVER['REQUEST_URI']);
        if($sbi['type'] == 'product') {
            require 'classes/categories.php';
            require 'classes/products.php';
            require 'catalog/view/head.php';
            require 'catalog/view/sidebar.php';
            require 'catalog/view/editproduct.php';
            require 'catalog/view/footer.php';
            exit;
        }
    }
} else {
    require 'classes/auth.php';
    require 'login.php';
}


?>

