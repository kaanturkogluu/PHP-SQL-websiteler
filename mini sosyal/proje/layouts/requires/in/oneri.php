<div class="modal fade" id="kullanicionerModal" tabindex="-1" aria-labelledby="kullanicionerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-x">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title align-self-center text-center" id="kullanicionerModalLabel">Tavsiye Edilen Kişiler</h5>
            </div>
            <div class="col ">
                <div class="card mask-custom">
                    <div class="card-body" style="overflow-y: scroll; max-height: 75vh; scrollbar-width:thin;  background: linear-gradient(to left, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));">
                        <ul class="list-unstyled mb-0">
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
                                LIMIT 50 ";
                            $result = $conn->prepare($sql);
                            $result->bindParam(':kullanici_id', $_SESSION['kullanici_id']);
                            $result->execute();
                            $users = $result->fetchAll();
                            if (count($users) > 0) {
                                foreach ($users as $user) {
                                    $sql = "SELECT resim FROM profil_resimleri WHERE resim_id = :rid";
                                    $result = $conn->prepare($sql);
                                    $result->bindParam(':rid', $user['profil_resim_id']);
                                    $result->execute();
                                    $tavsiyeprofil = $result->fetchColumn();
                                    if (empty($tavsiyeprofil)) {
                                        $tavsiyeprofil = "../../assets/images/profile/default.png";
                                    }
                                    $kullanici_adi = $user["kullanici_adi"]; // Kullanıcı adı
                            ?>
                                    <li class="p-2 border-bottom mb-1" style="border-bottom: 1px solid rgba(255,255,255,.3) !important;">
                                        <a class="d-flex justify-content-between link-light">
                                            <div class="d-flex flex-row">
                                                <img src="../../<?= $tavsiyeprofil ?>" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                                <div class="pt-1">
                                                    <p class="fw-bold mb-0"><?= $kullanici_adi ?></p>
                                                </div>
                                            </div>
                                            <div class="pt-1">
                                                <p class="small text-white mb-1" style="color:#000;">Takip ET</p>
                                                <span onclick="takipet()" id="takipet" class="badge bg-danger fas fa-plus float-end" style="cursor: pointer;"></span>

                                                <script>
                                                    const takip = document.getElementById('takipet');

                                                    function takipet() {

                                                        <?php 
                                                      
                                                      if ($_SESSION['istek'] == 'profil') {
                                                        echo 'window.location.href = "../../dbop/follow.php?kullanici_adi=' . $kullanici_adi . '&takipedilecekisim=' . $kullanici_adi . '&istek=profil";';
                                                    } else {
                                                        echo 'var url = "../../dbop/follow.php?kullanici_adi=' . $kullanici_adi . '&takipedilecekisim=' . $kullanici_adi . '&istek=visit&dons=' . $visited_id . '";';
                                                        echo 'window.location.href = url;';
                                                    }
                                                    
                                                    
                                                        
                                                        
                                                        ?>
                                                    }
                                                </script>
                                            </div>
                                        </a>
                                    </li>
                            <?php
                                }
                            } else { {
                                    echo '<p class="text-center">Önerilen kullanıcı bulunamadı.</p>';
                                }
                            }
                            ?>
                        </ul>

                        <?php
                      
                        if (isset($_GET['takip']) && $_GET['takip'] == '1') {
                            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">';
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>';

                            echo '<script>
                                    Swal.fire({
                                        icon: "success",
                                        title: "Takip edildi!",
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