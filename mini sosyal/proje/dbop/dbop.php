<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "raquun";

try {
    // Bağlantı oluşturma
    global $conn;
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}
function addTables($email, $sifre, $kullanici_adi)
{
    global $conn;

    try {
        $conn->beginTransaction();



        if (mailKontrol($email, $conn) == 0) {
            if (kullaniciAdiKontrol($kullanici_adi, $conn)==0) {
                $sql = "INSERT INTO kullanici_mail (mail) VALUES (:mail)";
                $addMail = $conn->prepare($sql);
                $addMail->bindValue(':mail', $email);
                $addMail->execute();
                $mailId = $conn->lastInsertId();
    
                if ($addMail->rowCount() === 0) {
                    throw new Exception('E-posta eklenirken bir hata oluştu.');
                }
    
                // Şifre ekleme
                $sifre = htmlspecialchars($sifre, ENT_QUOTES, 'UTF-8');
                $sql = "INSERT INTO kullanici_sifre (kullanici_sifre) VALUES (:sifre)";
                $addSifre = $conn->prepare($sql);
                $addSifre->bindValue(':sifre', $sifre);
                $addSifre->execute();
                $sifreId = $conn->lastInsertId();
    
                if ($addSifre->rowCount() === 0) {
                    throw new Exception('Şifre eklenirken bir hata oluştu.');
                }
    
                // Giriş tablosuna ekleme
                $sql = "INSERT INTO giris (mail_id, sifre_id, is_admin) VALUES (:mail, :sifre, :isadmin)";
                $addGiris = $conn->prepare($sql);
                $addGiris->bindValue(':mail', $mailId);
                $addGiris->bindValue(':sifre', $sifreId);
                $addGiris->bindValue(':isadmin', '0');
                $addGiris->execute();
    
                if ($addGiris->rowCount() === 0) {
                    throw new Exception('Giriş tablosuna ekleme yaparken bir hata oluştu.');
                }
    
                // Kullanıcı profil tablosuna ekleme işlemi yapılacak
                $kullanici_adi=htmlspecialchars($kullanici_adi, ENT_QUOTES, 'UTF-8');
                $sql = "INSERT INTO kullanici_profil (mail_id, sifre_id,kullanici_adi) VALUES (:mail, :sifre,:kullanici_adi)";
                $addProfil = $conn->prepare($sql);
                $addProfil->bindValue(':mail', $mailId);
                $addProfil->bindValue(':sifre', $sifreId);
                $addProfil->bindValue(':kullanici_adi', $kullanici_adi);
                $addProfil->execute();
    
                if ($addProfil->rowCount() === 0) {
                    throw new Exception('Kullanıcı profil tablosuna ekleme yaparken bir hata oluştu.');
                }
    
                $conn->commit();
                return true; // Başarılı bir şekilde eklendiğinde true döndürün
            } else {
                return 'Kullanici adi Kullanılmakta ';
            }
        } else {
            return 'Bu e Posta Zaten Kayıtlı';
        }
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Hata oluştu: " . $e->getMessage();
        return false;
    }
}

function kullaniciAdiKontrol($kullanici_adi, $conn)
{
    $kullanici_adi = htmlspecialchars($kullanici_adi, ENT_QUOTES, 'UTF-8');
    $sql = "SELECT COUNT(*) FROM kullanici_profil WHERE kullanici_adi = :kullanici_adi";
    $checkname = $conn->prepare($sql);
    $checkname->bindValue(':kullanici_adi', $kullanici_adi);
    $checkname->execute();
    $nameCount = $checkname->fetchColumn();
    return $nameCount;
}

function mailKontrol($email, $conn)
{

    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $sql = "SELECT COUNT(*) FROM kullanici_mail WHERE mail = :mail";
    $checkMail = $conn->prepare($sql);
    $checkMail->bindValue(':mail', $email);
    $checkMail->execute();
    $mailCount = $checkMail->fetchColumn();
    return $mailCount;
}
