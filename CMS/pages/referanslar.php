<?php if (isset($_GET['silme']) && $_GET['silme'] == 1) {
    echo '<script>basariliBildirimi("Silme  İşlemi Tamamlandı");</script>';
} ?>
<div class="content mt-3">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="card" id="card">
                    <div class="card-header border-0 ">

                    </div>

                    <div class="card-body">
                        <h4 class="text-center">Mevcut Referanslar </h4>
                        <?php $referanslar = $vt->veriGetir(0, "referanslar", "", array(), "ORDER BY id DESC"); ?>
                        <div class="row">
                            <?php foreach ($referanslar as $re) {
                            ?>
                                <div class="col-md-8">
                                    <img src="<?= $re['resim'] ?>" class="img img-fluid" height="100px" width="200px" alt="">
                                    <h4><?= $re['baslik'] ?></h4>break
                                    <p><?= $re['icerik'] ?></p>
                                    <form action="requests/request.php" method="post">
                                        <input type="hidden" value="<?= $re['id'] ?>" name="id" id="">
                                        <button class="btn btn-danger" type="submit" name="referansil"> Sil</button>
                                    </form>
                                </div>
                            <?php
                            } ?>

                        </div>




                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="card2">
                <div class="card" id="card">
                    <div class="card-header border-0 ">

                    </div>


                    <div class="card-body">
                        <h4 class="text-center">Referans Ekle</h4>
                        <div class="container mt-5">
                            <div class="row">


                                <div class="col-md-6">
                                    <form action="requests/request.php" method="post" id="referansForm" enctype="multipart/form-data">
                                        <input type="file" id="dosyaSec" name="resim">
                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                            <div class="image-box bg-light border rounded p-3">
                                                <img id="yuklenenResim" src="" name="resim" class="img img-fluid" alt="Seçilen Resim" required>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label for="metin1" class="form-label">Baslik</label>
                                        <input type="text" class="form-control" id="metin1" name="baslik" placeholder="Metin 1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="metin1" class="form-label">Lİnk</label>
                                        <input type="text" class="form-control" id="metin1" name="link" placeholder="Metin 1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="metin2" class="form-label">Sayfada Görüntülenecek Yazı</label>
                                        <input type="text" class="form-control" id="metin2" name="icerik" placeholder="Metin 2" required>
                                    </div>

                                    <button class="btn btn-success col-md-3" name="referans" type="submit">Ekle</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    document.getElementById('dosyaSec').addEventListener('change', function(event) {
        // Dosya seçilmiş mi kontrol et
        if (event.target.files.length > 0) {
            // Seçilen dosyayı al
            var dosya = event.target.files[0];
            // Dosyayı okumak için FileReader nesnesi oluştur
            var okuyucu = new FileReader();
            // Dosya okunduğunda tetiklenecek fonksiyon
            okuyucu.onload = function(event) {
                // Okunan dosyanın veri yolunu al ve img etiketinin src özelliğine at
                document.getElementById('yuklenenResim').src = event.target.result;
            };
            // Dosyayı oku
            okuyucu.readAsDataURL(dosya);
        }
    });
    document.getElementById('referansForm').addEventListener('submit', function(event) {
        var dosyaSecInput = document.getElementById('dosyaSec');
        // Eğer dosya seçilmediyse formu gönderme
        if (!dosyaSecInput.value) {
            // Formu gönderme
            event.preventDefault();
            // Kullanıcıya bir uyarı gösterme
            alert('Lütfen bir resim seçin.');
        }
    });
</script> <?php
            if (isset($_GET['success'])) {
                switch ($_GET['success']) {
                    case 1: //basarılı
                        echo '<script>basariliBildirimi("Resim Yükleme İşlemi Tamamlandı");</script>';
                        break;
                    case -1:
                        //resim değil
                        echo '<script>hataBildirimi("Seçilen Resim Değil Lütfen Bir Resim Seçin");</script>';
                        break;
                    case 2:
                        //dosya mevcut
                        echo '<script>bilgilendirmeBildirimi("Seçilen Dosya Sistemde Mevcut");</script>';
                        break;
                    case 3:
                        echo '<script>uyariBildirimi("Seçilen Resim Boyutu 10MB üzeri olamaz");</script>';
                        //dosya büyük
                        break;

                    case 4:
                        echo '<script>hataBildirimi("Resim JPG , PNG , JPEG , GIF formatında olmalıdır");</script>';
                        break;
                    case 5:
                        //dosya yüklenemedi
                        echo '<script>hataBildirimi("Dosya Yüklenemedi , Tekrar Deneyiniz");</script>';

                        break;
                    case 6:
                        echo '<script>uyariBildirimi("Bir Resim Dosyası Seçiniz");</script>';

                        break;
                }
            }
            ?>