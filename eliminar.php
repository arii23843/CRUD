<?php
require __DIR__ . '/includes/database.php';
require __DIR__ . '/includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  redirect('index.php');
}

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) redirect('index.php');

$conn = db();
$stmt = $conn->prepare("DELETE FROM reservas WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

redirect('index.php');