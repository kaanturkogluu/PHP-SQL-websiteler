<?php 
session_start();

// Oturumu sonlandır

 
// İsteğe bağlı olarak, oturum değişkenlerini de temizleyebilirsiniz

unset($_SESSION["kullanici_id"]);

$_SESSION = array();
// Kullanıcıyı başka bir sayfaya yönlendirin veya gerekli işlemleri yapın

session_destroy();
header('Location: ../../../layouts/pages/kayit.php?logout=1');
exit();
