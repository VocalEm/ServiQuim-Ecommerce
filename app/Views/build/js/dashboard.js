const images = [
  "/app/Views/src/img/Portada soluciones.png",
  "/app/Views/src/img/portada-Limpieza.png",
  "/app/Views/src/img/Portada navidad.png",
  "/app/Views/src/img/PortadaE.jpg",
];

let currentSlide = 0;

function showSlide(index) {
  $("#carousel-image").attr("src", images[index]);
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % images.length;
  showSlide(currentSlide);
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + images.length) % images.length;
  showSlide(currentSlide);
}

$(document).ready(function () {
  showSlide(currentSlide);
  setInterval(nextSlide, 3000); // Cambia la imagen cada 3 segundos (3000 ms)
});
