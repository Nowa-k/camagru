<?php require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); ?>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Camagru</title>
    <link href="css/header.css" rel="stylesheet">
    <link href="css/bord.css" rel="stylesheet">
</head>
<body>
<?php 
require('header.php');
if (isset($_SESSION['username']) && !empty($_SESSION['username'])){
    require("./view/bord.php");
} else {
    echo '<h1>Bonjour, connectez vous ou inscrivez vous!</h1>';
}
require('footer.php');
?>
</body>
</html>