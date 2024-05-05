<?php
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
    
        </nav>