<?php require($_SERVER["DOCUMENT_ROOT"] . '/important.php'); ?>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Camagru - Feed</title>
    <link href="../css/header.css" rel="stylesheet">
    <link href="../css/feed.css" rel="stylesheet">
</head>
<body>
<?php 
require('../header.php');
    if (!isset ($_GET['page'])) {  
        $page = 1;  
    } else {
        if (ctype_digit($_GET['page']) && is_int($_GET['page'])) {
            $page = $_GET['page'];  
        } else {
            $page = 1;
        }
    }
    // Nombre de resultat pour la pagination
    $results_per_page = 5; // Nombre de resultat par page
    $sql = "SELECT * FROM assetfeed";
    $resultats = $conn->query($sql);
    $number_of_result = mysqli_num_rows($resultats);  
    $number_of_page = ceil ($number_of_result / $results_per_page);
    
    // Sort 5 res
    $page_first_result = ($page-1) * $results_per_page;    
    $sql = "SELECT * FROM assetfeed ORDER BY assetfeed.id DESC LIMIT " . $page_first_result . "," . $results_per_page;
    $resultats = $conn->query($sql);
    ?>
    <div class="ctn-feed">
        <?php 
        foreach ($resultats as $res) {
            ?>
            <div class="ctn-picture">
                <p class="username"><?php echo $res['idUsers']?></p>
                <img class="asset-feed" src=<?php echo $res['filepath']; ?> alt="feed"/>
                <div class="line-info">
                    <div class="ctn-logo">
                        <img class="like" id=<?php echo $res['filename']; ?> src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADvUlEQVR4nO2ayWsUQRTGB8F9Da4gLqCCF72pRwVFRzJj9/c1BUaFePIgSFTEk+DBkyuKgngSPPgHuHv1ICKeNRuIcUWjnkymqtWSF4cYMjOZqe6aBUnBg2G6+r361auufu9VZzKT7T9ttr29rUCGmjyvgfsG6NbkNw3oESG/GeCVXJM+hTAMbBAsyLRCs9nsdA3s18BjDfw0pHURuUeTDzW5T3RlGg6g1ExDHjfke9fBVxTgnQGO2s7OGQ2BiMNwtyH7vQGUAvXF5K76LiPySt0ASoFuief9QuTzSw35omEQLD5D5HMLLPECMRwEq8XdjYYw/zzTK2NI5wmlFss22jQIjkq/VWpZMojOzhnNWE5momWWZIvW5PVmD96MhwGuJtlibStKHEU7a1tS2ex0Q/Y0e8CmkgB9Nb00i29s2+LSVd0bEio0f6C2iryd8MGXALAFBmlrER1FHROBPHZWCAxr4KIBNtkDB2ZbpeZLrKSBJ2X6PpFr0kf6mjDcrMlLmiw42yUflF9W7e1tCULx9zoINpTVd/r0FAMc08AvEfkt/5WdwCjaqMkPjiCxzWbnlSiTpMjRE0ZmNFOlGeCwSNV+UbRFBucyhgKZL50V4IKTN4CbGc/NALccJ/NcOZD7LkpicodvkJjc5TiZd8rNRq+LEhuGC32D2FxukSNId4kSTQ46gSg1zTtIdiSqcHngv5SCANpFybBSa32DFMh1jiCF1CCynfoGMcAJHyBfHZV8sLncLF8QVqk5mvzkNAbgc+lsJIt4T/kC0cAZZ/vAq9Tbb9ErsQnDrWkh4ija7voyNJW2XyljJvCIuPfjUBCsSAoxHIZrXHdM88/22dQhyriZ6fuh1HJXiCFylSFfJ7Ubh2GuRKkUlJPUb8dIj0vZpkCuN8CbpPY0YMoGjdI08CgFiDwzg3EUbasGEQNZTX5PaeteRQNSFU+jvGigoMmDlWwY8mRKz9uiR/Y2JNWVZMseOjR1VPeePXMNcNuHbkMOVA2RpLTvyZh45+mQUislb/FawQeO1FZh9FjrlcAuSSprKkN011xxdM4LGiSa/O2cB2nyWsuBAJedIMYc7DxvIYhniXOgkYytVY4V8vmlGQ8HPU5psGfpkVAmFcSoZ4AlzVhm+u9yWuwFYvxhqOwcDQEBbtT17F3OJ+q61IDuepSaJqp2dElV3CPEgLyxm/MFhCy3KOoofl/inOHJPRLFSgBYj/JSoia5gdRipYypybsjH9CQg2M+qpEs8KWkp5LZSVIkgWQya5Mt0/LtD90RujrneQX4AAAAAElFTkSuQmCC">
                        <p><?php echo $res['likes']?></p>
                    </div>
                    <div class="ctn-logo">
                        <img class="comment" id=<?php echo $res['filename']; ?> src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAACNElEQVR4nNWXz2sTURDH4y8ULyIImkt256V4VSmWotZ6EDxIFQ9K/wP9G7ys9NJkZjdUFIr/QrFQKK148FD17FXUYhDfzMYc2j+gxZUXaBLNvk12zS46MLd58/num5l975VK/6M5+OMc1HkGSM8pCm87QWu60miXc4Uqn68B8jKgaEUSxTkQb5uYqi+TYwM7QWtaIW/ZoFZH3nJQX8wMnvWio4BSU8j7qeE9EftAvFDyosOp4GWPTyri9czggdLI2sTTz8dHo69ER8yCccH7RZjcQ/lAUh83vK9JF5LhtXDqr2o+XMBe4oSoLN2eVgTyGxv8at7wA4/dBUBeLkqAIn4eI0Bsf7i3ivQ8YHg/zhVxkKEXtn+DVxrtsnUBysOkxj3v85lMvbDUOttNUqXwRoKAXUBeVcQrsY7yMZOAWjjVFeD6+k5x9T8og57r7QDy3aIFuD7fGnUEdxJLYPHOGpRdW96qr690BZgLRtYmTDJF8siWt7L47fQfwdy0CHiXNIb28dTzQPI+XgA3B9WiPCuuBzgYEAAkl4sSYD2QFMnrvOFA/MreNMj3cobvTfj6klUA5HwgQZ0fW+GO1zxhZj43OPJq4uXUpfBBfl/PLydfRMescGOAvJlHzYH4ydDLaKXRLpvggSTIXwFlqSMO+WdK+EZiw/WbS3K9Vyv5oFA8N/h+oT/GvHI6lw+UT/Y6yxeF7Kd/mkXRIXM4OIuhO0q4+Y8bCKC+abzzfKvtnEoH/UfsF6l2v3OsztZUAAAAAElFTkSuQmCC">
                        <p><?php echo $res['comments']?></p>
                    </div>
                </div>
                <div class="ctn-cmt" id=<?php echo $res['filename']; ?>>
                    <div class="ctn-comments">
                        <?php    
                        $sql = "SELECT * FROM comments 
                                LEFT JOIN users ON users.id = comments.iduser 
                                WHERE comments.idFile = '{$res["filename"]}'
                                ORDER BY comments.created_at";
                        $comments = $conn->query($sql);
                        foreach ($comments as $cmt) {
                            echo "<p class='sender'>" . $cmt['username'] . "</p>";
                            echo "<p class='message'>" . $cmt['comment'] . "</p>";
                        }
                        ?>
                    </div>
                    <input type="text" class="input-cmt" id=<?php echo $res['filename']; ?> name="input-comment" required minlength="1" maxlength="244" />
                    <button class="commenter" id=<?php echo $res['filename']; ?>>Envoyer</button>
                </div>
            </div>
        <?php 
        } ?>
            <div class="pagination">
                <?php
                for($page = 1; $page<= $number_of_page; $page++) {  
                    echo "<a class='page' href='feed.php?page=" . $page . "'>" . $page . "</a>";
  
                }
                ?>
            </div>
    </div>
    <?
require('../footer.php');
?>
</body>
</html>
<script src="../script/actionToFeed.js"></script>
