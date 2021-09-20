<?php
require_once("../controller/connect.php");
require_once("../controller/auth.php");

function e_key($lambda_n)
{
    for ($e = 2; $e < $lambda_n; $e++) {
        if (gmp_strval(gmp_gcd($e, $lambda_n)) == 1) {
            return $e;
        }
    }
    return false;
}

function d_key($e, $lambda_n)
{
    for ($d = 2; $d < $lambda_n; $d++) {
        if ($d * $e % $lambda_n == 1) {
            return $d;
        }
    }
    return false;
}

function renderUser($connect)
{
    $user_check = "SELECT * FROM users";
    $uchk_query = $connect->query($user_check);
    $datas_user = $uchk_query->fetchAll(PDO::FETCH_ASSOC);
    return $datas_user;
}

if (isset($_POST['signnow'])) {
    $start_time = microtime(true);
    $a = 1;
    for ($i = 1; $i <= 1000; $i++) {
        $a++;
    }

    $user_received = $_POST['username'];
    $prime_p = $_POST['pprime'];
    $prime_q = $_POST['qprime'];

    if (!$prime_p || !$prime_q) {
        header("Location: ../view/signature.php?status=primes-error");
    } elseif ($prime_p === $prime_q) {
        header("Location: ../view/signature.php?status=primes-same");
    }
    else {
        $pdf_name = $_FILES['pdfupload']['name'];
        $pdf_temp = $_FILES['pdfupload']['tmp_name'];
        $ext = pathinfo($pdf_name, PATHINFO_EXTENSION);
    
        if ($ext == 'pdf') {
            $senderID = $_SESSION['user']['id'];
            $senderUN = $_SESSION['user']['username'];
    
            $n = $prime_p * $prime_q;
            $lambda_n = ($prime_p - 1) * ($prime_q - 1);
            $e = e_key($lambda_n);
            $d = d_key($e, $lambda_n);
    
            // pindahkan pdf
            $dir = "../pdffiles/";
            $pdf_newname = $senderUN . "_" . date("Ymd-His") . "_" . $pdf_name;
            $pdf_upload = move_uploaded_file($pdf_temp, $dir . $pdf_newname);
    
            if ($pdf_upload) {
                // hashing pdf
                $hash_input = file_get_contents($dir . $pdf_newname);
                $hash_output = hash('sha3-256', $hash_input);
    
                $hash_dec = substr(hexdec($hash_output), 0, 5) * 1000;
    
                // proses signature
                $data[0] = 1;
                for ($i = 0; $i <= $d; $i++) {
                    $rest[$i] = pow($hash_dec, 1) % $n;
                    if ($data[$i] > $n) {
                        $data[$i + 1] = $data[$i] * $rest[$i] % $n;
                    } else {
                        $data[$i + 1] = $data[$i] * $rest[$i];
                    }
                }
                $get_sign = $data[$d] % $n;
    
                // selesai hitung waktu eksekusi
                $end_time = microtime(true);
                $execution_time = ($end_time - $start_time);
    
                $datas_user = renderUser($connect);
                foreach ($datas_user as $data_user) {
                    if ($data_user['username'] == $user_received) {
                        $username_r = $user_received;
                        $id_r = $data_user['id'];
                    }
                }
    
                if (($username_r == $user_received) || !$user_received) {
                    $sign_sql = "INSERT INTO signature (prime_p, prime_q, pubkey_n, pubkey_e, private_key, message_digest, sign_value, sign_byID, sign_by, pdf_name, user_received, process_time) VALUES 
                    ('$prime_p', '$prime_q', '$n', '$e', '$d', '$hash_output', '$get_sign', '$senderID','$senderUN', '$pdf_newname', '$username_r', '$execution_time')";
                    $sign_query = $connect->query($sign_sql);
    
    
                    if (!$user_received) {
                        if ($sign_query) {
                            header("Location: ../view/signature.php?status=sign-success");
                        } else {
                            header("Location: ../view/signature.php?status=query-error");
                        }
                    }
    
                    if ($username_r == $user_received) {
                        $sign_id = "SELECT * FROM signature";
                        $sign_chk = $connect->query($sign_id);
                        $datas_sign = $sign_chk->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($datas_sign as $data_sign) {
                            if ($data_sign['pdf_name'] == $pdf_newname) {
                                $sign_idf = $data_sign['id'];
                            }
                        }
                        $ver_sql = "INSERT INTO verification (sign_id, received_id, sender_uname, pubkey_n, pubkey_e, sign_value, sign_by, pdf_name, validation, process_time) 
                        VALUES ('$sign_idf', '$id_r', '$senderUN', '$n', '$e', '$get_sign', '$senderUN', '$pdf_newname', 'Belum diverifikasi', '$execution_time')";
                        $ver_query = $connect->query($ver_sql);
    
                        if ($sign_query && $ver_query) {
    
                            header("Location: ../view/signature.php?status=signsend-success");
                        } else {
                            header("Location: ../view/signature.php?status=query-error");
                        }
                        
                    } 
    
                }
                else {
                    header("Location: ../view/signature.php?status=username-notfound");
                }
    
            } else {
                header("Location: ../view/signature.php?status=upload-error");
            }
        } else {
            header("Location: ../view/signature.php?status=ext-error");
        }
    }

} else {
    die("access denied");
}
