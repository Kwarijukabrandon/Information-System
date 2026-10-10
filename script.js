function checkPassword() {
    var pass = document.getElementById("password").value;
    var confirm = document.getElementById("confirm").value;

    if (pass != confirm) {
        alert("Passwords do not match!");
        return false;
    }
    return true;
}