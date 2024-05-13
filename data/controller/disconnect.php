<?php
    require($_SERVER["DOCUMENT_ROOT"] . '/important.php');
    session_destroy();
    header("Location: ../index.php");
    exit();
?>