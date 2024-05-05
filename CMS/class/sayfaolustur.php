<?php
require_once 'vt.php';
class DosyaIslemleri
{
    private $dosyaYolu;
    private $dosyaadi;

    function __construct($dosyaYolu, $dosyaadi)
    {
        $this->dosyaYolu = $dosyaYolu;
        $this->dosyaadi = $dosyaadi;
    }

    public function dosyaOlusturVeYaz($metin)
    {
        if (file_exists($this->dosyaYolu)) {
            return "Dosya zaten mevcut.";
        }

        $dosya = fopen($this->dosyaYolu, "w");
        if (!$dosya) {
            return "Dosya açılamadı.";
        }

        if (fwrite($dosya, $metin) === false) {
            fclose($dosya);
            return "Dosyaya yazılamadı.";
        }

        fclose($dosya);
        $sonuc = $this->dosyaKayit($this->dosyaYolu, $this->dosyaadi);
        if ($sonuc !== true) {
            unlink($this->dosyaYolu);
            return $sonuc;
        } else {
            return 1;
        }
    }

    public function dosyaKayit($dosyayolu, $dosyaadi)
    {

        $vt = new Vt();
        $sayfakayit = $vt->sorguCalistir("INSERT INTO sayfalar(link, sayfaadi) VALUES", "(?, ?)", array($dosyaadi . ".php", $dosyaadi));
        if ($sayfakayit == false) {
            return $sayfakayit;
        }

        $sonuc = $vt->baglanti->query("SELECT LAST_INSERT_ID()");
        if ($sonuc == false) {
            return $sonuc;
        }
        $lastInsertId = $sonuc->fetchColumn();
        $res = $vt->sorguCalistir("INSERT INTO menu(baslik, linkid,sira) VALUES", "(?,?,?)", array($dosyaadi, $lastInsertId, 10));
        if ($res != true) {
            $vt->sorguCalistir("DELETE FROM sayfalar"," WHERE id=?", array($lastInsertId));

            
        }
        return $res;
    }
}
