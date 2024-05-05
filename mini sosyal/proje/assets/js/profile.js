$(document).ready(function() {
  $('#editIcon').click(function(e) {
      e.preventDefault();
      
      Swal.fire({
          title: 'Profil Adı',
          input: 'text',
          inputValue: $('#username').text(),
          showCancelButton: true,
          confirmButtonText: 'Kaydet',
          cancelButtonText: 'İptal',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              // Kullanıcı adını güncelleme işlemini burada yapabilirsiniz
              var newUsername = result.value;
              
              // Örneğin AJAX kullanarak veritabanında güncelleme yapabilirsiniz
              $.ajax({
                  url: 'guncelle.php', // Güncelleme işlemini yapacak PHP dosyasının adresi
                  type: 'POST',
                  data: { username: newUsername }, // Güncellenen kullanıcı adını gönderin
                  success: function(response) {
                      // Başarılı yanıt aldığınızda işlemleri burada gerçekleştirin
                      $('#username').text(newUsername); // Kullanıcı adını güncelleyin
                      
                      Swal.fire({
                          title: 'Başarılı',
                          text: 'Kullanıcı adı güncellendi',
                          icon: 'success'
                      });
                  },
                  error: function() {
                      // Hata durumunda işlemleri burada gerçekleştirin
                      Swal.fire({
                          title: 'Hata',
                          text: 'Bir hata oluştu, lütfen tekrar deneyin',
                          icon: 'error'
                      });
                  }
              });
          }
      });
  });
});
