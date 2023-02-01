/* Scrive il messaggio di errore.
 * @param error: elemento in cui scrivere il messaggio di errore
 * @param errorMessage: messaggio di errore da scrivere
 * @param errorClass: classe da applicare al messaggio
 */
function writeErrorMessage(error, errorMessage, errorClass) {
    error.innerHTML = errorMessage;
    error.classList.remove("input-hint");
    error.classList.add("error");
    error.classList.add(errorClass);
}

/* Rimuove il messaggio di errore.
 * @param error: elemento da cui rimuovere il messaggio di errore
 * @param errorClass: classe da rimuovere dall'elemento
 * @param oldMsg: messaggio pre-errore da ripristinare
 */
function removeErrorMessage(error, errorClass, oldMsg = "") {
    error.classList.remove(errorClass);
    error.classList.remove("error");
    error.classList.add("input-hint");
    error.innerHTML = oldMsg;
}

/* Controlla la lunghezza del campo.
 * @param elementCheck - Elemento da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - minLength Lunghezza minima del campo
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkLength(elementCheck, error, minLength, oldMsg = "") {
    const fieldLength = elementCheck.value.trim().length;
    // se la lunghezza è minore di minLength
    if (minLength && fieldLength > 0 && fieldLength < minLength) {
        writeErrorMessage(
            error,
            "Questo campo deve essere lungo almeno " + minLength + " caratteri",
            "noLongEnough"
        );
        return false;
    } else {
        removeErrorMessage(error, "noLongEnough", oldMsg);
        return true;
    }
}

/* Controlla la conferma della password.
 * @param pass - Password
 * @param confPass - Conferma password
 * @param error - Elemento in cui scrivere il messaggio di errore
 */
function confirmPassword(pass, confPass, error) {
    if (pass.value !== confPass.value)
        writeErrorMessage(error, "La password non coincide", "confPassFail");
    else removeErrorMessage(error, "confPassFail");
}

/* Controlla che la password contenga un numero, una lettera maiuscola e un carattere speciale
 * @param password - Password da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkPasswordFormat(password, error, oldMsg) {
    const numbers = /[0-9]/;
    const upperCaseLetter = /[A-Z]/;
    const specialCharacter = /[\*-\+\=\.,\?\^!\/&%\$£;°ç\[\]\(\)\{\}<>_\\!]/;

    if (!numbers.test(password.value)) {
        writeErrorMessage(
            error,
            "La password deve contenere almeno un numero",
            "numberErrorMessage"
        );
    } else {
        removeErrorMessage(error, "numberErrorMessage", oldMsg);
    }

    if (!upperCaseLetter.test(password.value)) {
        writeErrorMessage(
            error,
            "La password deve contenere almeno una lettera maiuscola",
            "upperCaseErrorMessage"
        );
    } else {
        removeErrorMessage(error, "upperCaseErrorMessage", oldMsg);
    }

    if (!specialCharacter.test(password.value)) {
        writeErrorMessage(
            error,
            "La password deve contenere almeno un carattere speciale",
            "specCharactErrorMessage"
        );
    } else {
        removeErrorMessage(error, "specCharactErrorMessage", oldMsg);
    }
}

/* Controlla la correttezza del campo email.
 * @param email - Email da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 */
function checkEmail(email, error) {
    const emailRegex =
        /^[a-z0-9]+[\w!#$%&'*+-/=?^_`{|}~]*@[\w|\d|!#$%&'*+-/=?^_`{|}~]*\.\w{2,3}$/;

    if (!emailRegex.test(email.value))
        // Niente trim perché l'input di tipo email in HTML lo fa di default
        writeErrorMessage(
            error,
            "Inserire un email valida",
            "emailFormatErrorMessage"
        );
    else removeErrorMessage(error, "emailFormatErrorMessage");
}

/* Controlla il formato del nome.
 * @param nome - Nome da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkName(nome, error, oldMsg) {
    const nameCharacters = /[^A-Za-z ]+/;

    if (nameCharacters.test(nome.value.trim()))
        writeErrorMessage(
            error,
            "Inserire un nome valido",
            "nameFormatErrorMessage"
        );
    else removeErrorMessage(error, "nameFormatErrorMessage", oldMsg);
}

/* Controlla il formato del cognome.
 * @param cognome - Cognome da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkSurname(cognome, error, oldMsg) {
    const nameCharacters = /[^A-Za-z ]+/;

    if (nameCharacters.test(cognome.value.trim()))
        writeErrorMessage(
            error,
            "Inserire un cognome valido",
            "surnameFormatErrorMessage"
        );
    else removeErrorMessage(error, "surnameFormatErrorMessage", oldMsg);
}

/* Controlla il formato dello username.
 * @param nome - Username da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkUsername(username, error, oldMsg) {
    const userCharacters = /[^A-Za-z0-9_-]+/;

    if (userCharacters.test(username.value.trim()))
        writeErrorMessage(
            error,
            "Inserire un username valido (l'username può contenere solo numeri,lettere,-,_)",
            "userFormatErrorMessage"
        );
    else removeErrorMessage(error, "userFormatErrorMessage", oldMsg);
}

/* Controlla il formato della data di nascita.
 * @param nome - Data da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkDate(data, error) {
    const date = new Date(data.value);

    if (date.getFullYear() > 2023 || date.getFullYear() <= 1930)
        writeErrorMessage(
            error,
            "Inserire una data valida",
            "userDateErrorMessage"
        );
    else removeErrorMessage(error, "userDateErrorMessage");
}

const nome = document.getElementById("inputNome");
const errNome = document.getElementById("nome-errore");
const oldNome = errNome.innerHTML;

const cognome = document.getElementById("inputCognome");
const errCognome = document.getElementById("cognome-errore");
const oldCognome = errCognome.innerHTML;

const username = document.getElementById("inputUsername");
const errUser = document.getElementById("username-errore");
const oldUser = errUser.innerHTML;

const password = document.getElementById("inputPassword");
const errPsw = document.getElementById("password-errore");
const oldPsw = errPsw.innerHTML;

const confPassword = document.getElementById("inputConfPassword");
const errConf = document.getElementById("conferma-errore");

const dataNascita = document.getElementById("inputDataNascita");
const errNasc = document.getElementById("nascita-errore");

const email = document.getElementById("inputEmail");
const errMail = document.getElementById("email-errore");

nome.addEventListener("blur", function () {
    if (checkLength(nome, errNome, 2, oldNome)) {
        checkName(nome, errNome, oldNome);
    }
});

cognome.addEventListener("blur", function () {
    if (checkLength(cognome, errCognome, 2, oldCognome)) {
        checkSurname(cognome, errCognome, oldCognome);
    }
});

username.addEventListener("blur", function () {
    if (checkLength(username, errUser, 2, oldUser)) {
        checkUsername(username, errUser, oldUser);
    }
});

password.addEventListener("blur", function () {
    if (checkLength(password, errPsw, 8, oldPsw)) {
        checkPasswordFormat(password, errPsw, oldPsw);
    }
});

confPassword.addEventListener("blur", function () {
    if (checkLength(confPassword, errConf)) {
        confirmPassword(password, confPassword, errConf);
    }
});

dataNascita.addEventListener("blur", function () {
    if (checkLength(dataNascita, errNasc)) {
        checkDate(dataNascita, errNasc);
    }
});

email.addEventListener("blur", function () {
    if (checkLength(email, errMail)) {
        checkEmail(email, errMail);
    }
});
