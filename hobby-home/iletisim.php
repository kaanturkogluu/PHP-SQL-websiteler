<?php
require_once 'admin/pages/inc-functions.php';
if (isset($_POST["submit"])) {
    $ad = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $telefon = htmlspecialchars($_POST["Telefon"], ENT_QUOTES, 'UTF-8');
    $mesaj = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');

    $ekle = $db->prepare("INSERT INTO `iletisim` (`ad`, `email`, `telefon`, `mesaj`) VALUES (:ad, :email, :telefon, :mesaj)");
    $ekle->bindValue(":ad", $ad, PDO::PARAM_STR);
    $ekle->bindValue(":email", $email, PDO::PARAM_STR);
    $ekle->bindValue(":telefon", $telefon, PDO::PARAM_STR);
    $ekle->bindValue(":mesaj", $mesaj, PDO::PARAM_STR);

    if ($ekle->execute()) {
        header("Location: iletisim.php?i=ok");
        exit;
    } else {
        header("Location: iletisim.php?i=hata");
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>İletisim</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php require_once 'includes/inc-menu.php'; ?>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>İletisim</h1>
                        <span class="subheading">Hobileriniz benimle paylaşın, bir mesaj bırakın</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>Formu esksiksiz doldurarak bana bir mesaj bırakabilirsiniz</p>
                    <div class="my-5">

                        <form method="POST" action="iletisim.php#bildiri">
                            <div class="control-group">
                                <div class="form-group floating-label-from-group controls">
                                    <label>Ad Soyad</label>
                                    <input type="text" class="form-control" placeholder="Ad soyad" name="name" required data-validation-reqiured-message="Adınızı Girin">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-from-group controls">
                                        <label>Mail</label>
                                        <input type="email" class="form-control" placeholder="E mail" name="email" required data-validation-reqiured-message="E-mail Girin">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <div class="form-group floating-label-from-group controls col-xs-12">
                                            <label>Telefon </label>
                                            <input type="tel" class="form-control" placeholder="Telefon" name="Telefon" required data-validation-reqiured-message="Telefon girin">
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <div class="form-group floating-label-from-group controls">
                                                <label>Mesaj</label>
                                                <textarea rows="5" class="form-control" placeholder="mesaj" name="message" required></textarea>
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                        <br>
                                      
                                        <div class="form-group">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Gönder">
                                        </div>
                                        <div id="bildiri"></div>
                                        <?php if (@$_GET["i"] == "ok") {
                                            echo       '<p class="text-center alert alert-success"> Mesaj Başarılı ile Gönderildi </p>';
                                        } elseif (@$_GET["i"] == "hata") {

                                            echo '   <p class="text-center alert alert-danger"> Hata olustu mesaj basarısız </p>';
                                        } ?>

                        </form>  </div> <a href="index.php" class="btn btn-primary rounded-4 w-50 mt-5"> Anasayfaya Dön</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer-->
    <?php require_once 'includes/inc-footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>