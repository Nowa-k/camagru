<?php require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); ?>
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
    <div class="content">
      <div class="juice">
        <div class="form-title">
          <h2 onclick="changeForm(this)" id="title-register">Inscription</h2>
          <h2 onclick="changeForm(this)" id="title-connexion">Connection</h2>
        </div>
        <form id="form-register" action="../controller/register.php" method="post">
          <div class="formLine">
            <label><img class='formAsset' src= "../public/log.png"/></label>
            <input type="text" id="username" name="username" />
          </div>
          <div class="formLine">
            <label><img class='formAsset' src="../public/mail.png";/></label>
            <input type="email" id="mail" name="mail" />
          </div>
          <div class="formLine">
            <label><img class='formAsset' src="../public/lock.png"/></label>
            <input type="password" id="pwd" name="pwd" />
          </div>
          <input class="validate" type="submit" value="Valider" />
        </form>

        <form id="form-connexion" action="controller/connexion.php" method="post">
          <div class="formLine">
            <label><img class='formAsset' src="../public/log.png";/></label>
            <input type="text" id="username" name="username" />
          </div>
          <div class="formLine">
            <label><img class='formAsset' src="../public/lock.png";/></label>
            <input type="password" id="pwd" name="pwd" />
          </div>
          <input class="validate" type="submit" value="Valider" />
        </form>
      </div>
    </div>
  </body>
</html>
<script src="../script/form.js"></script>
