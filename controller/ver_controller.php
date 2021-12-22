<?php
require_once("../controller/connect.php");
require_once("../controller/auth.php");

function verification($getSignV, $getPubKeyN, $getPubKeyE){
    $signs = explode(":",$getSignV);
    $ver_array = [];
    foreach ($signs as $sign) {
        $sign_dec = hexdec($sign);
        $data[0] = 1;
        for ($i=0; $i <= $getPubKeyE ; $i++) { 
            $rest[$i] = pow($sign_dec, 1) % $getPubKeyN;
            if ($data[$i] > $getPubKeyN) {
                $data[$i+1] = $data[$i] * $rest[$i] % $getPubKeyN;
            } else {
                $data[$i+1] = $data[$i] * $rest[$i];
            } 
        }
        $get_ver = $data[$getPubKeyE] % $getPubKeyN;
        array_push($ver_array, dechex($get_ver));
    }
    $newVer = [];
    foreach ($ver_array as $ver) {
        if (strlen($ver) >= 4) {
            array_push($newVer, $ver);
        }
        else if (strlen($ver) < 4) {
            $ver_combine = "0".$ver;
            array_push($newVer, $ver_combine);
        } 
    }
    $get_ver = implode("", $newVer);
    return $get_ver;
}

function sha3Hash($getPDF){
    $dir = "../pdffiles/";
    $hash_input = file_get_contents($dir . $getPDF);
    $hash_output = hash('sha3-256', $hash_input);
    return $hash_output;
}

// Mulai waktu proses
$start_time = microtime(true);

// verifikasi langsung dari pengirim
if (isset($_GET['verification'])) {
    $dataID = $_GET['verification'];
    $renderData = "SELECT * FROM verification WHERE id = $dataID";
    $dataCheck = $connect->query($renderData);
    $datas = $dataCheck->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datas as $data) {
        $getID = $data['id'];
        $getSignId = $data['sign_id'];
        $getPDF = $data['pdf_newname'];
        $getSignV = $data['sign_value'];
    }

    // cari kunci publik
    $signData = "SELECT * FROM signature WHERE id = $getSignId";
    $signCheck = $connect->query($signData);
    $signDatas = $signCheck->fetchAll(PDO::FETCH_ASSOC);
    foreach ($signDatas as $signData){
        $getPubKeyN = $signData['pubkey_n'];
        $getPubKeyE = $signData['pubkey_e'];
        $getSignBy = $signData['sign_by'];
    }
    // hashing pdf
    $hash_values = sha3Hash($getPDF);
    //proses verifikasi
    $ver = verification($getSignV, $getPubKeyN, $getPubKeyE);
    //bandingkan verifikasi dengan nilai message digest
    if ($ver == $hash_values) {
        $verify = "Valid";
    } else {
        $verify = "Not Valid";
    }
    // selesai waktu proses
    $end_time = microtime(true);
    $execution_time = ($end_time - $start_time);
    // update database
    $sql = "UPDATE verification SET pubkey_n = '$getPubKeyN', pubkey_e = '$getPubKeyE', message_digest = '$hash_values', sign_by = '$getSignBy' , ver_value = '$ver', validation = '$verify', process_time = '$execution_time' WHERE id=$getID AND sign_id = $getSignId";
    $query = $connect->query($sql);
    if ($query) {
        header("Location: ../view/ver-dt.php?info=$dataID&verify=success&hex=$hash_values&ver=$ver");
    } else {
        header("Location: ../view/ver-dt.php?info=$dataID&verify=failed");
    }
}

// verifikasi manual
if (isset($_POST['vernow'])) {
    $signValue = $_POST['signvalue'];
    $receivedID = $_SESSION['user']['id'];
    if (!$signValue) {
        header("Location: ../view/verification.php?status=input-error");
    } else {
        $pdf_name = $_FILES['uploadpdf']['name'];
        $pdf_temp = $_FILES['uploadpdf']['tmp_name'];
        $ext = pathinfo($pdf_name, PATHINFO_EXTENSION);
        if ($ext == 'pdf') {
            // cek id signature
            $check_data = "SELECT * FROM signature WHERE signv_id = $signValue";
            $query = $connect->query($check_data);
            $querydatas = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($querydatas as $querydata) {
                $signID = $querydata['id'];
                $getSignV = $querydata['sign_value'];
                $getSignVid = $querydata['signv_id'];
                $getSignBy = $querydata['sign_by'];
                $getN = $querydata['pubkey_n'];
                $getE = $querydata['pubkey_e'];
            }
            if ($getSignVid === $signValue) {
                //upload pdf
                $dir = "../pdffiles/";
                $pdf_newname =  "(".date("Ymd-His").")".$pdf_name;
                $pdf_upload = move_uploaded_file($pdf_temp, $dir . $pdf_newname);
                if ($pdf_upload) {
                    // hashing pdf
                    $hash_values = sha3Hash($pdf_newname);
                    // proses verifikasi
                    $ver = verification($getSignV, $getN, $getE);
                    //bandingkan verifikasi dengan nilai message digest
                    if ($ver == $hash_values) {
                        $verify = "Valid";
                    } else {
                        $verify = "Not Valid";
                    }
                    // selesai waktu proses
                    $end_time = microtime(true);
                    $execution_time = ($end_time - $start_time);
                    // simpan di database verification
                    $sql = "INSERT INTO verification (sign_id, received_id, pubkey_n, pubkey_e, message_digest, signv_id, sign_value, sign_by, ver_value, pdf_name, pdf_newname, validation, process_time) 
                    VALUES ('$signID', '$receivedID','$getN', '$getE', '$hash_values', '$getSignVid', '$getSignV', '$getSignBy', '$ver', '$pdf_name', '$pdf_newname', '$verify', '$execution_time')";
                    $query = $connect->query($sql);
                    if ($query) {
                        header("Location: ../view/verification.php?status=success&hex=$hash_values&ver=$ver");
                    } else {
                        header("Location: ../view/verification.php?status=failed");
                    }
                } else {
                    header("Location: ../view/verification.php?status=pdf-failed");
                }
            } else {
                header("Location: ../view/verification.php?status=input-notfound&sign=$getSignFr");
            } 
        } else {
            header("Location: ../view/verification.php?status=ext-error");
        }     
    }
}
else {
    die("Access Denied!");
}
?>