<style>
  label:hover {
    cursor: pointer;
  }
</style>


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Menu Düzenle</h1>
      </div>

    </div>
  </div>
</div>
<!-- cierik -->

<?php
if (isset($_GET['insertsuccess']) && $_GET['insertsuccess'] == 1) {
  echo "<script>basariliBildirimi('sayfa Olusturma')</script>";
}

// Örnek bir kontrol, eğer 'error' parametresi mevcutsa ve değeri boş değilse hata mesajını göster
if (isset($_GET['inserterror']) && $_GET['inserterror'] == 1) {
  $errorMessage = urldecode($_GET['errorMessage']);
  echo "<script>hataBildirimi('" . $errorMessage . "')</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["menuUpdate"])) {
  $siralar = $_POST["sira"];
  $basliklar = $_POST["baslik"];
  $linkler = $_POST["link"];
  $durumlar = isset($_POST["durum"]) ? $_POST["durum"] : array();
  $ids = $_POST["id"]; // Her satırın ID'sini alın

  $isSuccess = true; // Varsayılan olarak başarılı kabul edilir

  for ($i = 0; $i < count($siralar); $i++) {
    $sira = $siralar[$i];
    $baslik = $basliklar[$i];
    $link = $linkler[$i];
    $durum = isset($durumlar[$ids[$i]]) ? 1 : 0; // Durumu kontrol edin
    $id = $ids[$i];
    $result = $vt->sorguCalistir("UPDATE menu SET sira = ?, baslik = ?, linkid = ?, durum = ?", "WHERE id = ?", array($sira, $baslik, $link, $durum, $id));
    // Eğer güncelleme işlemi başarısız olursa, isSuccess değerini false yap ve döngüyü sonlandır
    if (!$result) {
      $isSuccess = false;
      break;
    }
  }

  if ($isSuccess) {
    echo "<div class='alert alert-success'>Güncelleme İşlemi başarıyla tamamlandı.</div>";
  } else {
    echo "<div class='alert alert-danger'>İşlem(ler) tamamlanırken bir hata oluştu.</div>";
  }
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-end ">

              <h3 class="card-title mr-3"> <button class="btn btn-info" name="newPage" data-toggle="modal" data-target="#sayfaOlusturModal"> Yeni Sayfa </button></h3>


              <h3 class="card-title"><a class="btn btn-info" href="#" onclick="event.preventDefault(), yardimGoster()">Yardım ?</a></h3>
            </div>
            <script>
              function yardimGoster() {



                var display = $("#ipucu").css('display');
                if (display === 'block') {
                  $("#ipucu").css('display', 'none');
                } else {
                  $("#ipucu").css('display', 'block');
                }
              }
            </script>
            <div class="row btn btn-outline-warning mt-3" id="ipucu" style="display: none;">

              <ol>
                <li> Soldan sağa menu öğelerin sıralaması</li>
                <li>Menüde Görünen İsmin Değişmesi</li>
                <li> Acilacak olan sayfanın seçilmesi</li>
                <li>Öğenin MEnüde yer alip almayacağı</li>

              </ol>
            </div>
          </div>

          <div class="card-body">
            <?php
            $menu = $vt->veriGetir(1, "SELECT m.*, s.id as 'linkid', s.sayfaadi as 'sayfa' FROM `menu` m INNER JOIN sayfalar s ON m.linkid = s.id", "", array(), "ORDER BY sira ASC");
            $sayfa = $vt->veriGetir(0, "sayfalar", "", array(), "ORDER BY id ASC");
            if (!empty($menu)) { ?>
              <form action="#" method="post">
                <input type="hidden" name="menuUpdate"> <!-- Add hidden field for form submission -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Mevcut Sıralama</th>
                      <th>Menude Listelenen Ad</th>
                      <th>Hedef Sayfa</th>
                      <th>Aktiflik</th>
                    </tr>
                  </thead>
                  <tbody id="sortableTable">
                    <?php foreach ($menu as $key => $item) { ?>
                      <tr>
                        <td><input type="number" class="form-control sira" value="<?= $item["sira"] ?>" name="sira[]" data-index="<?= $key ?>"></td>
                        <td><input type="text" class="form-control" value="<?= $item["baslik"] ?>" required name="baslik[]"></td>
                        <td>
                          <select class="form-control" name="link[]">
                            <?php foreach ($sayfa as $menuItem) {
                              $selected = ($menuItem["id"] == $item["linkid"]) ? "selected" : "";
                              echo "<option $selected value='" . $menuItem["id"] . "'>" .  $menuItem["sayfaadi"] . "</option>";
                            } ?>
                          </select>
                        </td>
                        <td>
                          <div class="form-group text-center">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                              <?php $durum = $item["durum"]; ?>
                              <input type="hidden" name="id[]" value="<?= $item["id"] ?>"> <!-- Her satır için gizli bir alan ekleyin -->
                              <input type="checkbox" value="1" <?= $durum == 1 ? 'checked' : '' ?> class="custom-control-input" name="durum[<?= $item["id"] ?>]" id="customSwitch<?= $item["id"] ?>">
                              <label class="custom-control-label" for="customSwitch<?= $item["id"] ?>"></label>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Güncelle</button> <!-- Add submit button -->
              </form>
            <?php } ?>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once 'modals/sayfaolustur.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.sira').change(function() {
      var $table = $(this).closest('table');
      var $tbody = $table.find('tbody');
      var $rows = $tbody.find('tr');

      // Değişiklik yapılan sıranın değerini al
      var changedIndex = $(this).data('index');
      var changedValue = parseInt($(this).val());

      // Eğer girdi geçerli bir sayı değilse veya sıfırdan küçükse, 1 olarak ayarla
      if (isNaN(changedValue) || changedValue <= 0) {
        changedValue = 1;
        $(this).val(changedValue);
      }

      var currentValue = 0;

      // Eğer yeni girilen değer zaten mevcutsa, mevcut değeri sakla
      $rows.each(function(index) {
        var $input = $(this).find('.sira');
        var currentIndex = $input.data('index');
        var currentValueInRow = parseInt($input.val());

        if (currentValueInRow === changedValue && currentIndex !== changedIndex) {
          currentValue = changedValue;
          return false; // Döngüden çık
        }
      });

      // Eğer yeni girilen değer mevcut değilse, mevcut değeri saklama
      if (currentValue === 0) {
        $rows.each(function(index) {
          var $input = $(this).find('.sira');
          var currentIndex = $input.data('index');
          var currentValueInRow = parseInt($input.val());

          if (currentIndex !== changedIndex) {
            if (currentValueInRow === changedValue) {
              currentValue = changedValue;
            }
          }
        });
      }

      // Eğer yeni girilen değer mevcut değilse, eski değeri set et
      if (currentValue !== 0) {
        $rows.each(function(index) {
          var $input = $(this).find('.sira');
          var currentIndex = $input.data('index');
          var currentValueInRow = parseInt($input.val());

          if (currentIndex !== changedIndex && currentValueInRow === changedValue) {
            $input.val(currentValue);
            return false; // Döngüden çık
          }
        });
      }
    });
  });
</script>


<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>