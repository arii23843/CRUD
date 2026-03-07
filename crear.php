<?php
require __DIR__ . '/includes/database.php';
require __DIR__ . '/includes/funciones.php';

$errores = [];
$values = [
  'nombre_cliente' => '',
  'telefono' => '',
  'email' => '',
  'habitacion' => '',
  'fecha_entrada' => '',
  'fecha_salida' => '',
  'personas' => 1,
  'estado' => 'pendiente',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  foreach ($values as $k => $_) {
    $values[$k] = trim((string)($_POST[$k] ?? $values[$k]));
  }

  $values['habitacion'] = mb_strtolower(trim($values['habitacion']), 'UTF-8');

  // Validaciones 
  if ($values['nombre_cliente'] === '') $errores[] = "El nombre del cliente es obligatorio.";
  if ($values['habitacion'] === '') $errores[] = "El tipo de habitación es obligatorio.";

  [$okf, $msgf] = validar_fechas($values['fecha_entrada'], $values['fecha_salida']);
  if (!$okf) $errores[] = $msgf;

  [$okp, $msgp] = validar_personas($values['personas']);
  if (!$okp) $errores[] = $msgp;

  // Validación de disponibilidad por fechas 
  $conn = db();

  $check = $conn->prepare("
    SELECT COUNT(*) as total
    FROM reservas
    WHERE habitacion = ?
      AND estado != 'cancelada'
      AND (? < fecha_salida AND ? > fecha_entrada)
  ");

  $check->bind_param(
    "sss",
    $values['habitacion'],
    $values['fecha_entrada'],
    $values['fecha_salida'],
  );

  $check->execute();
  $result = $check->get_result()->fetch_assoc();

  if ((int)$result['total'] > 0) {
    $errores[] = "La habitación ya está reservada en ese rango de fechas.";
  }

  // Insertar 
  if (!$errores) {
    $stmt = $conn->prepare("INSERT INTO reservas
      (nombre_cliente, telefono, email, habitacion, fecha_entrada, fecha_salida, personas, estado)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
      "ssssssis",
      $values['nombre_cliente'],
      $values['telefono'],
      $values['email'],
      $values['habitacion'],
      $values['fecha_entrada'],
      $values['fecha_salida'],
      $values['personas'],
      $values['estado']
    );

    $stmt->execute();
    redirect('index.php');
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nueva reserva</title>
  <link rel="stylesheet" href="build/css/style.css">
  <script defer src="build/js/validations.js"></script>
</head>
<body>
  <div class="container">
    <h1>Nueva reserva</h1>
    <a class="btn" href="habitaciones.php">← Volver</a>

    <?php if ($errores): ?>
      <div class="alert">
        <ul>
          <?php foreach ($errores as $e): ?>
            <li><?= h($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST" id="formReserva">
      <label>Nombre cliente</label>
      <input name="nombre_cliente" value="<?= h($values['nombre_cliente']) ?>" required>

      <label>Teléfono</label>
      <input name="telefono" value="<?= h($values['telefono']) ?>">

      <label>Email</label>
      <input type="email" name="email" value="<?= h($values['email']) ?>">

      <label>Tipo de habitación</label>
      <select name="habitacion" required>
        <?php
          $tipos = ['sencilla','doble','suite','ejecutiva','familiar','vista premium al mar'];
          foreach ($tipos as $t):
        ?>
          <option value="<?= $t ?>" <?= ($values['habitacion'] === $t ? 'selected' : '') ?>>
            <?= ucfirst($t) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <div class="grid">
        <div>
          <label>Fecha entrada</label>
          <input type="date" name="fecha_entrada" value="<?= h($values['fecha_entrada']) ?>" required>
        </div>
        <div>
          <label>Fecha salida</label>
          <input type="date" name="fecha_salida" value="<?= h($values['fecha_salida']) ?>" required>
        </div>
      </div>

      <label>Personas</label>
      <input type="number" name="personas" min="1" value="<?= (int)$values['personas'] ?>" required>

      <label>Estado</label>
      <select name="estado">
        <?php foreach (['pendiente','confirmada','cancelada'] as $st): ?>
          <option value="<?= $st ?>" <?= ($values['estado'] === $st ? 'selected' : '') ?>>
            <?= ucfirst($st) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button class="btn" type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
