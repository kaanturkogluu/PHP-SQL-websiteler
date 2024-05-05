<?php
include '../../pdo.php';
include '../../dbop/upload.php';
session_start();
if (isset($_SESSION['kullanici_id'])) {
    $userID = $_SESSION['kullanici_id'];
    global $conn;
    $sql = "SELECT kullanici_adi FROM kullanici_profil WHERE profil_id = '$userID'";
    $result = $conn->query($sql);
    $_SESSION['istek'] = 'profil';

    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $kullaniciAdi = $row['kullanici_adi'];
        $_SESSION['kullanici_adi'] = $kullaniciAdi;

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


    <!-- profil Düzenleme modal -->
    <div class="modal fade" id="centralExtraLargeModal" tabindex="-1" role="dialog" aria-labelledby="centralExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centralExtraLargeModalLabel">Profil Düzenle</h5>
                </div>
                <div class="modal-body">
                    <section style="background-color: #eee;">
                        <div class="container py-5">
                            <div class="row">
                                <div class="col">
                                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">

                                    </nav>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <?php
                                            $sql = "SELECT profil_resim_id FROM kullanici_profil WHERE profil_id = :pid";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bindParam(':pid', $userID);
                                            $stmt->execute();
                                            $kullanici_resim_id = $stmt->fetchColumn();
                                            $sql = "SELECT resim FROM profil_resimleri WHERE resim_id = :rid";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bindParam(':rid', $kullanici_resim_id);
                                            $stmt->execute();
                                            $row = $stmt->fetch();
                                            ?>
                                            <?php if (!empty($row['resim'])) : ?>
                                                <img src="../../<?= $row['resim'] ?>" alt="Generic placeholder image" class="rounded-circle img-fluid" style="width: 150px;">
                                            <?php else : ?>
                                                <img src="../../assets/images/profile/default.png" alt="Generic placeholder image" class="rounded-circle img-fluid" style="width: 150px;">
                                            <?php endif; ?>
                                            <?php
                                            $sql = "SELECT kp.kullanici_adi,kp.ad, kp.soyad, km.mail, kt.telefon, b.bolumler, a.alanlar as 'alan', s.kullanici_sifre
                                            FROM kullanici_profil kp
                                            LEFT JOIN kullanici_mail km ON km.mail_id = kp.mail_id
                                            LEFT JOIN kullanici_telefon kt ON kp.telefon_id = kt.telefon_id
                                            LEFT JOIN bolum b ON b.bolum_id = kp.bolum_id
                                            LEFT JOIN alan a ON a.alan_id = kp.alan_id
                                            LEFT JOIN kullanici_sifre s ON s.sifre_id = kp.sifre_id
                                            WHERE kp.profil_id = :userId;";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bindParam(':userId', $userID);
                                            $stmt->execute();
                                            $bilgiler = $stmt->fetchAll(Pdo::FETCH_ASSOC);
                                            foreach ($bilgiler as $row) {
                                            ?>
                                                <h5 class="my-3"><a href="">@<?= $row['kullanici_adi'] ?></a> </h5>
                                                <p class="text-muted mb-1"><?= $row['alan'] ?> </p>
                                                <p class="text-muted mb-4"><?= $row['bolumler'] ?></p>
                                                <div class="d-flex justify-content-center mb-2">

                                                    <form method="POST" action="../../dbop/upload.php" id="uploadForm" enctype="multipart/form-data">
                                                        <input type="button" class="btn btn-primary" value="Hakkımda" data-bs-toggle="modal" data-bs-target="#hakkimdaModal">
                                                        <label for="profileImage" class="btn btn-primary">
                                                            Profil Resmi
                                                            <input type="file" class="btn btn-primary" id="profileImage" name="profileImage" accept="image/jpeg, image/jpg, image/png" style="display: none;">
                                                        </label>
                                                    </form>
                                                    <?php
                                                    // Diğer PHP kodları
                                                    //  Resim İşlem başarılı olduğunda SweetAlert mesajını göstermek için bu kodu kullanabilirsiniz
                                                    if (isset($_GET['success']) && $_GET['success'] === '1') {
                                                        echo '<script>';
                                                        echo 'Swal.fire({';
                                                        echo '    icon: "success",';
                                                        echo '    title: "Profil Resmi Güncelleme!",';
                                                        echo '    text: "İşlem başarıyla gerçekleştirildi."';
                                                        echo '});';
                                                        echo '</script>';
                                                    }
                                                    if (isset($_GET['success']) && $_GET['success'] === '2') {
                                                        echo '<script>';
                                                        echo 'Swal.fire({';
                                                        echo '    icon: "success",';
                                                        echo '    title: "Profil Resmi Ekleme!",';
                                                        echo '    text: "İşlem başarıyla gerçekleştirildi."';
                                                        echo '});';
                                                        echo '</script>';
                                                    }
                                                    if (isset($_GET['success']) && $_GET['success'] === '0') {
                                                        echo '<script>';
                                                        echo 'Swal.fire({';
                                                        echo '    icon: "error",';
                                                        echo '    title: "Resim Yüklenirken Hata İle Karsılasıldı!",';
                                                        echo '    text: "Resim Yükleme İslemi Basarısız Oldu"';
                                                        echo '});';
                                                        echo '</script>';
                                                    }
                                                    ?>
                                                    <!-- Sayfa içeriği -->

                                                    <!-- sosyal medya modal -->

                                                    <!-- sosyal medya modal son -->

                                                    <script>
                                                        const fileInput = document.getElementById('profileImage');
                                                        const uploadForm = document.getElementById('uploadForm');

                                                        fileInput.addEventListener('change', function() {
                                                            if (fileInput.files.length > 0) {
                                                                uploadForm.submit(); // Dosya seçildiğinde formu otomatik olarak gönder
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                        </div><?php } ?>
                                    </div>
                                    <div class="card mb-4 mb-lg-0">
                                        <div class="card-body p-0">
                                            <ul class="list-group list-group-flush rounded-3">
                                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                    <i class="fab fa-linkedin fa-lg" style="color: #333333;"></i>

                                                    <p class="mb-0" data-bs-toggle="modal" data-bs-target="#sosyalmedyaModal" style="cursor:pointer">Linkedn</p>
                                                </li>

                                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                    <i class="fab fa-youtube fa-lg" style="color: red;"></i>
                                                    <p class="mb-0">youtube</p>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                                    <p class="mb-0">İnstagram</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $sql = "SELECT kp.kullanici_adi,kp.ad as 'ad', kp.soyad, km.mail, kt.telefon, b.bolumler as 'bolumler', a.alanlar as 'alan', s.kullanici_sifre
                                      FROM kullanici_profil kp
                                      LEFT JOIN kullanici_mail km ON km.mail_id = kp.mail_id
                                      LEFT JOIN kullanici_telefon kt ON kp.telefon_id = kt.telefon_id
                                      LEFT JOIN bolum b ON b.bolum_id = kp.bolum_id
                                      LEFT JOIN alan a ON a.alan_id = kp.alan_id
                                      LEFT JOIN kullanici_sifre s ON s.sifre_id = kp.sifre_id
                                      WHERE kp.profil_id = :userId;";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':userId', $userID);
                                $stmt->execute();
                                $bilgiler = $stmt->fetchAll(Pdo::FETCH_ASSOC);
                                foreach ($bilgiler as $row) {
                                    $veri = array(
                                        'kullanici_adi' => $row['kullanici_adi'],
                                        'ad' => $row['ad'],
                                        'soyad' => $row['soyad'],
                                        'mail' => $row['mail'],
                                        'telefon' => $row['telefon'],
                                        'bolumler' => $row['bolumler'],
                                        'alanlar' => $row['alan'],
                                        'kullanici_sifre' => $row['kullanici_sifre']
                                    );
                                    // Oluşturulan diziyi ana diziye ekle
                                } ?>
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Ad</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= $veri['ad'] ?> </p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#adModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Soyad</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= $veri['soyad'] ?></p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#soyadModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Kullanıcı Adı</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= $veri['kullanici_adi'] ?></p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#kullaniciadiModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Mail</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= $veri['mail'] ?></p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#mailModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Telefon</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= $veri['telefon'] ?></p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#telefonModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Bolum</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= $veri['bolumler'] ?></p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#bolumModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Alan</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= $veri['alanlar'] ?> </p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#alanModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Sifre</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0 mr-2"><?= md5($veri['kullanici_sifre']) ?></p>
                                                        <i class="fas fa-edit mx-5" data-bs-toggle="modal" data-bs-target="#sifreModal" style="cursor:pointer"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- ilk modal sonu -->
    <!-- AD modal-->
    <div class="modal fade" id="adModal" tabindex="-1" aria-labelledby="adModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adModalLabel">Ad: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <p>Adınızı Girin : <input type="text" name="editedInfo" id="editedInfo1"></p>

                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="adsave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

    if (isset($_POST['adsave'])) {
        $bilgi = $_POST['editedInfo'];

        $sql = "Update kullanici_profil set ad = :ad where profil_id =:userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ad', $bilgi);
        $stmt->bindParam(':userId', $userID);
        $stmt->execute();



        echo '<script>';
        echo 'Swal.fire("Yapılan Değişiklik : ", "' . $bilgi .  " olarak  kaydedildi" . '", "success");';
        echo '</script>';
    }
    ?>
    <!--ad modal sonu-->
    <!-- Hakkimda Modal-->
    <div class="modal fade" id="hakkimdaModal" tabindex="-1" aria-labelledby="hakkimdaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hakkimdaModalLabel">Kendinizi Tanıtın: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kendinizden Bahsedin </span>
                            </div>
                            <?php
                            $sql = "SELECT h.hakkimda from kullanici_profil kp INNER JOIN kullanici_hakkinda h on h.hakkimda_id = kp.hakkinda_id where profil_id=:usid";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':usid', $userID);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <textarea class="form-control" name="editedInfo" id="hakkimdaTextarea" style="height: 65vh;"> <?= !empty($row['hakkimda']) ? $row['hakkimda'] : "Kendinizi Tanıtın" ?>
</textarea>
                        </div>
                        <p id="karakterSayisi"></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" name="hakkimdasave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const textarea = document.getElementById('hakkimdaTextarea');
        const karakterSayisi = document.getElementById('karakterSayisi');
        textarea.addEventListener('input', function() {
            const kalanKarakter = 380 - this.value.length;
            const karakterSayisiText = 'Kalan karakter sayısı: ' + kalanKarakter;
            karakterSayisi.innerText = karakterSayisiText;
        });
    </script>
    <?php
    if (isset($_POST['hakkimdasave'])) {
        $bilgi = $_POST['editedInfo'];
        // kullanicinin hakkimda id sni bul 
        $sql = "SELECT hakkinda_id FROM kullanici_profil where profil_id = :pid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pid', $userID);
        $stmt->execute();
        $hakkimdaid = $stmt->fetchColumn();
        if (!empty($row)) {
            $sql = "UPDATE kullanici_hakkinda set hakkimda= :hk where hakkimda_id= :hid ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':hk', $bilgi);
            $stmt->bindParam(':hid', $hakkimdaid);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO  kullanici_hakkinda(hakkimda) values (:hk) ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':hk', $bilgi);
            $stmt->execute();
            $hakid = $conn->lastInsertId();
            $sql = "UPDATE kullanici_profil set hakkinda_id=:hid where profil_id = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':hid', $hakid);
            $stmt->bindParam(':pid', $userID);
            $stmt->execute();
        }
        echo '<script>';
        echo 'Swal.fire("Değişiklikler Kayit Edildi", "","success");';
        echo '</script>';
    }
    ?>
    <!--hakkimda modal end -->
    <!-- soyad modal -->
    <div class="modal fade" id="sosyalmedyaModal" tabindex="-1" aria-labelledby="sosyalmedyaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sosyalmedyaModalLabel">Medya: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="row col-9 mx-auto mb-2">
                        <i class="fab fa-linkedin fa-lg" style="color: #333333;"></i>
                        <input type="text" name="linkedn" placeholder="Linkedn Profil Linkini Girin:  https://birisilinkdn.com">
                    </div>
                    <div class="row  col-9 mx-auto mb-2">
                        <i class="fab fa-youtube fa-lg" style="color: red;"></i>
                        <input type="text" name="youtube" placeholder="Youtube Profil Linkini Girin:  https://birisiyoutube.com">
                    </div>
                    <div class="row  col-9 mx-auto mb-2">
                        <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                        <input type="text" name="instagram" placeholder="İnstagram Profil Linkini Girin:  https://birisinsgtaram.com">
                    </div>
                    <button class="btn btn-primary align-self-center" name="medyasave">Kaydet</button>
                    <div class="row col-6 mx-auto mt-3 mb-3">
                    </div>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['medyasave'])) {
            $linkedn = $_POST['linkedn'];
            $youtube = $_POST['youtube'];
            $instagram = $_POST['instagram'];

            // Get the social media ID of the user
            $sql = "SELECT medya_id FROM kullanici_profil WHERE profil_id = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pid', $userID);
            $stmt->execute();
            $kayit = $stmt->fetchColumn();

            // Check if there is a record in the sosyal_medya table for the profil_id
            $sql = "SELECT profil_id FROM sosyal_medya WHERE profil_id = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pid', $userID);
            $stmt->execute();
            $existingRecord = $stmt->fetchColumn();

            if ($existingRecord === false) {
                // Insert a new record into the sosyal_medya table
                $sql = "INSERT INTO sosyal_medya (instagram, linkedin, youtube, profil_id) VALUES (:instagram, :linkedin, :youtube, :pid)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':instagram', $instagram);
                $stmt->bindParam(':linkedin', $linkedn);
                $stmt->bindParam(':youtube', $youtube);
                $stmt->bindParam(':pid', $userID);
                $stmt->execute();
                $lastInsertId = $conn->lastInsertId();

                // Update the medya_id column in the kullanici_profil table
                $sql = "UPDATE kullanici_profil SET medya_id = :mid WHERE profil_id = :pid";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':mid', $lastInsertId);
                $stmt->bindParam(':pid', $userID);
                $stmt->execute();
                echo '<script>';
                echo 'Swal.fire("Sosyal Medya", "Medya Bilgileri Başarı ile Eklendi", "success");';
                echo '</script>';
            } else {
                // Update the existing record in the sosyal_medya table
                $sql = "UPDATE sosyal_medya SET instagram = :instagram, linkedin = :linkedin, youtube = :youtube WHERE profil_id = :pid";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':instagram', $instagram);
                $stmt->bindParam(':linkedin', $linkedn);
                $stmt->bindParam(':youtube', $youtube);
                $stmt->bindParam(':pid', $userID);
                $stmt->execute();
                echo '<script>';
                echo 'Swal.fire("Sosyal Medya", "Medya Bilgileri Başarı ile Güncellendi", "success");';
                echo '</script>';
            }
        }
        ?>
    </div>
    <!-- sosyal son -->
    <!-- soyad modal -->
    <div class="modal fade" id="soyadModal" tabindex="-1" aria-labelledby="soyadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="soyadModalLabel">Soyad: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <p>Soyadınızı Girin : <input type="text" name="editedInfo" id="editedInfo1"></p>
                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="soyadsave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['soyadsave'])) {
        $bilgi = $_POST['editedInfo'];
        $sql = "Update kullanici_profil set soyad = :soyad where profil_id =:userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':soyad', $bilgi);
        $stmt->bindParam(':userId', $userID);
        $stmt->execute();
        echo '<script>';
        echo 'Swal.fire("Yapılan Değişiklik : ", "' . $bilgi .  " olarak  kaydedildi" . '", "success");';
        echo '</script>';
    }

    ?>
    <!--soyad modal sonu-->
    <!--kullaniciadi modal -->
    <div class="modal fade" id="kullaniciadiModal" tabindex="-1" aria-labelledby="kullaniciadiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kullaniciadiModalLabel">Kullanici Adi: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <p>Yeni Kullanici Adinizi Girin : <input type="text" name="editedInfo" id="editedInfo1"></p>

                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="kullaniciadisave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['kullaniciadisave'])) {
        $bilgi = $_POST['editedInfo'];
        $checkname = "SELECT kullanici_adi FROM kullanici_profil WHERE kullanici_adi = :kadi";
        $stmt = $conn->prepare($checkname);
        $stmt->bindParam(':kadi', $bilgi);
        $stmt->execute();
        $kayitsayisi = $stmt->rowCount();
        if ($kayitsayisi == 0) {
            $sql = "UPDATE kullanici_profil SET kullanici_adi = :kuladi WHERE profil_id = :userId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':kuladi', $bilgi);
            $stmt->bindParam(':userId', $userID);
            $stmt->execute();
            echo '<script>';
            echo 'Swal.fire("Yapılan Değişiklik:", "' . $bilgi .  " olarak kaydedildi" . '", "success");';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'Swal.fire({icon: "error", title: "Hata!", text: "Farklı Bir Kullanıcı Adı Seçiniz"});';
            echo '</script>';
        }
    }
    ?>
    <!--kullanmici adi modal sonu-->
    <!--mail modal -->
    <div class="modal fade" id="mailModal" tabindex="-1" aria-labelledby="mailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mailModalLabel"> Mail: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <p>Yeni Mail Adresini Girin : <input type="email" name="editedInfo" id="editedInfo1" required></p>
                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="mailsave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['mailsave'])) {
        $bilgi = $_POST['editedInfo'];
        $takemailid = "SELECT mail_id FROM kullanici_profil WHERE profil_id = :p_id";
        $stmt = $conn->prepare($takemailid);
        $stmt->bindParam(':p_id', $userID);
        $stmt->execute();
        $mail_id = $stmt->fetchColumn();
        $sql = "SELECT mail FROM kullanici_mail  WHERE mail= :inmail ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":inmail", $bilgi);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $sql = "UPDATE kullanici_mail SET mail = :mail WHERE mail_id = :mail_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mail', $bilgi);
            $stmt->bindParam(':mail_id', $mail_id);
            $stmt->execute();
            echo '<script>';
            echo 'Swal.fire("Yapılan Değişiklik:", "' . $bilgi .  " olarak kaydedildi" . '", "success");';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'Swal.fire({icon: "error", title: "Hata!", text: "Girilen Mail sistemde Mevcut"});';
            echo '</script>';
        }
    }
    ?>
    <!--mail modal sonu-->
    <!--telefon modal -->
    <div class="modal fade" id="telefonModal" tabindex="-1" aria-labelledby="telefonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="telefonModalLabel"> Telefon: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <p>Telefon Numarası Girin : <input type="tel" name="editedInfo" id="editedInfo1" required></p>

                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="telefonsave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['telefonsave'])) {
        $bilgi = $_POST['editedInfo'];
        // kullanıcının telefon idsini al 
        $taketelefonid = "SELECT telefon_id FROM kullanici_profil WHERE profil_id = :p_id";
        $stmt = $conn->prepare($taketelefonid);
        $stmt->bindParam(':p_id', $userID);
        $stmt->execute();
        $telefonid = $stmt->fetchColumn();
        // telefon numara kontrolü
        $sql = "SELECT telefon FROM kullanici_telefon  WHERE telefon= :intelefon ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":intelefon", $bilgi);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            // yeni telefonu tabloya ekle 
            $sql = "INSERT INTO kullanici_telefon(telefon) Values (:tel)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':tel', $bilgi);
            $stmt->execute();
            $lastInsertedId = $conn->lastInsertId();
            // profil tablosuna güncelle
            $sql = "UPDATE kullanici_profil SET telefon_id = :telid Where profil_id = :userid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':telid', $lastInsertedId);
            $stmt->bindParam(':userid', $userID);
            $stmt->execute();
            echo '<script>';
            echo 'Swal.fire("Değişiklikler  kaydedildi", "success");';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'Swal.fire({icon: "error", title: "Hata!", text: "Girilen Telefon sistemde Mevcut"});';
            echo '</script>';
        }
    }
    ?>
    <!--telefon modal sonu-->
    <!--bolum modal -->
    <div class="modal fade" id="bolumModal" tabindex="-1" aria-labelledby="bolumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bolumModalLabel"> Bolum: Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <p>Bolum Secin :
                        <div class="input-group  ">
                            <select class="custom-select" id="inputGroupSelect01" name="editedInfo">
                                <option selected>Bölüm</option>
                                <?php
                                // Bölüm verilerini çekmek için gerekli SQL sorgusunu yazın
                                $sql = "SELECT bolumler FROM bolum";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();

                                // Bölüm verilerini döngüyle option elementlerine dönüştürün
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['bolumler'] . '">' . $row['bolumler'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        </p>
                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="bolumsave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['bolumsave'])) {
        $bilgi = $_POST['editedInfo'];
        // girilen bolum idsini al 
        $takebolmid = "SELECT bolum_id FROM bolum WHERE bolumler = :bl";
        $stmt = $conn->prepare($takebolmid);
        $stmt->bindParam(':bl', $bilgi);
        $stmt->execute();
        $bolmid = $stmt->fetchColumn();
        // kullanıcı bolm id güncelleme
        $sql = "UPDATE kullanici_profil SET bolum_id=:bl WHERE profil_id= :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":bl", $bolmid);
        $stmt->bindParam(":userid", $userID);
        $stmt->execute();
        echo '<script>';
        echo 'Swal.fire("Yapılan Değişiklik:", "' . $bilgi .  " olarak kaydedildi" . '", "success");';
        echo '</script>';
    }
    ?>
    <!--Bolum modal sonu-->
    <!--alan modal -->
    <div class="modal fade" id="alanModal" tabindex="-1" aria-labelledby="alanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alanModalLabel">Alan Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <p>Alanı Belirtin : <input type="text" name="editedInfo" id="editedInfo1"></p>

                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="alansave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['alansave'])) {
        $bilgi = $_POST['editedInfo'];
        $sql = "INSERT INTO alan (alanlar) VALUES (:al)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':al', $bilgi);
        $stmt->execute();
        $lastid = $conn->lastInsertId();
        $sql = "UPDATE kullanici_profil SET alan_id = :alid WHERE profil_id = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':alid', $lastid);
        $stmt->bindParam(':userId', $userID);
        $stmt->execute();
        echo '<script>';
        echo 'Swal.fire("Yapılan Değişiklik:", "' . $bilgi .  " olarak kaydedildi" . '", "success");';
        echo '</script>';
    }
    ?>
    <!-- alan modal sonu -->
    <!--sifre modal -->
    <div class="modal fade" id="sifreModal" tabindex="-1" aria-labelledby="sifreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sifreodalLabel">Sifre Düzenleme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body align-items-center">
                        <!-- Kullanıcıdan bilgi almak için giriş alanları -->
                        <div class="row">
                            <p class="col-3">Mevcut Sifre : <input type="password" name="editedInfo" id="editedInfo1" required></p>
                        </div>
                        <div class="row">
                            <p class="col-3">Yeni Sifre : <input type="password" name="editedInfo1" id="editedInfo1" required></p>
                        </div>
                        <div class="row">
                            <p class="col-3"> Sifre Tekrar : <input type="password" name="editedInfo2" id="editedInfo1" required></p>
                        </div>
                        <!-- Bilgileri kaydetme butonu -->
                        <button class="btn btn-primary align-self-center" name="sifresave">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['sifresave'])) {
        $mevcutsifre = $_POST['editedInfo'];
        $yenisifre = $_POST['editedInfo1'];
        $yenisifretekrar = $_POST['editedInfo2'];
        $sql = "SELECT sifre_id FROM kullanici_profil WHERE profil_id = :pid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pid', $userID);
        $stmt->execute();
        $sifreid = $stmt->fetchColumn();
        $sql = "SELECT kullanici_sifre FROM kullanici_sifre WHERE sifre_id = :sifre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':sifre', $sifreid);
        $stmt->execute();
        $user_pas = $stmt->fetchColumn();
        if ($mevcutsifre == $user_pas) {
            if ($yenisifre == $yenisifretekrar) {
                $sql = "UPDATE kullanici_sifre SET kullanici_sifre=:new WHERE sifre_id =:sd";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':new', $yenisifre);
                $stmt->bindParam(':sd', $sifreid);
                $stmt->execute();
                echo '<script>';
                echo 'Swal.fire("Şifre Değiştirme", "Şifre başarıyla değiştirildi.", "success");';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'Swal.fire(" Şifre Hatası", "' . $mevcutsifre .  "-" . $yenisifretekrar .  " olarak şifreler eşleşmedi" . '", "error");';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'Swal.fire("Mevcut Şifre Hatası", "' . $mevcutsifre .  " olarak yanlış girildi" . '", "error");';
            echo '</script>';
        }
    }

    ?>
    <!-- sifre modal sonu -->
    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col ">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <?php
                                $sql = "SELECT profil_resim_id FROM kullanici_profil WHERE profil_id = :pid";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':pid', $userID);
                                $stmt->execute();
                                $kullanici_resim_id = $stmt->fetchColumn();
                                $sql = "SELECT resim FROM profil_resimleri WHERE resim_id = :rid";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':rid', $kullanici_resim_id);
                                $stmt->execute();
                                $row = $stmt->fetch();
                                ?>
                                <?php if (!empty($row['resim'])) : ?>
                                    <img src="../../<?= $row['resim'] ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-5 mb-4" style="width: 150px;  z-index: 1">
                                <?php else : ?>
                                    <img src="../../assets/images/profile/default.png" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                                <?php endif; ?> <button data-bs-toggle="modal" data-bs-target="#centralExtraLargeModal" type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 3;">

                                    Profili Düzenle
                                </button>
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <?php
                                global $conn;
                                $stmt = $conn->prepare("SELECT ad, soyad,kullanici_adi FROM kullanici_profil WHERE profil_id = :id");
                                $stmt->bindParam(':id', $_SESSION['kullanici_id']);
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
                        $sqlPostCount = "SELECT COUNT(*) AS post_count FROM postlar where profil_id = $userID";
                        $stmtPostCount = $conn->prepare($sqlPostCount);
                        $stmtPostCount->execute();
                        $postCount = $stmtPostCount->fetch(PDO::FETCH_ASSOC)['post_count'];
                        // Takipçi sayısı sorgusu
                        $sqlFollowerCount = "SELECT COUNT(*) AS follower_count FROM takip WHERE takip_edilen_id = :profil_id";
                        $stmtFollowerCount = $conn->prepare($sqlFollowerCount);
                        $stmtFollowerCount->bindValue(':profil_id', $userID);
                        $stmtFollowerCount->execute();
                        $followerCount = $stmtFollowerCount->fetch(PDO::FETCH_ASSOC)['follower_count'];
                        // Takip edilen sayısı sorgusu
                        $sqlFollowingCount = "SELECT COUNT(*) AS following_count FROM takip WHERE takip_eden_id = :profil_id";
                        $stmtFollowingCount = $conn->prepare($sqlFollowingCount);
                        $stmtFollowingCount->bindValue(':profil_id', $userID);
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
                            $stm->bindParam(':pid', $userID);
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
                                        <h5 class="modal-title align-self-center text-center" id="takipciModalLabel">Tavsiye Edilen Kişiler</h5>
                                    </div>
                                    <div class="col">
                                        <div class="card mask-custom">
                                            <div class="card-body" style="overflow-y: scroll; max-height: 75vh; scrollbar-width:thin;  background: linear-gradient(to left, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));">
                                                <ul class="list-unstyled mb-0">
                                                    <?php
                                                    $sql = "SELECT takip_edilen_id FROM takip WHERE takip_eden_id = :tid";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->bindValue(':tid', $userID);
                                                    $stmt->execute();
                                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    $takipEdilenIDs = [];
                                                    foreach ($results as $row) {
                                                        $takipEdilenIDs[] = $row['takip_edilen_id'];
                                                    }
                                                    if (!empty($takipEdilenIDs)) {
                                                        $placeholders = implode(',', array_fill(0, count($takipEdilenIDs), '?'));
                                                        $sql = "SELECT kullanici_adi, profil_resim_id FROM kullanici_profil WHERE profil_id IN ($placeholders)";
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
                                                            echo '<p class="small text-white mb-1" style="color:#000;">Takibi Bırak </p>';
                                                            echo '<span onclick="takipbirak(\'' . $kullanici_adi . '\')" id="takipet" class="badge bg-danger fas fa-minus float-end" style="cursor: pointer;"></span>';
                                                            echo '</div>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                                <script>
                                                    function takipbirak(kullanici_adi) {

                                                        var url = "../../dbop/unfollow.php?kullanici_adi=" + kullanici_adi + "&&takipedilecekisim=" + kullanici_adi + "&&istek=profil";
                                                        window.location.href = url;
                                                    }
                                                </script>


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
                        <!-- takip edenleri görüntüleme -->
                        <!-- takip edenleri görüntüleme son -->
                        <!-- hakkımda yazısı profil görüntülenmesi -->
                        <?php
                        // Kullanıcı hakkında bilgilerini almak için sorgu
                        $sqlHakkinda = "SELECT hakkimda FROM kullanici_hakkinda WHERE hakkimda_id = (SELECT hakkinda_id FROM kullanici_profil WHERE profil_id = :profil_id)";
                        $stmtHakkinda = $conn->prepare($sqlHakkinda);
                        $stmtHakkinda->bindValue(':profil_id', $userID); // Kullanıcının profil ID'sini doğru şekilde ayarlayın
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
                                <p class="lead fw-normal mb-1">Hakkımda</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <p class="font-italic mb-1"><?= $hakkimda ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- paylasım alanı-->
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="list-group mt-5">
                                        <h6 class="text-center">Paylaşın</h6>
                                        <form action="../../dbop/postup.php" method="POST" enctype="multipart/form-data">
                                            <div class="list-group">
                                                <a class="list-group-item list-group-item-action d-flex align-items-center">
                                                    <div class="col-9">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mx-auto" name="yazilar" placeholder="Düşünceliriniz yazın...">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group">
                                                            <input type="submit" value="Gönder" name="paylasim" class="btn btn-primary mx-auto">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-group-item d-flex align-items-center">
                                                <div class="col-md-3 text-center">
                                                    <label for="resim" class="cursor-pointer">
                                                        <i class="mx-5 fas fa-image"></i> Resim
                                                        <input type="file" id="resim" name="postresim" accept="image/*" style="display:none;">
                                                    </label>
                                                </div>
                                                <div class="col-md-3 text-center">
                                                    <a href="video_paylas.php" class="decoration-none">
                                                        <i class="mx-5 fas fa-video"></i> Video
                                                    </a>
                                                </div>
                                                <div class="col-md-3 text-center">
                                                    <a href="kod_paylas.php">
                                                        <i class="mx-5 fas fa-code"></i> Kod
                                                    </a>
                                                </div>
                                                <div class="col-md-3 text-center">
                                                    <a href="dosya_paylas.php">
                                                        <i class="mx-5 fas fa-file"></i> Dosya
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="list-group-item d-flex align-items-center" id="resimContainer" style="display: none;">
                                                <div class="col-md-6 offset-md-3 text-center">
                                                    <img id="preview" src="" alt="Seçilen Resim" style="max-width: 100%; display: none;">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo " <script>
                        const resimInput = document.getElementById('resim');
                        const yaziInput = document.getElementById('yazi');
                        const resimContainer = document.getElementById('resimContainer');
                        const preview = document.getElementById('preview');
                        resimInput.addEventListener('change', function() {
                        const resimDosyasi = this.files[0];
                        const resimURL = URL.createObjectURL(resimDosyasi);
                        preview.src = resimURL;
                        preview.style.display = 'flex';
                        resimContainer.style.display = 'flex';
                        });
                        </script> ";
                        ?>
                        <?php
                        if (isset($_GET['success']) && $_GET['success'] == 1) {
                            // İşlem başarıyla tamamlandı
                            echo "<script>Swal.fire('Paylaşım', 'Gönderi Başarıyla Paylaşıldı.', 'success');</script>";
                        } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
                            // Bir hata oluştu
                            echo "<script>Swal.fire('Hata', 'Hata Oluştu.', 'error');</script>";
                        } elseif (isset($_GET['error']) && $_GET['error'] == 2) {
                            // Bir hata oluştu
                            echo "<script>Swal.fire('Hata', 'Paylaşabilmek için bir şeyler gönderin.', 'error');</script>";
                        }
                        ?>
                        <!-- payalsım alanı sonu-->
                        <div class="container-fluid">
                            <div class="row">
                                <!-- Paylaşımlar-->
                                <div class="col-md-9" style="height: auto; background-color: #ffffff;">
                                    <?php if (isset($_SESSION['kullanici_id'])) {
                                        $profilID = $_SESSION['kullanici_id'];
                                        // Kullanıcının profil resmini ve kullanıcı adını al
                                        $sql = "SELECT profil_resim_id, kullanici_adi FROM kullanici_profil WHERE profil_id = :pid";
                                        $deger = $conn->prepare($sql);
                                        $deger->bindParam(':pid', $profilID);
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
                                                            <i class="fas fa-trash-alt ms-auto delete-post" onclick="deletePost(<?= $postID ?>)" style="font-size: 1.2rem; cursor: pointer;"></i>
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

    <?php
    require_once '../requires/in/oneri.php';
    ?>

    <!--kullanıcı öneri modal son -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"></script>
</body>

</html>