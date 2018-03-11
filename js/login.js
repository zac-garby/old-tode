function onlogin(evt) {
    var req = new XMLHttpRequest()
    var form = document.getElementById("login")

    req.onreadystatechange = function(evt) {
        if (req.readyState !== 4) return
        if (req.status !== 200) {
            error("unknown error - see console", "login")
            return false
        }

        var content = JSON.parse(req.responseText)

        switch (content.error) {
        case "username":
            error("user doesn't exist. did you mean to sign up?", "login")
            return false
        case "password":
            error("wrong password", "login")
            return false
        case null:
            window.location.href = `https://${window.location.host}/`
            return false
        default:
            error("internal server error. " + content.error, "login")
            return false
        }

        evt.preventDefault()
        return false
    }

    req.open("POST", `https://${window.location.host}/newsession`, true)
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    req.send(`username=${form.username.value}&password=${form.password.value}`)

    evt.preventDefault()
    return false
}

function onsignup(evt) {
    var req = new XMLHttpRequest()
    var form = document.getElementById("signup")

    req.onreadystatechange = function(evt) {
        if (req.readyState !== 4) return
        if (req.status !== 200) {
            error("unknown error - see console", "signup")
            return false
        }

        var content = JSON.parse(req.responseText)

        switch (content.error) {
        case "username":
            error("user already exists. did you mean to log in?", "signup")
            return false
        case "email":
            error("a user already exists with that email. is it you?", "signup")
            return false
        case null:
            window.location.href = `https://${window.location.host}/`
            return false
        default:
            error("internal server error. " + content.error, "signup")
            return false
        }

        evt.preventDefault()
        return false
    }

    req.open("POST", `https://${window.location.host}/newuser`, true)
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    req.send(`username=${form.username.value}&email=${form.email.value}&password=${form.password.value}`)

    evt.preventDefault()
    return false
}

function error(msg, form) {
    var elem = document.getElementById(form == "login" ? "login-err" : "signup-err")
    elem.innerHTML = msg
    elem.className = "error"
}

document.getElementById("login").onsubmit = onlogin
document.getElementById("signup").onsubmit = onsignup
