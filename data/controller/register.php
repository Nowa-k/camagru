<?php
    require($_SERVER["DOCUMENT_ROOT"] . '/important.php');
    require($_SERVER["DOCUMENT_ROOT"] . '/header.php');

    $error = '';
    $error .= parseForm($_POST['username'], 'username');
    $error .= parseForm($_POST['mail'], 'mail');
    $error .= parsePwd($_POST['pwd']);

    if (!empty($error)) {
        echo $error;
    } else {
        $username = $_POST['username'];
        $email = $_POST['mail'];
        $pwd = $_POST['pwd'];
        $sql = "INSERT INTO users (username, email, pwd, valid) VALUES ('$username', '$email', '$pwd', false)";

        if ($conn->query($sql)) {
            echo 'succes';
            $_SESSION['username'] = $_POST['username'];
        } else {
            echo 'failed';
        }
        
    }

    function parseForm($data, $field) {
        if (empty($data)){
            return "Champ " . $field . " vide\n";
        }
        return ;
    }

    function parsePwd($pwd) {
        if (empty($pwd)) {
            return "Champs password vide.\n";
        }
        $reg = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z]{8,20}$/';
        if (preg_match($reg, $pwd) > 0) {
            return;
        }
        return "Le mot de passe ne remplis pas les conditions de securite\n";
    }

    require( '../footer.php');
?>