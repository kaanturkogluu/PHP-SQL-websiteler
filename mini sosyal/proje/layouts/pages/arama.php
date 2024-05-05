<?php

include '../../pdo.php';


if (isset($_GET['kelime'])) {
    $kullaniciAdi =$_GET['kelime'];
    $sql = "SELECT kullanici_profil.profil_id, kullanici_profil.kullanici_adi, profil_resimleri.resim
    FROM kullanici_profil
    INNER JOIN profil_resimleri ON kullanici_profil.profil_resim_id = profil_resimleri.resim_id
    WHERE kullanici_profil.kullanici_adi LIKE :kullaniciAdi
    LIMIT 10";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':kullaniciAdi', "%$kullaniciAdi%");

$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo '<ul class="list-group">';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $profilID = $row['profil_id'];
        $kullaniciAdi = $row['kullanici_adi'];
        $resim = $row['resim'];


        echo '<ul class="list-unstyled mb-0">';
        echo '<li class="p-2 border-bottom" style="border-bottom: 1px solid rgba(255,255,255,.3) !important;">';
        echo '<a href="visitprofil.php?visitprofilid=' . $profilID . '&visitedusername='.$kullaniciAdi.'" class="d-flex justify-content-between link-light">';
        echo '<div class="d-flex flex-row">';
        echo '<img src="../../' . $resim . '" alt="' . $kullaniciAdi . '" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">';
        echo '<div class="pt-1">';
        echo '<p class="fw-bold mb-0 text-black">' . $kullaniciAdi . '</p>';
        echo '<p class="small text-black">@' . $kullaniciAdi . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</li>';
        echo '</ul>';
    }
    echo '</ul>';
}
} else {
echo 'Sonuç bulunamadı.';
}


?>
