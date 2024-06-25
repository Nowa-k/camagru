<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camagru - Verifier</title>
    <link rel="stylesheet" href="/app/public/style/style.css">
    <link rel="stylesheet" href="/app/public/style/form.css">
</head>
<body>
    <?php include 'app/views/navbar.php'; ?>
    <div class="content">
        <h1>Vérifier votre email</h1>
        <?php if (isset($_SESSION['valide']) && $_SESSION['valide'] == '0'): ?>
            <form method="post" action="?controller=user&action=verify">
                <button type="submit">Envoyer un mail</button>
            </form>
        <?php elseif (isset($_SESSION['valide']) && $_SESSION['valide'] == '1'): ?>
            <p>Votre email est bien valide.</p>
        <?php endif; ?>
    </div>
</body>
</html>