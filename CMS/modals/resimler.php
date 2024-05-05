<div class="modal fade" id="resimlerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resim Seçiniz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row">
                        <div class="row gap-3" id="resimVerileri">
                            <?php
                            $data = $vt->veriGetir(0, "galeri", "", array(), "ORDER BY id ASC");
                            foreach ($data as $d) {
                            ?>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <img src="<?= $d['resim'] ?>" data-id="<?= $d['id'] ?>" class="img-fluid img-thumbnail" onclick="cerceveyiKirmiziYap(this)">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <form action="requests/request.php" method="post">
                        <input type="text" name="hedefurl" id="hedefurl">
                        <input type="text" name="secilenid" id="secilenid">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit"  id="degistir" name="resimDegistirme" class="btn btn-primary">Değiştir</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<style>
    .img-thumbnail.red-border {
        border-color: red;

    }

    img {
        cursor: pointer;
    }
</style>
<!-- jQuery -->
<script>
    function cerceveyiKirmiziYap(img) {
        // Önce tüm resimlerin çerçevesini varsayılan olarak ayarlayalım
        $(".img-thumbnail").removeClass("red-border");

        // Ardından sadece tıklanan resmin çerçevesini kırmızı yapalım
        $(img).addClass("red-border");


        $("#hedefurl").val(img.src);
    }
</script>
<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>