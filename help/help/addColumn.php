<?php 
    $sql = "ALTER TABLE users ADD notif BOOLEAN DEFAULT 1";
    $conn->query($sql);

    $sql = "ALTER TABLE assetFeed DROP uId";
    $conn->query($sql);
    
?>