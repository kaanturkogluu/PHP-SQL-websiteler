<?php
session_start();
ob_start();
define('DATA', "data/");
define('PAGES', "pages/");
define('SINIF', "class/");
include_once(DATA . "baglanti.php");

define('SITE', $siteURL);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="<?= $siteaciklama ?>">
    <meta name="keywords" content="<?= $siteanahtar ?>">
    <title><?= $sitebaslik ?></title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= SITE ?>plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= SITE ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--boostrap js-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert-->
    <link rel="stylesheet" href="<?= SITE ?>plugins/sweetalert2/sweetalert2.css">
    <script src="<?= SITE ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>
  
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include_once DATA . 'navbar.php';
        include_once DATA . 'sidebar.php';
        ?>
        <div class="content-wrapper">
            <?php
            if (isset($_GET) && !empty($_GET['sayfa'])) {
                $sayfa = PAGES . $_GET['sayfa'] . ".php";
                if (file_exists($sayfa)) {

                    include_once $sayfa;
                } else {
                    include_once PAGES . "anasayfa.php";
                }
            } else {
                include_once PAGES . "anasayfa.php";
            }
            ?>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <?php
        if (file_exists(DATA . "footer.php")) {
            include_once DATA . "footer.php";
        }
        ?>
    </div>

    <!-- jQuery -->
    <script src="<?= SITE ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= SITE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?= SITE ?>dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="<?= SITE ?>plugins/chart.js/Chart.min.js"></script>
    <script src="<?= SITE ?>dist/js/demo.js"></script>
  
    <script src="<?= SITE ?>dist/js/pages/dashboard3.js"></script>
    


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

</html>