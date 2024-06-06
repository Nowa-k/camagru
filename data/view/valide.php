<?php
if (isset($_SESSION['uuid'])) {
    $to = $_SESSION['email'];
}

if (isset($_POST['send'])) {
    $subject = "Valider son compte";
    $message = "
    <html>
    <head>
        <title>Valider votre compte</title>
    </head>
    <body>
        <h1>Merci de votre inscription sur le site !</h1>
        <p>Derniere etape afin de valider votre compte et de profiter de Camagru</p>
        <p>Merci de cliquer sur le bouton ci-dessous pour valider votre compte :</p>
        <a href='http://127.0.0.1:8080/controller/validate.php?code=" . $_SESSION['uuid'] . "' target='_blank' style='background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 8px;'>Valider mon compte</a>
    </body>
    </html>";

// En-têtes de l'e-mail
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: camagru42@outlook.fr\r\n";
$headers .= "Reply-To: camagru42@outlook.fr\r\n";

// Envoi de l'e-mail
if (mail($to, $subject, $message, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
        echo "Erreur lors de l'envoi de l'e-mail.";
    }
}

?>
<div class="content">
    <h2>Valide ton email</h2>
    <form action="../index.php" method="post">
        <input type="hidden" name="send" value="1"/>
        <input type="submit" value="Renvoyer un mail" />
    </form>
</div>
