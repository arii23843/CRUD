document.addEventListener("DOMContentLoaded", () => {

  const form = document.querySelector("#formReserva");
  if (!form) return;

  form.addEventListener("submit", function (e) {

    let errores = [];

    const nombre = form.nombre_cliente.value.trim();
    const telefono = form.telefono.value.trim();
    const email = form.email.value.trim();
    const habitacion = form.habitacion.value.trim();
    const entrada = form.fecha_entrada.value;
    const salida = form.fecha_salida.value;
    const personas = parseInt(form.personas.value);

    // Nombre
    if (nombre.length < 3 || nombre.length > 100) {
      errores.push("El nombre debe tener entre 3 y 100 caracteres.");
    }

    const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
    if (!nombreRegex.test(nombre)) {
      errores.push("El nombre solo puede contener letras y espacios.");
    }

    // Teléfono
    if (telefono !== "") {
      const telRegex = /^[0-9]{7,15}$/;
      if (!telRegex.test(telefono)) {
        errores.push("El teléfono debe contener entre 7 y 15 números.");
      }
    }

    // Email
    if (email !== "") {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        errores.push("El email no tiene un formato válido.");
      }
    }

    // Habitación
    if (habitacion.length < 1 || habitacion.length > 50) {
      errores.push("La habitación es obligatoria (máx 50 caracteres).");
    }

    // Fechas
    const hoy = new Date().toISOString().split("T")[0];

    if (entrada < hoy) {
      errores.push("La fecha de entrada no puede ser anterior a hoy.");
    }

    if (salida <= entrada) {
      errores.push("La fecha de salida debe ser mayor a la de entrada.");
    }

    // Personas
    if (isNaN(personas) || personas < 1 || personas > 10) {
      errores.push("Personas debe ser un número entre 1 y 10.");
    }

    if (errores.length > 0) {
      e.preventDefault();
      alert(errores.join("\n"));
    }

  });
});
