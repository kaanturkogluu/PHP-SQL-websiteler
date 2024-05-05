<?php

require_once '../class/vt.php';
require_once '../class/vticerik.php';
require_once '../class/sayfaolustur.php';
// icerik sayfasına sayfaların listelenmesi işlemi 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mode']) && $_POST['mode'] == 'takeData') {
    $icerik = new Icerik();
    $icerik->yaziVerileriniAl();
    return;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['icerikGüncelle'])) {
    $icerik = new Icerik();
    $icerik->yaziVerileriniDegistir($_POST['id'], $_POST['baslik'], $_POST['icerik']);
    if ($icerik !== false) {
        header('Location: ../index.php?sayfa=icerik&&islem=1');
        exit();
    } else {
        $mesaj = $icerik;
        header('Location: ../index.php?sayfa=icerik&&islem=0');
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["resim"]) && isset($_POST['galeriresim'])) {
    $grup = $_POST['secilengrup'];
    $icerik = new Icerik();

    $sonuc = $icerik->resimYukle("../dist/img/galeri/", $grup);

    switch ($sonuc) {
        case 1: //basarılı
            header('Location:../index.php?sayfa=galeri&&success=1');
            break;
        case -1:
            //resim değil
            header('Location:../index.php?sayfa=galeri&&success=-1');
            break;
        case 2:
            //dosya mevcut
            header('Location:../index.php?sayfa=galeri&&success=2');
            break;
        case 3:
            header('Location:../index.php?sayfa=galeri&&success=2');
            //dosya büyük
            break;

        case 4:
            header('Location:../index.php?sayfa=galeri&&success=4');
            break;
        case 5:
            //dosya yüklenemedi
            header('Location:../index.php?sayfa=galeri&&success=5');
            break;
        case 6:
            header('Location:../index.php?sayfa=galeri&&success=6');
            break;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mode']) && $_POST['mode'] == 'resimlerlist') {

    $id = $_POST['id'];
    $icerik = new Icerik();
    $result = $icerik->resimleriGetir($id);
    echo json_encode(array('data' => $result));
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resimDegistirme'])) {

    $url = $_POST['hedefurl'];
    $id = $_POST['secilenid'];
    $icerik = new Icerik();
    $result = $icerik->resimDegistir($url, $id);
    if ($result === true) {
        header('Location:../index.php?sayfa=resimler&&success=1');
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['olustur'])) {

    $vt = new Vt();
    $ad = strtolower($vt->normalizeString($_POST['sayfaadi']));
    $dosyaYeri = "../hedef/";
    $dosyaadi =  $ad . ".php";
    $dosya = $dosyaYeri . $dosyaadi;
    $dosyaIslemi = new DosyaIslemleri($dosya, $ad);
    $sayfaicerik = '<?php
    include_once "data.php";
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Untree.co">
        <link rel="shortcut icon" href="favicon.png">
    
        <meta name="description" content="" />
        <meta name="keywords" content="bootstrap, bootstrap4" />
    
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="css/tiny-slider.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
    </head>
    
    <body>
    
        <!-- Start Header/Navigation -->
        <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    
            <div class="container">
                <a class="navbar-brand" href="index.html">Furni<span>.</span></a>
    
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarsFurni">
    
                    <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                        <?php
                        $vt = new Vt();
                        $menu = $vt->veriGetir(1, "SELECT m.*,s.* FROM `menu` m  INNER JOIN  sayfalar s ON m.linkid=s.id", "", array(), "ORDER BY sira ASC");
                        $icerik = $vt->veriGetir(0, "yazilar", "", array(), "ORDER BY id ASC");
                        $yorumlar = $vt->veriGetir(0, "yorumlar", "WHERE sayfaid=?", array(1), "ORDER BY id ASC");
                        $resimler = $vt->veriGetir(0, "resimler", "WHERE sayfaid=?", array(1), "ORDER BY id ASC");
    
                        $currentURL = str_replace("/", " ", $_SERVER["REQUEST_URI"]);
    
                        foreach ($menu as $item) {
                            if ($item["link"] == $currentURL) {
                                $active = "active";
                            } else {
                                $active = "";
                            } ?>
    
                            <li class="nav-item <?= $active ?>">
                                <a class="nav-link" href="<?= $item["link"] ?>"><?= $item["baslik"] ?></a>
                            </li>
                        <?php	}
                        ?>
                    </ul>
                    <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                        <li><a class="nav-link" href="#"><img src="images/user.svg"></a></li>
                        <li><a class="nav-link" href="cart.html"><img src="images/cart.svg"></a></li>
                    </ul>
                </div>
            </div>

        </nav>';
    $sonuc = $dosyaIslemi->dosyaOlusturVeYaz($sayfaicerik);
    if ($sonuc === 1) {
        header('Location:../index.php?sayfa=menu&insertsuccess=1');
    } else {

        header('Location:../index.php?sayfa=menu&inserterror=1&errorMessage=' . urlencode($sonuc));
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['referans'])) {
    $vt = new Vt();
    $hedefyol = "../dist/img/galeri/";
    $target_file = $hedefyol . $vt->normalizeString(basename($_FILES["resim"]["name"])); // Yüklenen dosyanın tam yolu
    echo $target_file;

    $icerik = new Icerik();
    $icerik->referansresimKaydet($target_file, $_POST['baslik'], $_POST['icerik']);



    $sonuc = $icerik->resimYukle();


    switch ($sonuc) {
        case 1: //basarılı
            header('Location:../index.php?sayfa=referanslar&&success=1');
            break;
        case -1:
            //resim değil
            header('Location:../index.php?sayfa=referanslar&&success=-1');
            break;
        case 2:
            //dosya mevcut
            header('Location:../index.php?sayfa=referanslar&&success=2');
            break;
        case 3:
            header('Location:../index.php?sayfa=referanslar&&success=2');
            //dosya büyük
            break;

        case 4:
            header('Location:../index.php?sayfa=referanslar&&success=4');
            break;
        case 5:
            //dosya yüklenemedi
            header('Location:../index.php?sayfa=referanslar&&success=5');
            break;
        case 6:

            header('Location:../index.php?sayfa=referanslar&&success=6');
            break;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['referansil'])) {

    $id = $_POST['id'];
    $vt = new Vt();
    if ($vt->sorguCalistir("DELETE FROM referanslar", " WHERE id=?", array($id))) {

        header('Location:../index.php?sayfa=referanslar&silme=1');
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grupolustur'])) {

    $vt = new Vt();
    if ($vt->veriGetir(0, "resimgruplar", "WHERE grup=?", array($_POST['grup'])) == false) {
        if ($vt->sorguCalistir("INSERT INTO resimgruplar(grup) VALUES", "(?)", array($_POST['grup'])) == true) {
            header('Location:../index.php?sayfa=galeri&grup=1');
        } else {
            header('Location:../index.php?sayfa=galeri&grup=2');
        }
    } else {
        // mevcut
        header('Location:../index.php?sayfa=galeri&grup=3');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sliderdegisme'])) {
    if (isset($_POST['selectedImages'])) {
        $selectedImages = explode(',', $_POST['selectedImages']);

        $vt = new Vt();
        // Her bir seçilen resmin ID'sini ekrana yazdıralım
        foreach ($selectedImages as $imageId) {
            $vt->sorguCalistir("INSERT INTO slider(resimid) VALUES", "(?)", array($imageId));
        }
        header('Location:../index.php?sayfa=slider&ekleme=1');
    } else {
        header('Location:../index.php?sayfa=slider&ekleme=-1');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sliderdansil'])) {

    $id = $_POST['id'];


    $vt = new Vt();

    if ($vt->sorguCalistir("DELETE FROM slider", " WHERE id=?", array($id))) {

        header('Location:../index.php?sayfa=slider&silme=1');
    } else {
        header('Location:../index.php?sayfa=slider&silme=-1');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['slidericerikekle'])) {

    $icerik = $_POST['slidericerik'];
    $id = $_POST['id'];
    $vt = new Vt();


    if ($vt->sorguCalistir("UPDATE slider SET  icerik=?", " WHERE id=?", array($icerik, $id))) {

        header('Location:../index.php?sayfa=slider&icerikekleme=1');
    } else {
        header('Location:../index.php?sayfa=slider&icerikekleme=-1');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['iletisimkayit'])) {

    $icerik = $_POST['slidericerik'];
    $id = $_POST['id'];
    $vt = new Vt();


    if ($vt->sorguCalistir("UPDATE kullanicibilgileri SET  telefon=? , mail=?", " WHERE id=?", array($_POST['telefon'], $_POST['email'], 1))) {

        header('Location:../index.php?sayfa=iletisim&bilgi=1');
    } else {
        header('Location:../index.php?sayfa=iletisim&bilgi=-1');
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seoayarlari'])) {



    $vt = new Vt();


    if ($vt->sorguCalistir("UPDATE ayarlar SET  baslik=? , anahtar=? , aciklama=?", " WHERE id=?", array($_POST['baslik'], $_POST['anahtar'], $_POST['descrip'], 1))) {

        header('Location:../index.php?seo&update=1');
    } else {
        header('Location:../index.php?seo&update=-1');
    }
}
