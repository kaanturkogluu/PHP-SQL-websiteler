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
<div class="container-fluid">
    <div class="row">
        <form action="requests/request.php" method="post">
            <input type="text" name="grup" required>
            <button type="submit" name="grupolustur"> Grup Olustur</button>
        </form>
    </div>
    <div class="row">
        <h1> Resim Eklemeden Önce grup seçi , yok ise grup olusuturn</h1>
        <div class="col-12 mt-3">
            <form action="requests/request.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <?php
                    $veri = $vt->veriGetir(0, "resimgruplar", "", array(), "ORDER BY id ASC");
                    ?>

                    <select class="col-md-6" name="secilengrup" id="secilengrup">

                        <option value="0" selected disabled>Grup Secin</option>
                        <?php if (!empty($veri)) {
                            foreach ($veri as $v) {
                        ?>
                                <option value="<?= $v['id'] ?>"><?= $v['grup'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>


                </div>
                <div class="input-group mb-3 mt-3">
                    <input type="file" class="form-control" id="resim" name="resim" required>
                    <button type="submit" name="galeriresim" class="input-group-text">Resim Yükle</button>
                </div>

            </form>
        </div>
    </div>
    <?php
    //$sonuc = $vt->veriGetir(0, "galeri", "", array(), "ORDER BY grup");
    $sonuc = $vt->veriGetir(1, "SELECT g.*,rg.grup FROM `galeri` g INNER JOIN resimgruplar rg ON rg.id=g.grup ORDER BY g.grup", "", array(), "");
    $currentCategory = null;

    foreach ($sonuc as $res) {
        if ($res['grup'] !== $currentCategory) {
            // Eğer yeni bir kategori başlıyorsa, önceki kategorinin kartını kapat
            if ($currentCategory !== null) {
    ?>
</div><!-- .card-body -->
</div><!-- .card -->
</div><!-- .col-12 -->
</div><!-- .row -->
<?php
            }

            // Yeni kategori için kart başlat
?>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title"><?= $res['grup'] ?></h4>
            </div>
            <div class="card-body">
            <?php
            // Yeni kategorinin adını güncelle
            $currentCategory = $res['grup'];
        }
            ?>
            <div class="col-md-3">
                <a href="#galleryModal" data-large-src="<?= $res['resim'] ?>" data-toggle="modal" data-id=<?= $res['id'] ?>>
                    <img src="<?= $res["resim"] ?>" class="img-fluid img-thumbnail">
                </a>
            </div>
        <?php
    } // foreach sonu

    // Son kategorinin kartını kapat
    if ($currentCategory !== null) {
        ?>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div><!-- .col-12 -->
</div><!-- .row -->
<?php
    }
?>





<script>
    $('#galleryModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Öğe üzerine tıklanan buton
        var resim_id = button.data('id'); // İlgili resmin ID'sini al
        var modal = $(this);
        modal.find('.modal-body input[name="resim_id"]').val(resim_id); // Input alanına resim ID'sini yaz
    });
</script>
<div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-center mb-0"></h3>
                <button type="button" class="close float-right" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&#xD7;</span>
                </button>
            </div>
            <div class="modal-body p-0 text-center bg-alt">
                <img src="//placehold.it/1200x700/222?text=..." id="galleryImage" class="loaded-image mx-auto img-fluid">
                <form action="resim_sil.php" method="post"> <!-- Resim silme işlemi için form -->
                    <input type="hidden" name="resim_id"> <!-- Resim ID'sini saklamak için gizli bir input alanı -->
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="deleteFoto">Fotoğrafı Sil</button>
                <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Tamam</button>
            </div>
        </div>
    </div>
</div>


</div>
<script src="dist/js/mesaj.js"></script>
<!-- jQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#deleteFoto").click(function() {
        kullaniciOnayiBildirimi('Bu resmi silmek istediğinizden emin misiniz?', function() {
            // Kullanıcı "Evet" dediğinde çalışacak işlev buraya gelecek
            // Silme işlemini gerçekleştir
            $('#galleryModal form').submit(); // Formu otomatik olarak gönder
        });
    });
</script>
<?php
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
if (isset($_GET['grup']) && $_GET['grup'] == 1) {
    echo '<script>basariliBildirimi("Grup olusturma  İşlemi Tamamlandı");</script>';
}
if (isset($_GET['grup']) && $_GET['grup'] == 2) {
    echo '<script>hataBildirimi("Grup olusturma  İşlemi");</script>';
}
if (isset($_GET['grup']) && $_GET['grup'] == 3) {
    echo '<script>uyariBildirimi("Grup Mevcut  ");</script>';
}
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modalTrigger = document.querySelectorAll('[data-toggle="modal"]');
        var galleryModal = document.getElementById('galleryModal');
        var galleryImage = document.getElementById('galleryImage');

        modalTrigger.forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var largeSrc = this.getAttribute('data-large-src');
                var id = this.getAttribute('data-id');
                galleryImage.setAttribute('src', largeSrc);
                galleryImage.setAttribute('data-id', id);
            });
        });

        galleryModal.addEventListener('hide.bs.modal', function() {
            galleryImage.setAttribute('src', ''); // Reset image source when modal is closed
        });
    });
</script>