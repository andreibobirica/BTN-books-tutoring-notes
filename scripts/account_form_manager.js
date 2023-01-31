// prende in input: il messaggio che deve mostrare e la classe che deve aggiungere al errore ( mi servirà poi per trovarlo e cancellarlo)
function createErrorMessage(message, errorClass){
    let messageParagraph = document.createElement("p");
    messageParagraph.innerText = message;
    messageParagraph.setAttribute("class", errorClass);
    return messageParagraph;
}

// prende in input: l'id della label in cui deve apparire , il <p> con l'errore da mostrare , la classe del'errore in modo da controllare che non sia già presente
function appendErrorMessage(labelId, errorMessage, errorClass){
    const label = document.getElementById(labelId);
    let errorParagraph = label.querySelector('.' + errorClass);

    if(errorParagraph == null)
        label.appendChild(errorMessage); 
}

function removeErrorMessage(labelId, errorClass){
    const label = document.getElementById(labelId);
    let errorParagraph = label.querySelector('.' + errorClass);   // chiamo querySelector perché  è l'unico che può essere chiamato su un elemento e non solo su document come getElementById
    
    if(errorParagraph != null)
        errorParagraph.remove()
    
}

// prende in input: l'input su cui deve fare il controllo, il nome della label dove mettere il messaggio e la lunghezza minima che deve avere il campo
function checkLength(elementCheck,labelId, minLength){
    const fieldLength = elementCheck.value.trim().length;

    if(fieldLength == 0){
        appendErrorMessage(labelId, createErrorMessage("Questo campo non può essere lasciato vuoto", "emptyErrorMessage"), "emptyErrorMessage");
        removeErrorMessage(labelId,"noLongEnough"); /* rimuove il messaggio di errore campo vuoto nel caso ci sia */
    } 
    else{
        if(minLength && fieldLength < minLength){
            appendErrorMessage(labelId, createErrorMessage("Questo campo deve essere lungo almeno " + minLength + " caratteri", "noLongEnough"), "noLongEnough");
            removeErrorMessage(labelId,"emptyErrorMessage");
        }
        else{
            removeErrorMessage(labelId,"emptyErrorMessage");
            removeErrorMessage(labelId,"noLongEnough");
        }
    }    
}

function confirmPassword(pass,confPass,labelId){
    if(pass.value !== confPass.value)
        appendErrorMessage(labelId, createErrorMessage("La password non coincide", "confPassFail"), "confPassFail");
    else
        removeErrorMessage(labelId,"confPassFail");
}

// controlla che contenga un numero, una lettera maiuscola e un carattere speciale
function checkPasswordFormat(elementCheck,labelId){
    const numero = /[0-9]/;
    const upperCaseLetter = /[A-Z]/;
    const specialCharacter = /[\*-\+\=\.,\?\^!\/&%\$£;°ç\[\]\(\)\{\}<>_\\!]/;

    if(!numero.test(elementCheck.value))
        appendErrorMessage(labelId, createErrorMessage("Questo campo deve contenere almeno un numero", "numberErrorMessage"), "numberErrorMessage");
    else
        removeErrorMessage(labelId,"numberErrorMessage");

    if (!upperCaseLetter.test(elementCheck.value))
        appendErrorMessage(labelId, createErrorMessage("Questo campo deve contenere almeno una lettera maiuscola", "upperCaseErrorMessage"), "upperCaseErrorMessage");
    else
        removeErrorMessage(labelId,"upperCaseErrorMessage");

    if(!specialCharacter.test(elementCheck.value))
        appendErrorMessage(labelId, createErrorMessage("Questo campo deve contenere almeno un carattere speciale", "specCharactErrorMessage"), "specCharactErrorMessage");
    else
        removeErrorMessage(labelId,"specCharactErrorMessage");
}

function checkEmail(elementCheck,labelId){
    const email = /^[a-z0-9]+[\w!#$%&'*+-/=?^_`{|}~]*@[\w|\d|!#$%&'*+-/=?^_`{|}~]*\.\w{2,3}$/;

    if(!email.test(elementCheck.value)) // non c'è il trim perché il formato html email ce lo ha di default
        appendErrorMessage(labelId, createErrorMessage("Inserire un email valida", "emailFormatErrorMessage"), "emailFormatErrorMessage");
    else
        removeErrorMessage(labelId,"emailFormatErrorMessage");
}

function checkName(elementCheck,labelId){
    const nameCharacters = /[^A-Za-z ]+/;

    if(nameCharacters.test(elementCheck.value.trim()))
        appendErrorMessage(labelId, createErrorMessage("Inserire un nome valido", "nameFormatErrorMessage"), "nameFormatErrorMessage");
    else
        removeErrorMessage(labelId,"nameFormatErrorMessage");
}

function checkSurname(elementCheck,labelId){
    const nameCharacters = /[^A-Za-z ]+/;

    if(nameCharacters.test(elementCheck.value.trim()))
        appendErrorMessage(labelId, createErrorMessage("Inserire un cognome valido", "surnameFormatErrorMessage"), "surnameFormatErrorMessage");
    else
        removeErrorMessage(labelId,"surnameFormatErrorMessage");
}


function checkUsername(elementCheck,labelId){
    const userCharacters = /[^A-Za-z0-9_-]+/;  

    if(userCharacters.test(elementCheck.value.trim()))
        appendErrorMessage(labelId, createErrorMessage("Inserire un username valido", "userFormatErrorMessage"), "userFormatErrorMessage");
    else
        removeErrorMessage(labelId,"userFormatErrorMessage");

}

function checkDate(elementCheck,labelId){
    const date = new Date(elementCheck.value);

    if(date.getFullYear() > 2023 || date.getFullYear() <= 1930) 
        appendErrorMessage(labelId, createErrorMessage("Inserire una data valida", "userDateErrorMessage"), "userDateErrorMessage");
    else
        removeErrorMessage(labelId,"userDateErrorMessage");
}



function addEventListener(){
    const nome = document.getElementById("inputNome");
    const cognome = document.getElementById("inputCognome");
    const username = document.getElementById("inputUsername");
    const password = document.getElementById("inputPassword");
    const confPassword = document.getElementById("inputConfPassword");
    const dataNascita = document.getElementById("inputDataNascita");
    const email = document.getElementById("inputEmail");

    
    nome.addEventListener("blur", function(){
        checkLength(nome,"labelNome",2);
        checkName(nome,"labelNome");
    });

    cognome.addEventListener("blur", function(){
        checkLength(cognome,"labelCognome",2);
        checkSurname(cognome,"labelCognome");
    });

    username.addEventListener("blur", function(){
        checkLength(username,"labelUsername",2);
        checkUsername(username,"labelUsername");
    });

    password.addEventListener("blur", function(){
        checkLength(password,"labelPassword",8);
        checkPasswordFormat(password,"labelPassword");
    });

    confPassword.addEventListener("blur", function(){
        checkLength(confPassword,"labelConfPassword");
        confirmPassword(password,confPassword,"labelConfPassword");
    });

    dataNascita.addEventListener("blur", function(){
        checkLength(dataNascita,"labelDataNascita");
        checkDate(dataNascita,"labelDataNascita");
    });

    email.addEventListener("blur", function(){
        checkLength(email,"labelEmail");
        checkEmail(email,"labelEmail");
    });

}

addEventListener();

