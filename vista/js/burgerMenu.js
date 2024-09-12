document.addEventListener("DOMContentLoaded", function() {
    function burgerClick() {
        let burger = document.getElementById("burgerImagen");
        let nav = document.querySelector("nav");
        burger.addEventListener("click", function() {
            nav.classList.toggle("mostrar");
            nav.classList.toggle("ocultar");
        });
    }

    burgerClick();
});