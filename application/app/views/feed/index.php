<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camagru - Feed</title>
    <link rel="stylesheet" href="/app/public/style/style.css">
    <link rel="stylesheet" href="/app/public/style/feed.css">
</head>
<body>
    <?php include 'app/views/navbar.php'; ?>
    <div class="content">
    <a href="index.php?controller=feed&action=add">Prendre une photo</a>
    <?php foreach ($feed as $picture): ?>
    <div class="picture-item">
        <a href="index.php?controller=feed&action=del&id=<?php echo $picture['id']; ?>" class="delete-link">x</a>
        <p class="user-id"><?php echo $picture['username']; ?></p>
        <div class="ctn-picture">
            <img src="<?php echo $picture['filepath']; ?>" class="picture">
        </div>
    </div>
    <?php endforeach; ?>
    </div>
</body>
</html>
