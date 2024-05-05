<?php
class Vt
{
    var $sunucu = "localhost";
    var $user = "root";
    var $password = "";
    var $dbname = "yonetimpaneli";
    var $baglanti;

    function __construct()
    {
        try {

            $this->baglanti = new PDO("mysql:host=" . $this->sunucu . ";dbname=" . $this->dbname . ";charset=utf8", $this->user, $this->password);
        } catch (PDOException $error) {
            echo $error->getMessage();
            exit();
        }
    }

    public function veriGetir($innerjoin = 0, $tablo, $wherealanlar = "", $wherearraydeger = [], $orderby = "ORDER BY id ASC", $limit = "")
    {
        // tüm verileri alinacak ise  tablo değiskeni kullanulıur
        // farklı bir sorgu gönderilecek ise innerjoine 1 gönderip sorgu yaziliyr
        try {
            $this->baglanti->query("SET CHARACTER SET utf8");
            $sql = "";

            if ($innerjoin == 1) {
                $sql = $tablo;
            } else {
                $sql = "SELECT * FROM " . $tablo;
            }
            if (!empty($wherealanlar) && !empty($wherearraydeger)) {
                $sql .= " " . $wherealanlar;
            }
            if (!empty($orderby)) {
                $sql .= " " . $orderby;
            }
            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            $calistir = $this->baglanti->prepare($sql);
            $sonuc = $calistir->execute($wherearraydeger);
            if ($sonuc) {
                $veri = $calistir->fetchAll(PDO::FETCH_ASSOC);
                if ($veri != false && !empty($veri)) {
                    return $veri;
                }
            }
            return false;
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
            return false;
        }
    }



    public function sorguCalistir($tablosorgu, $alanlar = "", $degerlerarray = [], $limit = "")
    {
        try {
            $this->baglanti->beginTransaction(); // İşlemi başlat

            $this->baglanti->query("SET CHARACTER SET utf8");
            if (!empty($alanlar) && !empty($degerlerarray)) {
                $sql = $tablosorgu . " " . $alanlar;
                if (!empty($limit)) {
                    $sql .= " LIMIT " . $limit;
                }

                $calistir = $this->baglanti->prepare($sql);
                $sonuc = $calistir->execute($degerlerarray);
            } else {
                $sql = $tablosorgu . " " . $alanlar;
                if (!empty($limit)) {
                    $sql .= " LIMIT " . $limit;
                }
                $sonuc = $this->baglanti->exec($sql);
            }


            $this->baglanti->commit(); // İşlemi tamamla
            return true; // Başarılı olursa true döndür

        } catch (PDOException $e) {
            // Hata olursa işlemi geri al ve false döndür
            $this->baglanti->rollback();
            echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
            return false;
        }
    }
    function normalizeString($string) {
        // Türkçe karakterleri düzeltme
        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'I', 'ı', 'İ', 'i', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü');
        $replace = array('C', 'c', 'G', 'g', 'I', 'i', 'I', 'i', 'O', 'o', 'S', 's', 'U', 'u');
        $string = str_replace($search, $replace, $string);
        $string=str_replace(' ','_',$string);
        
        // Diğer karakter normalleştirmelerini buraya ekleyebilirsiniz
        
        return $string;
    }

    public function selflink($string)
    {
        // Türkçe karakterleri ingilizce karakterlere dönüştür
        $trans = array(
            'ş' => 's', 'Ş' => 's', 'ı' => 'i', 'İ' => 'i', 'ğ' => 'g', 'Ğ' => 'g',
            'ü' => 'u', 'Ü' => 'u', 'ö' => 'o', 'Ö' => 'o', 'ç' => 'c', 'Ç' => 'c',
            'â' => 'a', 'Â' => 'a', 'î' => 'i', 'Î' => 'i', 'û' => 'u', 'Û' => 'u',
            'é' => 'e', 'É' => 'e', "'" => '', ' ' => '-'
        );

        // Türkçe karakterleri temizle
        $string = strtr($string, $trans);

        // Alfa numerik olmayan karakterleri kaldır
        $string = preg_replace('/[^a-zA-Z0-9\-]/', '', $string);

        // Birden fazla '-' işaretini tek '-' işareti ile değiştir
        $string = preg_replace('/\-+/', '-', $string);
        $string = str_replace("-", "", $string);

        // Başta ve sonda kalan '-' işaretlerini kaldır
        $string = trim($string, '-');

        // Küçük harfe dönüştür
        $string = strtolower($string);

        return $string;
    }
    public function modulEkle()
    {
        if (!empty($_POST["modul"])) {
            $baslik = $_POST["modul"];
            if (!empty($_POST["durum"])) {
                $durum = 1;
            } else {
                $durum = 2;
            }
            $tablo = str_replace("-", "", $this->selflink($baslik));
            $kontrol = $this->veriGetir("moduller", "WHERE tablo=?", array($tablo), "ORDER BY id ASC", 1);
            if ($kontrol != false) {
                return false;
            } else {
                $tabloOlustur = $this->sorguCalistir("CREATE TABLE `$tablo` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `baslik` varchar(255) DEFAULT NULL,
                    `seflink` varchar(255) DEFAULT NULL,
                    `ketegori` int(11) DEFAULT NULL,
                    `metin` varchar(255) DEFAULT NULL,
                    `resim` varchar(255) DEFAULT NULL,
                    `anahtar` varchar(255) DEFAULT NULL,
                    `aciklama` varchar(255) DEFAULT NULL,
                    `durum` int(5) DEFAULT NULL,
                    `sirano` int(11) DEFAULT NULL,
                    `tarih` date DEFAULT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci");
                $modulekle = $this->sorguCalistir("INSERT INTO moduller", "SET baslik=?,tablo=?,durum=?,tarih=?", array($baslik, $tablo, $durum, date("Y-m-d")));
                $kategoriEkle = $this->sorguCalistir("INSERT INTO kategoriler", "SET baslik=?, seflink=?, tablo=?, durum=?, tarih=?", array($baslik, $tablo, 'modul', 1, date("Y-m-d")));
            }
            if ($modulekle != false) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function filter($val, $tf = false)
    {
        if ($tf == false) {
            $val = strip_tags($val);
        }
        $val = addslashes(trim($val));
        return $val;
    }
}
