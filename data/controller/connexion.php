<?php
    $username = $_POST["username"];
    $sql = "SELECT username, pwd, valide FROM users WHERE username='$username'";
    $resultat = $conn->query($sql);
    if ($resultat->num_rows == 1){
      $row = $resultat->fetch_assoc();
      if ($row['pwd'] == password_verify($_POST['pwd'], $row['pwd'])){
        $_SESSION['username'] = $_POST["username"];
        $_SESSION['valide'] = $row['valide'];
        if ($row['valide'] != 0) {
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../view/valide.php"); 
        }

      } else {
        $error = "Error : Mauvais mot de passe.";
      }
    } else {
      $error = "Error : Username inexistant.";
    }
?>