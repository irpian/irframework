<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $meta['title']; ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<meta content="<?php echo $meta['keyword']; ?>" name="keywords">
	<meta content="<?php echo $meta['description']; ?>" name="description">

	<!-- Favicons -->
	<link href="<?php echo $site->icon(); ?>" rel="icon">
	<link href="<?php echo $theme->url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

	<!-- Bootstrap CSS File -->
	<link href="<?php echo $theme->url(); ?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Libraries CSS Files -->
	<link href="<?php echo $theme->url(); ?>/assets/lib/animate/animate.min.css" rel="stylesheet">
	<link href="<?php echo $theme->url(); ?>/assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $theme->url(); ?>/assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="<?php echo $theme->url(); ?>/assets/lib/magnific-popup/magnific-popup.css" rel="stylesheet">

	<!-- Main Stylesheet File -->
	<link href="<?php echo $theme->url(); ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo $theme->url(); ?>/assets/css/custom.css" rel="stylesheet">
</head>

<body>

  <header id="header">
	<div class="container">

	  <div id="logo" class="pull-left">
		<?php if($setting["logo"]==""){ ?>
			<h1><a href="<?php echo base_url; ?>" class="scrollto"><?php echo $setting["site_name"]; ?></a></h1>
		<?php } else { ?>
			<a href="<?php echo base_url; ?>"><img src="<?php echo base_url."/images/".$setting["logo"]; ?>" alt="" title=""></a>
		<?php } ?>
	  </div>
	  <?php include $theme->base()."/layout.menu.php"; ?>
	</div>

  </header>

  <div style="height: 90px; background-color: #000;"></div>

  <main id="main">
	  <section id="intro" class="intro-404">
		<div class="intro-text" style="margin-top:64px;">
		  <h1 class="white">Error 404</h1>
		  <p>Page Not Found</p>
		  <a href="<?php echo base_url; ?>" class="btn-get-started scrollto">Back To Home</a>
		</div>
	</section>
  </main>

  <footer id="footer">
	<div class="container">
	  <div class="row">
		<div class="col-lg-6 text-lg-left text-center">
		  <div class="copyright">
			<?php echo $site->copyright(); ?>
		  </div>
		  <div class="credits">
			Content By Excrozer Design
		  </div>
		</div>
		<div class="col-lg-6">
		  <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
			<?php
			foreach ($footer_menu as $key => $data) { ?>
			  <a href="<?php echo $data['url']; ?>" class="scrollto"><?php echo $data['name']; ?></a>
			<?php } ?>
		  </nav>
		</div>
	  </div>
	</div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="<?php echo $theme->url(); ?>/assets/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo $theme->url(); ?>/assets/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo $theme->url(); ?>/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $theme->url(); ?>/assets/lib/easing/easing.min.js"></script>
  <script src="<?php echo $theme->url(); ?>/assets/lib/wow/wow.min.js"></script>
  <script src="<?php echo $theme->url(); ?>/assets/lib/superfish/hoverIntent.js"></script>
  <script src="<?php echo $theme->url(); ?>/assets/lib/superfish/superfish.min.js"></script>
  <script src="<?php echo $theme->url(); ?>/assets/lib/magnific-popup/magnific-popup.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?php echo $theme->url(); ?>/assets/js/main.js"></script>

  <script type="text/javascript">
	$(document).ready(function() {
		  $( "#icon-search" ).click(function() {
			$( "#search" ).slideToggle("slow");
		});
	});
  </script>
</body>
</html>