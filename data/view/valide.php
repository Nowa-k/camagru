<?php
$to = 'a.ferrand69@gmail.com';
$subject = 'Test d\'e-mail depuis Docker';
$message = 'Ceci est un test d\'e-mail envoyé depuis Docker.';
$headers = 'From: doudoufoot.em@live.com';

// Commande pour envoyer l'e-mail via msmtp
$command = 'echo "' . $message . '" | msmtp -a camagru ' . $to . ' 2>&1';

// Exécute la commande et capture la sortie
$output = shell_exec($command);

// Affiche la sortie (y compris les éventuelles erreurs)
echo nl2br($output);
?>
<!-- echo -e "Subject: Test\n\nThis is a test email." | msmtp --debug --from=default -t doudoufoot.em@live.fr -->
