<?php 
$sql = "CREATE TABLE IF NOT EXISTS users (
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(30) NOT NULL UNIQUE,
     email VARCHAR(50) NOT NULL UNIQUE,
     pwd VARCHAR(255) NOT NULL,
     valide BOOLEAN NOT NULL DEFAULT 0
     )";

if ($conn->query($sql)) {
    echo 'Table users create';
} else {
    echo 'Failed to create table';
}

$sql = "CREATE TABLE IF NOT EXISTS assetfeed (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo 'Table assetfeed create';
} else {
    echo 'Failed to create table';
}
?>