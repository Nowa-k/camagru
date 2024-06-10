<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camagru - Feed</title>
    <link rel="stylesheet" href="/app/public/style/style.css">
    <link rel="stylesheet" href="/app/public/style/form.css">
</head>
<body>
    <?php include 'app/views/navbar.php'; ?>
    <div class="content">
        <h1>Cree ton cama</h1>
        <h1>Image Superposables</h1>
        <form action="index.php?controller=feed&action=add" method="POST" enctype="multipart/form-data">
            <input type="file" name="myImage" accept="image/*" />
            <button type="submit">Enregistrer file</button>
        </form>
    </div>
</body>
</html>
<script src="/app/script/cam.js"></script>
