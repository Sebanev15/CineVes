let peliculas = document.querySelectorAll(".pelicula img");

peliculas.forEach(pelicula => {
    pelicula.addEventListener('mouseenter', (event) => {
        pelicula.style.filter = "brightness(50%)";
    });

    pelicula.addEventListener('mouseleave', (event) => {
        pelicula.style.filter = "brightness(100%)";
    });
});