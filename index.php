<?php
require __DIR__ . '/includes/database.php';
require __DIR__ . '/includes/funciones.php';

$conn = db();
$result = $conn->query("SELECT * FROM reservas ORDER BY creado_en DESC");
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Reservas</title>
  <link rel="stylesheet" href="build/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Reservas de habitaciones</h1>

    <a class="btn" href="crear.php">+ Nueva reserva</a>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Habitación</th>
          <th>Entrada</th>
          <th>Salida</th>
          <th>Personas</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php while($r = $result->fetch_assoc()): ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td><?= h($r['nombre_cliente']) ?></td>
          <td><?= h($r['habitacion']) ?></td>
          <td><?= h($r['fecha_entrada']) ?></td>
          <td><?= h($r['fecha_salida']) ?></td>
          <td><?= (int)$r['personas'] ?></td>
          <td><?= h($r['estado']) ?></td>
          <td class="actions">
            <a class="btn-sm" href="editar.php?id=<?= (int)$r['id'] ?>">Editar</a>
            <form class="inline" method="POST" action="eliminar.php" onsubmit="return confirm('¿Eliminar esta reserva?');">
              <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
              <button class="btn-sm danger" type="submit">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>