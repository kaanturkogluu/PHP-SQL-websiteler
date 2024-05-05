// bildirimler.js

// Başarılı bildirim
function basariliBildirimi(mesaj) {
    Swal.fire({
        icon: 'success',
        title: 'Başarılı!',
        text: mesaj
    });
}

// Hata bildirimi
function hataBildirimi(mesaj) {
    Swal.fire({
        icon: 'error',
        title: 'Hata!',
        text: mesaj
    });
}

// Kullanıcı onayı bildirimi
function kullaniciOnayiBildirimi(mesaj, onayCallback) {
    Swal.fire({
        icon: 'question',
        title: 'Onay',
        text: mesaj,
        showCancelButton: true,
        confirmButtonText: 'Evet',
        cancelButtonText: 'Hayır'
    }).then((result) => {
        if (result.isConfirmed) {
            onayCallback();
        }
    });
}

// Bilgilendirme bildirimi
function bilgilendirmeBildirimi(mesaj) {
    Swal.fire({
        icon: 'info',
        title: 'Bilgi',
        text: mesaj
    });
}
// bildirimler.js

// Uyarı bildirimi
function uyariBildirimi(mesaj) {
    Swal.fire({
        icon: 'warning',
        title: 'Uyarı',
        text: mesaj
    });
}

function beklet(islem) {
    Swal.fire({
        title: islem,
        html: 'İşlem sürüyor...',
        showConfirmButton: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function kapat() {
    Swal.close();
}

function sendPostAjaxRequest(url, data, successCallback=null, errorCallback=null) {
    // AJAX isteği yapılır
    beklet('Veriler Getiriliyor');
    $.ajax({
        type: 'POST',
        url: url,
        data:data,
        dataType: 'json',
        success: function (response) {
            console.log("basarili")
            kapat();
            // Başarılı cevap alındığında successCallback fonksiyonu çağrılır
            if (successCallback && typeof successCallback === 'function') {
                successCallback(response);
            }
        },
        error: function (xhr, status, error) {
            kapat();
            console.log(error)
            console.log('Hata')
            // Hata durumunda errorCallback fonksiyonu çağrılır
            if (errorCallback && typeof errorCallback === 'function') {
                errorCallback(xhr.status);
            }
        }
    });
}