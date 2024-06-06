
<div class="content">
    <?php
    // Send mail
    if (isset($_POST['forget'])) {
        $to = $_POST['forget'];
        $sql = "SELECT * FROM users WHERE email='$to'";
        $resultat = $conn->query($sql);
        if ($resultat->num_rows == 1) {
            $row = $resultat->fetch_assoc();
            $uuid = $row['uuid'];
            $subject = "Mot de passe oublie";
            $message = "
            <html>
            <head>
                <title>Pour accéder à votre demande de nouveau mot</title>
            </head>
            <body>
                <h1>Pour accéder à votre demande de nouveau mot</h1>
                <a href='http://127.0.0.1:8080/view/forget.php?code= ". $uuid ."' target='_blank' style='background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 8px;'>Nouveau mot de passe</a>
            </body>
            </html>";

            // En-têtes de l'e-mail
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: camagru42@outlook.fr\r\n";
            $headers .= "Reply-To: camagru42@outlook.fr\r\n";

            if (mail($to, $subject, $message, $headers)) {
                ?>
                    <h2>Email envoyer avec succes</h2>
                    <p>Vous avez recu un mail avec un lien afin de changer de mot de passe<p>
                <?php
            } else {
                echo "Erreur lors de l'envoi de l'e-mail.";
            }
        }
    }

    // Formulaire password
    if (isset($_GET['code'])) {
        ?>
            <h2>Modifier son mot de passe</h2>
            <form action="../view/forget.php" method="post">
                <div class="formLine">
                    <label><img class="formAsset" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB+klEQVR4nO2Yzy5DQRTGSywlEmsJZ64FXoEEYcGK57CjEYlNLdtzauclxI7nsGHhz1J6TmND7Cxw5bRRvX9ao+b2FvMlJ2na3rnfb+Y7c6ctFLy8vLy8vOIqhcNTFVkEki1DvJdnAcmWelFPBRtNHN6NA8m5IQkHqYDkXL1ZQQQoa4bkYWDMIz8FyBtW5lsQh3fTgHyZt3lDcj1Z5ZkvDZtqbQVQyu1Zmzu6HzXIJ7mZRzk15YexlskwHNK+CCr15SQA1XebF/JZ2kUG+aV/xvmt22QCSTEBAMQHkWUry2wefQEpeY/HWb1+BdAcqMqbfe6L63jeDcl6fOKsAGyWsh95N8SviVWyBmhVhn2B35+kHgCy6QuwyLtLgJ5vaJv3wHJCegZw1hed8o52kfwZwE9MONoUwAnAN/vCZfzAIYCuxKPu1XFjBvmibeYv9L3E/o6Na8N8ARrFr1DhfY3Rx3iLpXBEV0NLX7dHTb+btr+b/AA69EVMrh6CkBlAE+IqoPpSfHw9QepnLu4BmQJ8gtwY5GMtILl1OTb0BSDDAg9AfgVCH6E/2MRS/DUAKDupf6vkbczYVrW2kgDQ84rrB04mhXITOVtFV4EXAOV5gKPzbJDnU81HIAZxJbBxNOluPhInrK0Cybb+gsq1SLY18x1j4+Xl5eX1r/UOP8h8VC4qJJwAAAAASUVORK5CYII="></label>
                    <input type="email" id="email" name="email" />
                </div>
                <input type="hidden" id="code" name="code" value=<?php echo $_GET['code']; ?>>
                <div class="formLine">
                    <label><img class="formAsset" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABOklEQVR4nO2WsUoDQRCGt1exELRQwZlTFF9C7QxpfRJBbIWA5Ga08z0UES19A/UZkptZg5DC2Akqm2ysjOvdbYji/TDN3DDfzr+7d2dMpW+EbOeBpIGs90jyAiQdILkF0n1sdmfNOASse8DyjKzvXwbJY0K6Gx2KJG8OAKTnK6luLbCdcpGw3QbWi/4zlldkW49nLw8ntQej6+TQT9/dOM7mSoNhsKf9SYOLJL30kx+VBiPpg2vm7A3VJqnd8Yu8Kw0Gkp5rtnnWmQ7VrqdPMwOw9EqD0Z/acdVPHoxs60CajbyvOQNY28haC4J9YRToJ5y09WOrYoepwL/TapKrtdPW4mqzvQQk14XznBPsGgzzyUm2XDT/d8DOLtfMNQGWm6L56joFrf4fby6Y4EeiFhPuoNF/eyuZHPoAYYHe18MF56kAAAAASUVORK5CYII="></label>
                    <input type="password" id="pwd" name="pwd" />
                </div>
                <div class="formLine">
                    <input class="validate" type="submit" value="Valider" />
                </div>
            </form>
        <?php
    }

    // Action new password
    if (isset($_POST['email']) && isset($_POST['code']) && isset($_POST['pwd'])) {
        $mail = $_POST['email'];
        $code = $_POST['code'];
        $pwd = $_POST['pwd'];
        $sql = "SELECT * FROM users WHERE email='$mail' AND uuid='$code'";
        echo "first";
        $resultat = $conn->query($sql);
        echo $resultat->num_rows;
        if ($resultat->num_rows == 1) {
            echo "in";
            $row = $resultat->fetch_assoc();
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET pwd='$pwd' WHERE uuid='$code'";
            if ($conn->query($sql) === TRUE) {   
                echo "Faire attention a la secu des mots de passs";
            } else {
                echo "Failed to like" . $conn->error;
            }
            ?><h2>Le nouveau mot de passe est actif, veuillez-vous connecter</h2><?php
        }
    }
    ?>
    </div>