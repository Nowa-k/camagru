<?php
    session_start();
    $host = "mysql-service";   // MySQL server hostname within the same Docker network
    $user = "db_user";    // MySQL username
    $pass = "password";   // MySQL password
    $db = "test_database";// MySQL database name

    // Create a new MySQLi object to establish a database connection
    $conn = new mysqli($host, $user, $pass, $db);
    $rootPath = "http://127.0.0.1:8080";

    
?>