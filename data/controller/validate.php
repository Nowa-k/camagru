<?php
    require($_SERVER["DOCUMENT_ROOT"] . '/important.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/header.php');
    ?>
    <html lang="fr">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width" />
            <title>Camagru</title>
            <link href="../css/header.css" rel="stylesheet">
            <link href="../css/bord.css" rel="stylesheet">
        </head>
        <div class="content">
            <?php 
            if (isset($_GET['code'])) {
                $uuid = $_GET['code'];
                $sql = "SELECT id, uuid, username, email, pwd, valide FROM users WHERE uuid='$uuid'";
                $resultat = $conn->query($sql);
                if ($resultat->num_rows == 1) {
                    $row = $resultat->fetch_assoc();
                    ?>
                    <h1>Le mail a été valide avec succès</h1>
                    <h2>Bienvenue sur Camagru</h2>
                    <?php 
                    $sql = "UPDATE users SET valide = 1 WHERE uuid = '$uuid'";
                    $conn->query($sql);
                    $_SESSION['valide'] = 1;
                } else { ?>
                    <h2>Code invalide, renvoyer un code pour</h2>
                    <?php }
            }?>
        </div>
        <?php
require( '../footer.php');
?>