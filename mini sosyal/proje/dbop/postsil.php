<?php
include '../pdo.php';

try {
    $silinecekPostID = $_GET['silinecekpostid'];

    // Transaksiyonu başlat
    $conn->beginTransaction();

    // Posta ait yorumları bul
    $yorumlarQuery = "SELECT yorum_id FROM yorumlar WHERE post_id = :post_id";
    $yorumlarStatement = $conn->prepare($yorumlarQuery);
    $yorumlarStatement->bindValue(':post_id', $silinecekPostID, PDO::PARAM_INT);
    $yorumlarStatement->execute();
    $yorumlar = $yorumlarStatement->fetchAll(PDO::FETCH_COLUMN);

    // Yorumlara ait bildirimleri sil
    foreach ($yorumlar as $yorumID) {
        $bildirimSilQuery = "DELETE FROM bildirimler WHERE yorum_id = :yorum_id";
        $bildirimSilStatement = $conn->prepare($bildirimSilQuery);
        $bildirimSilStatement->bindValue(':yorum_id', $yorumID, PDO::PARAM_INT);
        $bildirimSilStatement->execute();
    }

    // Posta ait yorumları sil
    $yorumSilQuery = "DELETE FROM yorumlar WHERE post_id = :post_id";
    $yorumSilStatement = $conn->prepare($yorumSilQuery);
    $yorumSilStatement->bindValue(':post_id', $silinecekPostID, PDO::PARAM_INT);
    $yorumSilStatement->execute();

    // Posta ait resimleri sil
    $resimSilQuery = "DELETE FROM post_resim WHERE post_id = :post_id";
    $resimSilStatement = $conn->prepare($resimSilQuery);
    $resimSilStatement->bindValue(':post_id', $silinecekPostID, PDO::PARAM_INT);
    $resimSilStatement->execute();

    // Postu sil
    $silQuery = "DELETE FROM postlar WHERE post_id = :post_id";
    $silStatement = $conn->prepare($silQuery);
    $silStatement->bindValue(':post_id', $silinecekPostID, PDO::PARAM_INT);
    $silStatement->execute();

    // Transaksiyonu başarılı bir şekilde tamamla
    $conn->commit();

    header('Location: ../../../layouts/pages/profil.php?silme=1');
} catch (PDOException $e) {
    // Transaksiyonu geri al
    $conn->rollBack();

    echo "Hata: " . $e->getMessage();
} 
?>
