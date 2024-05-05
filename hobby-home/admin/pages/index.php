<?php session_start();
if (@$_SESSION["girisKontrol"] == 1) {
    header("Location:anasayfa.php");
}


?><?php require_once 'inc-functions.php'; ?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="İlayda Tekeli">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">

    <title>Hobby Room | Admin Giriş</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/in.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>

    </style>

</head>

<body>




    <div class="container">


        <div class="row">


            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                    <div class="text-center p-3">
                      <a href="../../index.php"><img src="../../logo.webp" class="rounded" alt="..." height=75%; width="55%"></a>  
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Giriş Yap </h3>
                    </div>

                    <div class="panel-body">

                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Kullanıcı Adı" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="*******" name="password" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me"> Beni Hatırla
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Giriş" class="btn btn-lg  btn-block" style="background-color: #400485 ;color:white;">


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php
    if (@$_POST["submit"]) {


        /*  $md5sifre = md5($_POST["password"]);
        if ($_POST["username"] == "admin" && $md5sifre == "e10adc3949ba59abbe56e057f20f883e") {
            $_SESSION["girisKontrol"] = "1"; // giris yapmıs
            $_SESSION["username"] = $_POST["username"];

            header("Location: anasayfa.php");
            return true;
        } else {

            echo  "<p style='text-align:center; color :red;'> Kullanıcı Adı veya Parola Yanlış </p>";
            return false;
        }
       */
        $vform_kullaniciadi = $_POST['username'];
        $vform_sifre = $_POST['password'];

        $result = $db->prepare("SELECT * FROM admin WHERE  ad=:k AND sifre = :s");
        $result->bindValue(":k", $vform_kullaniciadi, PDO::PARAM_STR);
        $result->bindValue(":s", $vform_sifre, PDO::PARAM_STR);
        $result->execute();
        if ($result->rowCount() >0) {
            
            $_SESSION["girisKontrol"] = "1";
            $_SESSION["username"] = $_POST["username"];
            header("Location: anasayfa.php");
            exit();
        } else {
            echo "<p style='text-align:center; color:red;'>Kullanıcı Adı veya Parola Yanlış</p>";
            return false;
        }
    }

    if (@$_GET["i"] == "cikis") {
        echo  "<p style='text-align:center; color :green;'>  Başarı ile Çıkış Yapıldı </p>";
    } elseif (@$_GET["i"] == "hack") {
        echo  "<p style='text-align:center; color :red;'> Öncelikle Giriş Yapmanız Gerekmektedir !! </p>";
    }
    ?>
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>