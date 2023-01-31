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

function checkLength(elementCheck,labelId, minLength){
    const fieldLength = elementCheck.value.trim().length;

    if(fieldLength == 0){
        appendErrorMessage(labelId, createErrorMessage("Questo campo non può essere lasciato vuoto", "emptyErrorMessage"), "emptyErrorMessage");
    } 
    else{
        removeErrorMessage(labelId,"emptyErrorMessage");
    }

}

function checkISBN(elementCheck,labelId){
    const userCharacters = /[^0-9]+/;  

    if(userCharacters.test(elementCheck.value.trim()))
        appendErrorMessage(labelId, createErrorMessage("L'ISBN può contenere solo numeri", "userFormatErrorMessage"), "userFormatErrorMessage");
    else
        removeErrorMessage(labelId,"userFormatErrorMessage");

}

function addEventListener(){
    const listingTitle = document.getElementById("new-listing-title");
    const listingDescr = document.getElementById("new-listing-descr");
    const listingPrice = document.getElementById("new-listing-price");
    const listingSubject = document.getElementById("new-listing-subject");
    const listingISBNEdit = document.getElementById("new-listing-isbn");
    
    //inserimento annuncio

    listingTitle.addEventListener("blur", function(){
        checkLength(listingTitle,"labelTitoloAnnuncio",2);
    });

    listingDescr.addEventListener("blur", function(){
        checkLength(listingDescr,"labelDescrAnnuncio",2);
    });

    listingPrice.addEventListener("blur", function(){
        checkLength(listingPrice,"labelPriceAnnuncio",2);
    });

    listingSubject.addEventListener("blur", function(){
        checkLength(listingSubject,"labeSubjectAnnuncio",2);
    });

    // controllo per l'ISBN
    listingISBNEdit.addEventListener("blur", function(){
        checkISBN(listingISBNEdit, "labelISBN");
    });
}

addEventListener();
