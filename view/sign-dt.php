<?php 
require_once("../controller/connect.php");
require_once("../controller/auth.php");

$id_userlog = $_SESSION['user']['id'];
$get_signid = $_GET['info'];

$sql = "SELECT * FROM signature WHERE sign_byID = $id_userlog AND id = $get_signid";
$query = $connect->query($sql);
$datas = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($datas as $data) {
    $getData = $data['id'];
    $getPDF = $data['pdf_name'];
    $getTO = $data['user_received'];
    $getPubKeyN = $data['pubkey_n'];
    $getPubKeyE = $data['pubkey_e'];
    $getMD = $data['message_digest'];
    $getSignV = $data['sign_value'];
    $getSignBy = $data['sign_by'];
    $getDate = $data['date'];
    $getTimePr = $data['process_time'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $getData?> - RSA Digital Signature</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="../view/css/styles.css">

    <script src="https://kit.fontawesome.com/3a0f2977a4.js" crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">



            <ul class="navbar-nav ms-auto username">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><?php echo $_SESSION['user']['username']?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-user"></i></a>
                    </li>
                </ul>
                <a class="btn btn-danger" href="../controller/logout.php">Log Out</a>



            </div>
        </nav>

        <div class="sidebar">
            <a href="mainpage.php">
                <div class="sidebar-content">
                    <button class="btn btn-link">
                        <p><i class="fas fa-home"></i>Home</p>
                    </button>
                </div>
            </a>

            <a href="signature.php">
                <div class="sidebar-content">
                    <button class="btn btn-link">
                        <p><i class="fas fa-file-signature"></i>Signature</p>
                    </button>
                </div>
            </a>

            <a href="verification.php">
                <div class="sidebar-content">
                    <button class="btn btn-link">
                        <p><i class="fas fa-user-check"></i>Verification</p>
                    </button>
                </div>
            </a>


        </div>

        <div class="contentmain">
            
            <div class="mainpage2">
            <a href="signature.php" type="button" class="btn btn-link" style="color: blue;">Kembali</a>
            <br>
            <br>
                <h3><?php echo $getPDF?></h3>
                <table style="width: 100%">
                    <tr>
                        <th>Dikirim Ke</th>
                        <td>:</td>
                        <td><?php echo $getTO ?></td>
                    </tr>
                    <tr>
                        <th>Kunci Publik n</th>
                        <td>:</td>
                        <td><?php echo $getPubKeyN ?></td>
                    </tr>
                    <tr>
                        <th>Kunci Publik e</th>
                        <td>:</td>
                        <td><?php echo $getPubKeyE ?></td>
                    </tr>
                    <tr>
                        <th>Message Digest</th>
                        <td>:</td>
                        <td><?php echo $getMD ?></td>
                    </tr>
                    <tr>
                        <th>Nilai Tanda Tangan</th>
                        <td>:</td>
                        <td><?php echo $getSignV ?></td>
                    </tr>
                    <tr>
                        <th>Tanda Tangan oleh</th>
                        <td>:</td>
                        <td><?php echo $getSignBy ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>:</td>
                        <td><?php echo $getDate?></td>
                    </tr>
                    <tr>
                        <th>Waktu Proses</th>
                        <td>:</td>
                        <td><?php echo $getTimePr ?></td>
                    </tr>
                </table>
            </div>
            
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</body>

</html>