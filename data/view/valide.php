<?php require($_SERVER["DOCUMENT_ROOT"] . '/important.php');
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    if (isset($_SESSION['valide']) && ($_SESSION['valide'] == 1)) {
        header("Location: ../index.php");
    }
}
?>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Camagru - Valide email</title>
    <link href="css/header.css" rel="stylesheet">
</head>
<body>
<?php 
require('../header.php');
$to = "a.ferrand69@gmail.com";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";
if (mail($to, $subject, $body, 'From: no-reply@camagru.com')) {
   echo "<p>Message successfully sent!</p>";
} else {
   echo "<p>Message delivery failed...</p>";
}
    
require('../footer.php');
?>
</body>
</html>
