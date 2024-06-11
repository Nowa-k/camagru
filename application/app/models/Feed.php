<?php
class Feed {
    public static function getAll() {
        $db = getDBConnection();
        $stmt = $db->query('SELECT feed.*, users.username 
        FROM feed 
        JOIN users ON feed.userid = users.id
        ORDER BY feed.created_at DESC');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM feed WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserFeed($userid) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM feed WHERE userid = ? ORDER BY created_at DESC');
        $stmt->execute([$userid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function add($overlayImage) {
        $targetDir = "uploads/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $userImage = $targetDir . basename($_FILES["userImage"]["name"]);
        if (!move_uploaded_file($_FILES["userImage"]["tmp_name"], $userImage)) {
            die("Erreur lors du téléchargement de l'image utilisateur.");
        }

        $overlay = imagecreatefrompng($overlayImage);
        $userImg = imagecreatefromstring(file_get_contents($userImage));

        $width = imagesx($overlay);
        $height = imagesy($overlay);

        imagecopy($userImg, $overlay, 0, 0, 0, 0, $width, $height);
        $filename = $targetDir . uniqid() . ".png";
        imagepng($userImg, $filename);

        imagedestroy($overlay);
        imagedestroy($userImg);

        $db = getDBConnection();
        $stmt = $db->prepare("INSERT INTO feed (filepath, userid) VALUES (?, ?)");
        $stmt->execute([$filename, $_SESSION['id']]);
    }

    public static function create($canvasData, $overlayPath) {
        $targetDir = "uploads/";
        list($type, $canvasData) = explode(';', $canvasData);
        list(, $canvasData) = explode(',', $canvasData);
        $canvasData = base64_decode($canvasData);

        $canvasImage = imagecreatefromstring($canvasData);
        if ($canvasImage === false) {
            die('Erreur lors de la création de l\'image à partir des données du canvas.');
        }

        $overlayImage = imagecreatefrompng($overlayPath);
        if ($overlayImage === false) {
            die('Erreur lors du chargement de l\'image overlay.');
        }

        $canvasWidth = imagesx($canvasImage);
        $canvasHeight = imagesy($canvasImage);
        $overlayWidth = imagesx($overlayImage);
        $overlayHeight = imagesy($overlayImage);

        imagecopy($canvasImage, $overlayImage, 0, 0, 0, 0, $overlayWidth, $overlayHeight);

        $filename = $targetDir . uniqid() . ".png";
        imagepng($canvasImage, $filename);

        imagedestroy($canvasImage);
        imagedestroy($overlayImage);
        $db = getDBConnection();
        $stmt = $db->prepare("INSERT INTO feed (filepath, userid) VALUES (?, ?)");
        $stmt->execute([$filename, $_SESSION['id']]);
    }

    public static function del($idsession, $idfeed) {
        $feed = self::getById($idfeed);
        if ($feed['userid'] != $idsession) {
            return;
        }
        $db = getDBConnection();
        $stmt = $db->prepare('DELETE FROM feed WHERE id = ?');
        $stmt->execute([$idfeed]);
    }
}