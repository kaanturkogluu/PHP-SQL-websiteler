    <?php
    session_start();
    
    ?>
    
    <!-- post modal -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <script src="../../assets/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <title>Document</title>
    </head>

    <body>



        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postModalLabel">Post Başlığı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php

                        require_once '../../../pdo.php';
                        $sql = "SELECT DISTINCT p.*, kp.profil_id, kp.kullanici_adi, kp.ad, kp.soyad, pr.resim AS profil_resim, y.yazi, r.resim AS post_resim,
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
                                   WHERE p.post_id = :post_id
                                    ORDER BY p.tarih DESC";


                        global $conn;
                        $stmt = $conn->prepare($sql);




                        $stmt->bindValue(':post_id', $_POST['postunid']);



                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>