// prende in input il messaggio che deve mostrare e la classe che deve aggiungere al errore ( mi servirà poi per trovarlo e cancellarlo)
function createErrorMessage(message, errorClass){
    let messageParagraph = document.createElement("p");
    messageParagraph.innerText = message;
    messageParagraph.setAttribute("class", errorClass);
    return messageParagraph;
}

// prende in input, l'id della label in cui deve apparire , il <p> con l'errore da mostrare , la classe del'errore in modo da controllare che non sia già presente
function appendErrorMesage(labelId, errorMessage, errorClass){ 
    const label = document.getElementById(labelId);
    let errorParagraph = label.querySelector('.' + errorClass);

    if(errorParagraph == null)
        label.appendChild(errorMessage); 
}

function removeErrorMesage(labelId, errorClass){
    const label = document.getElementById(labelId);
    let errorParagraph = label.querySelector('.' + errorClass);   // chiamo querySelector perchè  è l'unico che può essere chiamato su un elemento e non solo su document come getElementById
    
    if(errorParagraph != null)
        errorParagraph.remove()
    
}

//element check è l'input su cui deve fare il controllo
function checkEmpty(elementCheck,labelId){
    if(elementCheck.value == "")
        appendErrorMesage(labelId, createErrorMessage("Questo campo non può essere lasciato vuoto", "emptyErrorMessage"), "emptyErrorMessage");
    else{
        removeErrorMesage(labelId,"emptyErrorMessage");
    }
}


function addEventListener(){
    const nome = document.getElementById("inputNome");
    const cognome = document.getElementById("inputCognome");
    const password = document.getElementById("inputPassword");
    const confPassword = document.getElementById("inputConfPassword");
    const dataNascita = document.getElementById("inputDataNascita");
    const email = document.getElementById("inputEmail");
    
    nome.addEventListener("blur", function(){
        checkEmpty(nome,"labelNome");
    });

    cognome.addEventListener("blur", function(){
        checkEmpty(cognome,"labelCognome");
    });

    password.addEventListener("blur", function(){
        checkEmpty(password,"labelPassword");
    });

    confPassword.addEventListener("blur", function(){
        checkEmpty(confPassword,"labelConfPassword");
    });

    dataNascita.addEventListener("blur", function(){
        checkEmpty(dataNascita,"labelDataNascita");
    });

    email.addEventListener("blur", function(){
        checkEmpty(email,"labelEmail");
    });

}

addEventListener();

