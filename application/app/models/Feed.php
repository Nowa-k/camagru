<?php
class Feed {
    public static function getAll() {
        $db = getDBConnection();
        $stmt = $db->query('SELECT * FROM feed');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM feed WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function add($filename) {
        $db = getDBConnection();
        $stmt = $db->prepare('INSERT INTO feed (filename) VALUES (?)');
        $stmt->execute([$filename]);
    }

    public static function create($ex) {
        echo $ex;
    }
}
?>