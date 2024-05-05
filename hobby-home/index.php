<?php include_once 'admin/pages/inc-functions.php';  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hooby Home Blog</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="css/in.css">
</head>

<body>
    <!-- Navigation-->
    <?php require_once 'includes/inc-menu.php'; ?>
    <!-- Page Header-->

    <hr>

    <div class="row text-center ">
        <div class="col-sm-4 mb-3 mb-sm-0 radius-4">
            <div class="card border  border-success rounded-4">
                <div class="card-body ">
                   
                    <p class="card-text">Yazarınızın kısaca hayat yolculuğunu öğrenin</p>
                    <a href="hakkimda.php" class="btn btn-outline-primary rounded-5">Ben kimim?</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border  border-success rounded-4">
                <div class="card-body">
                    
                    <p class="card-text">Bilgilerinizi bizimle paylaşmaktan  çekinmeyin . </p>
                    <a href="iletisim.php" class="btn btn-outline-primary rounded-5">Bir Mesaj Bırakın</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border  border-success rounded-4">
                <div class="card-body">
                    
                    <p class="card-text">Gelin , Size uygun hobileri bulalım , yetenlerinizi keşfedelim</p>
                    <a href="index.php" class="btn btn-outline-primary  rounded-5">Blog</a>
                </div>
            </div>
        </div>
    </div>


    <h1 class="text-center m-5 text-capitalize text-primary">HoobyRoom 'da Yetenekleriniz Keşfedin</h1>


    <!-- Main Content-->



    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <?php
                $kelime = "";


                if (isset($_GET["q"])) {
                    $kelime = $_GET["q"];
                }

                if ($kelime != "") {
                    echo "<p> Aranan kelime: $kelime | <a href='index.php'>Anasayfaya Dön</a></p>";
                    $cek = $db->prepare("SELECT * FROM `blog` WHERE `aktif` = :aktif AND `baslik` LIKE :aranan ORDER BY `id` DESC");

                    $cek->bindValue(":aktif", 1, PDO::PARAM_INT);
                    $cek->bindValue(":aranan", "%$kelime%", PDO::PARAM_STR);
                    $urunsayisi =  $cek->execute();
                    $kac = 6;
                    if (isset($_GET['sayfa'])) {
                        $sayfa = $_GET['sayfa'];
                    } else {
                        $sayfa = 1;
                    }

                    $sayfa1 = ($sayfa * $kac) - $kac;
                    $sayfasayisi = ceil($urunsayisi / $kac);

                    $veriler = $db->prepare("SELECT * FROM `blog` WHERE `aktif` = :aktif AND `baslik` LIKE :aranan ORDER BY `id` DESC  limit :sayfa1, :sayfa2");
                    $veriler->bindValue(":aktif", 1, PDO::PARAM_INT);
                    $veriler->bindValue(":aranan", "%$kelime%", PDO::PARAM_STR);
                    $veriler->bindValue(":aktif", 1, PDO::PARAM_INT);
                    $veriler->bindValue(":sayfa1", $sayfa1, PDO::PARAM_INT);
                    $veriler->bindValue(":sayfa2", $kac, PDO::PARAM_INT);
                    $veriler->execute();
                } else {
                    $cek = $db->prepare("SELECT * FROM `blog` WHERE `aktif` = :aktif ORDER BY `id` DESC");
                    $cek->bindValue(":aktif", 1, PDO::PARAM_INT);
                    $cek->execute();
                    $urunsayisi = $cek->rowCount();
                    $kac = 6;
                    if (isset($_GET['sayfa'])) {
                        $sayfa = $_GET['sayfa'];
                    } else {
                        $sayfa = 1;
                    }

                    $sayfa1 = ($sayfa * $kac) - $kac;
                    $sayfasayisi = ceil($urunsayisi / $kac);

                    $veriler = $db->prepare("SELECT * FROM `blog` WHERE `aktif` = :aktif ORDER BY `id` DESC limit :sayfa1, :sayfa2");
                    $veriler->bindValue(":aktif", 1, PDO::PARAM_INT);
                    $veriler->bindValue(":sayfa1", $sayfa1, PDO::PARAM_INT);
                    $veriler->bindValue(":sayfa2", $kac, PDO::PARAM_INT);
                    $veriler->execute();
                }




                while ($row = $veriler->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <!-- Post preview-->
                    <div class="post-preview mt-10">

                        <?php
                        $stmt = $db->prepare("SELECT resim FROM blog WHERE id = :id");
                        $stmt->bindValue(":id", $row["id"], PDO::PARAM_INT);
                        $stmt->execute();
                        $rows = $stmt->fetch(PDO::FETCH_ASSOC);




                        ?>


                        <img src="../../resimler/<?= $row["resim"] ?>" class="img-fluid img-thumbnail pcr-h w-100 rounded-4" alt="...">



                        <a href="blog-detay.php?id=<?= $row["id"] ?>">
                            <h2 class="post-title"><?= $row["baslik"] ?></h2>
                            <h3 class="post-subtitle"><?= $row["alt_baslik"] ?></h3>
                        </a>
                        <p class="post-meta">
                            Paylaşan:
                            <a href="#!">İlayda Tekeli</a>
                            <?= $row["tarih"] ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />

                <?php
                }
                ?>
                <!-- Post preview-->

                <!-- Pager-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <nav aria-label="Page navigation example ">
                                <ul class="pagination">
                                    <?php
                                    $previousPage = $sayfa - 1;
                                    if ($previousPage > 0) {
                                        echo '<li class="page-item"><a class="page-link" href="?sayfa=' . $previousPage . '">Önceki</a></li>';
                                    }
                                    $startPage = max($sayfa - 2, 1);
                                    $endPage = min($startPage + 4, $sayfasayisi);

                                    for ($i = $startPage; $i <= $endPage; $i++) {
                                        $activeClass = ($i == $sayfa) ? "active" : "";
                                        echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?sayfa=' . $i . '">' . $i . '</a></li>';
                                    }
                                    $nextPage = $sayfa + 1;
                                    if ($nextPage <= $sayfasayisi) {
                                        echo '<li class="page-item"><a class="page-link" href="?sayfa=' . $nextPage . '">Next</a></li>';
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
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