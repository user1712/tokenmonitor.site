<?php
session_start();

if (is_file('../config.php')) {
    require_once('../config.php');
}
if($_SESSION['auth'] == 1) {
    require 'catalog/view/head.php';
    require 'catalog/view/sidebar.php';
    require 'catalog/view/home.php';
    require 'catalog/view/footer.php';
    exit;
} else {
    require 'classes/auth.php';
    require 'login.php';
}

?>


