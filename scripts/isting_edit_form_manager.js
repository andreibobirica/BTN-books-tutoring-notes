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


function addEventListener(){
    const listingTitleEdit = document.getElementById("edit-listing-title");
    const listingDescrEdit = document.getElementById("edit-listing-descr");
    const listingPriceEdit = document.getElementById("edit-listing-price");
    const listingSubjectEdit = document.getElementById("edit-listing-subject");


    // pagina di modifica annuncio 

    listingTitleEdit.addEventListener("blur", function(){
        checkLength(listingTitleEdit,"labelTitoloAnnuncio",2);
    });

    listingDescrEdit.addEventListener("blur", function(){
        checkLength(listingDescrEdit,"labelDescrAnnuncio",2);
    });

    listingPriceEdit.addEventListener("blur", function(){
        checkLength(listingPriceEdit,"labelPriceAnnuncio",2);
    });

    listingSubjectEdit.addEventListener("blur", function(){
        checkLength(listingSubjectEdit,"labeSubjectAnnuncio",2);
    });


}

addEventListener();
