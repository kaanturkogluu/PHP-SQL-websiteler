<?php 
//mesaj gönderenleri listeleme 

function mesajGonderenKisiler(){
    global $conn;
 $sql = "SELECT m.mesaj_metni, p.ad, p.soyad, r.resim
         FROM mesajlar AS m
         INNER JOIN kullanici_profil AS p ON m.gonderen_id = p.profil_id
         LEFT JOIN profil_resimleri AS r ON p.profil_resim_id = r.resim_id";
 
 $result = $conn->query($sql);
 
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $mesaj_metni = $row["mesaj_metni"];
         $gonderen = $row["ad"] . " " . $row["soyad"];
         $profil_resim = $row["resim"];
 
         echo "Gönderen: $gonderen<br>";
         echo "Profil Resmi: <img src='$profil_resim' alt='Profil Resmi'><br>";
         echo "Mesaj: $mesaj_metni<br><br>";
     }
 } else {
     echo "Henüz mesaj bulunmamaktadır.";
 }
}?>