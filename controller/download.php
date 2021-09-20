<?php
require_once("../controller/auth.php"); 
require_once("../controller/connect.php");

if (isset($_GET['file'])) {
    $filename = $_GET['file'];

    $dir = "../pdffiles/";
    $file = $dir . $filename;
    if (file_exists($file)) {
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".basename($file));
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Cache-Control: private");
        header("Pragma: private");
        header("Content-Length: ".filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    } else {
        $ver_id = $_GET['id'];
        header("Location: ../view/ver-dt.php?info=$ver_id&download=denied");
    }
}
?>