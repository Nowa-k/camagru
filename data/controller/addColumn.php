<?php 
    $sql = "ALTER TABLE users ADD valid BOOLEAN";
    $conn->query($sql);
?>