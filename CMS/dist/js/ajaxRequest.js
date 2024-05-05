 function sendAjaxRequest(url, method, data, successCallback, errorCallback) {
     beklet();
     $.ajax({
         url: url,
         method: method,
         data: data,
         dataType: 'json',
         success: function (response) {
             kapat();
             if (response.success) {
                 if (typeof successCallback === 'function') {
                     successCallback(response);
                 }
             }
         },
         error: function (response) {
             kapat();
          
             if (typeof errorCallback === 'function') {
                 errorCallback(response);
             } else {
                 console.error(response);
             }
         }
     });
 }

 function beklet() {
     Swal.fire({
         title: 'Yükleniyor',
         html: '<i class="fas fa-spinner fa-spin"></i>',
         allowOutsideClick: false,
         allowEscapeKey: false,
         showConfirmButton: false
     });
 }

 function kapat() {
     Swal.close();
 }