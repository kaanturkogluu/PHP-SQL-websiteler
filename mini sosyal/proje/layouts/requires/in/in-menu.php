<nav class="navbar navbar-expand-lg navbar-light bg-light  " style="background: url('') no-repeat; background-size:cover;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <img src="../../../assets/images/raquun.webp" class="rounded-4" height="50" alt="Raqun Logo" loading="lazy" />
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"> <b>Anasayfa</b> </a>
                </li>
               
            </ul>


            <div class="dropdown m-1">
                <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="modal" data-bs-target="#mesajModal" aria-expanded="false">
                    <i class="fas fa-envelope fa-2x"></i>


                    <span class="badge rounded-pill badge-notification bg-danger">22</span>
                </a>
            </div>
            <?php include 'mesajlar.php'; ?>


            <!-- bildirimler -->
            <div class="dropdown m-1">
                <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fa-2x"></i>

                    <?php
                    $sql = "SELECT b.bildirim_id, b.kullanici_id, b.yorum_id, b.goruldu_mu, b.tarih, y.yorum, k.kullanici_adi, p.resim AS profilresmi
                    FROM bildirimler AS b
                    INNER JOIN yorumlar AS y ON b.yorum_id = y.yorum_id
                    INNER JOIN kullanici_profil AS k ON b.kullanici_id = k.profil_id
                    INNER JOIN profil_resimleri AS p ON k.profil_resim_id = p.resim_id
                    WHERE b.kullanici_id = :kullanici_id
                    ORDER BY b.tarih DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
                    $stmt->execute();
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $bildirimsay = 0;
                    foreach ($res as $row) {
                        if ($row['goruldu_mu'] == 0) {
                            $bildirimsay = $bildirimsay + 1;
                        }
                    }


                    ?>
                    <span class="badge rounded-pill badge-notification bg-danger"><?= $bildirimsay ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" style="width: 400px; max-height: 300px; overflow-y: auto;">

                    <?php
                    $sql = "SELECT b.bildirim_id, b.kullanici_id, b.yorum_id, b.goruldu_mu, b.tarih, y.yorum, k.kullanici_adi, kp.kullanici_adi AS yorum_yapan_kullanici_adi, pr.resim AS yorum_yapan_profil_resim, p.resim AS profil_resmi
                  FROM bildirimler AS b
                  INNER JOIN yorumlar AS y ON b.yorum_id = y.yorum_id
                  INNER JOIN kullanici_profil AS k ON b.kullanici_id = k.profil_id
                  INNER JOIN kullanici_profil AS kp ON y.kullanici_id = kp.profil_id
                  INNER JOIN profil_resimleri AS p ON k.profil_resim_id = p.resim_id
                  INNER JOIN profil_resimleri AS pr ON kp.profil_resim_id = pr.resim_id
                  WHERE b.kullanici_id = :kullanici_id
                  ORDER BY b.tarih DESC";



                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
                    $stmt->execute();
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    function formatTimeAgo($datetime)
                    {
                        $now = new DateTime();
                        $time = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
                        $diff = $now->diff($time);

                        if ($diff->y > 0) {
                            return $diff->y . " yıl önce";
                        } elseif ($diff->m > 0) {
                            return $diff->m . " ay önce";
                        } elseif ($diff->d > 0) {
                            return $diff->d . " gün önce";
                        } elseif ($diff->h > 0) {
                            return $diff->h . " saat önce";
                        } elseif ($diff->i > 0) {
                            return $diff->i . " dakika önce";
                        } else {
                            return "şimdi";
                        }
                    }


                    // Bildirimleri listele
                    if (count($res) > 0) {
                        foreach ($res as $row) {
                            $bildirim_id = $row['bildirim_id'];
                            $kullanici_id = $row['kullanici_id'];
                            $yorum_id = $row['yorum_id'];
                            $goruldu_mu = $row['goruldu_mu'];
                            $tarih = $row['tarih'];
                            $yorum = $row['yorum'];
                            $kullanici_adi = $row['yorum_yapan_kullanici_adi'];
                            $presim = $row['yorum_yapan_profil_resim'];
                            $formattedTime = formatTimeAgo($tarih);
                            if (empty($presim)) {
                                $presim = '../../../assets/images/profile/default.png';
                            }
                            $sql = "SELECT post_id FROM yorumlar WHERE yorum_id = :yid";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindValue(':yid', $yorum_id);
                            $stmt->execute();

                            $postr = $stmt->fetchColumn();

                            $sql = "UPDATE bildirimler SET goruldu_mu = 1 WHERE bildirim_id = :bildirim_id";
                            $stmt = $conn->prepare($sql);

                            $stmt->bindParam(':bildirim_id', $bildirim_id, PDO::PARAM_INT);
                            $stmt->execute();


                    ?>
                            <li class="p-2 border-bottom" style="border-bottom: 1px solid rgba(0,0,0,.3) !important;">
                                <a href="#!" class="d-flex justify-content-between link-light">

                                    <div class="d-flex flex-row">
                                        <img src="../../../<?= $presim ?>" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">

                                        <div class="pt-1">
                                            <p class="fw-bold mb-0 text-black"><?php echo $kullanici_adi ?></p>
                                            <form class="d-flex flex-row" method="GET">
                                                <input type="hidden" name="postunid" value="<?= $postr ?>">
                                                <input type="hidden" name="bildirimid"><?= (!empty($bildirim_id)) ? '' : $bildirim_id = 0 ?>

                                                <button data-bs-toggle="modal" data-bs-target="#postModal" type="submit" name="bildirimac" style="border: none; background: none; padding: 0; font-size: 14px; color: black; text-decoration: underline; cursor: pointer;">Tarafından Gönderinize Yorum Yapıldı</button>
                                            </form>

                                            <div class="pt-1">
                                                <p class="small text-black mb-1"><?php echo $formattedTime ?></p>

                                                <?php if ($goruldu_mu == 0) { ?>
                                                    <span class="badge bg-danger float-end">1</span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>






                        <?php
                        } ?>


                    <?php

                    } else {  ?>
                        <li class="p-2 border-bottom" style="border-bottom: 1px solid rgba(255,255,255,.3) !important;">
                            <a href="#!" class="d-flex justify-content-between link-light">

                                <div class="pt-1">
                                    <a class="small text-black mb-1">Bildirminiz Bulunmamaktadır</a>

                                </div>
                            </a>
                        </li>




                    <?php



                    }



                    ?>

                </ul>
            </div>



            <!--  bildirim modal-->


            <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl mx-auto">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="postModalLabel">Bildirimler </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                                        WHERE p.profil_id = :pid and p.post_id=:psid ORDER BY p.post_id DESC";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':pid', $profilID);
                                    $stmt->bindParam(':psid', $_GET['postunid']);
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
                            <?php

                            $sql = "UPDATE bildirimler SET goruldu_mu = 1 WHERE bildirim_id = :bildirim_id";
                            $stmt = $conn->prepare($sql);

                            $stmt->bindParam(':bildirim_id', $_GET['bildirimid'], PDO::PARAM_INT);
                            $stmt->execute();
                            ?>
                            <!-- Paylasımlar sonu-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>









            <div class="dropdown m-1">

                <?php
                $sql = "SELECT resim from profil_resimleri where resim_id = (select profil_resim_id from kullanici_profil where profil_id = :id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $_SESSION['kullanici_id']);
                $stmt->execute();
                $profil_resim = $stmt->fetchColumn();

                if ($_SESSION['sayfa'] == 'anasayfa' && !empty($profil_resim)) {

                    $profil_resim = '../' . $profil_resim;
                }

                ?>
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <?php
                    if (!empty($profil_resim)) {
                        echo '<img src="../../' . $profil_resim . '" class="rounded-circle" height="40" alt="Black and White Portrait of a Man" loading="lazy" />';
                    } else {
                        echo '<img src="../../../assets/images/profile/default.png" class="rounded-circle" height="40" alt="Default Profile Picture" loading="lazy" />';
                    }
                    ?>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    <li>
                        <a class="dropdown-item" href="profil.php">Profil</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="../../../dbop/logout.php">Çıkış</a>
                    </li>
                </ul>
            </div>
        </div>





    </div>

</nav>