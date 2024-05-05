<?php include '../../pdo.php';
session_start();
$_SESSION['sayfa'] = 'anasayfa';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../../assets/images/raquun.webp" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Raquun.Net</title>

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

        .footer {
            background: url("https://www.unfe.org/wp-content/uploads/2017/03/Footer-Background.jpg");
            background-size: contain;
            filter: brightness(80%);
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

        body {
            background-color: #f0f0f0;
            ;
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

    <!-- navbar -->

    <?php

    require_once '../../layouts/requires/in/in-menu.php';
    ?>

    <!--İçerik -->
    <div class="container-fluid " style="margin-top:1%;">

        <div class="row">

            <!--Onerilen Kisiler  -->
            <div class="col-md-3 order-md-last" style="height:auto; background-color: #f0f0f0;">
                <div style="position: sticky; top: 20px;">
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
                    <div class="list-group mt-5 border border-dark-subtle">


                        <input class="form-control me-2 p-2 mx-auto" id="kelime" name="kelime" type="search" placeholder="Search" aria-label="Search">
                        <p id="sonuc"></p>


                        <ul class="list-group">




                            <script>
                                var input = document.getElementById('kelime');
                                var sonuc = document.getElementById('sonuc');

                                input.addEventListener('input', function() {
                                    var inputValue = input.value.trim();

                                    if (inputValue !== '') {
                                        var kullaniciAdi = inputValue.substr(1); // İlk karakteri atla

                                        // Ajax isteği yapma
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('GET', 'arama.php?kelime=' + kullaniciAdi, true);
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                // Yanıtı işleyin ve sonuçları gösterin
                                                var response = xhr.responseText;
                                                sonuc.innerHTML = response;
                                            }
                                        };
                                        xhr.send();
                                    } else {
                                        sonuc.innerHTML = '';
                                    }
                                });
                            </script>
                        </ul>


                    </div>
                </div>

            </div>


            <!-- oneri modal -->
            <?php
            require_once '../requires/in/oneri.php';
            ?>

            <!-- Paylasımlar-->
            <div class="col-md-7 rounded-5" style="height:auto; background-color: #ffffff;">
                <?php

                $sql = " SELECT DISTINCT p.*,kp.profil_id, kp.kullanici_adi, kp.ad, kp.soyad, pr.resim AS profil_resim, y.yazi, r.resim AS post_resim,
                 ky.kullanici_adi AS yorum_yapan_kullanici_adi, 
                 kr.resim AS yorum_yapan_profil_resim
                    FROM postlar p
                    LEFT JOIN takip t ON t.takip_edilen_id = p.profil_id
                    LEFT JOIN kullanici_profil kp ON kp.profil_id = p.profil_id
                    LEFT JOIN profil_resimleri pr ON pr.resim_id = kp.profil_resim_id
                    LEFT JOIN yazilar y ON y.yazi_id = p.yazi_id
                    LEFT JOIN post_resim prr ON prr.post_id = p.post_id
                    LEFT JOIN resimler r ON r.resim_id = prr.resim_id
                    LEFT JOIN yorumlar yorum ON yorum.post_id = p.post_id
                    LEFT JOIN kullanici_profil ky ON ky.profil_id = yorum.kullanici_id
                    LEFT JOIN profil_resimleri kr ON kr.resim_id = ky.profil_resim_id
                    WHERE t.takip_eden_id = :kullanici_id OR p.profil_id = :kullanici_id
                    ORDER BY p.tarih DESC ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
                $stmt->execute();
                $result = $stmt->fetchAll(Pdo::FETCH_ASSOC);



                foreach ($result as $row) {
                    // Veri işlemlerini burada gerçekleştirin
                    $sqlsorgu = "SELECT COUNT(yorum) from  yorumlar where post_id =:pid";
                    $stmt = $conn->prepare($sqlsorgu);
                    $stmt->bindParam(':pid', $row['post_id']);
                    $stmt->execute();
                    $klad = $row['kullanici_adi']
                    // Diğer veri alanlarını da burada listeleyebilirsiniz
                ?>
                    <div class="card mb-5 mt-5 border ">
                        <div class="card-body">
                            <!-- İçeriği dinamik olarak alınacak veri tabanı kaynaklı veri ile doldurun -->
                            <div class="media ">

                                <div class="d-flex align-items-center mb-3">
                                    <?php
                                    if (!empty($row['profil_resim'])) {
                                        echo '<img src="../../' . $row['profil_resim'] . '" class="me-2 rounded-5" alt="Profil Resmi" style="width: 32px;">';
                                    } else {
                                        echo '<img src="../../assets/images/profile/default.png" class="me-2 rounded-5" alt="Profil Resmi" style="width: 32px;">';
                                    }
                                    ?>



                                    <a class="ml-3" href="visitprofil.php?visitedusername=<?= $row['kullanici_adi'] ?>&amp;visitprofilid=<?= $row['profil_id'] ?>">
                                        <?= $row['kullanici_adi'] ?>
                                    </a>


                                </div>

                                <div class="media-body">

                                    <!-- Gönderi içeriği -->
                                    <div class="mb-3">
                                        <!-- Gönderiye ait fotoğraf veya video -->

                                        <?php
                                        if (!empty($row['post_resim'])) {
                                            echo '<div class="text-center"><img src="../../assets/images/posts/' . $row['post_resim'] . '" alt="Gönderi Fotoğrafı" class="img-fluid img-thumbnail mt-5 mb-4 w-50 h-100"></div>';
                                        }
                                        ?>
                                    </div>
                                    <!-- Gönderi metni -->
                                    <?php
                                    if (!empty($row['yazi'])) {
                                        echo  '<p>' . $row['yazi'] . '  </p>';
                                    } ?>

                                    <!-- Begeni, görüntülenme ve paylaşma sayıları 
    <div class="row">
        <div class="col">
            <a class="far fa-heart"></a> 500
        </div>
        <div class="col">
            <a class="far fa-eye"></a> 1000
        </div>
        <div class="col">
            <a class="fas fa-share"></a> 200
        </div>
    </div>-->
                                    <!-- Yorum yapma -->


                                    <div class="mt-3">

                                        <hr>
                                        <?php
                                        $sql = "SELECT yorum_id, kullanici_id , yorum,tarih,yorum  FROM yorumlar where post_id =:pid";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bindParam(':pid', $row['post_id']);
                                        $stmt->execute();
                                        $res = $stmt->fetchAll(Pdo::FETCH_ASSOC);


                                        foreach ($res as $yorm) {



                                            if (!empty($yorm['yorum_id'])) { ?>
                                                <!-- Önceki yorumların listesi -->
                                                <div class="media border col-md-9 rounded-5 mt-2">
                                                    <div class="d-flex align-items-center mb-3">

                                                        <?php if (!empty($row['yorum_yapan_profil_resim'])) {

                                                            echo '<img src="../../' . $row['yorum_yapan_profil_resim'] . '" class="me-2 rounded-5" alt="Profil Resmi" style="width: 32px;">';
                                                        } else {
                                                            echo '<img src="../../assets/images/profile/default.png" class="me-2 rounded-5" alt="Profil Resmi" style="width: 32px;">';
                                                        } ?>

                                                        <?php
                                                        $sql = "SELECT profil_id FROM kullanici_profil WHERE kullanici_adi = :kullanici_adi";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bindParam(':kullanici_adi', $row['yorum_yapan_kullanici_adi']);
                                                        $stmt->execute();
                                                        $res = $stmt->fetchColumn();

                                                        ?>
                                                        <a class="ml-3" href="visitprofil.php?visitedusername=<?= $row['yorum_yapan_kullanici_adi'] ?>&amp;visitprofilid=<?= $res ?>"><?= $row['yorum_yapan_kullanici_adi'] ?></a>
                                                    </div>
                                                    <div class="media-body m-3">
                                                        <p class="border border-dark-subtle p-1  rounded-5"><?= $yorm['yorum'] ?></p>
                                                    </div>
                                                </div>
                                        <?php

                                                if (isset($_GET['yorum']) && $_GET['yorum'] == 1) {
                                                    echo "<script>Swal.fire('Basarılı', 'Yorum Eklendi .', 'success');</script>";
                                                }
                                            }
                                        } ?>

                                        <!-- Yorum yapma alanı -->
                                        <form action="../../dbop/yorumgonder.php" method="POST">
                                            <div class="input-group mt-3 mb-5">
                                                <input type="text" class="form-control" placeholder="Yorum yap..." name="yorumMetni" required>
                                                <input type="hidden" name="postID" value="<?php echo $row['post_id']; ?>">
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
                ?>




            </div>

            <div class="col-md-1 order-md-first" style="height: 20px; background-color: #f0f0f0; position: sticky; top: 0;">
                <!-- Konut Etiketleri -->

                <!-- Üyelik ve Giriş Seçenekleri -->
            </div>




        </div>

    </div>

    <!--footer -->
    <?php
    require_once '../../layouts/requires/footer.php'
    ?>
</body>

</html>