<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resim Seçiniz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="requests/request.php" method="POST" >
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
                        <input type="text" name="selectedImages" id="selectedImages">
                        <input type="hidden" name="sourcePage" value="sliderModal">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="degistir" name="sliderdegisme" class="btn btn-primary">Slider İçin Seç</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </form>
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
<script>
    function cerceveyiKirmiziYap(img) {
        $(img).toggleClass("red-border");

        var selectedImages = [];
        $(".img-thumbnail.red-border").each(function() {
            selectedImages.push($(this).data("id"));
        });

        $("#selectedImages").val(selectedImages.join(","));
    }
</script>