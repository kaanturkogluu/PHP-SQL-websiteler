<style>
    img {
        aspect-ratio: 16/9;
    }

    .img-thumbnail {
        width: 100%;
        /* Resim genişliğini konteynerin genişliğine ayarlar */
        height: 200px;
        /* Resim yüksekliğini sabit bir değere ayarlar */
        object-fit: cover;
        /* Resim, belirtilen yükseklik ve genişliğe sığacak şekilde kırpılır */
    }
</style>
<div class="content mt-3">
    <div class="container-fluid">
        <div class="row mt-3 text-center">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal">
                Slider İçin Resim Seç

            </button>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12" id="card2">
                <div class="card" id="card">
                    <div class="card-header border-0 ">
                        <h4>Mevuct Slider Resimleri</h4>
                    </div>

                    <div class="card-body">
                        <h4 class="text-center"> <mark> Sliderinizdeki Resimleriniz </mark> </h4>

                        <div class="row">
                            <?php

                            $sliderdata = $vt->veriGetir(1, "SELECT g.id,s.id as 'sliderid' ,g.resim FROM galeri g RIGHT JOIN slider s ON g.id=s.resimid");

                            if (!empty($sliderdata)) {


                                foreach ($sliderdata as $s) { ?>
                                    <div class="col-md-4">
                                        <img src="<?= $s['resim'] ?>" class="img img-fluid img-thumbnail" alt="">
                                        <form action="requests/request.php" method="post">
                                            <input type="hidden" name="id" value="<?= $s['sliderid'] ?>">
                                            <button type="submit" name="sliderdansil"> Sil</button>
                                        </form>
                                        <form action="requests/request.php" method="post">
                                            <label for="">Resim ÜzerineYazı </label>
                                            <input type="text" name="slidericerik">
                                            <input type="hidden" name="id" value="<?= $s['sliderid'] ?>">
                                            <button type="submit" name="slidericerikekle"> Ekle/Güncelle</button>
                                        </form>
                                    </div>


                            <?php   }
                            } else {
                                echo "<h1>Resim Ekleyin</h1>";
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>


</div>
</div>


<?php require_once 'modals/slider.php';

if (isset($_GET['ekleme']) && $_GET['ekleme'] == 1) {
    echo '<script>basariliBildirimi("Slider Resim Seçme  İşlemi Tamamlandı");</script>';
}

if (isset($_GET['ekleme']) && $_GET['ekleme'] == -1) {
    echo '<script>hataBildirimi("Slider Resim Seçme Başarısız ");</script>';
}

if (isset($_GET['silme']) && $_GET['silme'] == 1) {
    echo '<script>basariliBildirimi("Slider Resim Silme  İşlemi Tamamlandı");</script>';
}

if (isset($_GET['silme']) && $_GET['silme'] == -1) {
    echo '<script>hataBildirimi("Slider Resim  Sİlme  Başarısız ");</script>';
}
if (isset($_GET['icerikekleme']) && $_GET['icerikekleme'] == 1) {
    echo '<script>basariliBildirimi("Slider icerikekleme  İşlemi Tamamlandı");</script>';
}

if (isset($_GET['icerikekleme']) && $_GET['icerikekleme'] == -1) {
    echo '<script>hataBildirimi("Slider icerikekleme  Başarısız ");</script>';
}
?>