<?php
$to = 'camagruweb@gmail.com';
$subject = 'Test d\'e-mail depuis Docker';
$message = 'Ceci est un test d\'e-mail envoyé depuis Docker.';
$headers = 'From: camagruweb@gmail.com';

// Commande pour envoyer l'e-mail via msmtp
$command = 'echo "' . $message . '" | msmtp -a alex ' . $to . ' 2>&1';

// Exécute la commande et capture la sortie
$output = shell_exec($command);

// Affiche la sortie (y compris les éventuelles erreurs)
echo nl2br($output);
?>
