<?php

// Koneksi
$host = "sql306.epizy.com";
$db_username = "epiz_29820710";
$db_password = "ghrmE6N0MIzkr1";
$database = "epiz_29820710_skripsi171401117";

try {
    $connect = new PDO("mysql:host=$host;dbname=$database", $db_username, $db_password);
} catch (\Throwable $th) {
    die("Terjadi masalah:" . $th->getMessage());
}
?>