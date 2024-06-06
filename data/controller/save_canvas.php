<?php

require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); 

// Vérifie si des données d'image ont été envoyées
if (isset($_POST['imageData'])) {
    // Récupère les données de l'image et les décode
    $uuid = $_SESSION['uuid'];
    $imageData = $_POST['imageData'];
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageData = base64_decode($imageData);

    // Génère un nom de fichier unique pour l'image
    $fileName = uniqid('image_') . '.jpg';

    // Chemin où enregistrer l'image sur le serveur (dossier public)
    $filePath = '../assets/' . $fileName;

    // Enregistre les données de l'image dans un fichier
    file_put_contents($filePath, $imageData);

    // Insère les informations sur l'image dans la table de la base de données
    $sql = "INSERT INTO assetfeed (filename, filepath, idUsers) VALUES ('$fileName', '$filePath', '$uuid')";
    if ($conn->query($sql) === TRUE) {
        echo "Image enregistrée avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de l'image: " . $conn->error;
    }
}

require('../footer.php');
?>
