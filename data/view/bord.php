<div class="bord-content">
    <div class="ctn-camera">
        <div class="camera">
            <video id="video" autoplay></video>
            <canvas id="canvas"></canvas>
            <div class="ctn-btn">
                <button id="start-camera">Start Camera</button>
                <button id="click-photo">Prendre une photo</button>
                <form action="../controller/download.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="myImage" accept="image/*" />
                    <button type="submit">Enregistrer</button>
                </form>
                <button id="save-button">Enregister la photo</button>
            </div>
        </div>
        <div class="ctn-scrool">
            <img id="btn-top" src="../public/arrow.png">
            <div class="surcouche">
                <div class="scrool">
                    <img class="goodies" src="../pimp/ange.png">
                    <img class="goodies" src="../pimp/cat.png">
                    <img class="goodies" src="../pimp/demon.png">
                    <img class="goodies" src="../pimp/lunette.png">
                </div>
            </div>
            <img id="btn-btm" src="../public/arrow.png">
        </div>
    </div>
</div>
<script src="../script/takeScreen.js"></script>

