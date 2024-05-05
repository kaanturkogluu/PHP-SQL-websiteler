<?php
include 'dbop.php';
session_start();

try {
    // Oturum açmış kullanıcının kimlik bilgisi
    $followerID = $_SESSION['kullanici_id'];
    $followingUsername = $_GET['takipedilecekisim'];

   

    // Takip edilecek kullanıcının id bilgisini sorgula
    $stmt = $conn->prepare("SELECT profil_id FROM kullanici_profil WHERE kullanici_adi = :kullanici_adi");
    $stmt->bindParam(':kullanici_adi', $followingUsername);
    $stmt->execute();
    $followingID = $stmt->fetchColumn();

    if ($followingID) {
        // Takibi bırakma işlemi
        try {
            $conn->beginTransaction();

            // Takip tablosundan kaldırma işlemi
            $stmt = $conn->prepare("DELETE FROM takip WHERE takip_eden_id = :takip_eden_id AND takip_edilen_id = :takip_edilen_id");
            $stmt->bindParam(':takip_eden_id', $followerID);
            $stmt->bindParam(':takip_edilen_id', $followingID);
            $stmt->execute();

            $conn->commit();

            if ($_GET['istek'] == 'profil') {
                header('Location: ../../../layouts/pages/profil.php?takipbirak=1');
            } else {
                header('Location: ../../../layouts/pages/visitprofil.php?visitedusername=' . $followingUsername . '&&visitprofilid=' . $_GET['dons'] .'&&basari=1');
            }
        } catch (PDOException $e) {
            $conn->rollback();
            throw $e;
        }
    } else {
        echo "Böyle bir kullanıcı bulunamadı.";
    }
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
