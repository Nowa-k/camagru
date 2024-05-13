var titleRegister = document.getElementById("title-register");
var titleConnexion = document.getElementById("title-connexion");
var formRegister = document.getElementById("form-register");
var formConnexion = document.getElementById("form-connexion");

function changeForm(element) {
    if (titleRegister == element) {
        titleRegister.style.opacity = '1';
        titleConnexion.style.opacity = '0.2';
        formRegister.style.display = 'flex';
        formConnexion.style.display = 'none';
    }
    if (titleConnexion == element) {
        titleRegister.style.opacity = '0.2';
        titleConnexion.style.opacity = '1';
        formRegister.style.display = 'none';
        formConnexion.style.display = 'flex';
    }
}