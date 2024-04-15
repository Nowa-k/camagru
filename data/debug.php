<?php 
require($_SERVER["DOCUMENT_ROOT"] . '/important.php');
require($_SERVER["DOCUMENT_ROOT"] . '/header.php'); 
?>
    <h1>Debug</h1>
    <h2>Contenue table user</h2>
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
    <h2>Les differentes tables</h2>
    <?php
    $showTables = mysqli_query($conn, "SHOW TABLES FROM $db");
    $tables = mysqli_fetch_array($showTables);
    foreach ($tables as $table) {
        var_dump($table);
    
    }
    ?>
<?php require('footer.php'); ?>