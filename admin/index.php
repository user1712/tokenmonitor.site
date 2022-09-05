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
        $menu1 = 'active';
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
    if ($_SERVER['REQUEST_URI'] == '/admin/pages') {
        $menu5 = 'active';
        require 'classes/pages.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/pages.php';
        require 'catalog/view/footer.php';
        exit;
    }
    if ($_SERVER['REQUEST_URI'] == '/admin/newpage') {
        $menu5 = 'active';
        require 'classes/pages.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/newpage.php';
        require 'catalog/view/footer.php';
        exit;
    }
    if ($_SERVER['REQUEST_URI'] == '/admin/newcategory') {
        require 'classes/categories.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/newcategory.php';
        require 'catalog/view/footer.php';
        exit;
    }

    if ($_SERVER['REQUEST_URI'] == '/admin/reviews') {
        $menu3 = 'active';
        require 'classes/reviews.php';
        require 'classes/products.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/reviews.php';
        require 'catalog/view/footer.php';
        exit;
    }
    //// API
    if ($_SERVER['REQUEST_URI'] == '/admin/api/updaterate') {
        require 'classes/products.php';
        $core = new Products();
        echo $core->updateProductsRate();
        exit;
    }
    if ($_SERVER['REQUEST_URI'] == '/admin/settings') {
        $menu2 = 'active';
        require 'classes/settings.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/settings.php';
        require 'catalog/view/footer.php';
        exit;
    }
    if ($_SERVER['REQUEST_URI'] == '/admin/categories') {
        $menu4 = 'active';
        require 'classes/categories.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/categories.php';
        require 'catalog/view/footer.php';
        exit;
    }
    if(stristr($_SERVER['REQUEST_URI'], '/admin/page_')) {
        $page = preg_replace('~\D+~','', $_SERVER['REQUEST_URI']);
        require 'classes/categories.php';
        require 'classes/products.php';
        require 'catalog/view/head.php';
        require 'catalog/view/sidebar.php';
        require 'catalog/view/home.php';
        require 'catalog/view/footer.php';
        exit;
    }
    if(stristr($_SERVER['REQUEST_URI'], '/admin/sort1')) {
        $_SESSION['sort'] = 1;
        $back = $_SERVER['HTTP_REFERER'];
        header('Location:'.$back.'');
        exit;
    }
    if(stristr($_SERVER['REQUEST_URI'], '/admin/sort2')) {
        $_SESSION['sort'] = 2;
        $back = $_SERVER['HTTP_REFERER'];
        header('Location:'.$back.'');
        exit;
    }


    if ($_SERVER['REQUEST_URI']) {
        require 'classes/rout.php';
        $check = new Rout();
        $sbi = $check->Routs($_SERVER['REQUEST_URI']);
        if($sbi['type'] == 'product') {
            require 'classes/categories.php';
            require 'classes/products.php';
            require 'classes/reviews.php';
            require 'catalog/view/head.php';
            require 'catalog/view/sidebar.php';
            require 'catalog/view/editproduct.php';
            require 'catalog/view/footer.php';
            exit;
        }
        if($sbi['type'] == 'page') {
            $menu5 = 'active';
            require 'classes/pages.php';
            require 'catalog/view/head.php';
            require 'catalog/view/sidebar.php';
            require 'catalog/view/editpage.php';
            require 'catalog/view/footer.php';
            exit;
        }
        if($sbi['type'] == 'category') {
            $menu4 = 'active';
            require 'classes/categories.php';
            require 'catalog/view/head.php';
            require 'catalog/view/sidebar.php';
            require 'catalog/view/editcategory.php';
            require 'catalog/view/footer.php';
            exit;
        }
    }
} else {
    require 'classes/auth.php';
    require 'login.php';
}


?>

