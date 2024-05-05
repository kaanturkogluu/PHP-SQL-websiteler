<?php
include_once SINIF . "vt.php";
$vt = new Vt();
$ayarlar = $vt->veriGetir(0,"ayarlar", "WHERE id=?", array(1), "ORDER BY id ASC", "1");

if ($ayarlar != false) {
    foreach ($ayarlar as $ayar) {

        $sitebaslik = $ayar['baslik'];
        $siteanahtar = $ayar["anahtar"];
        $siteaciklama = $ayar["aciklama"];
        $siteURL = $ayar["url"];
    }
}
