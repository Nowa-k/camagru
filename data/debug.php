<?php 
require($_SERVER["DOCUMENT_ROOT"] . '/important.php');
require($_SERVER["DOCUMENT_ROOT"] . '/header.php');
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
   iduser INT NOT NULL,
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
   iduser INT NOT NULL
)";

if ($conn->query($sql)) {
   echo 'Table likes create';
} else {
   echo 'Failed to create table';
}
?>
    <h1>Debug</h1>
    <h2>Le contenu des tables</h2>
    <h3>Users</h3>
    <?php 
        $sql = "SELECT * FROM users";
        $resultats = $conn->query($sql);
        foreach ($resultats as $res) {
            var_dump($res);
            ?>
            <br>
            <?php
        }
    ?>
    <h3>Feed</h3>
    <?php 
        $sql = "SELECT * FROM assetfeed";
        $resultats = $conn->query($sql);
        foreach ($resultats as $res) {
            var_dump($res);
            echo "<br>";
        }
    ?>

    <h3>Comments</h3>
    <?php 
        $sql = "SELECT * FROM comments";
        $resultats = $conn->query($sql);
        foreach ($resultats as $res) {
            var_dump($res);
            echo "<br>";
        }
    ?>

    <h3>Likes</h3>
    <?php 
        $sql = "SELECT * FROM likes";
        $resultats = $conn->query($sql);
        foreach ($resultats as $res) {
            var_dump($res);
            echo "<br>";
        }
    ?>
    <h2>Les differentes tables</h2>
    <?php
    $showTables = mysqli_query($conn, "SHOW TABLES FROM $db");
    while ($tables = mysqli_fetch_array($showTables)) {
        foreach ($tables as $table) {
            var_dump($table);
            echo "<br>";
        }
    }
    ?>


<?php require('footer.php'); ?>