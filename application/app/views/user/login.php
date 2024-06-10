<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camagru - Inscription</title>
    <link rel="stylesheet" href="/app/public/style/style.css">
    <link rel="stylesheet" href="/app/public/style/form.css">
</head>
<body>
    <?php include 'app/views/navbar.php'; ?>
    <div class="content">
        <h1>Se connecter</h1>
        <form class="form-group" method="POST" action="index.php?controller=user&action=login">
            <div class="form-line">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-line">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="pwd">
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <a href="index.php?controller=user&action=forget">Mot de passe oublié</a>
    </div>
</body>
</html>