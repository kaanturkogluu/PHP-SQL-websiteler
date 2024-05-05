<div class="container">
    <div class="container-fluid  mt-5">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">General Elements</h3>
            </div>

            <?php  $seo=$vt->veriGetir(0,"ayarlar","",array(),"")[0]; ?>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="requests/request.php" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label> Sayfa Basliklari </label>
                                <input type="text" class="form-control" name="baslik" placeholder="Enter ..."><?=$seo['baslik']?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Anahtar Kelimeler</label>
                                <textarea class="form-control" rows="3" name="anahtar" placeholder="Site keywords"><?=$seo['anahtar']?></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Acıklama</label>
                                <textarea class="form-control" rows="3" name="descrip" placeholder="Site ne işe yarar"><?=$seo['aciklama']?></textarea>
                            </div>
                        </div>

                    </div>


                    <div class="card-footer">
                        <button type="submit" name="seoayarlari" class="btn btn-primary">Submit</button>
                    </div> <!-- input states -->

                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<?php


if (isset($_GET['update']) && $_GET['update'] == 1) {
    echo '<script>basariliBildirimi(" İşlemi Tamamlandı");</script>';
}

if (isset($_GET['update']) && $_GET['update'] == -1) {
    echo '<script>hataBildirimi(" İşlem Başarısız ");</script>';
}



?>