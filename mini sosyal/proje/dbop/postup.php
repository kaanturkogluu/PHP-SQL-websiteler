<?php
include 'dbop.php';

session_start();

if (isset($_POST['paylasim'])) {
    $profilID = $_SESSION['kullanici_id'];
    $yazi = $_POST['yazilar'];

    try {
        // Transaction başlatma
        $conn->beginTransaction();

        if (!empty($_FILES["postresim"]["name"])) {
            // Resim yükleme işlemi
            $sql = "SELECT kullanici_adi FROM kullanici_profil WHERE profil_id = $profilID";
            $stmtt = $conn->prepare($sql);
            $stmtt->execute();
            $kullaniciAdi = $stmtt->fetchColumn();

            $rastgeleSayi = rand(10, 99999);
            $resimAdi = $kullaniciAdi . $rastgeleSayi;

            $targetDir = "../assets/images/posts/";
            $targetFile = $targetDir . basename($_FILES["postresim"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $newFileName = $resimAdi . "." . $imageFileType;
            $targetPath = $targetDir . $newFileName;

            if (move_uploaded_file($_FILES["postresim"]["tmp_name"], $targetPath)) {
                $sql = "SELECT * FROM resimler WHERE resim = '$newFileName'";
                $result = $conn->query($sql);

                if ($result->rowCount() > 0) {
                    header('Location: ../../../layouts/pages/profil.php?error=1');
                } else {
                    $sql = "INSERT INTO resimler (resim) VALUES ('$newFileName')";
                    $stmt = $conn->prepare($sql);

                    if ($stmt->execute()) {
                        $resimId = $conn->lastInsertId();

                        $sql = "INSERT INTO yazilar (yazi) VALUES ('$yazi')";
                        $stmt = $conn->prepare($sql);
                        if ($stmt->execute()) {
                            $yaziID = $conn->lastInsertId();

                            $sql = "INSERT INTO postlar (profil_id, baslik, yazi_id) VALUES ('$profilID', 'Başlık', '$yaziID')";
                            $stmt = $conn->prepare($sql);
                            if ($stmt->execute()) {
                                $postid = $conn->lastInsertId();

                                $sql = "INSERT INTO post_resim (post_id, resim_id) VALUES ($postid, $resimId)";
                                $stmt = $conn->prepare($sql);
                                if ($stmt->execute()) {
                                    // İşlem başarılı, commit yap
                                    $conn->commit();
                                    header('Location: ../../../layouts/pages/profil.php?succes=1');
                                } else {
                                    // İşlem başarısız, rollback yap
                                    $conn->rollback();
                                    echo "Post veritabanına kaydedilemedi: " . $conn->errorInfo()[2];
                                }
                            } else {
                                // İşlem başarısız, rollback yap
                                $conn->rollback();
                                echo "Post veritabanına kaydedilemedi: " . $conn->errorInfo()[2];
                            }
                        } else {
                            // İşlem başarısız, rollback yap
                            $conn->rollback();
                            header('Location: ../../../layouts/pages/profil.php?error=1');
                        }
                    } else {
                        // İşlem başarısız, rollback yap
                        $conn->rollback();
                        header('Location: ../../../layouts/pages/profil.php?error=1');
                    }
                }
            } else {
                // İşlem başarısız, rollback yap
                $conn->rollback();
                header('Location: ../../../layouts/pages/profil.php?error=1');
            }
        } elseif (!empty($yazi)) {
            $sql = "INSERT INTO yazilar (yazi) VALUES ('$yazi')";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                $yaziID = $conn->lastInsertId();

                $sql = "INSERT INTO postlar (profil_id, baslik, yazi_id) VALUES ('$profilID', 'Başlık', '$yaziID')";
                $stmt = $conn->prepare($sql);
                if ($stmt->execute()) {
                    // İşlem başarılı, commit yap
                    $conn->commit();
                    header('Location: ../../../layouts/pages/profil.php?success=1');
                } else {
                    // İşlem başarısız, rollback yap
                    $conn->rollback();
                    header('Location: ../../../layouts/pages/profil.php?error=1');
                }
            } else {
                // İşlem başarısız, rollback yap
                $conn->rollback();
                header('Location: ../../../layouts/pages/profil.php?error=1');
            }
        } else {
            // İşlem başarısız, rollback yap
            $conn->rollback();
            header('Location: ../../../layouts/pages/profil.php?error=2');
        }
    } catch (Exception $e) {
        // Hata durumunda işlemleri geri al
        $conn->rollback();
        header('Location: ../../../layouts/pages/profil.php?error=1');
    }
}
