<?php

include '../dbop/dbop.php';

// Oturumu başlat
session_start();

function loggedin($mail, $sifre)

{
    // Formdan gelen mail ve şifre değerlerini al
    $mail = $_POST['email'];
    $sifre = $_POST['pswd'];

  
    // Giriş tablosundaki mail_id ve sifre_id'ye göre oturum açma sorgusu
    global $conn;
    $mailkontrol = $conn->prepare("SELECT mail_id FROM kullanici_mail where mail = :mail");
    $mailkontrol->bindValue(":mail", $mail);
    $mailkontrol->execute();
    if ($mailkontrol->rowCount() == 0) {
        return 'Girilen Mail sistemde Kayıtlı Değil';
    }
    $mail_id = null; // Önceden $mail_id değişkenini null olarak tanımlayalım
    $mailkontrol->bindColumn('mail_id', $mail_id); // mail_id sütununu $mail_id değişkenine bağlayalım
    $mailkontrol->fetch(PDO::FETCH_BOUND);
    echo $mail_id; // $mail_id değerini kullanabilirsiniz


    
  
    $sifrekontrol = $conn->prepare("SELECT * FROM kullanici_sifre where kullanici_sifre =:s");
    $sifrekontrol->bindValue(":s", $sifre);
    $sifrekontrol->execute();
    if ($sifrekontrol->rowCount() == 0) {
        return 'Girilen Sifre Sistemde Bulunamadı';
    }




    $stmt = $conn->prepare("SELECT * FROM Giris
      JOIN kullanici_mail ON Giris.mail_id = kullanici_mail.mail_id
      JOIN kullanici_sifre ON Giris.sifre_id = kullanici_sifre.sifre_id
      WHERE kullanici_mail.mail = :m AND kullanici_sifre.sifre = :s");
}
