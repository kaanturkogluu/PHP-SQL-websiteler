<?php
require_once 'vt.php';
class Icerik
{
    private $baglanti;

    function __construct()
    {
        $this->baglanti = new Vt();
    }
    function  yaziVerileriniAl($siteURL = "http://localhost:3000/")
    {
        $id = $_POST['id'];
        $data = $this->baglanti->veriGetir(0, "yazilar", "WHERE sayfaid=?", array($id), "ORDER  BY id ASC");
        $table = '';
        if ($data != null) {
            $say = 1;
            foreach ($data as $dt) {
                $table .= '<tr>';
                $table .= "<td> {$say} </td>";
                $table .= "<td>{$dt['baslik']}</td>";
                $table .= "<td>
            <a class='btn btn-warning' href='" . $siteURL . "index.php?sayfa=detay&&id=" . $dt['id'] . "' >Detay </a>
            <a class='btn btn-danger'>Sil </a>
                </td>";
                $table .= "<td></td>";
                $table .= '</tr>';
                $say++;
            }
        }
        echo json_encode(array('success' => true, 'data' => $table));
    }
    function yaziVerileriniDegistir($id, $baslik, $icerik)
    {
        $this->baglanti->sorguCalistir("UPDATE yazilar SET", "baslik=?,icerik=? WHERE id=?", array($baslik, $icerik, $id));
    }

    function resimYukle($hedefyol = "../dist/img/galeri/", $grup = "0")
    {

        if (isset($_FILES["resim"])) {
            $target_directory = $hedefyol; // Yüklenen dosyanın kaydedileceği dizin
            $target_file = $target_directory . $this->baglanti->normalizeString(basename($_FILES["resim"]["name"])); // Yüklenen dosyanın tam yolu
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Dosyanın gerçek bir resim olup olmadığını kontrol et
            $check = getimagesize($_FILES["resim"]["tmp_name"]);
            if ($check !== false) {

                $uploadOk = 1;
            } else {

                $uploadOk = 0;
                return -1;
            }

            // Dosyanın zaten var olup olmadığını kontrol et
            if (file_exists($target_file)) {

                $uploadOk = 0;
                return 2;
            }

            // Dosya boyutunu kontrol et
            if ($_FILES["resim"]["size"] > 10485760) {

                $uploadOk = 0;
                return 3;
            }

            // İzin verilen dosya uzantılarını kontrol et
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {

                $uploadOk = 0;
                return 4;
            }

            // Dosya yükleme işlemini gerçekleştir
            if ($uploadOk == 0) {
                return 5;
            } else {
                if (move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file)) {

                    $this->resimKaydet($target_file, $grup);
                    return 1;
                } else {
                    return 5;
                }
            }
        } else {
            return 6;
        }
    }

    public function resimKaydet($path, $grup)
    {
        $result = $this->baglanti->sorguCalistir("INSERT INTO galeri (resim,grup)", "VALUES (?,?)", array($path, $grup));
        if ($result != true) {
            unlink($path);
        }
        return $result;
    }
    public function referansresimKaydet($path, $baslik, $icerik)
    {
        $this->baglanti->sorguCalistir("INSERT INTO referanslar (resim,baslik,icerik)", "VALUES (?,?,?)", array($path, $baslik, $icerik));
    }

    function resimleriGetir($sayfaid)
    {
        return $this->baglanti->veriGetir(0, "resimler", "WHERE sayfaid=?", array($sayfaid), "ORDER BY id ASC");
    }
    function resimDegistir($url, $id)
    {

        return $this->baglanti->sorguCalistir("UPDATE resimler SET", " resim=? WHERE id=?", array($url, $id));
    }
}
