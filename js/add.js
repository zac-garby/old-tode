function onadd(evt) {
    var form = document.getElementById("form")

    var equation = form.equation.value
    var description = form.description.value
    var categories = form.categories.value
    var references = form.references.value

    for (var elem of document.querySelectorAll("[id$=-err]")) {
        elem.innerHTML = ""
    }

    if (equation.length < 3) {
        error("equation", "your equation must contain at least 3 characters", evt)
        return false
    }

    if (description.length < 20) {
        error("description", "your description must contain at least 20 characters", evt)
        return false
    }

    if (categories.length < 3) {
        error("categories", "your category list must contain at least 3 characters", evt)
        return false
    }

    if (references.length < 10) {
        error("references", "your references section must contain at least 10 characters", evt)
        return false
    }
}

function error(id, message, evt) {
    document.getElementById(id + "-err").innerHTML = message
    evt.preventDefault()
}

document.getElementById("form").onsubmit = onadd
