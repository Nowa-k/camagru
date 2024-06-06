<?php

require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); 

function sendMail($conn, $idFile)
{
    $sql = "SELECT idUsers FROM assetfeed WHERE filename='$idFile'";
    $resultat = $conn->query($sql);
    if ($resultat->num_rows == 1) {
        $row = $resultat->fetch_assoc();
        $uuid = $row['idUsers'];
        $sql = "SELECT email, notif FROM users WHERE uuid='$uuid'";
        $resultat = $conn->query($sql);
        if ($resultat->num_rows == 1) {
            $row = $resultat->fetch_assoc();
            if ($row['notif'] == "0") {
                return ;
            }
            $to = $row['email'];
            $subject = "Nouveau commentaire";
            $message = "
            <html>
            <head>
                <title>Une de vos publications a été commentée.</title>
            </head>
            <body>
                <h1>Une de vos publications a été commentée.</h1>
                <a href='http://127.0.0.1:8080' target='_blank' style='background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 8px;'>Aller sur le site</a>
            </body>
            </html>";

            // En-têtes de l'e-mail
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: camagru42@outlook.fr\r\n";
            $headers .= "Reply-To: camagru42@outlook.fr\r\n";

            if (mail($to, $subject, $message, $headers)) {
                echo "E-mail envoyé avec succès.";
            } else {
                echo "Erreur lors de l'envoi de l'e-mail.";
            }
        }
    }
}

$username = $_SESSION['username'];
$id = $_SESSION['id'];
// Vérifie si des données d'image ont été envoyées
if (isset($_POST['filename'])) {
    $fileName = $_POST['filename'];
    $sql = "SELECT * FROM likes WHERE idfile = '$fileName' AND iduser = '$id'";
    $resultats = $conn->query($sql);
    if ($resultats->num_rows > 0) {
        $sql = "DELETE FROM likes WHERE idFile = '$fileName' AND iduser = '$id'";
        if ($conn->query($sql) === TRUE) {   
            echo "Maj enregistrée avec succès.";
            $sql = "UPDATE assetfeed SET likes = likes-1 WHERE filename = '$fileName'";
            if ($conn->query($sql) === TRUE) {   
                echo "Maj enregistrée avec succès.";
            } else {
                echo "Failed to like" . $conn->error;
            }
        } else {
            echo "Failed to like" . $conn->error;
        }
    } else {
        // Insère les informations sur l'image dans la table de la base de données
        $sql = "INSERT INTO likes (idFile, iduser) VALUES ('$fileName', '$id')";
        if ($conn->query($sql) === TRUE) {
            echo "Like enregistrée avec succès.";
            $sql = "UPDATE assetfeed SET likes = likes+1 WHERE filename = '$fileName'";
            if ($conn->query($sql) === TRUE) {   
                echo "Maj enregistrée avec succès.";
            } else {
                echo "Failed to like" . $conn->error;
            }
        } else {
            echo "Failed to like" . $conn->error;
        }
    }

}

if (isset($_POST['comment']) && isset($_POST['idFile'])) {
    $idFile = $_POST['idFile'];
    $comment = $_POST['comment'];
    $sql = "INSERT INTO comments (idFile, comment, iduser) VALUES ('$idFile', '$comment', '$id')";
    if ($conn->query($sql) === TRUE) {
        echo "Commentaire enregistrée avec succès.";
        $sql = "UPDATE assetfeed SET comments = comments+1 WHERE filename = '$idFile'";
            if ($conn->query($sql) === TRUE) {
                sendMail($conn, $idFile);
                echo "Maj enregistrée avec succès.";
            } else {
                echo "Failed to like" . $conn->error;
            }
    } 
}

require('../footer.php');
?>