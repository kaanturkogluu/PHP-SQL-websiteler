-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 May 2023, 12:50:31
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
-- Veritabanı: `hobbyhome`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ad` text NOT NULL,
  `sifre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `ad`, `sifre`) VALUES
(1, 'İlayda Tekeli', '123456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `baslik` varchar(100) NOT NULL,
  `alt_baslik` varchar(255) NOT NULL,
  `aciklama` text NOT NULL,
  `resim` varchar(255) NOT NULL,
  `tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `aktif` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `blog`
--

INSERT INTO `blog` (`id`, `baslik`, `alt_baslik`, `aciklama`, `resim`, `tarih`, `aktif`) VALUES
(28, 'Futbol', 'Futbol Taktikleri ve Oyun Stilleri: Farklı takımların kullandığı taktikler, oyun planları ve farklı oyun stili yaklaşımları.', '&lt;p&gt;utbol, d&amp;uuml;nyada en pop&amp;uuml;ler ve sevilen sporlardan biridir. İki takım arasında oynanan bir m&amp;uuml;sabaka şeklinde ger&amp;ccedil;ekleşen futbol, heyecanı, stratejisi ve oyuncuların yetenekleriyle birleşerek milyonlarca insanı kendine &amp;ccedil;ekmektedir.&lt;/p&gt;\r\n&lt;p&gt;Futbolun k&amp;ouml;kenleri antik &amp;ccedil;ağlara dayanır. İnsanlar, top benzeri nesneleri birbirlerine paslaşarak veya farklı şekillerde oynayarak eğlenceli bir aktivite haline getirdiler. Ancak modern futbolun temelleri 19. y&amp;uuml;zyılda atıldı. İngiltere&#039;de ortaya &amp;ccedil;ıkan kurallar ve organize m&amp;uuml;sabakalar, futbolun yayılmasını sağladı ve d&amp;uuml;nya genelinde b&amp;uuml;y&amp;uuml;k bir takip&amp;ccedil;i kitlesi oluştu.&lt;/p&gt;\r\n&lt;p&gt;Futbol, belirli bir oyun alanında 11 oyuncuyla oynanan takım sporudur. Ama&amp;ccedil;, rakip takımın kalesine topu sokarak gol atmaktır. Oyuncular, topu paslaşarak ilerletir, şut &amp;ccedil;eker, dripling yapar ve takım stratejilerini uygularlar. Futbol, fiziksel yeteneklerin yanı sıra strateji, hız, dayanıklılık ve koordinasyon gerektirir.&lt;/p&gt;\r\n&lt;p&gt;Futbol, ulusal ligler, uluslararası turnuvalar ve d&amp;uuml;nya &amp;ccedil;apında &amp;uuml;nl&amp;uuml; oyuncularıyla b&amp;uuml;y&amp;uuml;k bir organizasyon ağına sahiptir. FIFA D&amp;uuml;nya Kupası, futbolun en prestijli turnuvası olarak kabul edilir ve her d&amp;ouml;rt yılda bir d&amp;uuml;zenlenir. UEFA Şampiyonlar Ligi, Avrupa kul&amp;uuml;plerinin m&amp;uuml;cadele ettiği heyecan verici bir turnuvadır.&lt;/p&gt;\r\n&lt;p&gt;Futbol, sadece bir spor etkinliği değil aynı zamanda bir k&amp;uuml;lt&amp;uuml;r ve birleştirici bir g&amp;uuml;&amp;ccedil;t&amp;uuml;r. Ma&amp;ccedil;lar, taraftarlar i&amp;ccedil;in bir buluşma ve coşku kaynağıdır. Trib&amp;uuml;nlerdeki tezah&amp;uuml;ratlar, takım renkleri ve marşlar, futbolun sosyal ve toplumsal etkisini g&amp;ouml;sterir. Ayrıca, futbolun &amp;ccedil;ocukların fiziksel aktiviteye teşvik etmesi, toplumsal değerleri &amp;ouml;ğretmesi ve dostlukları g&amp;uuml;&amp;ccedil;lendirmesi gibi olumlu etkileri de vardır.&lt;/p&gt;\r\n&lt;p&gt;Futbol, yıllar boyunca bir&amp;ccedil;ok unutulmaz anı ve efsanevi oyuncuyu da beraberinde getirdi. Pele, Diego Maradona, Lionel Messi, Cristiano Ronaldo gibi isimler futbol tarihinde yer edinmiş ve b&amp;uuml;y&amp;uuml;k bir hayran kitlesi oluşturmuştur.&lt;/p&gt;\r\n&lt;p&gt;Sonu&amp;ccedil; olarak, futbol, tutkusu, heyecanı ve evrenselliğiyle d&amp;uuml;nyanın en sevilen sporlarından biridir. Her yaş grubundan insanın ilgisini &amp;ccedil;eken futbol, oyuncuların yeteneklerini g&amp;ouml;sterebilir.&lt;/p&gt;', '3449710292.jpg', '2023-05-18 15:10:49', 1),
(29, 'Bisiklet sürmek', 'Bisikletin  size faydaları', '&lt;p&gt;Bisiklet s&amp;uuml;rmek, insanlar i&amp;ccedil;in hem bir spor aktivitesi hem de bir ulaşım aracı olarak yaygın olarak kullanılan bir faaliyettir. Bisiklet, pedallarla g&amp;uuml;&amp;ccedil; sağlanarak hareket ettirilen iki tekerlekli bir ara&amp;ccedil;tır. Bisiklet s&amp;uuml;rmek, bir&amp;ccedil;ok kişi i&amp;ccedil;in eğlenceli, sağlıklı ve &amp;ouml;zg&amp;uuml;rleştirici bir deneyim sunar.&lt;/p&gt;\r\n&lt;p&gt;Bisiklet s&amp;uuml;rmenin bir&amp;ccedil;ok farklı y&amp;ouml;n&amp;uuml; vardır. İşte bisiklet s&amp;uuml;rmekle ilgili bazı &amp;ouml;nemli noktalar:&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Sağlık ve Fitness: Bisiklet s&amp;uuml;rmek, fiziksel kondisyonu artırır ve kardiyovask&amp;uuml;ler sağlığı destekler. Bisiklet s&amp;uuml;rmek, kalp ve akciğerleri g&amp;uuml;&amp;ccedil;lendirir, kas tonusunu artırır ve v&amp;uuml;cut yağını azaltmaya yardımcı olur.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Ulaşım: Bisiklet, kısa mesafelerde &amp;ccedil;evre dostu ve hızlı bir ulaşım aracıdır. Trafik sıkışıklığından ka&amp;ccedil;ınmak, park yeri bulma sorununu aşmak ve toplu taşıma maliyetlerini azaltmak i&amp;ccedil;in bisiklet s&amp;uuml;rmek tercih edilebilir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Doğa ve &amp;Ccedil;evreyle Bağlantı: Bisiklet s&amp;uuml;rmek, doğayla daha yakın bir temas sağlar. Bisikletle yapılan turlar, doğal g&amp;uuml;zellikleri keşfetmek ve a&amp;ccedil;ık havada zaman ge&amp;ccedil;irmek i&amp;ccedil;in harika bir fırsattır. Aynı zamanda &amp;ccedil;evre dostu bir ulaşım şekli olduğu i&amp;ccedil;in doğal kaynakları korumaya katkı sağlar.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Stres Azaltma: Bisiklet s&amp;uuml;rmek, stresi azaltmaya ve zihni rahatlatmaya yardımcı olur. Hareket halindeyken doğayı izlemek, zihni boşaltmak ve g&amp;uuml;nl&amp;uuml;k endişelerden uzaklaşmak i&amp;ccedil;in bisiklet s&amp;uuml;rmek terap&amp;ouml;tik bir etkiye sahip olabilir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Sosyal Etkileşim: Bisiklet s&amp;uuml;rmek, gruplar halinde yapıldığında sosyal etkileşimi teşvik eder. Bisiklet kul&amp;uuml;plerine katılarak veya bisiklet etkinliklerine katılarak benzer ilgiye sahip insanlarla tanışabilir ve paylaşılan deneyimlerle bağlar kurabilirsiniz.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Yarış ve Rekabet: Bisiklet s&amp;uuml;rmek, yarışlarda veya spor etkinliklerinde rekabet etmek i&amp;ccedil;in bir fırsat sunar. Bisiklet yarışları, dayanıklılık, hız ve taktik becerilerini test etmek i&amp;ccedil;in uygundur.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Teknik Beceriler: Bisiklet s&amp;uuml;rmek, denge, koordinasyon ve motor becerilerini geliştirir. Bisiklet kullanmak, trafik kurallarına uymayı &amp;ouml;ğrenmek, g&amp;uuml;venli bir şekilde s&amp;uuml;rmek ve yolculuk...&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;/ol&gt;', '3348037120.jpg', '2023-05-18 15:12:12', 1),
(30, 'Koşu yapmak', 'Koşu yapmak, insanlar için popüler bir spor aktivitesi ve sağlıklı bir yaşam tarzının önemli bir parçasıdır...', '&lt;p&gt;Koşu yapmak, insanlar i&amp;ccedil;in pop&amp;uuml;ler bir spor aktivitesi ve sağlıklı bir yaşam tarzının &amp;ouml;nemli bir par&amp;ccedil;asıdır. Hem fiziksel hem de zihinsel sağlığa bir&amp;ccedil;ok faydası olan koşu, bir&amp;ccedil;ok kişi i&amp;ccedil;in enerji verici, stres atıcı ve motive edici bir deneyim sunar. İşte koşu yapmakla ilgili &amp;ouml;nemli noktaları i&amp;ccedil;eren 200 satırlık bir yazı:&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Koşunun Faydaları: Koşu yapmanın bir&amp;ccedil;ok sağlık faydası vardır. Kalp ve dolaşım sistemini g&amp;uuml;&amp;ccedil;lendirir, kardiyovask&amp;uuml;ler dayanıklılığı artırır, kan dolaşımını iyileştirir, bağışıklık sistemini destekler, kilo kontrol&amp;uuml;ne yardımcı olur, kemik sağlığını korur ve genel fitness d&amp;uuml;zeyini artırır.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Kondisyon ve Dayanıklılık: Koşu yapmak, genel kondisyonu ve dayanıklılığı artırmak i&amp;ccedil;in etkili bir y&amp;ouml;ntemdir. D&amp;uuml;zenli koşu, kasları g&amp;uuml;&amp;ccedil;lendirir, kardiyovask&amp;uuml;ler sistemini iyileştirir ve solunum kapasitesini artırır.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Kilo Kaybı: Koşu, kalori yakmanın etkili bir yoludur ve kilo kaybı hedeflerine ulaşmada yardımcı olabilir. Y&amp;uuml;ksek yoğunluklu koşu, v&amp;uuml;cut yağını azaltmaya yardımcı olur ve metabolizmayı hızlandırır.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Mental Sağlık: Koşu, stresi azaltmaya ve zihinsel sağlığı iyileştirmeye yardımcı olur. Koşu sırasında salgılanan endorfinler, mutluluk hissi ve stresin azalmasına katkı sağlar. Aynı zamanda koşu, depresyon, anksiyete ve stresle m&amp;uuml;cadelede etkili bir stratejidir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Hedefler Belirleme: Koşu yapmak, hedefler belirlemek ve bunlara ulaşmak i&amp;ccedil;in motive edicidir. Bir maraton koşmak, belirli bir s&amp;uuml;rede mesafe katetmek veya kişisel en iyi dereceyi ge&amp;ccedil;mek gibi hedefler, koşuculara ilham verir ve s&amp;uuml;rekli gelişimi teşvik eder.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Esneklik ve Kolaylık: Koşu, neredeyse her yerde yapılabilen bir spor aktivitesidir. Parklarda, sokaklarda, koşu pistlerinde veya koşu bantlarında koşabilirsiniz. Ayrıca, koşu i&amp;ccedil;in &amp;ouml;zel bir ekipmana veya b&amp;uuml;y&amp;uuml;k bir harcamaya ihtiya&amp;ccedil; yoktur. Sadece bir &amp;ccedil;ift uygun koşu ayakkabısıyla başlayabilirsiniz.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Sosyal Etkileşim: Koşu, gruplar halinde yapıldığında sosyal etkileşimi teşvik eder. Koşu kul&amp;uuml;plerine&amp;nbsp; katılın&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;/ol&gt;', '4881923733.jpg', '2023-05-18 15:13:24', 1),
(31, 'Basketbol', 'Basketbol, iki takım arasında oynanan, topu panoya atarak skor yapma amacı olan bir oyundur. Her takım, 5 oyuncudan oluşur ve oyun alanı, bir sıradan yüksek pano ile sınırlıdır. Oyunun amacı, topu rakip takımın panosuna atmaktır.', '&lt;p&gt;Basketbol, heyecan verici bir takım sporu ve d&amp;uuml;nya genelinde b&amp;uuml;y&amp;uuml;k bir pop&amp;uuml;lerliğe sahip. Hem profesyonel liglerde hem de sokak sahalarında oynanan basketbol, fiziksel yetenekleri, stratejiyi ve takım &amp;ccedil;alışmasını bir araya getirir. İşte basketbol oynamakla ilgili 250 satırlık bir yazı:&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Basketbolun K&amp;ouml;keni: Basketbol, 1891 yılında Dr. James Naismith tarafından Amerika Birleşik Devletleri&#039;nde icat edildi. Naismith, sporu kış mevsiminde kapalı alanlarda oynanabilecek bir aktivite olarak tasarladı.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Oyun Kuralları: Basketbolun temel amacı, takımların topu rakip takımın potasına sokarak sayı elde etmektir. Beşer kişilik iki takımın karşılaştığı ma&amp;ccedil;larda, oyuncular topu paslaşarak ilerletir, şut atar, savunma yapar ve h&amp;uuml;cum ve savunma stratejilerini uygular.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Fiziksel Beceriler: Basketbol oynamak, bir&amp;ccedil;ok fiziksel beceriyi gerektirir. Denge, koordinasyon, hız, &amp;ccedil;eviklik, zıplama yeteneği ve el-g&amp;ouml;z koordinasyonu, başarılı bir basketbolcu olmak i&amp;ccedil;in &amp;ouml;nemli fakt&amp;ouml;rlerdir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Takım &amp;Ccedil;alışması: Basketbol, takım &amp;ccedil;alışmasının &amp;ouml;nemli olduğu bir spor dalıdır. Oyuncuların birbirleriyle etkileşim i&amp;ccedil;inde olması, paslaşma becerileri, uyum ve takım stratejilerine uyum sağlamak &amp;ouml;nemlidir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Strateji ve Taktikler: Basketbol, strateji ve taktiklerin &amp;ouml;nemli olduğu bir spor dalıdır. H&amp;uuml;cum ve savunma stratejileri, pick-and-roll, b&amp;ouml;lgesel savunma, h&amp;uuml;cum setleri gibi taktikler, takımların başarıya ulaşmasında &amp;ouml;nemli bir rol oynar.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Fitness ve Kondisyon: Basketbol oynamak, kardiyovask&amp;uuml;ler dayanıklılığı artırır, kasları g&amp;uuml;&amp;ccedil;lendirir ve genel fitness d&amp;uuml;zeyini y&amp;uuml;kseltir. S&amp;uuml;rekli hareket halinde olmak, koşu, zıplama ve hız gerektiren bir spor olduğundan, fiziksel kondisyonun &amp;ouml;nemli olduğu bir aktivitedir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Rekabet ve Motivasyon: Basketbol, rekabet&amp;ccedil;i bir spordur ve oyuncuları motive eder. Ma&amp;ccedil;lardaki rekabet, oyuncuların kendilerini geliştirmelerini ve en iyi performanslarını sergilemelerini teşvik eder.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Stratejik D&amp;uuml;ş&amp;uuml;nme: Basketbol oynamak, stratejik d&amp;uuml;ş&amp;uuml;nmeyi teşvik eder. Oyun sırasında hızlı kararlar vermek, takım arkadaşlarıyla iletişim kurmak ve rakip takım...&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;&amp;nbsp;&lt;/li&gt;\r\n&lt;/ol&gt;', '2361126495.jpg', '2023-05-18 15:16:39', 1),
(32, 'Voleybol', 'Voleybol: Heyecan Verici Bir Takım Sporu', '&lt;p&gt;Voleybol, heyecan verici bir takım sporu ve bir&amp;ccedil;ok kişi tarafından oynanan pop&amp;uuml;ler bir aktivitedir. İşte voleybol ile ilgili 100 satırlık bir yazı:&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Oyunun K&amp;ouml;keni: Voleybol, 19. y&amp;uuml;zyılın sonlarında Amerika Birleşik Devletleri&#039;nde icat edildi. William G. Morgan tarafından geliştirilen spor, başlangı&amp;ccedil;ta &quot;mintonette&quot; olarak adlandırıldı ve zamanla g&amp;uuml;n&amp;uuml;m&amp;uuml;zdeki voleybol haline d&amp;ouml;n&amp;uuml;şt&amp;uuml;.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Oyunun Amacı: Voleybol, iki takım arasında ağın &amp;uuml;zerinden topun paslaşarak karşı tarafa ge&amp;ccedil;irilmesiyle oynanan bir spor dalıdır. Amacı, topu rakip takımın sahasına d&amp;uuml;ş&amp;uuml;rmek ve sayı elde etmektir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Takım ve Oyuncular: Voleybol, iki takım arasında oynanan bir takım sporudur. Her takım, altı oyuncudan oluşur ve belirli pozisyonlarda g&amp;ouml;rev alır. Orta oyuncular, pas&amp;ouml;rler, sma&amp;ccedil;&amp;ouml;rler ve libero gibi farklı pozisyonlar bulunur.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Sahanın &amp;Ouml;zellikleri: Voleybol sahası dikd&amp;ouml;rtgen şeklinde olup, ortasında ağ bulunur. Her takım kendi yarı sahasında servis atar ve rakip takımın sahasına topu ge&amp;ccedil;irmeye &amp;ccedil;alışır. Oyuncular, topu elle paslaşarak karşı tarafa iletir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Fiziksel Yetenekler: Voleybol oynamak, bir&amp;ccedil;ok fiziksel yeteneği gerektirir. Hız, &amp;ccedil;eviklik, zıplama g&amp;uuml;c&amp;uuml;, el-g&amp;ouml;z koordinasyonu ve denge gibi beceriler, başarılı bir voleybolcu olmak i&amp;ccedil;in &amp;ouml;nemlidir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Strateji ve Taktikler: Voleybol, strateji ve taktiklerin &amp;ouml;nemli olduğu bir spor dalıdır. H&amp;uuml;cum ve savunma stratejileri, bloklama, pas se&amp;ccedil;imleri, hızlı h&amp;uuml;cum gibi taktikler, takımların başarıya ulaşmasında etkili olur.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;İletişim ve Takım &amp;Ccedil;alışması: Voleybol, takım &amp;ccedil;alışmasının &amp;ouml;nemli olduğu bir spor dalıdır. Oyuncuların birbirleriyle iletişim kurması, paslaşma becerileri ve takım stratejilerine uyum sağlaması gerekmektedir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Fitness ve Kondisyon: Voleybol oynamak, kardiyovask&amp;uuml;ler dayanıklılığı artırır, kasları g&amp;uuml;&amp;ccedil;lendirir ve genel fitness d&amp;uuml;zeyini y&amp;uuml;kseltir. S&amp;uuml;rekli hareket halinde olmak, hızlı hareketler yapmak ve zıplama becerisi gerektiren bir spor olduğundan, fiziksel kondisyonun &amp;ouml;nemli olduğu bir aktivitedir.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;Rekabet ve Motivasyon: Voleybol, rekabet&amp;ccedil;i bir spordur&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;/ol&gt;', '3467639484.jpg', '2023-05-18 15:18:32', 1),
(33, 'Yüzme', 'Yüzme nin size faydaları', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, su &amp;uuml;zerinde veya su altında ilerlemek i&amp;ccedil;in kullanılan bir spor ve rekreasyon aktivitesidir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, v&amp;uuml;cut i&amp;ccedil;in d&amp;uuml;ş&amp;uuml;k etkili bir egzersizdir ve kasları g&amp;uuml;&amp;ccedil;lendirir, esnekliği artırır ve kardiyovask&amp;uuml;ler dayanıklılığı geliştirir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, bir&amp;ccedil;ok yaş grubundan insan i&amp;ccedil;in uygundur ve &amp;ccedil;ocuklara su g&amp;uuml;venliği becerilerini &amp;ouml;ğretmeye yardımcı olur.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, kalori yakmayı teşvik eder ve kilo kontrol&amp;uuml;ne yardımcı olabilir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, stresi azaltabilir ve genel bir iyilik hissi sağlayabilir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, t&amp;uuml;m v&amp;uuml;cut kaslarını &amp;ccedil;alıştırır ve v&amp;uuml;cut şeklini geliştirmeye yardımcı olur.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, koordinasyonu geliştirir ve dengeyi artırır.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, eklemlere ve kemiklere minimal stres uygular, bu nedenle sakatlanma riskini azaltır.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, solunum kapasitesini artırır ve akciğer fonksiyonunu iyileştirir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, kardiyovask&amp;uuml;ler hastalık riskini azaltır ve kan dolaşımını iyileştirir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, kasları uzatır ve esnekliği artırır.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, metabolizmayı hızlandırır ve enerji seviyelerini y&amp;uuml;kseltir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, sıcak havalarda serinlemek i&amp;ccedil;in harika bir se&amp;ccedil;enektir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, v&amp;uuml;cutta biriken toksinleri atmayı teşvik eder ve detoks etkisi sağlar.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, post&amp;uuml;r&amp;uuml; d&amp;uuml;zeltir ve duruşu iyileştirir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, uyku kalitesini artırır ve uykusuzlukla m&amp;uuml;cadelede yardımcı olabilir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, sosyal bir aktivite olarak aile ve arkadaşlar arasındaki bağları g&amp;uuml;&amp;ccedil;lendirebilir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, suya karşı diren&amp;ccedil; yaratır ve kas g&amp;uuml;c&amp;uuml;n&amp;uuml; artırır.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, dayanıklılığı artırır ve genel fiziksel performansı geliştirir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, astım semptomlarını hafifletebilir ve solunum kontrol&amp;uuml;n&amp;uuml; sağlar.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, yaralanma rehabilitasyonunda kullanılabilir ve kasları g&amp;uuml;&amp;ccedil;lendirerek iyileşmeyi hızlandırabilir.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, stres hormonu kortizol seviyelerini azaltır ve mutluluk hormonu endorfin salgılar.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, suya bağlı diren&amp;ccedil; nedeniyle kalori yakma potansiyelini artırır.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, kalp sağlığını destekler ve kan basıncını d&amp;uuml;zenler.&lt;/li&gt;\r\n&lt;li&gt;Y&amp;uuml;zme, v&amp;uuml;cutta daha fazla&lt;/li&gt;\r\n&lt;/ol&gt;', '3867222585.jpg', '2023-05-18 15:21:41', 1),
(34, 'Tenis', 'Size Faydaları', '&lt;ol&gt;\r\n&lt;li&gt;Tenis, iki veya d&amp;ouml;rt oyuncu arasında oynanan bir raket sporudur.&lt;/li&gt;\r\n&lt;li&gt;Tenis, beceri, strateji ve dayanıklılığı gerektiren rekabet&amp;ccedil;i bir spor dalıdır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, genellikle a&amp;ccedil;ık havada veya kapalı kortlarda oynanır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, t&amp;uuml;m v&amp;uuml;cut kaslarını &amp;ccedil;alıştırır ve koordinasyonu geliştirir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, kardiyovask&amp;uuml;ler sağlığı iyileştirir ve dayanıklılığı artırır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, refleksleri hızlandırır ve el-g&amp;ouml;z koordinasyonunu geliştirir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, kalori yakmayı teşvik eder ve kilo kontrol&amp;uuml;ne yardımcı olabilir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, stresi azaltır ve genel bir iyilik hissi sağlar.&lt;/li&gt;\r\n&lt;li&gt;Tenis, sosyal bir spor olup, arkadaşlarla veya aile &amp;uuml;yeleriyle oynanabilir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, odaklanmayı ve stratejik d&amp;uuml;ş&amp;uuml;nmeyi gerektirir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, beyin fonksiyonlarını geliştirir ve zihinsel keskinliği artırır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, eklemlere ve kemiklere minimal stres uygular, bu nedenle sakatlanma riskini azaltır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, v&amp;uuml;cut dengesini ve esnekliğini artırır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, kendine g&amp;uuml;veni artırır ve &amp;ouml;z disiplini teşvik eder.&lt;/li&gt;\r\n&lt;li&gt;Tenis, hızlı ve yavaş kas liflerini &amp;ccedil;alıştırır, b&amp;ouml;ylece kas g&amp;uuml;c&amp;uuml;n&amp;uuml; artırır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, kalp sağlığını destekler ve kan dolaşımını iyileştirir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, kemik yoğunluğunu artırır ve osteoporoz riskini azaltır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, &amp;ouml;zg&amp;uuml;veni ve liderlik becerilerini geliştirir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, &amp;ccedil;evikliği artırır ve v&amp;uuml;cut kontrol&amp;uuml;n&amp;uuml; sağlar.&lt;/li&gt;\r\n&lt;li&gt;Tenis, zaman y&amp;ouml;netimi becerilerini geliştirir ve planlama yapmayı &amp;ouml;ğretir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, bireysel ve takım oyunu olarak oynanabilir.&lt;/li&gt;\r\n&lt;li&gt;Tenis, yaşam boyu s&amp;uuml;ren bir spor olup, her yaş grubundan insan i&amp;ccedil;in uygundur.&lt;/li&gt;\r\n&lt;li&gt;Tenis, esnek olmayı teşvik eder ve kasların esnekliğini artırır.&lt;/li&gt;\r\n&lt;li&gt;Tenis, disiplin ve &amp;ouml;z disiplin kazanmayı sağlar.&lt;/li&gt;\r\n&lt;li&gt;Tenis, rekabet&amp;ccedil;i ruhu destekler ve motive eder.&lt;/li&gt;\r\n&lt;/ol&gt;', '1201943186.jpg', '2023-05-18 15:22:30', 1),
(35, 'Yoga yapmak', 'Size Faydaları', '&lt;ol&gt;\r\n&lt;li&gt;Yoga, Hindistan k&amp;ouml;kenli bir egzersiz ve meditasyon sistemidir.&lt;/li&gt;\r\n&lt;li&gt;Asırlardır uygulanan yoga, bedeni, zihni ve ruhu dengelemeyi ama&amp;ccedil;lar.&lt;/li&gt;\r\n&lt;li&gt;Yoga, esneklik, denge, g&amp;uuml;&amp;ccedil; ve koordinasyonu artırır.&lt;/li&gt;\r\n&lt;li&gt;Yoga pozları (asana), v&amp;uuml;cuttaki kasları g&amp;uuml;&amp;ccedil;lendirir ve esnetir.&lt;/li&gt;\r\n&lt;li&gt;D&amp;uuml;zenli yoga pratiği, stresi azaltır ve rahatlama sağlar.&lt;/li&gt;\r\n&lt;li&gt;Yoga nefes teknikleri (pranayama) kullanır ve nefesi d&amp;uuml;zenler.&lt;/li&gt;\r\n&lt;li&gt;Nefes farkındalığı, zihni sakinleştirir ve odaklanmayı artırır.&lt;/li&gt;\r\n&lt;li&gt;Yoga, duruş bozukluklarını d&amp;uuml;zeltmeye yardımcı olabilir.&lt;/li&gt;\r\n&lt;li&gt;V&amp;uuml;cuttaki enerji merkezleri olan &amp;ccedil;akralar &amp;uuml;zerinde etkilidir.&lt;/li&gt;\r\n&lt;li&gt;Yoga, dolaşımı iyileştirir ve i&amp;ccedil; organların işlevini destekler.&lt;/li&gt;\r\n&lt;li&gt;Meditasyon, yoga pratiğinin &amp;ouml;nemli bir par&amp;ccedil;asıdır ve zihni sakinleştirir.&lt;/li&gt;\r\n&lt;li&gt;Yoga, uyku kalitesini artırır ve uyku problemlerini hafifletebilir.&lt;/li&gt;\r\n&lt;li&gt;Yoga, sindirim sistemini d&amp;uuml;zenler ve sindirim sorunlarını azaltır.&lt;/li&gt;\r\n&lt;li&gt;Yoga, bağışıklık sistemini g&amp;uuml;&amp;ccedil;lendirir ve hastalıklara karşı direnci artırır.&lt;/li&gt;\r\n&lt;li&gt;Yoga, yaşlanma s&amp;uuml;recini yavaşlatır ve esnekliği korur.&lt;/li&gt;\r\n&lt;li&gt;Yoga pratiği, kasların tonlanmasına ve v&amp;uuml;cut şeklinin iyileştirilmesine yardımcı olur.&lt;/li&gt;\r\n&lt;li&gt;Yoga, sinir sisteminin rahatlamasına ve sakinleşmesine yardımcı olur.&lt;/li&gt;\r\n&lt;li&gt;Yoga, zihinsel odaklanmayı ve konsantrasyonu geliştirir.&lt;/li&gt;\r\n&lt;li&gt;Yoga, i&amp;ccedil;sel dengeyi sağlar ve duygusal istikrarı artırır.&lt;/li&gt;\r\n&lt;/ol&gt;', '1924626924.jpg', '2023-05-18 15:24:01', 1),
(36, 'Deneme Yazsısı', '.', '&lt;p&gt;.&lt;/p&gt;', '2392323489.png', '2023-05-26 13:34:41', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `id` int(11) NOT NULL,
  `aciklama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hakkimizda`
--

INSERT INTO `hakkimizda` (`id`, `aciklama`) VALUES
(8, '&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;&lt;strong&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse laoreet erat ligula, eu blandit odio maximus ut. Proin tincidunt maximus blandit. Nulla euismod urna ac est dignissim imperdiet. Nam nec nunc vel diam accumsan maximus a vel ex. Duis eget urna id ligula &lt;/strong&gt;malesuada faucibus at a ex. Pellentesque at leo mi. Aliquam tempor faucibus felis ac facilisis. Fusce egestas lectus eu felis vulputate mattis non euismod risus. Nullam nec odio non neque lacinia placerat. Quisque ut purus condimentum, semper leo luctus, pulvinar odio. Cras laoreet mi id justo tempus tincidunt. Nam eros urna, laoreet eget posuere ac, vestibulum sit amet arcu. Donec eget semper nibh.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Ut aliquam arcu convallis ipsum vulputate, in aliquam sem vehicula. Curabitur vitae dapibus erat. Quisque egestas faucibus ligula, iaculis rhoncus enim aliquam et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut suscipit tempus mollis. Praesent sodales feugiat felis blandit elementum. Mauris sagittis et arcu sed consequat. Nulla venenatis enim ac ante efficitur sodales. Donec laoreet auctor posuere. Aenean porttitor, tortor et consequat auctor, arcu metus elementum libero, a suscipit diam leo vitae dolor. Vivamus egestas quam ac ipsum cursus, id blandit nulla lobortis. Aliquam erat volutpat. Quisque aliquet a erat vitae fermentum. Maecenas posuere rutrum est sit amet finibus.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Praesent convallis, turpis sit amet faucibus efficitur, enim nibh egestas nunc, vitae eleifend ante arcu non nisi. In commodo vulputate posuere. Curabitur metus ligula, bibendum sed mi at, fermentum finibus justo. Ut malesuada felis eu sagittis ullamcorper. Praesent feugiat elementum ex, vitae dictum ligula maximus id. Quisque placerat nisl sed diam ultrices varius. Pellentesque ex nulla, tempus eu tellus sed, sollicitudin vulputate nisi.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Sed a vehicula nunc. Aenean aliquet sagittis purus, non aliquet magna eleifend non. Aliquam sed feugiat est, at auctor nisi. Donec mollis purus et massa tempor malesuada. Vestibulum fermentum interdum ante, ac blandit nulla venenatis quis. Nulla ut dolor feugiat, commodo lectus quis, faucibus justo. Nunc laoreet laoreet pulvinar. Morbi finibus, purus eu sollicitudin faucibus, dui velit ultricies quam, ut consequat ante odio imperdiet nunc. Curabitur eu enim finibus arcu luctus sagittis in nec nunc. Mauris sit amet elementum eros, eget interdum nisl. In porta varius justo. Mauris vitae pretium metus, sit amet placerat quam. Pellentesque varius est ipsum, a pulvinar diam rutrum ut. Nam in sem eu velit mollis venenatis. Pellentesque ultrices tortor eget justo imperdiet mattis. Morbi lacus enim, maximus quis risus vel, gravida commodo dui.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Sed eget ligula porta, faucibus augue at, pellentesque quam. Vestibulum vitae imperdiet lorem, id eleifend erat. Nam lacus est, maximus ut purus pharetra, rhoncus rhoncus mi. Suspendisse mollis turpis nec sapien feugiat sodales. Etiam vulputate, dolor quis convallis tincidunt, nibh nunc rhoncus tortor, at pellentesque risus tellus eget ipsum. Sed at faucibus nibh, nec ultrices turpis. Vivamus erat massa, ornare at tempus faucibus, vehicula nec libero. Donec malesuada ipsum eu mauris ullamcorper euismod. Praesent vel diam quis eros sollicitudin pretium nec quis orci. Praesent congue mauris quam, aliquam ullamcorper urna tempus vel. Nunc convallis id purus dictum sagittis.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Praesent ornare, lectus ut malesuada blandit, quam enim molestie ante, et fringilla turpis ligula vitae augue. Morbi mollis luctus enim, ac pretium diam dignissim quis. Curabitur gravida velit at quam semper molestie. Vestibulum fermentum ante et blandit auctor. Maecenas consectetur tempus velit. Praesent quis blandit nisi. Suspendisse faucibus posuere augue bibendum dapibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque auctor aliquam magna, ac aliquam nibh tempor sed. Sed ac cursus tortor. Nunc vulputate porta iaculis. Vestibulum interdum nunc ut lorem blandit, pretium posuere urna dictum. Integer nibh ipsum, vehicula quis nisl eget, dapibus faucibus lacus.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Nam id metus vel odio fringilla elementum. Fusce tempor consequat sapien vel ultrices. Integer molestie dictum sapien, in volutpat est tincidunt facilisis. Donec elementum a enim non aliquet. Etiam nisl urna, aliquam nec metus sit amet, egestas molestie magna. Maecenas ut tempor velit, vel gravida metus. Duis interdum odio ac eros ullamcorper posuere. Aenean ac orci non augue interdum vestibulum nec eu leo.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Etiam est turpis, euismod eget fermentum id, aliquam sed nisi. Suspendisse condimentum quam ac tellus hendrerit mattis. Nunc in turpis at eros vestibulum venenatis ac non magna. Quisque iaculis feugiat laoreet. Nunc elit ex, commodo non vehicula non, volutpat eget lorem. Praesent vel mi ex. Nulla pulvinar ligula nec neque pellentesque, vel mattis enim facilisis. Phasellus a eleifend felis.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Pellentesque laoreet ex lorem, vitae tincidunt libero interdum ut. Phasellus arcu dolor, vulputate luctus consequat at, maximus aliquam risus. Pellentesque eget dolor et ex tempor cursus. Aenean lectus leo, gravida placerat risus et, rutrum finibus magna. Sed quis est non nisi varius tincidunt in vel justo. Aenean sed velit sit amet ligula tincidunt maximus a nec velit. Curabitur dui tellus, commodo ac semper ac, finibus quis nisl. Nam eleifend nunc eu orci finibus varius. Suspendisse quis ornare ante. Phasellus et viverra tellus. Maecenas quis dapibus nulla, lobortis condimentum massa. Quisque egestas enim a mi mollis molestie. Maecenas pharetra, augue ut pretium scelerisque, metus metus suscipit erat, ut scelerisque felis tortor ut massa. Fusce ultricies gravida tempor.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;em&gt;Aenean elementum purus eget mi sodales aliquam sed id metus. In hac habitasse platea dictumst. In ac elementum diam, ac volutpat nisi. Proin semper enim neque, nec venenatis ligula bibendum vel. Aliquam euismod ante sed blandit consequat. Nulla vel odio vitae mi tincidunt luctus. Aenean non luctus magna. Aliquam erat volutpat. Nullam cursus sed turpis eu vehicula. Praesent pharetra efficitur eros, sed sagittis justo ultricies a. Quisque non elit sagittis, porttitor nisl gravida, efficitur quam. Vivamus accumsan tincidunt nibh vel varius. Cras elementum fermentum lorem vel feugiat. Donec ullamcorper quam non tortor imperdiet, et bibendum leo commodo. Duis euismod gravida urna, non dignissim ex cursus in. Praesent mi tellus, consequat et dui sit amet, tincidunt dapibus orci.&lt;/em&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `mesaj` text NOT NULL,
  `okundu` int(1) NOT NULL DEFAULT 0,
  `tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`id`, `ad`, `email`, `telefon`, `mesaj`, `okundu`, `tarih`) VALUES
(10, 'Deneme', 'Denememail@example.com', '1234567890', 'Denem Mesajı', 0, '2023-05-18 01:51:24'),
(11, 'Deneme Adı', 'jffj@djxjd', '545454', 'Deneme', 1, '2023-05-18 01:52:09');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hakkimizda`
--
ALTER TABLE `hakkimizda`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `hakkimizda`
--
ALTER TABLE `hakkimizda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
