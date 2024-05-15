<?php 
    $sql = "ALTER TABLE assetfeed ADD uId INT";
    $conn->query($sql);

    $sql = "ALTER TABLE assetFeed DROP uId";
    $conn->query($sql);
    
?>