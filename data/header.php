<div class="header">
    <h1>Camagru</h1>
    <div class="navigator">
        <a href=<?php echo $rootPath . "/index.php"; ?>><img src="../public/home.png"/></a>
        <a href=<?php echo $rootPath . "/view/user.php"; ?>><img src="../public/log.png"/></a>
        <a href=<?php echo $rootPath . "/debug.php"; ?>><img src="../public/info.png"/></a>
        <?php
            if (isset($_SESSION['username']) && !empty($_SESSION['username'])){
            ?>
                <a href=<?php echo $rootPath . "/controller/disconnect.php"; ?>><img src="../public/info.png"/></a>
            <?php        
            }
        ?>
    </div>
</div>