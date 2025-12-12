<?php

session_start();
require_once 'config.php';

// posting start
if (isset($_POST['listing'])) {
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
}

?>