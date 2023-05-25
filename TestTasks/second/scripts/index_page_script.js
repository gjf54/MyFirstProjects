
function start() {
    if (getCookie("user") != null) {
        var a1 = document.createElement("a")
        a1.href = "/profile"
        a1.innerText = "Profile"
        var div = document.getElementById("nav")
        div.appendChild(a1)
    } else {
        var a1 = document.createElement("a")
        var a2 = document.createElement("a")
        a1.href = "/registration"
        a2.href = "/login"
        a1.innerText = "Sign Up"
        a2.innerText = "Sign In"
        var div = document.getElementById("nav")
        div.appendChild(a1)
        div.appendChild(a2)
    }
}

window.addEventListener("load", start)
