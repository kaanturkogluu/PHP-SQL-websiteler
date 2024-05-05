<?php 
// mesajları listeleme 
$kullanici_id = 1; // Kullanıcının profil ID'si

$sql = "SELECT m.mesaj_id, m.mesaj_metni, m.tarih, p.ad, p.soyad
        FROM mesajlar AS m
        INNER JOIN kullanici_profil AS p ON m.gonderen_id = p.profil_id OR m.alici_id = p.profil_id
        WHERE m.gonderen_id = $kullanici_id OR m.alici_id = $kullanici_id
        ORDER BY m.tarih DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mesaj_id = $row["mesaj_id"];
        $mesaj_metni = $row["mesaj_metni"];
        $tarih = $row["tarih"];
        $gonderen = $row["ad"] . " " . $row["soyad"];

        echo "Mesaj ID: $mesaj_id<br>";
        echo "Gönderen: $gonderen<br>";
        echo "Mesaj: $mesaj_metni<br>";
        echo "Tarih: $tarih<br><br>";
    }
} else {
    echo "Henüz mesajınız bulunmamaktadır.";
}


?>