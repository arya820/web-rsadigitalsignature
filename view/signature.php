<?php
require_once("../controller/connect.php");
require_once("../controller/auth.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature page - RSA Digital Signature</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="../view/css/styles.css">

    <script src="https://kit.fontawesome.com/3a0f2977a4.js" crossorigin="anonymous"></script>
</head>

<body>
    <section>
    <?php include("../view/partial/bar.php");?>

        <div class="contentmain">
            <div class="notification">
                <?php if (isset($_GET['status'])) {
                    if ($_GET['status'] == 'upload-error') { ?>
                        <div class="alert alert-danger" role="alert">
                            Can't upload PDF
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'primes-error') { ?>
                        <div class="alert alert-danger" role="alert">
                            Prime Numbers Not Generated
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'sign-success') { ?>
                        <div class="alert alert-success" role="alert">
                            Signature Success!
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'query-error') { ?>
                        <div class="alert alert-danger" role="alert">
                            Database Query Error
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'primes-same') { ?>
                        <div class="alert alert-danger" role="alert">
                            Both Prime Numbers are Same
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'ext-error') { ?>
                        <div class="alert alert-danger" role="alert">
                            File isn't PDF Format
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'signsend-success') { ?>
                        <div class="alert alert-success" role="alert">
                            Signature and Send PDF Success!
                        </div>
                    <?php } ?>
                    <?php if ($_GET['status'] == 'username-notfound') { ?>
                        <div class="alert alert-danger" role="alert">
                            Username Not Found
                        </div>
                <?php }
                } ?>


            </div>
            <div class="mainpage2">
                <h3>Signature Inbox</h3>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#uploadpdf">Upload PDF</button>
            </div>
            <div class="mainpage2 table-page">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Send To</th>
                            <th>File Name</th>
                            <th>Date & Time</th>
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
                        $dataQuery = "SELECT * FROM signature WHERE sign_byID = $id_userlog";
                        $dataCount = $connect->query($dataQuery)->rowCount();
                        $dataTotal = ceil($dataCount / $batas);


                        $sql = "SELECT * FROM signature WHERE sign_byID = $id_userlog ORDER BY date DESC LIMIT $halaman_awal,$batas";
                        $query = $connect->query($sql);
                        $datas = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($datas as $data) { ?>

                            <tr>
                                <?php
                                if (!$data['user_received']) { ?>
                                    <td style="color: green;">Signed</td>
                                <?php } else { ?>
                                    <td><?php echo $data['user_received']; ?></td>


                                <?php } ?>

                                <td><a style="color: blue;" href="../view/sign-dt.php?info=<?php echo $data['id'] ?>"><?php echo $data['pdf_name'] ?></a></td>
                                <td><?php echo $data['date'] ?></td>

                            </tr>
                        <?php    }
                        ?>
                    </tbody>

                </table>


            </div>
            <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="../view/signature.php?page=<?php if($halaman > 1){ echo $previous; }?>">Previous</a>
                        </li>
                        <?php
                        for ($i=1; $i <= $dataTotal; $i++) { ?>
                            <li class="page-item"><a class="page-link" href="../view/signature.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            
                        <?php }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="../view/signature.php?page=<?php if($halaman < $dataCount){echo $next;}?>">Next</a>
                        </li>
                    </ul>
                </nav>
        </div>
    </section>

    <div class="modal fade" id="uploadpdf" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Signature Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../controller/sign_controller.php" method="post" enctype="multipart/form-data">

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <div class="form-text">Username can Empty</div>
                        </div>
                        <div class="mb-3">
                            <label for="generate" class="form-label">Prime Numbers Generate</label>
                            <br>
                            <button class="btn btn-outline-secondary" onclick="primeGenerate();return false;">Generate</button>
                            <span class="form-text">p = </span>
                            <input type="text" name="pprime" id="prime_p" style="width: 40px;" value="499" readonly>
                            <span class="form-text">q = </span>
                            <input type="text" name="qprime" id="prime_q" style="width: 40px;" value="503" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="generate" class="form-label">Upload PDF</label>
                            <br>
                            <input type="file" name="pdfupload" id="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="signnow">Sign & Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

    <script>
        let prime_list = [];
            for (let i = 100; i <= 1000; i++) {
                let flag = 0;
                for (let j = 2; j < i; j++) {
                    if (i % j == 0) {
                        flag = 1;
                        break;
                    }

                }
                if (i > 1 && flag == 0) {
                    prime_list.push(i);
                }
            }
        
        primeGenerate = () => {


            let primeP = prime_list[Math.floor(Math.random() * prime_list.length)];
            let primeQ = prime_list[Math.floor(Math.random() * prime_list.length)];

            document.getElementById("prime_p").setAttribute("value", primeP);
            document.getElementById("prime_q").setAttribute("value", primeQ);

        }
    </script>
</body>

</html>