<?php
declare(strict_types=1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function db(): mysqli {
    static $conn = null;

    if ($conn instanceof mysqli) {
        return $conn;
    }

    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $name = 'reservas_hotel';
    $port = 3306;

    $conn = new mysqli($host, $user, $pass, $name, $port);
    $conn->set_charset('utf8mb4');

    return $conn;
}