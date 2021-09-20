<?php

require_once("connect.php");
$usernameError = "";
if(isset($_POST['register'])){
    try {
        // filter data yang diinputkan
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        // enkripsi password
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        // menyiapkan query
        $sql = "INSERT INTO users (name, username, email, password) 
                VALUES (:name, :username, :email, :password)";
        $stmt = $connect->prepare($sql);
    
        // bind parameter ke query
        $params = array(
            ":name" => $name,
            ":username" => $username,
            ":email" => $email,
            ":password" => $password
        );
        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);
    
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
            $success = true;
            header("Location: ../view/login.php?regist=$success");
        } 
    } catch (\Throwable $th) {
        $alertUsername = true;
    }
        
    
        
}

?>