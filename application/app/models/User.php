<?php
class User {
    public static function parsePwd($pwd) {
        if (empty($pwd)) {
            return false;
        }
        $reg = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z]{8,20}$/';
        if (preg_match($reg, $pwd) > 0) {
            return true;
        }
        return false;
    }

    public static function parseEmail($email) {
        $email = trim($email);
        if (empty($email)) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        list($username, $domain) = explode('@', $email);
        if (!checkdnsrr($domain, 'MX')) {
            return false;
        }
        return true;
    }

    public static function getAll() {
        $db = getDBConnection();
        $stmt = $db->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByUuid($uuid) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE uuid = ?');
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByMail($mail) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$mail]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByUsername($username) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function add($username, $mail, $pwd) {
        $db = getDBConnection();
        if (!self::parsePwd($pwd)) {
            return false;
        }
        if (!self::parseEmail($mail)) {
            return false;
        }
        $pwdHashed = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $uuid = uniqid();
        try {
            $stmt = $db->prepare('INSERT INTO users (uuid, username, email, pwd) VALUES (?, ?, ?, ?)');
            $result = $stmt->execute([$uuid, $username, $mail, $pwdHashed]);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
        }
        return false;
    }

    public static function login($username, $pwd) {
        $db = getDBConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$row) {
            return 'Ce compte user inexistant';
        }
    
        if (password_verify($pwd, $row['pwd'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['uuid'] = $row['uuid'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['valide'] = $row['valide'];
            $_SESSION['notif'] = $row['notif'];
            return 'Connexion reussi';
        } else {
            return 'Connexion echoue';
        }
    }

    public static function updateUsername($id, $username) {
        if (empty($username)) {
            return;
        }
        $db = getDBConnection();
        $stmt = $db->prepare('UPDATE users SET username = ? WHERE id = ?');
        $stmt->execute([$username, $id]);

        if ($stmt->rowCount()) {
            $_SESSION['username'] = $username;
            return "L'username a été mis à jour avec succès.";
        } else {
            return "Le changement d'username a échoué.";
        }
    }

    public static function updateMail($id, $mail) {
        if (empty($mail)) {
            return ;
        }
        $db = getDBConnection();
        $stmt = $db->prepare('UPDATE users SET email = ?, valide = ? WHERE id = ?');
        $stmt->execute([$mail, 0, $id]);
        if ($stmt->rowCount()) {
            $_SESSION['valide'] = 0;
            $_SESSION['email'] = $mail;
            return "L'email a été mis à jour avec succès.";
        } else {
            return "Le changement d'email a echoue.";
        }
    }

    public static function updatePwd($id, $pwd) {
        if (empty($pwd)) {
            return ;
        }
        if (!self::parsePwd($pwd)) {
            return "Le mot de passe n'est pas conforme au regle.";
        }
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $db = getDBConnection();
        $stmt = $db->prepare('UPDATE users SET pwd = ? WHERE id = ?');
        $stmt->execute([$pwd, $id]);
        
        if ($stmt->rowCount()) {
            return "Le mot de passe a été mis à jour avec succès.";
        } else {
            return "Le changement de mot de passe a echoue.";
        }
    }

    public static function setting($id, $username, $mail, $pwd, $oldpwd) {
        $user = self::getById($id);
        if (!password_verify($oldpwd, $user['pwd'])) {
            return "Mot de passe actuel invalide.";
        }
        $mess['username'] = self::updateUsername($id, $username);
        $mess['mail'] = self::updateMail($id, $mail);
        $mess['pwd'] = self::updatePwd($id, $pwd);
        $user = self::getById($id);
        return $mess;
    }

    public static function notification($notification, $id) {
        if ($notification == '1' || $notification == '0') {
            $db = getDBConnection();
            $stmt = $db->prepare('UPDATE users SET notif = ? WHERE id = ?');
            $stmt->execute([$notification, $id]);
        }
    }

    public static function valideWithCode($uuid) {
        $db = getDBConnection();
        $stmt = $db->prepare('UPDATE users SET valide = ? WHERE uuid = ?');
        $stmt->execute([1, $uuid]);
        $_SESSION['valide'] = 1;
    } 

    public static function mailForValide($to, $code) {
        $subject = "Valider son compte";
        $message = "
        <html>
        <head>
            <title>Valider votre compte</title>
        </head>
        <body>
            <h1>Merci de votre inscription sur le site !</h1>
            <p>Dernière étape pour valider votre compte et profiter de Camagru.</p>
            <p>Cliquer sur le bouton ci-dessous pour valider votre compte :</p>
            <a href='http://127.0.0.1:8080/index.php?controller=user&action=verify&code=$code' target='_blank' style='background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 8px;'>Valider mon compte</a>
            </body>
        </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: camagru42@outlook.fr\r\n";
        $headers .= "Reply-To: camagru42@outlook.fr\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return "E-mail envoyé avec succès.";
        } else {
            return "Erreur lors de l'envoi de l'e-mail.";
        }
    }

    public static function resetPassword($username, $pwd) {
        if (empty($username)) {
            $mess['username'] = "Username invalide.";
        }
        $user = self::getByUsername($username);
        $mess['pwd'] = self::updatePwd($user['id'], $pwd);
        return $mess;
    }

    public static function mailForPassword($to) {
        $user = self::getByMail($to);
        if (!$user) {
            return "Email inexistant";
        }
        $code = $user['uuid'];
        $subject = "Demande de nouveau mot de passe";
        $message = "
        <html>
        <head>
            <title>Valider votre compte</title>
        </head>
        <body>
            <h1>Voici le lien pour créer votre nouveau mot de passe.</h1>
            <a href='http://127.0.0.1:8080/index.php?controller=user&action=forget&code=$code' target='_blank' style='background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 8px;'>Valider mon compte</a>
            </body>
        </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: camagru42@outlook.fr\r\n";
        $headers .= "Reply-To: camagru42@outlook.fr\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return "E-mail envoyé avec succès.";
        } else {
            return "Erreur lors de l'envoi de l'e-mail.";
        }
    }
}
?>
