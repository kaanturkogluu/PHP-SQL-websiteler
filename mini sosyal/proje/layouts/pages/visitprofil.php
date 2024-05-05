<?php
include '../../pdo.php';
include '../../dbop/upload.php';
session_start();
if (true) {


    if (isset($_GET['visitedusername'])) {;
        $kullaniciAdi = $_GET['visitedusername'];

        $visited_id = $_GET['visitprofilid'];
        $_SESSION['istek'] = 'visit';


        // Sayfa başlığını kullanıcı adıyla birleştirerek ayarla
        $pageTitle = $kullaniciAdi . " Profil";
        echo "<title>$pageTitle</title>";
    } else {
        // Kullanıcı adı bulunamadıysa veya kullanıcı oturumu yoksa gerekli işlemleri yap
        echo "<title>Kullanıcı Profili</title>";
    }
} else {
    // Kullanıcı oturumu yoksa gerekli işlemleri yap
    echo "<title>Kullanıcı Profili</title>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="../../assets/images/raquun.webp" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Profil</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <script src="../../assets/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Kaydırma çubuğu parçası */
        ::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        /* Kaydırma çubuğu üzerine gelindiğinde */
        ::-webkit-scrollbar-thumb:hover {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Kaydırma çubuğu arka planı */
        ::-webkit-scrollbar-track {
            background-color: rgba(0, 0, 0, 0.1);
        }

        /* Kaydırma çubuğu arka planı üzerine gelindiğinde */
        ::-webkit-scrollbar-track:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .modal-content select {
            width: 100%;

        }

        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fbc2eb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
        }

        .col-md-3 a {
            text-decoration: none;

        }

        .gradient-custom {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to bottom right, rgba(252, 203, 144, 1), rgba(213, 126, 235, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to bottom right, rgba(252, 203, 144, 1), rgba(213, 126, 235, 1))
        }

        .mask-custom {
            background: rgba(24, 24, 16, .2);
            border-radius: 2em;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.05);
            background-clip: padding-box;
            box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
        }
    </style>
</head>

<body>
    <!--  header-->

    <?php
    $_SESSION['sayfa'] = 'profil';
    require_once '../../layouts/requires/in/in-menu.php' ?>

    <!-- içerik bölümü -->

    <!-- mesajlar -->
    <?php require_once '../../layouts/requires/in/mesajlar.php' ?>



    <!-- Ana içerik buraya gelecek -->

    <!-- sifre modal sonu -->
    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col ">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <?php
                                $sql = "SELECT profil_id,profil_resim_id FROM kullanici_profil WHERE profil_id = :pid";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':pid', $visited_id);
                                $stmt->execute();
                                $kullanici_resim_id = $stmt->fetchColumn();
                                $sql = "SELECT resim FROM profil_resimleri WHERE resim_id = :rid";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':rid', $kullanici_resim_id);
                                $stmt->execute();
                                $row = $stmt->fetch();
                                ?>
                                <?php if (!empty($row['resim'])) : ?>
                                    <img src="../../<?= $row['resim'] ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-5 mb-4" style="width: 150px; z-index: 1">
                                <?php else : ?>
                                    <img src="../../assets/images/profile/default.png" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                                <?php endif; ?>

                                <div class="d-flex justify-content-between">

                                    <button type="button" class="btn btn-outline-danger" data-mdb-ripple-color="dark" style="z-index: 3;">
                                        <i class="fas fa-envelope"></i>
                                    </button>



                                    <span style="width: 10px;"></span> <!-- Boşluk ekledim -->
                                    <?php


                                    $loggedinUserID = $_SESSION['kullanici_id']; // Oturum açmış kullanıcının kimlik bilgisi

                                    // Takip edilen hesapların profil ID'lerini çekme
                                    $sql = "SELECT takip_edilen_id FROM takip WHERE takip_eden_id = :loggedinUserID  and takip_edilen_id=:takipid ";
                                    $stmt = $conn->prepare($sql);



                                    $stmt->bindParam(':loggedinUserID', $loggedinUserID);
                                    $stmt->bindParam(':takipid', $visited_id);
                                    $stmt->execute();
                                    $results = $stmt->fetchColumn();

                                    if (!empty($results)) {
                                        // Takip ediliyorsa

                                    ?>


                                        <button  name="cikilsin" id="takipbirakBtn" class="btn btn-outline-primary" data-mdb-ripple-color="dark" style="z-index: 3;">
                                        
                                            <?= '<span onclick="takipbirak(\'' . $_GET['visitedusername'] . '\',\'' . $visited_id . '\')" id="takipet" class="fas fa-user-minus" style="cursor: pointer;"></span>';?>
                                        </button>

                                    <?php
                                    } else { ?>



                                        <button id="takipeyleBtn" type="button" class="btn btn-outline-primary" data-mdb-ripple-color="dark" style="z-index: 3;">
                                            

                                            
                                            <?php     echo '<span onclick="takipeyle(\'' .  $_GET['visitedusername'] . '\', \'' . $visited_id . '\')" id="takipet" class="fas fa-user-plus" style="cursor: pointer;"></span>';
                                                        ?>
                                        </button>
                                    <?php }



                                    ?>
                                    <script>
                                        function takipibirak(kullanici_adi, visited_id) {

                                            alert('al');
                                            var url = "../../dbop/unfollow.php?takipedilecekisim=" + kullanici_adi + "&&istek=visit" + "&&dons=" + visited_id;
                                            window.location.href = url;
                                        }
                                    </script>




                                </div>
                            </div>
                            <?php


                            ?>
                            <div class="ms-3" style="margin-top: 130px;">
                                <?php
                                global $conn;
                                $stmt = $conn->prepare("SELECT ad, soyad,kullanici_adi FROM kullanici_profil WHERE profil_id = :id");
                                $stmt->bindParam(':id', $visited_id);
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <h5><?= $row["ad"] . " " . $row["soyad"] ?></h5>
                                    <p> <a href="">@<?= $row["kullanici_adi"] ?></a></p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        // Veritabanı bağlantısı yapılması ve gerekli sorguların çalıştırılması
                        // Gönderi sayısı sorgusu

                        $sqlPostCount = "SELECT COUNT(*) AS post_count FROM postlar where profil_id = $visited_id";

                        $stmtPostCount = $conn->prepare($sqlPostCount);

                        $stmtPostCount->execute();
                        $postCount = $stmtPostCount->fetch(PDO::FETCH_ASSOC)['post_count'];
                        // Takipçi sayısı sorgusu
                        $sqlFollowerCount = "SELECT COUNT(*) AS follower_count FROM takip WHERE takip_edilen_id = :profil_id";
                        $stmtFollowerCount = $conn->prepare($sqlFollowerCount);
                        $stmtFollowerCount->bindValue(':profil_id', $visited_id);
                        $stmtFollowerCount->execute();
                        $followerCount = $stmtFollowerCount->fetch(PDO::FETCH_ASSOC)['follower_count'];
                        // Takip edilen sayısı sorgusu
                        $sqlFollowingCount = "SELECT COUNT(*) AS following_count FROM takip WHERE takip_eden_id = :profil_id";
                        $stmtFollowingCount = $conn->prepare($sqlFollowingCount);
                        $stmtFollowingCount->bindValue(':profil_id', $visited_id);
                        $stmtFollowingCount->execute();
                        $followingCount = $stmtFollowingCount->fetch(PDO::FETCH_ASSOC)['following_count'];
                        ?>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <div>
                                    <p class="mb-1 h5"><?= $postCount ?></p>
                                    <p class="small text-muted mb-0">Gönderi</p>
                                </div>
                                <div class="px-3">
                                    <p class="mb-1 h5"><?= $followerCount ?></p>
                                    <p class="small text-muted mb-0">Takipçi</p>
                                </div>
                                <div>
                                    <p class="mb-1 h5"><?= $followingCount ?></p>
                                    <p style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#takipciModal" class="small text-muted mb-0">Takip Edilen</p>
                                </div>
                            </div>
                            <?php
                            $sql = "SELECT instagram, youtube, linkedin FROM sosyal_medya WHERE profil_id = :pid";
                            $stm = $conn->prepare($sql);
                            $stm->bindParam(':pid', $visited_id);
                            $stm->execute();
                            $result = $stm->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="d-flex justify-content-center text-center py-1">
                                <div>
                                    <i class="fab fa-instagram"></i>
                                    <a href="<?= $result['instagram'] ?>">
                                        <p class="small text-muted mb-0 mx-auto">Instagram</p>
                                    </a>
                                </div>
                                <div class="px-3">
                                    <i class="fab fa-youtube"></i>
                                    <a href="<?= $result['youtube'] ?>">
                                        <p class="small text-muted mb-0 mx-auto">YouTube</p>
                                    </a>
                                </div>
                                <div>

                                    <i class="fab fa-linkedin"></i>
                                    <a href="<?= $result['linkedin'] ?>">
                                        <p class="small text-muted mb-0 mx-auto">LinkedIn</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- takip edenleri görüntüleme -->
                        <div class="modal fade" id="takipciModal" tabindex="-1" aria-labelledby="takipciModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-x">
                                <div class="modal-content">
                                    <div class="modal-header align-items-center">
                                        <h5 class="modal-title align-self-center text-center" id="takipciModalLabel">Takip Edilenler</h5>
                                    </div>
                                    <div class="col">
                                        <div class="card mask-custom">
                                            <div class="card-body" style="overflow-y: scroll; max-height: 75vh; scrollbar-width:thin;  background: linear-gradient(to left, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));">
                                                <ul class="list-unstyled mb-0">
                                                    <?php
                                                    $sql = "SELECT takip_edilen_id FROM takip WHERE takip_eden_id = :tid";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->bindValue(':tid', $visited_id);
                                                    $stmt->execute();
                                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    $takipEdilenIDs = [];
                                                    foreach ($results as $row) {
                                                        $takipEdilenIDs[] = $row['takip_edilen_id'];
                                                    }
                                                    if (!empty($takipEdilenIDs)) {
                                                        $placeholders = implode(',', array_fill(0, count($takipEdilenIDs), '?'));
                                                        $sql = "SELECT profil_id,kullanici_adi, profil_resim_id FROM kullanici_profil WHERE profil_id IN ($placeholders)";
                                                        $stmt = $conn->prepare($sql);
                                                        foreach ($takipEdilenIDs as $index => $id) {
                                                            $stmt->bindValue($index + 1, $id);
                                                        }
                                                        $stmt->execute();
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($results as $row) {
                                                            $kullanici_adi = $row['kullanici_adi'];
                                                            $profil_resim_id = $row['profil_resim_id'];
                                                            $profil_resim = '';
                                                            $sql = "SELECT resim FROM profil_resimleri WHERE resim_id = :resimID";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->bindValue(':resimID', $profil_resim_id);
                                                            $stmt->execute();
                                                            $resimRow = $stmt->fetch(PDO::FETCH_ASSOC);
                                                            if ($resimRow) {
                                                                $profil_resim = $resimRow['resim'];
                                                            }
                                                            echo '<li class="p-2 border-bottom mb-1" style="border-bottom: 1px solid rgba(255,255,255,.3) !important;">';
                                                            echo '<a class="d-flex justify-content-between link-light">';
                                                            echo '<div class="d-flex flex-row">';
                                                            if (!empty($profil_resim)) {
                                                                echo '<img src="../../' . $profil_resim . '" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">';
                                                            } else {
                                                                echo '<img src="../../assets/images/profile/default.png" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">';
                                                            }
                                                            echo '<div class="pt-1">';
                                                            echo '<p class="fw-bold mb-0">' . $kullanici_adi . '</p>';

                                                            echo '</div>';
                                                            echo '</div>';
                                                            echo '<div class="pt-1">';

                                                            if ($row['profil_id'] != $_SESSION['kullanici_id']) {
                                                                // Kullanıcı kendi profili değilse, takip etme/takibi bırakma seçeneklerini göster
                                                                $sql = "SELECT takip_edilen_id FROM takip WHERE takip_eden_id = :kullanici_id";
                                                                $stmt = $conn->prepare($sql);
                                                                $stmt->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
                                                                $stmt->execute();
                                                                $takip_edilen_idler = $stmt->fetchAll(PDO::FETCH_COLUMN);

                                                                if (in_array($row['profil_id'], $takip_edilen_idler)) {
                                                                    // Kullanıcı takip ediliyor
                                                                    echo '<p class="small text-white mb-1" style="color:#000;">Takibi Bırak </p>';
                                                                    echo '<span onclick="takipbirak(\'' . $kullanici_adi . '\',\'' . $visited_id . '\')" id="takipet" class="badge bg-danger fas fa-minus float-end" style="cursor: pointer;"></span>';
                                                                } else {
                                                                    // Kullanıcı takip edilmiyor
                                                                    echo '<p class="small text-white mb-1" style="color:#000;">Takip Et </p>';
                                                                    echo '<span onclick="takipeyle(\'' . $kullanici_adi . '\', \'' . $visited_id . '\')" id="takipet" class="badge bg-success fas fa-plus float-end" style="cursor: pointer;"></span>';
                                                                }
                                                            }

                                                            echo '</div>';
                                                            echo '</a>';



                                                            echo '</li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                                <script>
                                                    function takipbirak(kullanici_adi, visited_id) {


                                                        var url = "../../dbop/unfollow.php?takipedilecekisim=" + kullanici_adi + "&&istek=visit" + "&&dons=" + visited_id;
                                                        window.location.href = url;
                                                    }

                                                    function takipeyle(kullanici_adi, visited_id) {

                                                        var url = "../../dbop/follow.php?kullanici_adi=" + kullanici_adi + "&&takipedilecekisim=" + kullanici_adi + " &&istek=visit" + "&&dons=" + visited_id;
                                                        window.location.href = url;
                                                    }
                                                </script>

                                                <?php
                                                if (isset($_GET['basari'])) {
                                                    if ($_GET['basari'] == 1) {
                                                        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">';
                                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>';

                                                        echo '<script>
                                                        Swal.fire({
                                                            icon: "success",
                                                            title: "Takipten Cıkıldı!",
                                                            showConfirmButton: false,
                                                            timer: 1000 // 1 saniye
                                                    });
                                                 </script>';
                                                    }
                                                    if ($_GET['basari'] == 11) {
                                                        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">';
                                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>';

                                                        echo '<script>
                                                        Swal.fire({
                                                            icon: "success",
                                                            title: "Kullanıcı Takibe Alındı",
                                                            showConfirmButton: false,
                                                            timer: 1000 // 1 saniye
                                                    });
                                                 </script>';
                                                    }
                                                }
                                                ?>
                                                <?php

                                                if (isset($_GET['takipbirak']) && $_GET['takipbirak'] == 1) {
                                                    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">';
                                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>';

                                                    echo '<script>
                                                        Swal.fire({
                                                            icon: "success",
                                                            title: "Takipten Cıkıldı!",
                                                            showConfirmButton: false,
                                                            timer: 1000 // 1 saniye
                                                    });
                                                 </script>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- takip edilenleri görüntüleme son-->
                        <?php
                        require_once '../requires/in/oneri.php';
                        ?>
                        <!-- hakkımda yazısı profil görüntülenmesi -->
                        <?php
                        // Kullanıcı hakkında bilgilerini almak için sorgu
                        $sqlHakkinda = "SELECT hakkimda FROM kullanici_hakkinda WHERE hakkimda_id = (SELECT hakkinda_id FROM kullanici_profil WHERE profil_id = :profil_id)";
                        $stmtHakkinda = $conn->prepare($sqlHakkinda);
                        $stmtHakkinda->bindValue(':profil_id', $visited_id); // Kullanıcının profil ID'sini doğru şekilde ayarlayın
                        $stmtHakkinda->execute();
                        $hakkimdaRow = $stmtHakkinda->fetch(PDO::FETCH_ASSOC);
                        if ($hakkimdaRow) {
                            $hakkimda = $hakkimdaRow['hakkimda'];
                        } else {
                            $hakkimda = "Merhaba, Kendinizi Tanıtın";
                        }
                        ?>
                        <div class="card-body p-4 text-black">
                            <div class="mb-5">

                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <p class="font-italic mb-1"><?= $hakkimda ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- payalsım alanı sonu-->
                        <div class="container-fluid">
                            <div class="row">
                                <!-- Paylaşımlar-->
                                <div class="col-md-9" style="height: auto; background-color: #ffffff;">
                                    <?php if (isset($visited_id)) {
                                        $profilID = $visited_id;

                                        // Kullanıcının profil resmini ve kullanıcı adını al
                                        $sql = "SELECT profil_resim_id, kullanici_adi FROM kullanici_profil WHERE profil_id = :pid";
                                        $deger = $conn->prepare($sql);
                                        $deger->bindParam(':pid', $visited_id);
                                        $deger->execute();
                                        $rrow = $deger->fetch(PDO::FETCH_ASSOC);
                                        $presimid = $rrow['profil_resim_id'];
                                        $kullanici_adi = $rrow['kullanici_adi'];
                                        $sql = "SELECT resim from profil_resimleri where resim_id = :rid";
                                        $newsql = $conn->prepare($sql);
                                        $newsql->bindParam(':rid', $presimid);
                                        $newsql->execute();
                                        $profilresimi = $newsql->fetchColumn();
                                        // Kullanıcının postlarını al
                                        $sql = "SELECT p.post_id, r.resim, y.yazi,y.yazi_id
                                        FROM postlar p
                                        LEFT JOIN post_resim pr ON p.post_id = pr.post_id
                                        LEFT JOIN resimler r ON pr.resim_id = r.resim_id
                                        JOIN yazilar y ON p.yazi_id = y.yazi_id
                                        WHERE p.profil_id = :pid ORDER BY p.post_id DESC";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bindParam(':pid', $profilID);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        // Her bir postu listeleyerek görüntüle
                                        foreach ($result as $row) {
                                            $postID = $row['post_id'];
                                            $resim = $row['resim'];
                                            $yazi = $row['yazi'];
                                            $yaziID = $row['yazi_id'];
                                    ?>
                                            <div class="card mb-3 mt-5">
                                                <div class="card-body" style="border: 1px solid #ddd; padding: 10px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                                                    <div class="media">
                                                        <div class="d-flex align-items-center">
                                                            <?php if ($presimid) { ?>
                                                                <img src="../../<?= $profilresimi ?>" class="me-2 rounded-5" alt="Profil Resmi" style="width: 32px;">
                                                            <?php } else { ?>
                                                                <img src="../../assets/images/profile/default.png" class="me-2 rounded-5" alt="Varsayılan Profil Resmi" style="width: 32px;">
                                                            <?php } ?>
                                                            <a class="ml-3" href=""><?= $kullanici_adi ?></a>

                                                        </div>
                                                        <script>
                                                            function deletePost(postID) {
                                                                if (confirm("Bu gönderiyi silmek istediğinize emin misiniz?")) {
                                                                    var url = "../../dbop/postsil.php?silinecekpostid=" + postID;
                                                                    window.location.href = url;
                                                                }
                                                            }
                                                        </script>
                                                        <div class="media-body">
                                                            <?php if ($resim && $yazi) { ?>
                                                                <div class="mb-3 text-align-center">
                                                                    <img src="../../assets/images/posts/<?= $resim ?>" alt="Gönderi Fotoğrafı" class=" img-fluid img-thumbnail mt-5 mb-4 h-50" width="55%" style="object-fit: cover;">
                                                                    <p class="m-2 border border-light bg-light  rounded-1 p-2"><?php echo $yazi; ?></p>
                                                                </div>
                                                            <?php } elseif ($resim) { ?>
                                                                <div class="mb-3 text-align-center">
                                                                    <img src="../../assets/images/posts/<?= $resim ?>" alt="Gönderi Fotoğrafı" class="img-fluid img-thumbnail mt-5 mb-4" width="75%">
                                                                </div>
                                                            <?php } elseif ($yazi) { ?>
                                                                <p class="m-2 border border-light bg-light  rounded-1 p-2"><?php echo $yazi; ?></p>
                                                            <?php } ?>
                                                            <div class="mt-3">
                                                                <hr>
                                                                <?php
                                                                $yorumlarQuery = "SELECT * FROM yorumlar WHERE post_id = :postid";
                                                                $stmt = $conn->prepare($yorumlarQuery);
                                                                $stmt->bindValue(":postid", $postID);
                                                                $stmt->execute();
                                                                // Yorumları al
                                                                $yorumlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($yorumlar as $yorum) {
                                                                    $yorumyapanid = $yorum['kullanici_id'];
                                                                    $newq = "SELECT kullanici_adi, profil_resim_id FROM kullanici_profil WHERE profil_id = :pid";
                                                                    $newq1 = $conn->prepare($newq);
                                                                    $newq1->bindValue(':pid', $yorumyapanid);
                                                                    $newq1->execute();
                                                                    $result = $newq1->fetch(PDO::FETCH_ASSOC);
                                                                    $yorumyapankullaniciadi = $result['kullanici_adi'];
                                                                    $yorumprofilresimid = $result['profil_resim_id'];

                                                                    $resimsorgu = "SELECT resim FROM profil_resimleri WHERE resim_id = :rid";
                                                                    $nres = $conn->prepare($resimsorgu);
                                                                    $nres->bindValue(':rid', $yorumprofilresimid);
                                                                    $nres->execute();
                                                                    $yorumyapanprofilresmi = $nres->fetchColumn();
                                                                ?>
                                                                    <div class="media">
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <?php if ($yorumyapanprofilresmi) { ?>
                                                                                <img src="../../<?= $yorumyapanprofilresmi ?>" class="me-2 rounded-5" alt="Profil Resmi" style="width: 32px;">

                                                                            <?php } else { ?>
                                                                                <img src="../../assets/images/profile/default.png" class="me-2 rounded-5" alt="Varsayılan Profil Resmi" style="width: 32px;">
                                                                            <?php } ?>
                                                                            <a class="ml-3" href=""><?= $yorumyapankullaniciadi ?></a>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <p class="border border-dark-subtle p-1">
                                                                                <?= $yorum['yorum'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <?php
                                                                if (isset($_GET['silme']) && $_GET['silme'] == 1) {
                                                                    echo "<script>Swal.fire('Silme', 'Sİlme Başarılı.', 'info');</script>";
                                                                }
                                                                ?>
                                                                <form action="../../dbop/yorumgonder.php" method="POST">
                                                                    <div class="input-group mt-3 mb-5">
                                                                        <input type="text" class="form-control" placeholder="Yorum yap..." name="yorumMetni" required>
                                                                        <input type="hidden" name="postID" value="<?php echo $postID; ?>">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-primary" name="yorumgonder" type="submit">Gönder</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if (isset($_GET['yorum']) && $_GET['yorum'] == 1) {
                                        echo "<script>Swal.fire('Basarılı', 'Yorum Eklendi .', 'success');</script>";
                                    }
                                    ?>
                                </div>
                                <!-- Paylasımlar sonu-->
                                <!--Onerilen Kisiler  -->
                                <div class="col-md-3" style="height: auto; background-color: #f8f9fa;">
                                    <div style="position: sticky; top: 50;">
                                        <h4 style="text-align: center;">Kullanıcıları Gözden Geçirin</h4>
                                        <div class="list-group mt-3">
                                            <?php
                                            // Önerilen kullanıcıları sorgula
                                            $sql = "SELECT takip_edilen_id FROM takip WHERE takip_eden_id = :kullanici_id";
                                            $result = $conn->prepare($sql);
                                            $result->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
                                            $result->execute();
                                            $takipEdilenler = $result->fetchAll(PDO::FETCH_COLUMN);
                                            $sql = "SELECT kp.profil_id,kp.kullanici_adi
                                             FROM kullanici_profil kp
                                             LEFT JOIN takip t ON t.takip_edilen_id = kp.profil_id AND t.takip_eden_id = :kullanici_id
                                             WHERE t.id IS NULL AND kp.profil_id != :kullanici_id
                                             LIMIT 50";
                                            $result = $conn->prepare($sql);
                                            $result->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
                                            $result->execute();
                                            $users = $result->fetchAll();
                                            if (count($users) > 0) {
                                                // Her bir önerilen kullanıcı için bir listeleme öğesi oluştur
                                                foreach ($users as $user) {
                                                    $sql = "SELECT resim from profil_resimleri where resim_id= :rid";
                                                    $result = $conn->prepare($sql);
                                                    $result->bindParam(':rid', $user['profil_resim_id']);
                                                    $result->execute();
                                                    $tavsiyeprofil = $result->fetchColumn();
                                                    if (!empty($tavsiyeprofil)) {
                                                    } else {
                                                        $tavsiyeprofil = "../../assets/images/profile/default.png ";
                                                    }
                                                    $kullanici_adi = $user["kullanici_adi"]; // Kullanıcı adı
                                                    echo '<a href="#" class="list-group-item list-group-item-action">
                                                    <img src="../../' . $tavsiyeprofil . '" class="mr-2 rounded-circle" alt="Profil Resmi" style="width: 32px;">
                                                    ' . $kullanici_adi . '
                                                </a>';
                                                }
                                            } else {
                                                echo '<p class="text-center">Önerilen kullanıcı bulunamadı.</p>';
                                            }
                                            ?>
                                            <!-- Daha fazla öneri için bir bağlantı -->
                                            <a href="#" class="list-group-item list-group-item-action text-center" data-bs-toggle="modal" data-bs-target="#kullanicionerModal">
                                                Daha fazla öneri için tıklayın

                                            </a>
                                        </div>
                                        <div class="list-group mt-5">
                                            <!-- Duyurular -->
                                            <h6 class="text-center">Duyurular</h6>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                Henüz bir duyuru eklenmemiş
                                            </a>
                                            <!-- Daha fazla öneri için bir bağlantı -->
                                            <a href="#" class="list-group-item list-group-item-action text-center">
                                                Daha fazla...
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- kullanıcı öneri modal -->



    <!--kullanıcı öneri modal son -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"></script>
</body>

</html>