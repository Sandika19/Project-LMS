function showRegister() {
    document.getElementById("login-card").classList.remove("active-card");
    document.getElementById("register-card").classList.add("active-card");
}

function showLogin() {
    document.getElementById("register-card").classList.remove("active-card");
    document.getElementById("login-card").classList.add("active-card");
}
