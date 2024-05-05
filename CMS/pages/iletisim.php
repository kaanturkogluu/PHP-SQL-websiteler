<div class="container">

    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-lg-12" id="card2">
                <div class="card" id="card">
                    <div class="card-header">
                        <h4>Site Üzerindeki İletisim Bilgileriniz</h4>
                    </div>


                    <div class="cord-body">

                        <form action="requests/request.php" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email </label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefon">Telefon Numaranız</label>
                                    <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Password" required>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" name="iletisimkayit" class="btn btn-primary">Kaydet</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php


if (isset($_GET['bilgi']) && $_GET['bilgi'] == 1) {
    echo '<script>basariliBildirimi(" İşlemi Tamamlandı");</script>';
}

if (isset($_GET['bilgi']) && $_GET['bilgi'] == -1) {
    echo '<script>hataBildirimi(" İşlem Başarısız ");</script>';
}



?>