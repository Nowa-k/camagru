<?php

require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); 

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
        echo "Like enregistrée avec succès.";
        $sql = "UPDATE assetfeed SET comments = comments+1 WHERE filename = '$idFile'";
            if ($conn->query($sql) === TRUE) {   
                echo "Maj enregistrée avec succès.";
            } else {
                echo "Failed to like" . $conn->error;
            }
    } 
}

require('../footer.php');
?>