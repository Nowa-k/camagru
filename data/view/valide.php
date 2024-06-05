<?php
// ini_set('sendmail_path', '/usr/bin/msmtp -t');

// phpinfo();
// Destinataire
$to = "a.ferrand69@gmail.com";

// Sujet de l'e-mail
$subject = "Test d'e-mail avec PHP et msmtp";

// Contenu de l'e-mail
$message = "Ceci est un test d'e-mail envoyé avec PHP et msmtp.";

// Headers
$headers = "From: camagru42@outlook.fr\r\n";
$headers .= "Reply-To: camagru42@outlook.fr\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Envoi de l'e-mail
if (mail($to, $subject, $message, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}
?>