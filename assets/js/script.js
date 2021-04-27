var modalLogin = document.getElementById('idLoginForm');

window.onclick = function(event) {
    if (event.target == modalLogin) {
        modalLogin.style.display = "none";
    }
}