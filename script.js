function onSubmit(){
    const alert = $('#responseAlert')
    hasError() ? onError(alert) : onSuccess(alert)
    showAndHide(alert)
}

function showAndHide(alert){
    alert.show()
    setTimeout(function(){
        alert.hide()
    }, 3000);
}

function hasError(){
    const username = $('#usernameIn').val()
    const password = $('#passwordIn').val()
    const mail = $('#mailIn').val()
    return badValue(username) || badValue(password) || badValue(mail)
}

function badValue(string){
    return string === undefined || string === ""
}

function onError(alert){
    alert.removeClass('alert-success').addClass('alert-danger')
    alert.text("Bitte alle Felder ausfüllen!")
}

function onSuccess(alert){
    const username = $('#usernameIn').val()
    alert.removeClass('alert-danger').addClass('alert-success')
    alert.text("Neues Nutzerkonto mit Nutzername " + username + " wurde erfolgreich hinzugefügt.")
}
