let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");
let createButton = document.getElementById("create");
let canvasFilled = false;
let overlaySelected = false;
let image_data_url;

function checkConditions() {
    if (canvasFilled && overlaySelected) {
        createButton.disabled = false;
    } else {
        createButton.disabled = true;
    }
}

camera_button.addEventListener('click', async function() {
   	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
	video.srcObject = stream;
	video.addEventListener('loadedmetadata', function() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
    });
    canvas.style.display = 'none';
   	video.style.display = 'block';

});

click_button.addEventListener('click', async function() {
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

    canvas.style.display = 'block';
    video.style.display = 'none';

 let tracks = video.srcObject.getTracks();
 tracks.forEach(track => track.stop());
 image_data_url = canvas.toDataURL('image/jpeg');
 canvasFilled = true;
 checkConditions();
});

document.querySelectorAll('input[name="overlayImage"]').forEach((input) => {
    input.addEventListener('change', () => {
        if (document.getElementById('userImage').files.length > 0) {
            document.getElementById('submitButton').disabled = false;
            document.getElementById('submitButton').classList.remove('disabled');
        }
        overlaySelected = true;
        checkConditions();
    });
});

document.getElementById('userImage').addEventListener('change', () => {
    if (document.querySelector('input[name="overlayImage"]:checked')) {
        document.getElementById('submitButton').disabled = false;
        document.getElementById('submitButton').classList.remove('disabled');
    }
});


createButton.addEventListener("click", function() {
    if (image_data_url) {
        var checkbox1 = document.getElementById("overlay1");
        var checkbox2 = document.getElementById("overlay2");
        var checkbox3 = document.getElementById("overlay3");
        var checkbox4 = document.getElementById("overlay4");
        if (checkbox1.checked || checkbox2.checked || checkbox3.checked || checkbox4.checked) {
            let overlay = document.querySelector('input[name="overlayImage"]:checked').value; 
            let formData = new FormData();
            formData.append('canvasData', image_data_url);
            formData.append('overlay', overlay);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?controller=feed&action=create', true);
            xhr.onload = function() {
                window.location.href = 'index.php?controller=feed&action=index';
                console.log(xhr.responseText);
        };
        xhr.send(formData);
        }
    }
});
