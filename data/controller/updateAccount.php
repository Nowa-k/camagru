<?php
//$sql = "UPDATE assetfeed SET likes = likes-1 WHERE filename = '$fileName'";
require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); 
var_dump($_POST);
if (isset($_POST['oldName']) && !empty($_POST['oldName'])) {
    echo "first step \n";
    $username = $_POST["oldName"];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $resultat = $conn->query($sql);
    if ($resultat->num_rows == 1){
        echo "Second step \n";
        $row = $resultat->fetch_assoc();
        $id = $row['id'];
        if ($row['pwd'] == password_verify($_POST['oldpwd'], $row['pwd'])) {
            echo "Verify step \n";

            if (isset($_POST['username']) && !empty(isset($_POST['username']))) {
                echo "username step \n";
                $info = $_POST['username'];
                $sql = "UPDATE users SET username='$info' WHERE id='$id'";
                $resultat = $conn->query($sql);
                $_SESSION['username'] = $_POST["username"];
            }
            if (isset($_POST['mail']) && !empty(isset($_POST['mail']))) {
                echo "verify mail \n";
                $info = $_POST['mail'];
                $sql = "UPDATE users SET email='$info' WHERE id='$id'";
                $resultat = $conn->query($sql);
            }
            if (isset($_POST['password']) && !empty(isset($_POST['password']))) {
                echo "passw step \n";
                $info = $_POST['password'];
                $sql = "UPDATE users SET password='$info' WHERE id='$id'";
                $resultat = $conn->query($sql);
            }
        }
    }

}

require('../footer.php');
?>
