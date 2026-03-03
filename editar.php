<?php
require __DIR__ . '/includes/database.php';
require __DIR__ . '/includes/funciones.php';

$conn = db();
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) redirect('index.php');

$stmt = $conn->prepare("SELECT * FROM reservas WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$values = $res->fetch_assoc();
if (!$values) redirect('index.php');

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $values['nombre_cliente'] = trim((string)($_POST['nombre_cliente'] ?? ''));
  $values['telefono'] = trim((string)($_POST['telefono'] ?? ''));
  $values['email'] = trim((string)($_POST['email'] ?? ''));
  $values['habitacion'] = trim((string)($_POST['habitacion'] ?? ''));
  $values['fecha_entrada'] = trim((string)($_POST['fecha_entrada'] ?? ''));
  $values['fecha_salida'] = trim((string)($_POST['fecha_salida'] ?? ''));
  $values['personas'] = (int)($_POST['personas'] ?? 1);
  $values['estado'] = trim((string)($_POST['estado'] ?? 'pendiente'));

  if ($values['nombre_cliente'] === '') $errores[] = "El nombre del cliente es obligatorio.";
  if ($values['habitacion'] === '') $errores[] = "La habitación es obligatoria.";

  [$okf, $msgf] = validar_fechas($values['fecha_entrada'], $values['fecha_salida']);
  if (!$okf) $errores[] = $msgf;

  [$okp, $msgp] = validar_personas($values['personas']);
  if (!$okp) $errores[] = $msgp;

  if (!$errores) {
    $upd = $conn->prepare("UPDATE reservas SET
      nombre_cliente=?, telefono=?, email=?, habitacion=?, fecha_entrada=?, fecha_salida=?, personas=?, estado=?
      WHERE id=?");
    $upd->bind_param(
      "ssssssisi",
      $values['nombre_cliente'],
      $values['telefono'],
      $values['email'],
      $values['habitacion'],
      $values['fecha_entrada'],
      $values['fecha_salida'],
      $values['personas'],
      $values['estado'],
      $id
    );
    $upd->execute();
    redirect('index.php');
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar reserva</title>
  <link rel="stylesheet" href="build/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Editar reserva #<?= $id ?></h1>
    <a class="btn" href="index.php">← Volver</a>

    <?php if($errores): ?>
      <div class="alert">
        <ul>
          <?php foreach($errores as $e): ?><li><?= h($e) ?></li><?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST">
      <label>Nombre cliente</label>
      <input name="nombre_cliente" value="<?= h($values['nombre_cliente']) ?>" required>

      <label>Teléfono</label>
      <input name="telefono" value="<?= h($values['telefono']) ?>">

      <label>Email</label>
      <input type="email" name="email" value="<?= h($values['email']) ?>">

      <label>Habitación</label>
      <input name="habitacion" value="<?= h($values['habitacion']) ?>" required>

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
        <?php foreach(['pendiente','confirmada','cancelada'] as $st): ?>
          <option value="<?= $st ?>" <?= $values['estado']===$st ? 'selected' : '' ?>><?= ucfirst($st) ?></option>
        <?php endforeach; ?>
      </select>

      <button class="btn" type="submit">Guardar cambios</button>
    </form>
  </div>
</body>
</html>