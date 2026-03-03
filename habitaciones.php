<?php
// Catálogo estático (sin SQL). Solo HTML + CSS.
// Cambia precios, detalles e imágenes como quieras.
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Catálogo de Habitaciones</title>
  <link rel="stylesheet" href="build/css/style.css">  <link rel="stylesheet" href="build/css/habitacion.css">
</head>
<body>
  <div class="container">
    <div class="catalogo-header">
      <div>
        <h1 style="margin:0;" color>Catálogo de Habitaciones</h1>
        <p class="catalogo-sub">Elige el tipo de habitación ideal.</p>
      </div>
      <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a class="btn" href="index.php">Ver Reservas</a>
        <a class="btn" href="crear.php">Reservar</a>
      </div>
    </div>

    <div class="catalogo-grid">

      <!-- HABITACIÓN 1 -->
      <article class="card">
        <img src="build/img/sencilla.jpg" alt="Habitación Sencilla"
             onerror="this.style.display='none'">
        <div class="card-body">
          <div class="card-top">
            <div>
              <h2 class="titulo">Sencilla</h2>
              <div class="badge">Capacidad: 1 persona</div>
            </div>
            <p class="precio">$650 <span>MXN / noche</span></p>
          </div>

          <p class="desc">Ideal para viajeros solos. Cómoda, práctica y con lo esencial para descansar.</p>

          <ul class="features">
            <li><span class="dot"></span> Cama individual</li>
            <li><span class="dot"></span> Baño privado</li>
            <li><span class="dot"></span> WiFi + TV</li>
            <li><span class="dot"></span> Aire acondicionado</li>
          </ul>

          <div class="card-actions">
            <a class="btn" href="crear.php">Reservar</a>
            <a class="btn-outline" href="#contacto">Más info</a>
          </div>
        </div>
      </article>

      <!-- HABITACIÓN 2 -->
      <article class="card">
        <img src="build/img/doble.jpg" alt="Habitación Doble"
             onerror="this.style.display='none'">
        <div class="card-body">
          <div class="card-top">
            <div>
              <h2 class="titulo">Doble</h2>
              <div class="badge">Capacidad: 2 personas</div>
            </div>
            <p class="precio">$850 <span>MXN / noche</span></p>
          </div>

          <p class="desc">Perfecta para parejas o amigos. Mayor espacio y cama matrimonial.</p>

          <ul class="features">
            <li><span class="dot"></span> Cama matrimonial</li>
            <li><span class="dot"></span> Baño privado</li>
            <li><span class="dot"></span> Escritorio de trabajo</li>
            <li><span class="dot"></span> Amenidades incluidas</li>
          </ul>

          <div class="card-actions">
            <a class="btn" href="crear.php">Reservar</a>
            <a class="btn-outline" href="#contacto">Más info</a>
          </div>
        </div>
      </article>

      <!-- HABITACIÓN 3 -->
      <article class="card">
        <img src="build/img/suite.jpg" alt="Suite"
             onerror="this.style.display='none'">
        <div class="card-body">
          <div class="card-top">
            <div>
              <h2 class="titulo">Suite</h2>
              <div class="badge">Capacidad: 4 personas</div>
            </div>
            <p class="precio">$1500 <span>MXN / noche</span></p>
          </div>

          <p class="desc">Experiencia premium: amplitud, sala privada y comodidades superiores.</p>

          <ul class="features">
            <li><span class="dot"></span> 1 cama king + sofá cama</li>
            <li><span class="dot"></span> Sala privada</li>
            <li><span class="dot"></span> Mini bar</li>
            <li><span class="dot"></span> Vista / balcón (según disponibilidad)</li>
          </ul>

          <div class="card-actions">
            <a class="btn" href="crear.php">Reservar</a>
            <a class="btn-outline" href="#contacto">Más info</a>
          </div>
        </div>
      </article>

      <!-- HABITACIÓN 4 -->
      <article class="card">
  <img src="build/img/habitacion2.jpg" alt="Habitación Ejecutiva">
  <div class="card-body">
    <h2 class="titulo">Ejecutiva</h2>
    <div class="badge">Capacidad: 2 personas</div>

    <p class="precio">$1,050 <span>MXN / noche</span></p>

    <p class="desc">
      Ideal para viajes de negocios. Ambiente moderno con espacio de trabajo y comodidad premium.
    </p>

    <ul class="features">
      <li>✔ Cama queen size</li>
      <li>✔ Escritorio ejecutivo</li>
      <li>✔ Smart TV</li>
      <li>✔ WiFi alta velocidad</li>
    </ul>

    <div class="card-actions">
      <a class="btn" href="crear.php">Reservar</a>
      <a class="btn-outline" href="#">Más info</a>
    </div>
  </div>
</article>
<!-- HABITACIÓN 5 -->
 <article class="card">
  <img src="build/img/habitacion1.jpg" alt="Habitación Familiar">
  <div class="card-body">
    <h2 class="titulo">Familiar</h2>
    <div class="badge">Capacidad: 5 personas</div>

    <p class="precio">$1,800 <span>MXN / noche</span></p>

    <p class="desc">
      Espaciosa y cómoda para familias grandes. Perfecta para vacaciones en grupo.
    </p>

    <ul class="features">
      <li>✔ 2 camas matrimoniales</li>
      <li>✔ Área de descanso</li>
      <li>✔ Baño amplio</li>
      <li>✔ Servicio a la habitación</li>
    </ul>

    <div class="card-actions">
      <a class="btn" href="crear.php">Reservar</a>
      <a class="btn-outline" href="#">Más info</a>
    </div>
  </div>
</article>

<!-- HABITACIÓN 6 -->
 <article class="card">
  <img src="build/img/habitacion3.jpg" alt="Habitación Premium Vista al Mar">
  <div class="card-body">
    <h2 class="titulo">Premium Vista al Mar</h2>
    <div class="badge">Capacidad: 3 personas</div>

    <p class="precio">$2,200 <span>MXN / noche</span></p>

    <p class="desc">
      Disfruta de una vista espectacular y servicios exclusivos para una experiencia inolvidable.
    </p>

    <ul class="features">
      <li>✔ Cama king size</li>
      <li>✔ Balcón privado</li>
      <li>✔ Jacuzzi</li>
      <li>✔ Desayuno incluido</li>
    </ul>

    <div class="card-actions">
      <a class="btn" href="crear.php">Reservar</a>
      <a class="btn-outline" href="#">Más info</a>
    </div>
  </div>
</article>

    </div>

    <hr style="margin:22px 0; border:none; border-top:1px solid #eee;">

    <section id="contacto">
      <h2 style="margin:0 0 8px;">Contacto</h2>
      <p style="margin:0; color:#444;">
        ¿Dudas o quieres una cotización? Llámanos al <strong>222-000-0000</strong> o escribe a
        <strong>reservas@tuhotel.com</strong>.
      </p>
    </section>
  </div>
</body>
</html>