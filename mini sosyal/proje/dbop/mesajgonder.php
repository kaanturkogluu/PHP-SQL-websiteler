<?php
// Veritabanı bağlantısı

 
require_once '../pdo.php';
 
// Mesaj gönderme işlemi

$gonderen_id = 1; // Gönderen kullanıcının profil ID'si
$alici_id = 2; // Alıcı kullanıcının profil ID'si
$mesaj_metni = "Merhaba, nasılsınız?"; // Gönderilecek mesaj metni

$sql = "INSERT INTO mesajlar (gonderen_id, alici_id, mesaj_metni)
        VALUES ($gonderen_id, $alici_id, '$mesaj_metni')";

if ($conn->query($sql) === TRUE) {
    echo "Mesaj başarıyla gönderildi.";
} else {
    echo "Mesaj gönderilirken hata oluştu: " . $conn->error;
}




?>



