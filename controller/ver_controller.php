<?php
require_once("../controller/connect.php");
require_once("../controller/auth.php");

function verification($getSignV, $getPubKeyN, $getPubKeyE){
    $data[0] = 1;
    for ($i=0; $i <= $getPubKeyE ; $i++) { 
        $rest[$i] = pow($getSignV, 1) % $getPubKeyN;
        if ($data[$i] > $getPubKeyN) {
            $data[$i+1] = $data[$i] * $rest[$i] % $getPubKeyN;
        } else {
            $data[$i+1] = $data[$i] * $rest[$i];
        } 
    }
    $get_ver = $data[$getPubKeyE] % $getPubKeyN;
    return $get_ver;
}

function sha3Hash($getPDF){
    $dir = "../pdffiles/";
    $hash_input = file_get_contents($dir . $getPDF);
    $hash_output = hash('sha3-256', $hash_input);
    return $hash_output;
}

function hashToDec($hash_output){
    $hash_dec = substr(hexdec($hash_output), 0, 5) * 1000;
    return $hash_dec;
}


$start_time = microtime(true);
$a = 1;
for ($i = 1; $i <= 1000; $i++) {
    $a++;
}
if (isset($_GET['verification'])) {


    $dataID = $_GET['verification'];
    $renderData = "SELECT * FROM verification WHERE id = $dataID";
    $dataCheck = $connect->query($renderData);
    $datas = $dataCheck->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datas as $data) {
        $getID = $data['id'];
        $getSignId = $data['sign_id'];
        $getPubKeyN = $data['pubkey_n'];
        $getPubKeyE = $data['pubkey_e'];
        $getPDF = $data['pdf_newname'];
        $getSignV = $data['sign_value'];
    }
    $hash_values = sha3Hash($getPDF);
    $dec = hashToDec($hash_values);
    
    $ver = verification($getSignV, $getPubKeyN, $getPubKeyE);

    if ($ver == $dec) {
        $verify = "Valid";
    } else {
        $verify = "Tidak valid";
    }
    $end_time = microtime(true);
    $execution_time = ($end_time - $start_time);
    $sql = "UPDATE verification SET message_digest = '$hash_values', ver_value = '$ver', validation = '$verify', process_time = '$execution_time' WHERE id=$getID AND sign_id = $getSignId";
    $query = $connect->query($sql);
    if ($query) {
        header("Location: ../view/ver-dt.php?info=$dataID&verify=success&hex=$dec&ver=$ver");
    } else {
        header("Location: ../view/ver-dt.php?info=$dataID&verify=failed");
    }
    
}

if (isset($_POST['vernow'])) {
    $pubkey_N = $_POST['pubkeyn'];
    $pubkey_E = $_POST['pubkeye'];
    $signValue = $_POST['signvalue'];

    $receivedID = $_SESSION['user']['id'];
    if (!$pubkey_N || !$pubkey_E || !$signValue) {
        header("Location: ../view/verification.php?status=input-error");
    } else {
        $pdf_name = $_FILES['uploadpdf']['name'];
        $pdf_temp = $_FILES['uploadpdf']['tmp_name'];
        $ext = pathinfo($pdf_name, PATHINFO_EXTENSION);
        

        if ($ext == 'pdf') {
            $check_data = "SELECT * FROM signature WHERE pubkey_n = $pubkey_N AND pubkey_e = $pubkey_E AND sign_value = $signValue";
            $query = $connect->query($check_data);
            $querydatas = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($querydatas as $querydata) {
                $signID = $querydata['id'];
                $getSignV = $querydata['sign_value'];
                $getSignBy = $querydata['sign_by'];
                $getN = $querydata['pubkey_n'];
                $getE = $querydata['pubkey_e'];
            }
            if ($getSignV === $signValue || $getN === $pubkey_N || $getE === $pubkey_E) {
                $dir = "../pdffiles/";
                $pdf_newname =  "(".date("Ymd-His").")".$pdf_name;
                $pdf_upload = move_uploaded_file($pdf_temp, $dir . $pdf_newname);
                if ($pdf_upload) {
                    $hash_values = sha3Hash($pdf_newname);
                    $dec = hashToDec($hash_values);
    
                    $ver = verification($getSignV, $getN, $getE);
    
                    if ($ver == $dec) {
                        $verify = "Valid";
                    } else {
                        $verify = "Tidak valid";
                    }
                    $end_time = microtime(true);
                    $execution_time = ($end_time - $start_time);
                    $sql = "INSERT INTO verification (sign_id, received_id, pubkey_n, pubkey_e, message_digest, sign_value, sign_by, ver_value, pdf_name, pdf_newname, validation, process_time) 
                    VALUES ('$signID', '$receivedID','$getN', '$getE', '$hash_values', '$getSignV', '$getSignBy', '$ver', '$pdf_name', '$pdf_newname', '$verify', '$execution_time')";
                    $query = $connect->query($sql);
                    if ($query) {
                        header("Location: ../view/verification.php?status=success&hex=$dec&ver=$ver");
                    } else {
                        header("Location: ../view/verification.php?status=failed");
                    }
    
    
                } else {
                    header("Location: ../view/verification.php?status=pdf-failed");
                }
            } else {
                header("Location: ../view/verification.php?status=input-notfound");
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