<?php
// Veritabanı bağlantısı
// Veritabanı bağlantı bilgilerinizi kullanarak bağlantı sağlayın
include 'dbop.php';

    // Yorumu kaydetmek için form verilerini al
    if (isset($_POST['yorumgonder'])) {
        $yorumMetni = $_POST['yorumMetni'];
        $postID = $_POST['postID'];
session_start(); 
$userID=$_SESSION['kullanici_id']; 
        // Yorumu veritabanına ekle
        $sql = "INSERT INTO yorumlar (post_id, yorum,kullanici_id) VALUES (:postID, :yorumMetni,:kid)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':postID', $postID);
        $stmt->bindParam(':kid', $userID);
        $stmt->bindParam(':yorumMetni', $yorumMetni);
        $stmt->execute();
        $yorum_id =$conn->lastInsertId();
        yorumEklendi($postID, $yorum_id);

        // Yorum eklendikten sonra yönlendirme yapabilirsiniz
       
       if($_SESSION['sayfa']=='anasayfa'){
        header('Location: ../../../layouts/pages/index.php?yorum=1');

    }if($_SESSION['sayfa']=='profil'){

        header('Location: ../../../layouts/pages/profil.php?yorum=1');
    }
      

     

    }

    function bildirimGonder($kullaniciId, $yorumId) {
        global $conn;
        // Bildirimi veritabanına ekleyin
        $bildirimEkleQuery = "INSERT INTO bildirimler (kullanici_id, yorum_id) VALUES (:kid, :yid)";
        $stmt=$conn->prepare($bildirimEkleQuery);
        $stmt->bindParam(':kid',$kullaniciId);
        $stmt->bindParam(':yid',$yorumId);
        if ($stmt->execute()) {
            echo "Bildirim başarıyla eklendi.";
        } else {
            echo "Bildirim eklenirken hata oluştu: " . $conn->errorInfo()[2];
        }
    }  
    
    function yorumEklendi($post_id, $yorum_id) {
        global $conn;
    
        $kullaniciId = $_SESSION['kullanici_id'];
    
        $postSahibiSorgu = "SELECT profil_id FROM postlar WHERE post_id = $post_id";
        $postSahibiSonuc = $conn->query($postSahibiSorgu);
    
        if ($postSahibiSonuc->rowCount() > 0) {
            $postSahibiId = $postSahibiSonuc->fetchColumn();
    
            if ($postSahibiId != $kullaniciId) {
                bildirimGonder($postSahibiId, $yorum_id);
            }
        } else {
            echo "Post sahibi bulunamadı.";
        }
    }
