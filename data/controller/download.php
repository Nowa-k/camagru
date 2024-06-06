<?php
function saveImageToDatabase($conn, $fileName, $filePath) {
    // Génère un identifiant unique pour l'image
    $uniqueId = uniqid();
    // Requête SQL pour insérer les informations sur l'image dans la table
    $sql = "INSERT INTO images (uId, filename, filepath) VALUES ('$uniqueId', '$fileName', '$filePath')";

    // Exécute la requête
    if ($conn->query($sql) === TRUE) {
        echo "Image enregistrée dans la base de données avec succès.<br>";
    } else {
        echo "Erreur lors de l'enregistrement de l'image dans la base de données: " . $conn->error . "<br>";
    }
}

var_dump($_POST);

if (isset($_POST['imageData'])) {
    var_dump("Post");
    // Récupère les données de l'image et les décode
    $imageData = $_POST['imageData'];
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageData = base64_decode($imageData);

    // Génère un nom de fichier unique pour l'image
    $fileName = uniqid('image_') . '.jpg';

    // Chemin où enregistrer l'image sur le serveur (dossier public)
    $filePath = '../public/' . $fileName;

    // Enregistre les données de l'image dans un fichier
    file_put_contents($filePath, $imageData);
    chmod($filePath, 0664);

    // Enregistre l'image dans la base de données
    saveImageToDatabase($conn, $fileName, $filePath);
}

?>