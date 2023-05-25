let type = ""

function createRequest(url, data) {
    //подготовка xml запроса
    let xhr = new XMLHttpRequest
    console.log(data);


    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            //результат работы php скриипта
            user = JSON.parse(xhr.responseText)

            //обработка отдельных типов событий 
            switch (user['type']) {
                case "login":
                    //проверка на наличие ошибок, их вывод
                    if (!user.error) {
                        //объявление куки с данными о пользователе
                        setCookie('user', JSON.stringify(user), 1)
                        console.log("login completed");
                        //запуск success-таблицы
                        success_message("form", "/profile")
                    } else {
                        var span = document.querySelector("#error>span")
                        var div = document.getElementById("error")
                        div.innerHTML = user.error
                        div.removeAttribute("hidden")
                    }
                    break
                case "registration":
                    if (!user.error) {
                        setCookie('user', JSON.stringify(user), 1)
                        success_message("form", "/profile")
                        break
                    } else {
                        var span = document.querySelector("#error>span")
                        var div = document.getElementById("error")
                        div.innerHTML = user.error
                        div.removeAttribute("hidden")
                    }
                    break
                case "update":
                    if (!user.error) {
                        console.log("updated");
                        setCookie('user', JSON.stringify(user), 1)
                        success_message("profile", "/profile")
                        window.location.href = "/profile"
                    } else {
                        var span = document.querySelector("#error>span")
                        var div = document.getElementById("error")
                        div.innerHTML = user.error
                        div.removeAttribute("hidden")
                    }
                    break
                case "delete":
                    if (!user.error) {
                        eraseCookie("user")
                        window.location.href = "/"
                    } else {
                        var span = document.querySelector("#error>span")
                        var div = document.getElementById("error")
                        div.innerHTML = user.error
                        div.removeAttribute("hidden")
                    }
                    break
                default:
                    console.warn("type of event wasn't defined")
                    break

            }
        }
    }

    xhr.open("POST", url, true)
    xhr.setRequestHeader("Content-Type", "application/json")
    xhr.send(data)

}

function log_in() {
    //скрытие блока ошибки
    var div = document.getElementById("error")
    div.setAttribute("hidden", "")
    //выборка значений из полей input (функция объявлена ниже)
    var login = get_value_by_id("login")
    var password = get_value_by_id("password")
    //объявление типа эвента
    type = "login"
    //объявление url исполняющего скрипта
    let url = "http://aa.com/php/login.php"
    data = JSON.stringify({ "login": login, "password": password, "type": type })
    //вызов метода на создание запроса
    createRequest(url, data)
}

function registr() {
    var div = document.getElementById("error")
    div.setAttribute("hidden", "")
    type = "registration"

    login = get_value_by_id("login")
    Name = get_value_by_id("name")
    mail = get_value_by_id("mail")
    password = get_value_by_id("password")
    password_repeat = get_value_by_id("password_repeat")
    //проверка совпадения паролей
    if (password == password_repeat) {
        let url = "http://aa.com/php/registration.php"
        data = JSON.stringify({ "login": login, "password": password, "name": Name, "mail": mail, "type": type })
        createRequest(url, data)
    } else {
        var span = document.querySelector("#error>span")
        var div = document.getElementById("error")
        div.innerHTML = "The passwords do not match"
        div.removeAttribute("hidden")
    }
}

function get_value_by_id(id) {
    element = document.getElementById(id)
    return element.value
}

function success_message(block_id, url) {
    //отключаем форму, проявляем таблицу
    let form = document.getElementById(block_id)
    form.style.display = "none"
    form.style.position = "absolute"
    let table = document.getElementById("table")
    table.style.display = "block"
    //получаем promise через setTimeOut (10 секунд)
    setTimeout(() => {
        table.style.display = "none"
        document.location.href = url
    }, 10000)
}

function generate_profile() {
    data = JSON.parse(getCookie("user"))

    Name = document.getElementById("profile-name")
    login = document.getElementById("profile-login")
    mail = document.getElementById("profile-mail")

    Name.value = data.name
    login.value = data.login
    mail.value = data.mail
}

function update() {
    var div = document.getElementById("error")
    div.setAttribute("hidden", "")
    type = "update"

    Name = get_value_by_id("profile-name")
    new_login = get_value_by_id("profile-login")
    mail = get_value_by_id("profile-mail")
    new_password = get_value_by_id("profile-password")
    repeat_new_password = get_value_by_id("profile-password-repeat")
    password = get_value_by_id("password")
    cookie = JSON.parse(getCookie('user'))

    if (new_password != repeat_new_password) {
        var span = document.querySelector("#error>span")
        var div = document.getElementById("error")
        div.innerHTML = "The new passwords do not match"
        div.removeAttribute("hidden")
    } else {

        if (new_password.length > 0) {
            data = JSON.stringify({ "login": cookie.login, "new_login": new_login, "password": password, "new_password": new_password, "name": Name, "mail": mail, "type": type })
        } else {
            data = JSON.stringify({ "login": cookie.login, "new_login": new_login, "name": Name, "mail": mail, "type": type, "password": password })
        }
        let url = "http://aa.com/php/update.php"
        createRequest(url, data)
    }

}

function log_out() {
    eraseCookie("user")
    document.location.href = "/"
}

function delete_account() {
    var cookie = JSON.parse(getCookie("user"))
    type = "delete"
    let data = JSON.stringify({ "login": cookie.login, "type": type })
    let url = "http://aa.com/php/delete.php"
    createRequest(url, data)
}
