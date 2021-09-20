<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <ul class="navbar-nav ms-auto username">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><?php echo $_SESSION['user']['username'] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-user"></i></a>
            </li>
        </ul>
        <a class="btn btn-danger" href="../controller/logout.php">Log Out</a>
    </div>
</nav>



<div class="collapse navbar-collapse" id="navbarSupportedContent">
<a href="../view/mainpage.php">
        <div class="sidebar-content">
            <button class="btn btn-link">
                <p><i class="fas fa-home"></i>Home</p>
            </button>
        </div>
    </a>
    <a href="../view/signature.php">
        <div class="sidebar-content">
            <button class="btn btn-link">
                <p><i class="fas fa-file-signature"></i>Signature</p>
            </button>
        </div>
    </a>
    <a href="../view/verification.php">
        <div class="sidebar-content">
            <button class="btn btn-link">
                <p><i class="fas fa-user-check"></i>Verification</p>
            </button>
        </div>
    </a>

</div>
<div class="sidebar">
    <a href="../view/mainpage.php">
        <div class="sidebar-content">
            <button class="btn btn-link">
                <p><i class="fas fa-home"></i>Home</p>
            </button>
        </div>
    </a>

    <a href="../view/signature.php">
        <div class="sidebar-content">
            <button class="btn btn-link">
                <p><i class="fas fa-file-signature"></i>Signature</p>
            </button>
        </div>
    </a>

    <a href="../view/verification.php">
        <div class="sidebar-content">
            <button class="btn btn-link">
                <p><i class="fas fa-user-check"></i>Verification</p>
            </button>
        </div>
    </a>


</div>