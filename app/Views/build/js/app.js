$(document).ready(function () {
  const params = new URLSearchParams(window.location.search);
  if (params.get("alert") === "Agregar") {
    Swal.fire({
      title: "¡Artículo Agregado!",
      text: "El artículo ha sido agregado a tu carrito.",
      icon: "success",
      confirmButtonText: "OK",
    });
  }

  if (params.get("alert") === "Compra") {
    Swal.fire({
      title: "¡Compra Exitosa!",
      text: "Tu pedido se ha generado correctamente.",
      icon: "success",
      confirmButtonText: "OK",
    });
  }

  if (params.get("alert") === "Error") {
    Swal.fire({
      title: "¡Oops...!",
      text: "Algo ha salido mal.",
      icon: "error",
      confirmButtonText: "OK",
    });
  }
});
