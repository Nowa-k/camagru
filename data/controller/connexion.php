<?php
    $username = $_POST["username"];
    $sql = "SELECT id, uuid, username, email, pwd, valide FROM users WHERE username='$username'";
    $resultat = $conn->query($sql);
    if ($resultat->num_rows == 1) {
      $row = $resultat->fetch_assoc();
      if ($row['pwd'] == password_verify($_POST['pwd'], $row['pwd'])) {
        $_SESSION['username'] = $_POST["username"];
        $_SESSION['id'] = $row["id"];
        $_SESSION['uuid'] = $row["uuid"];
        $_SESSION['email'] = $row['email'];
        $_SESSION['valide'] = $row['valide'];
        header("Location: ../index.php");
        exit();
      } else {
        $error = "Error : Mauvais mot de passe.";
      }
    } else {
      $error = "Error : Username inexistant.";
    }
?>