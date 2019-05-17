<?php include '../../sistema/system.php'; 

	$way = URL_PAINEL;
	$user = GetUser();
	$user = $user[0];
	$url = (isset($_GET['url'])) ? $_GET['url'] : 'home';
	$url = array_filter(explode('/', $url));
	$url = DBescape($url);
	AcessPrivate();

?>
<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bateria de sinestesia | LCCP | UFC </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by gettemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="gettemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="<?php echo URLBASE; ?>css/style.css">
	<link rel="stylesheet" href="<?php echo URL_PAINEL; ?>css/style.css">

	<!-- PICK COLOR -->
	<!-- <link rel="stylesheet" media="screen" type="text/css" href="<?php // echo URL_PAINEL; ?>css/pickcolor/colorpicker.css" /> -->
	<link rel="stylesheet" href="<?php echo URL_PAINEL; ?>css/bootstrap-colorpicker.css">

	<!-- Modernizr JS -->
	<script src="<?php echo URLBASE; ?>js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="<?php// echo URLBASE; ?>js/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		#gtco-header p{ font-size: 16px; }
		#gtco-header .btn-special{ color: #009a63 !important; }
	</style>
	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

		<?php include '../../includes/nav.php' ?>