// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty("--vh", `${vh}px`);
menu = document.getElementById("menu");

function menuOnClick() {
    menu.classList.toggle("show-menu");
    if (menu.classList.contains("show-menu")) {
        menu.setAttribute("aria-expanded", "true");
    } else {
        menu.setAttribute("aria-expanded", "false");
    }
}
