function onlogin(evt) {
    var req = new XMLHttpRequest()
    var form = document.getElementById("login")

    req.onreadystatechange = function(evt) {
        if (req.readyState !== 4) return
        if (req.status !== 200) {
             error("unknown error - see console")
            return false
        }

        var content = JSON.parse(req.responseText)

        switch (content.error) {
        case "username":
             error("user doesn't exist. did you mean to sign up?")
            return false
        case "password":
             error("wrong password")
            return false
        case null:
            window.location.href = `https://${window.location.host}/`
            return false
        default:
             error("internal server error. " + content.error)
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

function error(msg) {
    var elem = document.getElementById("login-err")
    elem.innerHTML = msg
    elem.className = "error"
}

document.getElementById("login").onsubmit = onlogin
