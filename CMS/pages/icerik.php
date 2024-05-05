<div class="content mt-3">
  <div class="container-fluid">
    <?php
    if (isset($_GET['islem']) && $_GET['islem'] == 1) {
      echo "<div id='successMessage' class='alert alert-success'>Güncelleme İşlemi Başarıyla Tamamlandı</div>";
      echo "<script>
          setTimeout(function() {
              var successMessage = document.getElementById('successMessage');
              successMessage.style.display = 'none';
          }, 3000); 
        </script>";
    } 
    if (isset($_GET['islem']) && $_GET['islem'] == 0) 
      {
      echo "<div id='successMessage' class='alert alert-danger'>İşlem Tamamlanamadı , Değişiklikler Geri Alındı, Tekrar Deneyiniz</div>";
      echo "<script>
             setTimeout(function() {
                 var successMessage = document.getElementById('successMessage');
                 successMessage.style.display = 'none';
             }, 5000); 
           </script>";
    } ?>
    <div class="row mt-5">

      <div class="card col-lg-12">
        <div class="card-header border-0">
          <h2>Sayfalar</h2>


        </div>
        <div class="card-body">

          <?php
          $menu = $vt->veriGetir(1, "SELECT m.*,s.id as 'linkid' , s.sayfaadi as 'sayfa' FROM `menu` m INNER JOIN sayfalar s ON m.linkid = s.id", "", array(), "ORDER BY sira ASC");
          ?>
          <div class="row">
            <div class="col-md-12">
              <select name="sayfalar" class="form-control" id="sayfalar">
                <option disabled selected>Sayfa Seciniz</option>
                <?php foreach ($menu as $item) { ?>
                  <option value="<?= $item["linkid"] ?>"><?= $item["baslik"] ?></option>";
                <?php } ?>
              </select>
            </div>

            <div class="col-md-12 mt-3">
              <table class="table table-bordered">
                <thead>
                  <th>#</th>
                  <th>Baslik</th>
                  <th>Seçenekler</th>

                </thead>
                <tbody id="tbody">

                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= SITE ?>/dist/js/ajaxRequest.js"></script>
<script src="<?= SITE ?>dist/js/mesaj.js"></script>
<script>
  var table = $("#tbody");
  $(document).ready(function() {

    $("#sayfalar").change(function() {
      var data = {
        'mode': 'takeData',
        'id': $(this).val()
      };

      sendAjaxRequest('requests/request.php', 'POST', data, function(response) {
        console.log(response)
        table.html(response.data);

      }, function(error) {
        table.html('');

        console.log(error);
      });
    });

  });
</script>