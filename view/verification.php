<?php
require_once("../controller/auth.php");
require_once("../controller/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification page - RSA Digital Signature</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="../view/css/styles.css">

    <script src="https://kit.fontawesome.com/3a0f2977a4.js" crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <?php include("../view/partial/bar.php"); ?>

        <div class="contentmain">
            <div class="notification">
                <!-- php -->
                <?php if (isset($_GET['status'])) {
                    if ($_GET['status'] == 'failed') { ?>
                        <div class="alert alert-danger" role="alert">
                            Verification Failed
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'pdf-failed') { ?>
                        <div class="alert alert-danger" role="alert">
                            Can't upload PDF
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'ext-error') { ?>
                        <div class="alert alert-danger" role="alert">
                            File isn't PDF Format
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'input-error') { ?>
                        <div class="alert alert-danger" role="alert">
                            Signature ID Not Filled
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'input-notfound') { ?>
                        <div class="alert alert-danger" role="alert">
                            Signature ID Not Found
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'success') { ?>
                        <div class="alert alert-success" role="alert">
                            Verification Success
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <br>
            <div class="mainpage2">
                <h3>Verification Inbox</h3>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload PDF</button>
            </div>
            <div class="mainpage2 table-page">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sent By</th>
                            <th>File Name</th>
                            <th>Date & Time</th>
                            <th>Verification Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $id_userlog = $_SESSION['user']['id'];

                        $halaman = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                        $batas = 5;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                        $previous = $halaman - 1;
                        $next = $halaman + 1;
                        $dataQuery = "SELECT * FROM verification WHERE received_id = $id_userlog";
                        $dataCount = $connect->query($dataQuery)->rowCount();
                        $dataTotal = ceil($dataCount / $batas);

                        $sql = "SELECT * FROM verification WHERE received_id = $id_userlog ORDER BY date DESC LIMIT $halaman_awal,$batas";
                        $query = $connect->query($sql);
                        $datas = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($datas as $data) {
                            $verification = $data['validation']; ?>

                            <tr class="tab-hide">
                                <td>
                                    <?php if ($data['sender_uname']) {
                                        echo $data['sender_uname'];
                                    } else {
                                        switch ($verification) {
                                            case 'Not Verified': ?>
                                                <p><?php echo "" ?></p>
                                            <?php break;
                                            case 'Valid': ?>
                                                <p><?php echo "Verified" ?></p>
                                            <?php break;
                                            case 'Not Valid': ?>
                                                <p><?php echo "Verified" ?></p>
                                    <?php break;
                                            default:
                                                # code...
                                                break;
                                        }
                                    } ?>
                                </td>
                                <td><a style="color: blue;" href="../view/ver-dt.php?info=<?php echo $data['id'] ?>"><?php echo $data['pdf_name'] ?></a></td>
                                <td><?php echo $data['date'] ?></td>
                                <td><?php

                                    switch ($verification) {
                                        case 'Not Verified': ?>
                                            <p><?php echo $verification ?></p>
                                        <?php break;
                                        case 'Valid': ?>
                                            <p style="color: green;"><?php echo $verification ?></p>
                                        <?php break;
                                        case 'Not Valid': ?>
                                            <p style="color: red;"><?php echo $verification ?></p>
                                    <?php break;
                                        default:
                                            # code...
                                            break;
                                    }

                                    ?>
                                </td>

                            </tr>
                        <?php    }
                        ?>
                    </tbody>

                </table>



            </div>
            
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="../view/verification.php?page=<?php if($halaman > 1){ echo $previous; }?>">Previous</a>
                        </li>
                        <?php
                        for ($i=1; $i <= $dataTotal; $i++) { ?>
                            <li class="page-item"><a class="page-link" href="../view/verification.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            
                        <?php }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="../view/verification.php?page=<?php if($halaman < $dataCount){echo $next;}?>">Next</a>
                        </li>
                    </ul>
                </nav>
            
        </div>

    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verification Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../controller/ver_controller.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kunci Publik</label>
                            <span class="form-text">N = </span>
                            <input type="text" name="pubkeyn" id="pubkeyn" style="width: 60px;">
                            <span class="form-text">E = </span>
                            <input type="text" name="pubkeye" id="pubkeye" style="width: 40px;">

                        </div> -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Signature ID</label>
                            <input type="text" class="form-control" id="signvalue" name="signvalue">

                        </div>
                        <div class="mb-3">
                            <label for="generate" class="form-label">Upload PDF</label>
                            <br>
                            <input type="file" name="uploadpdf" id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="vernow" class="btn btn-primary">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</body>

</html>