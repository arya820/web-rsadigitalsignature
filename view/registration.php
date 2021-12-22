<?php
include("../controller/regist_controller.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - RSA Digital Signature</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="../view/css/styles.css">
</head>

<body>
    <div class="log-reg">
        <h1>Account Registration</h1>
        
        <div class="card">
            <div class="card-body">
                <form class="logreg-form" action="" method="POST" onsubmit="return pass_validation()" name="registration-form">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="col-lg-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            <?php if (isset($alertUsername)) {?>
                                <div id="emailHelp" class="form-text" style="color: red;">Username does exists</div>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email">
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" pattern=".{8,}" title="Eight or more characters">
                        </div>
                        <div class="col-lg-6">
                            <label for="password" class="form-label">Re-type Password</label>
                            <input type="password" class="form-control" name="retype-password">
                        </div>
                    </div>

                    <div class="submit-logreg">
                        <button type="submit" class="btn btn-primary" name="register">Sign Up Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="signup">
        <p>Have an Account?</p>
        <a href="login.php">Sign in</a>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script>
        function pass_validation(){
            let password1 = document.forms['registration-form']['password'].value;
            let password2 = document.forms['registration-form']['retype-password'].value;
            if (password1 == password2) {
                return true;
            } else {
                alert("Password type must be same!");
                return false;
            }


        }
    </script>
</body>

</html>