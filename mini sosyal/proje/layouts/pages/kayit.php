<?php require_once '../../pdo.php';
include '../../dbop/dbop.php';
?>
<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="../../assets/images/raquun.webp" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/favicon.ico" type="image/x-icon">
    <title> Kayit Ol</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/kayit.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">



    <script>
        function showSuccessPopup() {
            Swal.fire({
                icon: 'success',
                title: 'Kayıt Başarılı',
                text: 'Kayıt işlemi başarıyla tamamlandı.',
                timer: 5000,
                showConfirmButton: true,
                confirmButtonText: 'Giriş Sayfasına Git'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href;
                }
            });
        }

        function showErrorPopup(hataMesaji) {
            Swal.fire({
                icon: 'error',
                title: 'Kayıt Başarısız',
                text: hataMesaji,
                confirmButtonText: 'Geri Dön',
                footer: 'Kayıt işlemi sırasında bir hata oluştu.'

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href;
                }
            });
        }
    </script>

</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form method="POST" action="">


                <label for="chk" aria-hidden="true" name="kayit">Kayıt Ol</label>

                <input type="text" name="name" placeholder="Kullanıcı Adı" id="name" required>

                <input type="email" name="email" placeholder="Email" id="email" required>

                <input type="password" name="pswd" placeholder="Şifre" id="password" required>






                <button name="buton">Kayıt</button>
                <?php



                if (isset($_POST["buton"])) {
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $password = $_POST["pswd"];

                    if (empty($name) || empty($email) || empty($password)) {
                        $emptyFields = array();

                        if (empty($name)) {
                            $emptyFields[] = "Kullanıcı Adı";
                        }

                        if (empty($email)) {
                            $emptyFields[] = "Email";
                        }

                        if (empty($password)) {
                            $emptyFields[] = "Şifre";
                        }

                        $errorMsg = "Lütfen " . implode(", ", $emptyFields) . " alanlarını doldurunuz";

                        echo "<script>showErrorPopup('$errorMsg');</script>";
                    } else {
                        $result = addTables($email, $password, $name);

                        if ($result === true) {
                            echo "<script>showSuccessPopup();</script>";
                        } else {
                            echo "<script>showErrorPopup('$result');</script>";
                        }
                    }
                }

                ?>





            </form>
        </div>




        <div class="login">

            <?php

            session_start(); // Oturumu başlat



            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = $_POST['pswd'];

                // Giriş tablosunda mail_id ve sifre_id'ye göre oturum açma sorgusu
                global $conn;
                $loginQuery = $conn->prepare("SELECT giris.mail_id, giris.sifre_id, kullanici_profil.profil_id FROM giris
        INNER JOIN kullanici_mail ON giris.mail_id = kullanici_mail.mail_id
        INNER JOIN kullanici_sifre ON giris.sifre_id = kullanici_sifre.sifre_id
        INNER JOIN kullanici_profil ON kullanici_mail.mail_id = kullanici_profil.mail_id
        WHERE kullanici_mail.mail = :email AND kullanici_sifre.kullanici_sifre = :password");

                $loginQuery->bindParam(":email", $email);
                $loginQuery->bindParam(":password", $password);
                $loginQuery->execute();

                if ($loginQuery->rowCount() == 1) {
                    // Giriş başarılı, oturum değişkenlerini ayarla
                    $row = $loginQuery->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['mail_id'] = $row['mail_id'];
                    $_SESSION['kullanici_id'] = $row['profil_id'];

                    // Oturum açma işlemi tamamlandı, istenen sayfaya yönlendir
                    header("Location: index.php");
                    exit();
                } else {
                    // Giriş başarısız, hata mesajı göster veya yeniden giriş yapılmasını iste
                    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Hata!",
                text: "Geçersiz kullanıcı adı veya şifre.",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Tamam"
            });
        </script>';
                }
            }

            ?>
            <form method="POST" action="">

                <label for="chk" aria-hidden="true" name="girisyap">Giriş Yap</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Şifre" required="">

                <button name="login">Login</button>




            </form>
        </div>


    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector("label[name=girisyap]").click();
    });
</script>

</html>