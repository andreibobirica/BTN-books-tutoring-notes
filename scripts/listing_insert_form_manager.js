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

/* Controlla il formato dell'ISBN.
 * @param isbn - ISBN da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkISBN(isbn, error, oldMsg) {
    const numbers = /[^0-9]+/;

    if (numbers.test(isbn.value.trim()))
        writeErrorMessage(
            error,
            "L'ISBN può contenere solo numeri",
            "userFormatErrorMessage"
        );
    else removeErrorMessage(error, "userFormatErrorMessage", oldMsg);
}

/* Controlla il formato del prezzo.
 * @param prezzo - Prezzo da controllare
 * @param error - Elemento in cui scrivere il messaggio di errore
 * @param - oldMsg Messaggio pre-errore da ripristinare
 */
function checkPrice(prezzo, error, oldMsg) {
    console.log("blur prezzo");

    const decimal = /^\d+(.\d{1,2})?$/;

    if (!decimal.test(prezzo.value.trim()))
        writeErrorMessage(
            error,
            "Il prezzo può contenere solo con massimo due cifre decimali",
            "userFormatErrorMessage"
        );
    else removeErrorMessage(error, "userFormatErrorMessage", oldMsg);
}

const listingPrice = document.getElementById("new-listing-price");
const errPrezzo = document.getElementById("prezzo-errore");
const oldPrezzo = errPrezzo.innerHTML;

const listingISBN = document.getElementById("new-listing-isbn");
const errISBN = document.getElementById("isbn-errore");
const oldISBN = errISBN.innerHTML;

listingPrice.addEventListener("blur", function () {
    checkPrice(listingPrice, errPrezzo, oldPrezzo);
});

listingISBN.addEventListener("blur", function () {
    if (checkLength(listingISBN, errISBN, 10, oldISBN)) {
        checkISBN(listingISBN, errISBN, oldISBN);
    }
});
