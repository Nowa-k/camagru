<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camagru - Compte</title>
    <link rel="stylesheet" href="/app/public/style/style.css">
    <link rel="stylesheet" href="/app/public/style/form.css">
</head>
<body>
    <?php include 'app/views/navbar.php'; ?>
    <div class="content">
        <h1>Compte</h1>
        <?php foreach ($users as $user): ?>
            <h2><?php echo $user['username']; ?></h2>
            <h2><?php echo "mail : " . $user['email']; ?></h2>
            <h2><?php echo "notif : " . $user['notif']; ?></h2>
            <h2><?php echo "valide : " . $user['valide']; ?></h2>
            <p><?php echo $user['pwd']; ?></p>
        <?php endforeach; ?>
        <a href="index.php?controller=user&action=add">S'inscrire</a>
        <a href="index.php?controller=user&action=login">Se connecter</a>
    </div>
</body>
</html>

