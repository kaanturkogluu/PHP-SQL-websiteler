<style>
    #card {
        min-height: 350px;
        max-height: 500px;
    }

    .card-info {
        height: auto !important;
    }
</style>
<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];
}

$data = $vt->veriGetir(1, "SELECT * FROM `yazilar`", " WHERE id=?", array($id), "ORDER BY id ASC")[0];


?>
<div class="content mt-3">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-6" id="card2">
                <div class="card" id="card">
                    <div class="card-header border-0 ">
                        <h4>İp Uçları</h4>
                    </div>

                    <div class="card-body">
                        <h4 class="text-center"> <mark> Kendi Sitenizi Dizayn Etmek İçin Adımları Takip Ediniz </mark> </h4>

                        <ol class="border">

                            <li style="color:red">Web Sayfanızdaki değiştirelebilecek olan yazı kırmızı çizgiler arasında gösterilmiştir.</li>
                            <li>Kendi Yazılarınızı Ayırt Edebilmek İçin Onlara Başlık Veriniz(bu basliklari sadece siz göreceksiniz)</li>
                            <li>Kendi yazınızı metin kutusuna ekleyiniz</li>
                        </ol>

                        <ol class="border ">


                            <li> <mark> <a href=""> Youtube</a> </mark> Üzerinden Bilgilendirme Videolarını İzleyerek Bilgi Alablirisiniz</li>
                            <li>Yazılarınızı İstediğiniz Zaman Değiştirebilirsiniz</li>
                            <li>Canlı Destek ile 7/24 İletişime Geçebilirsiniz</li>
                            <li>Bırakın İşi Sizin İçin Biz Yapalım , <a href="#">Ek Yardım Paketi</a> satın alabilirsiniz </li>
                        </ol>

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card" id="card">
                    <div class="card-header border-0">
                    </div>
                    <div class="card-body">

                        <img src="<?= $data['resim'] ?>" class="img-fluid" alt="...">
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Kayıt Alanı</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="../requests/request.php" method="POST">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Baslık</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?= $data['baslik'] ?>" name="baslik" class="form-control" id="inputEmail3" placeholder="Baslik" required>
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-lg-12">
                            <textarea id="editor" name="icerik" required>
    <?php echo isset($data['icerik']) ? $data['icerik'] : 'Henüz Bilgi Girişi Yapılmamış'; ?>
</textarea>
                            <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="<?= SITE . 'index.php?sayfa=anasayfa' ?>" class="btn btn-info">Geri Dön</a>
                    <button type="submit" name="icerikGüncelle" class="btn btn-default float-right">Kaydet</button>
                </div>

            </form>
        </div>


    </div>
</div>
<script>
    CKEDITOR.replace('editor', {
        uiColor: '#CCEAEE',
        removeButtons: 'PasteFromWord',
        language: 'tr',
     
    });
</script>
removePlugins: 'image',
