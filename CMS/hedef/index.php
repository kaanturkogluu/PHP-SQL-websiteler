<?php
include_once 'data.php';
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="css/tiny-slider.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
</head>

<body>

	<!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="index.html">Furni<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">

				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<?php
					$vt = new Vt();
					$menu = $vt->veriGetir(1, "SELECT m.*,s.* FROM `menu` m  INNER JOIN  sayfalar s ON m.linkid=s.id", "", array(), "ORDER BY sira ASC");
					$icerik = $vt->veriGetir(0, "yazilar", "", array(), "ORDER BY id ASC");
					$yorumlar = $vt->veriGetir(0, "yorumlar", "WHERE sayfaid=?", array(1), "ORDER BY id ASC");
					$resimler = $vt->veriGetir(0, "resimler", "WHERE sayfaid=?", array(1), "ORDER BY id ASC");
				

					$currentURL = str_replace("/", " ", $_SERVER['REQUEST_URI']);

					foreach ($menu as $item) {
						if ($item['link'] == $currentURL) {
							$active = "active";
						} else {
							$active = "";
						} ?>

						<li class="nav-item <?= $active ?>">
							<a class="nav-link" href="<?= $item['link'] ?>"><?= $item["baslik"] ?></a>
						</li>
					<?php	}
					?>



				</ul>

				<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<li><a class="nav-link" href="#"><img src="images/user.svg"></a></li>
					<li><a class="nav-link" href="cart.html"><img src="images/cart.svg"></a></li>
				</ul>
			</div>
		</div>

	</nav>
	<!-- End Header/Navigation -->

	<?php
	foreach ($icerik as $dt) {
		switch ($dt['id']) {
			case 4:
				$i1 = $dt['icerik'];
				break;
			case 5:
				$i2 = $dt['icerik'];
				break;
			case 6:
				$i3 = $dt['icerik'];
				break;
			case 7:
				$i4 = $dt['icerik'];
				break;
			case 8:
				$i5 = $dt['icerik'];
				break;
			case 9:
				$i6 = $dt['icerik'];
				break;
			case 10:
				$i7 = $dt['icerik'];
				break;
			case 11:
				$i8 = $dt['icerik'];
				break;
			case 12:
				$i9 = $dt['icerik'];
				break;
			case 13:
				$i10 = $dt['icerik'];
				break;
			case 14:
				$i11 = $dt['icerik'];
				break;
			case 15:
				$i12 = $dt['icerik'];
				break;
			case 16:
				$i13 = $dt['icerik'];
				break;
			case 17:
				$i14 = $dt['icerik'];
				break;
			case 18:
				$i15 = $dt['icerik'];
				break;
			case 19:
				$i16 = $dt['icerik'];
				break;
			case 20:
				$i17 = $dt['icerik'];
				break;
			case 21:
				$i18 = $dt['icerik'];
				break;
			case 22:
				$i19 = $dt['icerik'];
				break;
			case 23:
				$i20 = $dt['icerik'];
				break;
		}
	}
	foreach ($resimler as $resim) {

		switch ($resim['id']) {
			case 1:
				$resim1 = $resim['resim'];

				break;
			case 2:
				$resim2 = $resim['resim'];
				$icerik1 = $resim['icerik'];
				break;
			case 3:
				$resim3 = $resim['resim'];
				$icerik2 = $resim['icerik'];
				break;
			case 4:
				$resim4 = $resim['resim'];
				$icerik3 = $resim['icerik'];
				break;
			case 5:
				$resim5 = $resim['resim'];
				break;
			case 6:
				$resim6 = $resim['resim'];
				break;
			case 7:
				$resim7 = $resim['resim'];
				break;
			case 8:
				$resim8 = $resim['resim'];
				break;
			case 9:
				$resim9 = $resim['resim'];
				break;
			case 10:
				$resim10 = $resim['resim'];
				break;
			case 11:
				$resim11 = $resim['resim'];
				break;
			case 12:
				$resim12 = $resim['resim'];
		}
	}
	?>


	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">



						<h1> <span clsas="d-block"></span><?= $i1 ?></h1>
						<p class="mb-4"><?= $i2 ?></p>
						<p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="hero-img-wrap">
						<img src="<?= $resim1 ?>" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

	<!-- Start Product Section -->
	<div class="product-section">
		<div class="container">
			<div class="row">

				<!-- Start Column 1 -->
				<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
					<h2 class="mb-4 section-title"><?= $i3 ?></h2>
					<p class="mb-4"><?= $i4 ?> </p>
					<p><a href="shop.html" class="btn">Explore</a></p>
				</div>
				<!-- End Column 1 -->

				<!-- Start Column 2 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="<?= $resim2 ?>" class="img-fluid product-thumbnail">
						<h3 class="product-title"><?= $icerik1 ?></h3>
						<strong class="product-price"></strong>

						<span class="icon-cross">
							<img src="images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 2 -->

				<!-- Start Column 3 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="<?= $resim3 ?>" class="img-fluid product-thumbnail">
						<h3 class="product-title"><?= $icerik2 ?></h3>
						<strong class="product-price"></strong>

						<span class="icon-cross">
							<img src="images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 3 -->

				<!-- Start Column 4 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="<?= $resim4 ?>" class="img-fluid product-thumbnail">
						<h3 class="product-title"><?= $icerik3 ?></h3>
						<strong class="product-price"></strong>

						<span class="icon-cross">
							<img src="images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 4 -->

			</div>
		</div>
	</div>
	<!-- End Product Section -->

	<!-- Start Why Choose Us Section -->
	<div class="why-choose-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-6">
					<h2 class="section-title"><?= $i5 ?></h2>
					<p><?= $i6 ?></p>
					<div class="row my-5">
						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/truck.svg" alt="Image" class="imf-fluid">
								</div>
								<h3><?= $i7 ?> </h3>
								<p><?= $i8 ?></p>
							</div>
						</div>

						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/bag.svg" alt="Image" class="imf-fluid">
								</div>
								<h3><?= $i13 ?></h3>
								<p><?= $i9 ?> </p>
							</div>
						</div>

						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/support.svg" alt="Image" class="imf-fluid">
								</div>
								<h3><?= $i10 ?></h3>
								<p><?= $i11 ?></p>
							</div>
						</div>

						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/return.svg" alt="Image" class="imf-fluid">
								</div>
								<h3><?= $i14 ?></h3>
								<p><?= $i12 ?></p>
							</div>
						</div>

					</div>
				</div>

				<div class="col-lg-5">
					<div class="img-wrap">
						<img src="<?= $resim5 ?>" alt="Image" class="img-fluid">
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- End Why Choose Us Section -->

	<!-- Start We Help Section -->
	<div class="we-help-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-7 mb-5 mb-lg-0">
					<div class="imgs-grid">
						<div class="grid grid-1"><img src="<?= $resim6 ?>" alt="Untree.co"></div>
						<div class="grid grid-2"><img src="<?= $resim7 ?>" alt="Untree.co"></div>
						<div class="grid grid-3"><img src="<?= $resim8 ?>" alt="Untree.co"></div>
					</div>
				</div>
				<div class="col-lg-5 ps-lg-5">
					<h2 class="section-title mb-4"><?= $i15 ?></h2>
					<p><?= $i16 ?></p>
					<ul class="list-unstyled custom-list my-4">
						<li><?= $i17 ?></li>
						<li><?= $i18 ?></li>
						<li><?= $i19 ?></li>
						<li><?= $i20 ?></li>
					</ul>
					<p><a herf="#" class="btn">Explore</a></p>
				</div>
			</div>
		</div>
	</div>
	<!-- End We Help Section -->

	<!-- Start Popular Product -->

	<!-- End Popular Product -->

	<!-- Start Testimonial Slider -->
	<div class="testimonial-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 mx-auto text-center">
					<h2 class="section-title">Testimonials</h2>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-12">
					<div class="testimonial-slider-wrap text-center">

						<div id="testimonial-nav">
							<span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
							<span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
						</div>

						<div class="testimonial-slider">

							<?php foreach ($yorumlar as $yorum) {

							?>
								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>&ldquo;<?= $yorum['icerik'] ?>&rdquo;</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img src="images/person-1.png" alt="kullanici" class="img-fluid">
													</div>
													<h3 class="font-weight-bold"><?= $yorum['ad'] ?></h3>
													<span class="position d-block mb-3"><?= $yorum['unvan'] ?></span>
												</div>
											</div>

										</div>
									</div>
								</div>
							<?php } ?>



						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Testimonial Slider -->

	<!-- Start Blog Section -->
	<div class="blog-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-6">
					<h2 class="section-title">Recent Blog</h2>
				</div>
				<div class="col-md-6 text-start text-md-end">
					<a href="#" class="more">View All Posts</a>
				</div>
			</div>

			<div class="row">

				<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
					<div class="post-entry">
						<a href="#" class="post-thumbnail"><img src="<?= $resim9 ?>" alt="Image" class="img-fluid"></a>
						<div class="post-content-entry">
							<h3><a href="#">First Time Home Owner Ideas</a></h3>
							<div class="meta">
								<span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
					<div class="post-entry">
						<a href="#" class="post-thumbnail"><img src="<?= $resim10 ?>" alt="Image" class="img-fluid"></a>
						<div class="post-content-entry">
							<h3><a href="#">How To Keep Your Furniture Clean</a></h3>
							<div class="meta">
								<span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
					<div class="post-entry">
						<a href="#" class="post-thumbnail"><img src="<?= $resim11 ?>" alt="Image" class="img-fluid"></a>
						<div class="post-content-entry">
							<h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
							<div class="meta">
								<span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- End Blog Section -->

	<!-- Start Footer Section -->
	<footer class="footer-section">
		<div class="container relative">

			<div class="sofa-img">
				<img src="<?= $resim12 ?>" alt="Image" class="img-fluid">
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="subscription-form">
						<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

						<form action="#" class="row g-3">
							<div class="col-auto">
								<input type="text" class="form-control" placeholder="Enter your name">
							</div>
							<div class="col-auto">
								<input type="email" class="form-control" placeholder="Enter your email">
							</div>
							<div class="col-auto">
								<button class="btn btn-primary">
									<span class="fa fa-paper-plane"></span>
								</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<div class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
					<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

					<ul class="list-unstyled custom-social">
						<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
					</ul>
				</div>

				<div class="col-lg-8">
					<div class="row links-wrap">
						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">About us</a></li>
								<li><a href="#">Services</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Contact us</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Support</a></li>
								<li><a href="#">Knowledge base</a></li>
								<li><a href="#">Live chat</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Jobs</a></li>
								<li><a href="#">Our team</a></li>
								<li><a href="#">Leadership</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Nordic Chair</a></li>
								<li><a href="#">Kruzo Aero</a></li>
								<li><a href="#">Ergonomic Chair</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a hreff="https://themewagon.com">ThemeWagon</a> <!-- License information: https://untree.co/license/ -->
						</p>
					</div>

					<div class="col-lg-6 text-center text-lg-end">
						<ul class="list-unstyled d-inline-flex ms-auto">
							<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>

				</div>
			</div>

		</div>
	</footer>
	<!-- End Footer Section -->


	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/tiny-slider.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>