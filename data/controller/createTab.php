<?php 
$sql = "CREATE TABLE IF NOT EXISTS users (
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(30) NOT NULL UNIQUE,
     email VARCHAR(50) NOT NULL UNIQUE,
     pwd VARCHAR(50) NOT NULL
     )";

if ($conn->query($sql)) {
    echo 'Table users create';
} else {
    echo 'Failed to create table';
}
?>