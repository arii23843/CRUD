<?php
declare(strict_types=1);

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): never {
    header("Location: {$path}");
    exit;
}

function validar_fechas(string $entrada, string $salida): array {
    if (!$entrada || !$salida) return [false, "Debes indicar fecha de entrada y salida."];
    if ($salida <= $entrada) return [false, "La fecha de salida debe ser mayor a la de entrada."];
    return [true, ""];
}

function validar_personas($personas): array {
    $p = (int)$personas;
    if ($p < 1) return [false, "Personas debe ser 1 o más."];
    return [true, ""];
}