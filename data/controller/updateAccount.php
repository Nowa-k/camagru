<?php
//$sql = "UPDATE assetfeed SET likes = likes-1 WHERE filename = '$fileName'";
require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); 
if (isset($_POST['oldName']) && !empty($_POST['oldName'])) {
    echo "first step \n";
    $username = $_POST["oldName"];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $resultat = $conn->query($sql);
    if ($resultat->num_rows == 1){
        $row = $resultat->fetch_assoc();
        $id = $row['id'];
        if ($row['pwd'] == password_verify($_POST['oldpwd'], $row['pwd'])) {
            if (isset($_POST['username']) && !empty($_POST['username'])) {
                $info = $_POST['username'];
                $sql = "UPDATE users SET username='$info' WHERE id='$id'";
                $resultat = $conn->query($sql);
                $_SESSION['username'] = $_POST["username"];
            }
            if (isset($_POST['mail']) && !empty($_POST['mail'])) {
                $info = $_POST['mail'];
                $sql = "UPDATE users SET email='$info' WHERE id='$id'";
                $resultat = $conn->query($sql);
            }
            if (isset($_POST['password']) && !empty($_POST['password'])) {
                $info = $_POST['password'];
                $pwd = password_hash($info, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password='$pwd' WHERE id='$id'";
                $resultat = $conn->query($sql);
            }
        }
    }

}

require('../footer.php');
?>
