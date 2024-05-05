<style>
    .fa-sync-alt {
        cursor: pointer;
    }

    .icon-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        opacity: 0;
        transition: opacity 0.7s;
    }

    .image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 0;
        opacity: 0;
        transition: height 0.7s, opacity 0.7s;
    }


    .col-md-4:hover .icon-container,
    .col-md-4:hover .image-overlay {
        height: 70%;
        opacity: 1;
    }

    img {
        aspect-ratio: 16/9;
        ;
    }
</style>


<?php
if (isset($_GET['success'])) {
    if ($_GET['success'] == 1) {

        echo '<script>basariliBildirimi("Resim Değiştirme İşlemi Tamamlandı");</script>';
    } else {
        echo '<script>hataBildirimi("İşlem Suan Gerçekleştirelemiyor , Daha sonra tekrar deneyiniz");</script>';
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Site Resimleri</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                    </div>
                    <div class="card-body">
                        <?php

                        $menu = $vt->veriGetir(1, "SELECT m.*, s.id as 'linkid', s.sayfaadi as 'sayfa' FROM `menu` m INNER JOIN sayfalar s ON m.linkid = s.id", "WHERE durum=?", array(1), "ORDER BY sira ASC");

                        ?>
                        <div class="row">
                            <div class="col-md-6" data-select2-id="30">
                                <div class="form-group" data-select2-id="29">
                                    <label>Sayfalar</label>
                                    <select class="form-control " style="width: 100%;" id="sayfa">

                                        <option selected> Sayfa Seçimi Yapın </option>
                                        <?php foreach ($menu as $s) { ?>
                                            <option value="<?= $s['linkid'] ?>"><?= $s['baslik'] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                    </div>
                    <div class="card-body">
                        <div class="row gap-3" id="resimVerileri">


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php require_once 'modals/resimler.php';

?>

<script>
    $(document).on('click', ' .fa-sync-alt', function() {
        $("#secilenid").val($(this).data('id'))
        $("#resimlerModal").modal('show');
    })
    $("#sayfa").change(function() {

        sendPostAjaxRequest('requests/request.php', {
            'id': $(this).val(),
            'mode': 'resimlerlist'
        }, verileriyaz, function(response) {
            console.log(response);
        });
    });

    function verileriyaz(response) {
        html = '';
        $.each(response.data, function(index, item) {
            if(item.resim.startsWith('http')){
                öge = item.resim;
            }else{
                öge = 'hedef/'+item.resim;
            }
            html += '<div class="col-md-4 p-3 position-relative"><div class="position-relative"><div class="image-overlay"></div>';
            html += '<span class="icon-container"> <i class="fas fa-sync-alt fa-3x" data-id="' + item.id + '"></i> </span>';
            html += '<img src="' + öge + '" class="card-img-top img-thumbnail img-fluid" alt="Önizleme Resmi"> </div></div>';
        });
        $("#resimVerileri").html(html);
    }
</script>
<script src="<?= SITE ?>dist/js/mesaj.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>