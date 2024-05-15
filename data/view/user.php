<?php 
  require($_SERVER["DOCUMENT_ROOT"] . '/important.php');

  if (isset($_POST['form-connexion'])){
    require("../controller/connexion.php");
  }
?>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Camagru - Register</title>
    <link href="../css/header.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">
</head>
  <body>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/header.php'); ?>
    <?php 
      if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        include('accountSetting.php');
      } else {
        include('connexion.php');
      }
      ?>
  </body>
</html>
<script src="../script/form.js"></script>
