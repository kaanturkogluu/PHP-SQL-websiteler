<?php require_once 'inc-functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yazı Ekle | Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php
    if (@$_POST["submit"]) {
        $baslik = htmlspecialchars($_POST["baslik"], ENT_QUOTES, 'UTF-8');
        $alt_baslik = htmlspecialchars($_POST["alt_baslik"], ENT_QUOTES, 'UTF-8');
        $aciklama = htmlspecialchars($_POST["aciklama"], ENT_QUOTES, 'UTF-8');

        $aktif = htmlspecialchars($_POST["aktif"], ENT_QUOTES, 'UTF-8');




        $yukleklasor = "../../resimler/";

        $tmp_name = $_FILES['yukle_resim']["tmp_name"];
        $name = $_FILES['yukle_resim']['name'];
        $boyut = $_FILES['yukle_resim']['size'];
        $tip = $_FILES['yukle_resim']['type'];
        $uzanti = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $rastagelesayi1 = rand(10000, 50000);
        $rastagelesayi2 = rand(10000, 50000);
        $resimad = $rastagelesayi1 . $rastagelesayi2 . '.' . $uzanti;

        if (strlen($name) == 0) {

            echo '<div style="height:100vh; width:100vw; border: 1px solid red; display: flex; justify-content: center; align-items: center; gap:1%;">
Resim Seçimi Yapın
<a href="blog_ekle.php" class="btn btn-primary"> <-Geri Dön</a>
</div>';



            exit();
        }

        if ($boyut > (1024 * 1024 * 3)) {

            echo '<div style="height:100vh; width:100vw; border: 1px solid red; display: flex; justify-content: center; align-items: center; gap:1%;">
 Max veri boyutu 5mb olmalıdır
<a href="blog_ekle.php" class="btn btn-primary"> <-Geri Dön</a>
</div>';
            exit();
        }

        $desteklenenTipler = ['jpeg', 'jpg', 'png'];
        if (!in_array($uzanti, $desteklenenTipler)) {

            echo '<div style="height:100vh; width:100vw; border: 1px solid red; display: flex; justify-content: center; align-items: center; gap:1%;">
            Desteklenen tipler: jpeg | jpg | png
<a href="blog_ekle.php" class="btn btn-primary"> <-Geri Dön</a>
</div>';

            exit();
        }

        move_uploaded_file($tmp_name, $yukleklasor . $resimad);



        $sql = "INSERT INTO blog (baslik, alt_baslik, aciklama, aktif,resim) VALUES (:baslik, :alt_baslik, :aciklama, :aktif,:resim)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':baslik', $baslik);
        $stmt->bindParam(':alt_baslik', $alt_baslik);
        $stmt->bindParam(':aciklama', $aciklama);
        $stmt->bindParam(':aktif', $aktif);
        $stmt->bindParam('resim', $resimad);




        if ($stmt->execute()) {
            header("Location: blog.php?i=ekle");
        } else {
            //  print_r($ekle ->errorInfo()); 
            header("Location blog.php?i=hata");
        }
    } ?>

    <div id="wrapper">

        <?php require_once 'inc-menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Yeni Ekle</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="blog.php" class="btn btn-outline btn-warning">Geri Dön</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="POST" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <label>Başlık</label>
                                            <input class="form-control" placeholder="Başlık Girin " name="baslik">
                                        </div>

                                        <div class="form-group">
                                            <label>Alt Başlık</label>
                                            <input class="form-control" placeholder="Alt Başlık Girin" name="alt_baslik">
                                        </div>

                                        <div class="form-group">
                                            <label>Açıklama</label>
                                            <textarea class="form-control" id="mytextarea" rows="3" name="aciklama"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Resim Seçin</label>
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" id="image" name="yukle_resim">

                                        </div>

                                        <div class="form-group">
                                            <label>Radio Buttons</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="1" checked>Aktif
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" value="0">Pasif
                                                </label>
                                            </div>

                                        </div>



                                      
                                        <a  class="btn btn-primary" href="blog.php">Geri Dön</a>  <input type="submit" name="submit" value="Kaydet" class="btn btn-success">
                                    </form>
                                </div>


                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/tinymce.min.js"> </script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>

</body>

</html>