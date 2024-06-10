<?php
define('DB_HOST', 'mysql-service');
define('DB_NAME', 'camagru');
define('DB_USER', 'db_user');
define('DB_PASS', 'password');

function getDBConnection() {
    return new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
}
?>
