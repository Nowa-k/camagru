let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");
let lastSelect; 

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
    let image_data_url = canvas.toDataURL('image/jpeg');
});


const prevBtn = document.querySelector('#btn-top');
const nextBtn = document.querySelector('#btn-btm');
const carouselSlide = document.querySelector('.scrool');
const images = document.querySelectorAll('.scrool img');

// Counter and size variables
let counter = 0;
const size = images[0].clientWidth;

nextBtn.addEventListener('click', () => {
  if (counter >= images.length - 1) return;
  carouselSlide.style.transition = 'transform 0.5s ease-in-out';
  counter++;
  carouselSlide.style.transform = 'translateY(' + (-size * counter) + 'px)';
});

prevBtn.addEventListener('click', () => {
  if (counter <= 0) return;
  carouselSlide.style.transition = 'transform 0.5s ease-in-out';
  counter--;
  carouselSlide.style.transform = 'translateY(' + (-size * counter) + 'px)';
});

carouselSlide.addEventListener('transitionend', () => {
  if (counter === images.length - 1) {
    carouselSlide.style.transition = 'none';
    counter = 0;
    carouselSlide.style.transform = 'translateY(0px)';
  }
  if (counter === 0) {
    carouselSlide.style.transition = 'none';
    counter = images.length - 1;
    carouselSlide.style.transform = 'translateY(' + (-size * counter) + 'px)';
  }
});

// Parcourez chaque image et ajoutez un gestionnaire d'événements pour détecter les clics
images.forEach(image => {
    image.addEventListener('click', function() {
        lastSelect = image;
		console.log(lastSelect);
    });
});

canvas.addEventListener('click', function(event) {
    let canvasRect = canvas.getBoundingClientRect();
    let canvasWidth = canvas.offsetWidth;
    let canvasHeight = canvas.offsetHeight;

    let x = (event.clientX - canvasRect.left) * (canvas.width / canvasWidth);
    let y = (event.clientY - canvasRect.top) * (canvas.height / canvasHeight);

    if (lastSelect) {
        canvas.getContext('2d').drawImage(lastSelect, x, y, 50, 50); // Par exemple, dessinez l'image à la position du clic (x, y) avec une taille de 50x50
    } else {
        console.log("Aucune image sélectionnée.");
    }
});

function saveCanvasToServer() {
	console.log("insde")
    let imageDataURL = canvas.toDataURL('image/jpeg');

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../controller/save_canvas.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log('L\'image a été enregistrée sur le serveur.');
        }
    };
    xhr.send('imageData=' + encodeURIComponent(imageDataURL));
}

// Ajoutez un écouteur d'événements au clic du bouton de sauvegarde sur le serveur
document.querySelector('#save-button').addEventListener('click', saveCanvasToServer);


let imageForm = document.getElementById('image-form');
let imageDataInput = document.getElementById('image-data');

// Ajoute un gestionnaire d'événements au soumettre du formulaire
imageForm.addEventListener('submit', function(event) {
    // Récupère les données de l'image depuis le canvas en format base64
    let imageDataURL = canvas.toDataURL('image/jpeg');

    // Met à jour la valeur de l'input avec les données de l'image
    imageDataInput.value = imageDataURL;

    // Soumet le formulaire
    // L'image sera envoyée via POST vers l'URL spécifié dans l'action du formulaire
});
