<?php

require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

if (isset($_FILES['profileImage'])) {
    $file = $_FILES['profileImage'];
    session_start();
    include '../dbop/dbop.php';
    $userId = $_SESSION['kullanici_id'];
    $sql = "SELECT kullanici_adi FROM kullanici_profil WHERE profil_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $kullanici_adi = $stmt->fetchColumn();
    $kullanici_adi = trim($kullanici_adi);

    $targetDirectory = '../assets/images/profile/'; // Dosyaların kaydedileceği dizin
    $targetFile = $targetDirectory . basename($file['name']);

    // Geçerli dosya uzantılarını kontrol edin
    $validExtensions = array('jpg', 'jpeg', 'png');
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $validExtensions)) {
        echo 'Geçersiz dosya uzantısı. Sadece JPG, JPEG ve PNG dosyaları yükleyebilirsiniz.';
        exit;
    }

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $targetWidth = 256;
        $targetHeight = 256;

        $newFileName = $kullanici_adi . 'profil.' . $fileExtension;
        $newFilePath = $targetDirectory . $newFileName;
        $resimYol = 'assets/images/profile/' . $newFileName;

        $resizedImage = Image::make($targetFile)->fit($targetWidth, $targetHeight);
        $resizedImage->save($targetFile);

        if (rename($targetFile, $newFilePath)) {
            // Veritabanına kayıt için kullanıcı resim idsini alma
            $sql = "SELECT profil_resim_id FROM kullanici_profil WHERE profil_id = :pid";
            $stm = $conn->prepare($sql);
            $stm->bindParam(':pid', $userId);
            $stm->execute();

            // İşlemler devam eder...
            if ($stm->fetchColumn() == 0) {
                // Yeni resim ekleme işlemi
                $resimYol = 'assets/images/profile/' . $newFileName;

                $sql = "INSERT INTO profil_resimleri (resim) VALUES (:resimYol)";
                $stmt2 = $conn->prepare($sql);
                $stmt2->bindParam(':resimYol', $resimYol);
                $stmt2->execute();
                $sonresim = $conn->lastInsertId();

                $sql = "UPDATE kullanici_profil SET profil_resim_id = :pid WHERE profil_id = :id";
                $stmt3 = $conn->prepare($sql);
                $stmt3->bindParam(':pid', $sonresim);
                $stmt3->bindParam(':id', $userId);
                $stmt3->execute();

                header('Location: ../../../layouts/pages/profil.php?success=2');
                exit;
            } else {
                $sql = "SELECT profil_resim_id FROM kullanici_profil where profil_id = :kid";
                $run = $conn->prepare($sql);
                $run->bindParam(':kid', $userId);
                $run->execute();
                $profil_resim_id = $run->fetchColumn();

                $sql = "UPDATE profil_resimleri SET resim = :resimYol WHERE resim_id = :resimId";
                $stmt2 = $conn->prepare($sql);
                $stmt2->bindParam(':resimYol', $resimYol);
                $stmt2->bindParam(':resimId', $profil_resim_id);
                $stmt2->execute();

                header('Location: ../../../layouts/pages/profil.php?success=1');
                exit;
            }
        }
    }

    header('Location: ../../../layouts/pages/profil.php?success=0');
    exit;
}
