<?php
// DB configs
define('DB_HOST', 'local');
define('DB_NAME', 'db_name');
define('DB_USERNAME', 'db_user_name');
define('DB_PASSWORD', 'db_user_pass');

// Esteblish DB connection
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('DB connection faild: ' . $e->getMessage());
}