-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Tem 2023, 22:47:35
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `raquun`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alan`
--

CREATE TABLE `alan` (
  `alan_id` int(11) NOT NULL,
  `alanlar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bildirimler`
--

CREATE TABLE `bildirimler` (
  `bildirim_id` int(11) NOT NULL,
  `kullanici_id` int(11) DEFAULT NULL,
  `yorum_id` int(11) DEFAULT NULL,
  `goruldu_mu` tinyint(4) DEFAULT 0,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bolum`
--

CREATE TABLE `bolum` (
  `bolum_id` int(11) NOT NULL,
  `bolumler` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `giris`
--

CREATE TABLE `giris` (
  `id` int(11) NOT NULL,
  `mail_id` int(11) DEFAULT NULL,
  `sifre_id` int(11) DEFAULT NULL,
  `is_admin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `giris`
--

INSERT INTO `giris` (`id`, `mail_id`, `sifre_id`, `is_admin`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0),
(3, 3, 3, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_hakkinda`
--

CREATE TABLE `kullanici_hakkinda` (
  `hakkimda_id` int(11) NOT NULL,
  `hakkimda` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_mail`
--

CREATE TABLE `kullanici_mail` (
  `mail_id` int(11) NOT NULL,
  `mail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanici_mail`
--

INSERT INTO `kullanici_mail` (`mail_id`, `mail`) VALUES
(1, 'kaantrrkoglu@gmail.com'),
(2, 'kaan_30_1999@hotmail.com'),
(3, 'jffj@djxjd');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_profil`
--

CREATE TABLE `kullanici_profil` (
  `profil_id` int(11) NOT NULL,
  `profil_resim_id` int(11) DEFAULT NULL,
  `kullanici_adi` varchar(50) DEFAULT NULL,
  `ad` varchar(50) DEFAULT NULL,
  `soyad` varchar(50) DEFAULT NULL,
  `mail_id` int(11) DEFAULT NULL,
  `hakkinda_id` int(11) DEFAULT NULL,
  `sifre_id` int(11) DEFAULT NULL,
  `telefon_id` int(11) DEFAULT NULL,
  `dogum_tarihi` date DEFAULT NULL,
  `bolum_id` int(11) DEFAULT NULL,
  `alan_id` int(11) DEFAULT NULL,
  `medya_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanici_profil`
--

INSERT INTO `kullanici_profil` (`profil_id`, `profil_resim_id`, `kullanici_adi`, `ad`, `soyad`, `mail_id`, `hakkinda_id`, `sifre_id`, `telefon_id`, `dogum_tarihi`, `bolum_id`, `alan_id`, `medya_id`) VALUES
(1, 1, 'user1', 'user1', 'user1', 1, NULL, 1, 1, NULL, NULL, NULL, NULL),
(2, NULL, 'user2', NULL, NULL, 2, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 'user3', NULL, NULL, 3, NULL, 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_sifre`
--

CREATE TABLE `kullanici_sifre` (
  `sifre_id` int(11) NOT NULL,
  `kullanici_sifre` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanici_sifre`
--

INSERT INTO `kullanici_sifre` (`sifre_id`, `kullanici_sifre`) VALUES
(1, '1234'),
(2, '1234'),
(3, '1234');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_telefon`
--

CREATE TABLE `kullanici_telefon` (
  `telefon_id` int(11) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanici_telefon`
--

INSERT INTO `kullanici_telefon` (`telefon_id`, `telefon`) VALUES
(1, '123-456-789');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `mesaj_id` int(11) NOT NULL,
  `gonderen_id` int(11) NOT NULL,
  `alici_id` int(11) NOT NULL,
  `mesaj_metni` text DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `postlar`
--

CREATE TABLE `postlar` (
  `post_id` int(11) NOT NULL,
  `profil_id` int(11) DEFAULT NULL,
  `baslik` varchar(100) DEFAULT NULL,
  `yazi_id` int(11) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `postlar`
--

INSERT INTO `postlar` (`post_id`, `profil_id`, `baslik`, `yazi_id`, `tarih`) VALUES
(1, 1, 'Başlık', 1, '2023-07-06 20:09:16'),
(2, 1, 'Başlık', 2, '2023-07-06 20:09:38'),
(3, 1, 'Başlık', 3, '2023-07-06 20:09:43'),
(4, 1, 'Başlık', 4, '2023-07-06 20:10:12'),
(5, 2, 'Başlık', 5, '2023-07-06 20:11:26'),
(6, 2, 'Başlık', 6, '2023-07-06 20:11:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `post_resim`
--

CREATE TABLE `post_resim` (
  `post_id` int(11) DEFAULT NULL,
  `resim_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `post_resim`
--

INSERT INTO `post_resim` (`post_id`, `resim_id`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profil_resimleri`
--

CREATE TABLE `profil_resimleri` (
  `resim_id` int(11) NOT NULL,
  `resim` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `profil_resimleri`
--

INSERT INTO `profil_resimleri` (`resim_id`, `resim`) VALUES
(1, 'assets/images/profile/Kaanprofil.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resimler`
--

CREATE TABLE `resimler` (
  `resim_id` int(11) NOT NULL,
  `resim` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `resimler`
--

INSERT INTO `resimler` (`resim_id`, `resim`) VALUES
(1, 'user18540.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyal_medya`
--

CREATE TABLE `sosyal_medya` (
  `medya_id` int(11) NOT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `linkedin` varchar(50) DEFAULT NULL,
  `youtube` varchar(50) DEFAULT NULL,
  `profil_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `takip`
--

CREATE TABLE `takip` (
  `id` int(11) NOT NULL,
  `takip_eden_id` int(11) NOT NULL,
  `takip_edilen_id` int(11) NOT NULL,
  `takip_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `takip`
--

INSERT INTO `takip` (`id`, `takip_eden_id`, `takip_edilen_id`, `takip_tarihi`) VALUES
(1, 1, 2, '2023-07-06 20:06:58'),
(2, 1, 3, '2023-07-06 20:07:02'),
(3, 2, 1, '2023-07-06 20:11:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazilar`
--

CREATE TABLE `yazilar` (
  `yazi_id` int(11) NOT NULL,
  `yazi` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yazilar`
--

INSERT INTO `yazilar` (`yazi_id`, `yazi`) VALUES
(1, 'Bu yazı deneme amacı ile yazılmıstır .'),
(2, 'Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .'),
(3, 'Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .Bu yazı deneme amacı ile yazılmıstır .'),
(4, 'Bu resim deneme amacı ile paylasılmıstır'),
(5, 'Bu yaaı user2 tarafından deneme amacı ile yazıldı'),
(6, 'Bu yazı da  user2 tarafından deneme amacı ile yazıldı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `kullanici_id` int(11) DEFAULT NULL,
  `yorum` varchar(500) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `alan`
--
ALTER TABLE `alan`
  ADD PRIMARY KEY (`alan_id`);

--
-- Tablo için indeksler `bildirimler`
--
ALTER TABLE `bildirimler`
  ADD PRIMARY KEY (`bildirim_id`),
  ADD KEY `kullanici_id` (`kullanici_id`),
  ADD KEY `yorum_id` (`yorum_id`);

--
-- Tablo için indeksler `bolum`
--
ALTER TABLE `bolum`
  ADD PRIMARY KEY (`bolum_id`);

--
-- Tablo için indeksler `giris`
--
ALTER TABLE `giris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail_id` (`mail_id`),
  ADD KEY `sifre_id` (`sifre_id`);

--
-- Tablo için indeksler `kullanici_hakkinda`
--
ALTER TABLE `kullanici_hakkinda`
  ADD PRIMARY KEY (`hakkimda_id`);

--
-- Tablo için indeksler `kullanici_mail`
--
ALTER TABLE `kullanici_mail`
  ADD PRIMARY KEY (`mail_id`);

--
-- Tablo için indeksler `kullanici_profil`
--
ALTER TABLE `kullanici_profil`
  ADD PRIMARY KEY (`profil_id`),
  ADD KEY `mail_id` (`mail_id`),
  ADD KEY `sifre_id` (`sifre_id`),
  ADD KEY `telefon_id` (`telefon_id`),
  ADD KEY `bolum_id` (`bolum_id`),
  ADD KEY `alan_id` (`alan_id`),
  ADD KEY `profil_resim_id` (`profil_resim_id`),
  ADD KEY `hakkinda_id` (`hakkinda_id`);

--
-- Tablo için indeksler `kullanici_sifre`
--
ALTER TABLE `kullanici_sifre`
  ADD PRIMARY KEY (`sifre_id`);

--
-- Tablo için indeksler `kullanici_telefon`
--
ALTER TABLE `kullanici_telefon`
  ADD PRIMARY KEY (`telefon_id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`mesaj_id`),
  ADD KEY `gonderen_id` (`gonderen_id`),
  ADD KEY `alici_id` (`alici_id`);

--
-- Tablo için indeksler `postlar`
--
ALTER TABLE `postlar`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `profil_id` (`profil_id`),
  ADD KEY `yazi_id` (`yazi_id`);

--
-- Tablo için indeksler `post_resim`
--
ALTER TABLE `post_resim`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `resim_id` (`resim_id`);

--
-- Tablo için indeksler `profil_resimleri`
--
ALTER TABLE `profil_resimleri`
  ADD PRIMARY KEY (`resim_id`);

--
-- Tablo için indeksler `resimler`
--
ALTER TABLE `resimler`
  ADD PRIMARY KEY (`resim_id`);

--
-- Tablo için indeksler `sosyal_medya`
--
ALTER TABLE `sosyal_medya`
  ADD PRIMARY KEY (`medya_id`),
  ADD KEY `profil_id` (`profil_id`);

--
-- Tablo için indeksler `takip`
--
ALTER TABLE `takip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `takip_eden_id` (`takip_eden_id`),
  ADD KEY `takip_edilen_id` (`takip_edilen_id`);

--
-- Tablo için indeksler `yazilar`
--
ALTER TABLE `yazilar`
  ADD PRIMARY KEY (`yazi_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `alan`
--
ALTER TABLE `alan`
  MODIFY `alan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `bildirimler`
--
ALTER TABLE `bildirimler`
  MODIFY `bildirim_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `bolum`
--
ALTER TABLE `bolum`
  MODIFY `bolum_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `giris`
--
ALTER TABLE `giris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici_hakkinda`
--
ALTER TABLE `kullanici_hakkinda`
  MODIFY `hakkimda_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici_mail`
--
ALTER TABLE `kullanici_mail`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici_profil`
--
ALTER TABLE `kullanici_profil`
  MODIFY `profil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici_sifre`
--
ALTER TABLE `kullanici_sifre`
  MODIFY `sifre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici_telefon`
--
ALTER TABLE `kullanici_telefon`
  MODIFY `telefon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `mesaj_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `postlar`
--
ALTER TABLE `postlar`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `profil_resimleri`
--
ALTER TABLE `profil_resimleri`
  MODIFY `resim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `resimler`
--
ALTER TABLE `resimler`
  MODIFY `resim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `sosyal_medya`
--
ALTER TABLE `sosyal_medya`
  MODIFY `medya_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `takip`
--
ALTER TABLE `takip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `yazilar`
--
ALTER TABLE `yazilar`
  MODIFY `yazi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `bildirimler`
--
ALTER TABLE `bildirimler`
  ADD CONSTRAINT `bildirimler_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici_profil` (`profil_id`),
  ADD CONSTRAINT `bildirimler_ibfk_2` FOREIGN KEY (`yorum_id`) REFERENCES `yorumlar` (`yorum_id`);

--
-- Tablo kısıtlamaları `giris`
--
ALTER TABLE `giris`
  ADD CONSTRAINT `giris_ibfk_1` FOREIGN KEY (`mail_id`) REFERENCES `kullanici_mail` (`mail_id`),
  ADD CONSTRAINT `giris_ibfk_2` FOREIGN KEY (`sifre_id`) REFERENCES `kullanici_sifre` (`sifre_id`);

--
-- Tablo kısıtlamaları `kullanici_profil`
--
ALTER TABLE `kullanici_profil`
  ADD CONSTRAINT `kullanici_profil_ibfk_1` FOREIGN KEY (`mail_id`) REFERENCES `kullanici_mail` (`mail_id`),
  ADD CONSTRAINT `kullanici_profil_ibfk_2` FOREIGN KEY (`sifre_id`) REFERENCES `kullanici_sifre` (`sifre_id`),
  ADD CONSTRAINT `kullanici_profil_ibfk_3` FOREIGN KEY (`telefon_id`) REFERENCES `kullanici_telefon` (`telefon_id`),
  ADD CONSTRAINT `kullanici_profil_ibfk_4` FOREIGN KEY (`bolum_id`) REFERENCES `bolum` (`bolum_id`),
  ADD CONSTRAINT `kullanici_profil_ibfk_5` FOREIGN KEY (`alan_id`) REFERENCES `alan` (`alan_id`),
  ADD CONSTRAINT `kullanici_profil_ibfk_6` FOREIGN KEY (`profil_resim_id`) REFERENCES `profil_resimleri` (`resim_id`),
  ADD CONSTRAINT `kullanici_profil_ibfk_7` FOREIGN KEY (`hakkinda_id`) REFERENCES `kullanici_hakkinda` (`hakkimda_id`);

--
-- Tablo kısıtlamaları `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD CONSTRAINT `mesajlar_ibfk_1` FOREIGN KEY (`gonderen_id`) REFERENCES `kullanici_profil` (`profil_id`),
  ADD CONSTRAINT `mesajlar_ibfk_2` FOREIGN KEY (`alici_id`) REFERENCES `kullanici_profil` (`profil_id`);

--
-- Tablo kısıtlamaları `postlar`
--
ALTER TABLE `postlar`
  ADD CONSTRAINT `postlar_ibfk_1` FOREIGN KEY (`profil_id`) REFERENCES `kullanici_profil` (`profil_id`),
  ADD CONSTRAINT `postlar_ibfk_2` FOREIGN KEY (`yazi_id`) REFERENCES `yazilar` (`yazi_id`);

--
-- Tablo kısıtlamaları `post_resim`
--
ALTER TABLE `post_resim`
  ADD CONSTRAINT `post_resim_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `postlar` (`post_id`),
  ADD CONSTRAINT `post_resim_ibfk_2` FOREIGN KEY (`resim_id`) REFERENCES `resimler` (`resim_id`);

--
-- Tablo kısıtlamaları `sosyal_medya`
--
ALTER TABLE `sosyal_medya`
  ADD CONSTRAINT `sosyal_medya_ibfk_1` FOREIGN KEY (`profil_id`) REFERENCES `kullanici_profil` (`profil_id`);

--
-- Tablo kısıtlamaları `takip`
--
ALTER TABLE `takip`
  ADD CONSTRAINT `takip_ibfk_1` FOREIGN KEY (`takip_eden_id`) REFERENCES `kullanici_profil` (`profil_id`),
  ADD CONSTRAINT `takip_ibfk_2` FOREIGN KEY (`takip_edilen_id`) REFERENCES `kullanici_profil` (`profil_id`);

--
-- Tablo kısıtlamaları `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `postlar` (`post_id`),
  ADD CONSTRAINT `yorumlar_ibfk_2` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici_profil` (`profil_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
