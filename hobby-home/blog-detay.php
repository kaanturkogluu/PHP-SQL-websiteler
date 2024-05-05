<?php
require_once 'admin/pages/inc-functions.php';
$id = intval($_GET["id"]);

$cek = $db->prepare("SELECT * FROM `blog` WHERE `id` = :id LIMIT 1");
$cek->bindValue(":id", $id, PDO::PARAM_INT);
$cek->execute();
$row = $cek->fetch(PDO::FETCH_ASSOC);

if ($row["aktif"] == 0) {
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $row["baslik"] ?></title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php require_once 'includes/inc-menu.php' ?>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/about-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1> <?= $row["baslik"] ?></h1>
                    
                        <span class="meta">

                            <a href="#!">İlayda Tekeli:</a>
                            <?= $row["tarih"] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content-->
    <hr>
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">

                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h2> <?= $row["alt_baslik"] ?></h2>
                        
                    </div>
                </div>
            </div>
                    <img src="../../resimler/<?= $row["resim"] ?>" class="img-fluid img-thumbnail pcr-h w-100 rounded-4 mb-5" alt="...">
                    <?= htmlspecialchars_decode($row["aciklama"]) ?>
                </div> <a href="index.php" class="btn btn-primary rounded-4 w-50"> Anasayfaya Dön</a>
            </div>

        </div>

    </article>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">

            </div>
        </div>
    </div>
    <!-- Footer-->
    <?php require_once 'includes/inc-footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>