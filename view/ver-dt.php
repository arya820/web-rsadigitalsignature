<?php 
require_once("../controller/auth.php"); 
require_once("../controller/connect.php");

$id_userlog = $_SESSION['user']['id'];
$get_verid = $_GET['info'];

$sql = "SELECT * FROM verification WHERE received_id = $id_userlog AND id = $get_verid";
$query = $connect->query($sql);
$datas = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($datas as $data) {
    $getData = $data['id'];
    $getPDF = $data['pdf_name'];
    $getPDFdw = $data['pdf_newname'];
    $getFrom = $data['sender_uname'];
    $getPubKeyN = $data['pubkey_n'];
    $getPubKeyE = $data['pubkey_e'];
    $getMD = $data['message_digest'];
    $getSignVid = $data['signv_id'];
    $getSignV = $data['sign_value'];
    $getSignBy = $data['sign_by'];
    $getVer = $data['ver_value'];
    $verification = $data['validation'];
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
            <div class="notification">
                <!-- php -->
                <?php if (isset($_GET['verify'])) {
                    if ($_GET['verify'] == 'failed') { ?>
                        <div class="alert alert-danger" role="alert">
                            Verification Failed
                        </div>
                    <?php } ?>
                    <?php if ($_GET['verify'] == 'success') { ?>
                        <div class="alert alert-success" role="alert">
                            Verification Success
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <br>
            <div class="mainpage2">
            <a href="verification.php" type="button" class="btn btn-link" style="color: blue;">Kembali</a>
            <br>
            <br>
                <h3><?php echo $getPDF?></h3>
                <table class="dt-table">
                    <tr>
                        <th class="dt-title">From</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php echo $getFrom; ?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Public Key n</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getPubKeyN) {
                            echo $getPubKeyN;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Public Key e</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getPubKeyE) {
                            echo $getPubKeyE;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Message Digest</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getMD) {
                            echo $getMD;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Verification Digest</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getVer) {
                            echo $getVer;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Signature ID</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getSignVid) {
                            echo $getSignVid;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Signature</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getSignV) {
                            echo $getSignV;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Sign By</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getSignBy) {
                            echo $getSignBy;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Date & Time</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php echo $getDate ?></td>
                    </tr>
                    <tr>
                        <th class="dt-title">Verification Result</th>
                        <td class="dt-dot">:</td>
                        
                            <?php 
                            switch ($verification) {
                                case 'Not Verified':?>
                                    <td class="dt-value"><?php echo $verification?></td>
                                    <?php break;
                                case 'Valid':?>
                                    <td class="dt-value" style="color: green;"><?php echo $verification?></td>
                                    <?php break;
                                case 'Not Valid':?>
                                    <td class="dt-value" style="color: red;"><?php echo $verification?></td>
                                    <?php break;
                                default:
                                    # code...
                                    break;
                            }
                            ?>
                        
                    </tr>
                    <tr>
                        <th class="dt-title">Process Time</th>
                        <td class="dt-dot">:</td>
                        <td class="dt-value"><?php if ($getTimePr) {
                            echo $getTimePr;
                        } else {
                            echo "Not Verified";
                        }?></td>
                    </tr>
                </table>
            </div>
            <br>
            <br>
            <div class="d-flex justify-content-end">
                <?php 
                    if ($verification === "Valid" && $getFrom) {?>
                    <a class="btn btn-outline-primary me-3" href="../controller/download.php?id=<?php echo $getData ?>&file=<?php echo $getPDFdw?>">Download PDF</a>
                <?php } else { ?>
                    <button class="btn btn-outline-primary me-3" href="" disabled>Download PDF</button>
                <?php } ?>

                <?php
                if ($verification === "Valid" || $verification === "Tidak valid") { ?>
                    <button class="btn btn-primary" href="" disabled>Verify Now</button>
                <?php } else { ?>
                    <a href="../controller/ver_controller.php?verification=<?php echo $getData ?>"class="btn btn-primary">Verifikasi</a>
                <?php }
                ?>
                
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</body>

</html>