<?php

// Koneksi
$host = "localhost";
$db_username = "id17634622_171401117";
$db_password = "Aryadutadias999:)";
$database = "id17634622_skripsi171401117";

try {
    $connect = new PDO("mysql:host=$host;dbname=$database", $db_username, $db_password);
} catch (\Throwable $th) {
    die("Terjadi masalah:" . $th->getMessage());
}
?>