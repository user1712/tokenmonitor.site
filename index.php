<?php
// Configuration
if (is_file('config.php')) {
    require_once('config.php');
}
// Startup
require_once(DIR_SYSTEM . '/classes/mysql.php');
require_once(DIR_SYSTEM . '/catalog/view/home/header.php');
require_once(DIR_SYSTEM . '/catalog/view/home/head.php');
require_once(DIR_SYSTEM . '/catalog/view/home/home.php');
require_once(DIR_SYSTEM . '/catalog/view/home/footer.php');

