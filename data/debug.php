<?php 
require($_SERVER["DOCUMENT_ROOT"] . '/important.php');
require($_SERVER["DOCUMENT_ROOT"] . '/header.php');
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