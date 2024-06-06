<?php 
$sql = "CREATE TABLE IF NOT EXISTS users (
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     uuid VARCHAR(50) NOT NULL UNIQUE,
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
    idUsers VARCHAR(30) NOT NULL, 
    likes INT DEFAULT 0,
    comments INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo 'Table assetfeed create';
} else {
    echo 'Failed to create table';
}

$sql = "CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idFile VARCHAR(255) NOT NULL,
    comment VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo 'Table comments create';
} else {
    echo 'Failed to create table';
}

$sql = "CREATE TABLE IF NOT EXISTS likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idfile VARCHAR(255) NOT NULL,
    idlike VARCHAR(255) NOT NULL
)";

if ($conn->query($sql)) {
    echo 'Table likes create';
} else {
    echo 'Failed to create table';
}


$sql = "DROP TABLE likes";
$conn->query($sql);

$sql = "ALTER TABLE assetfeed ADD uId INT";
$conn->query($sql);

?>