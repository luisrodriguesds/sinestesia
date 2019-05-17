<?php include '../sistema/system.php'; 

  $url  = (isset($_GET['url'])) ? $_GET['url'] : 'login';
  $url  = array_filter(explode('/', $url));

  AcessPublic();
  // ValidaLogin();
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

	<!-- Modernizr JS -->
	<script src="<?php echo URLBASE; ?>js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="<?php// echo URLBASE; ?>js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

		<?php include '../includes/nav.php' ?>
		<div class="gtco-section" id="gtco-header" style="padding-top: 64px; padding-bottom: 0px;">
			<div class="gtco-container" style="background: #fff; padding: 60px 30px 30px 30px;">
				<?php 
					if ($url[0] == 'login') {
					ValidaLogin();
				?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 gtco-heading text-center" style="margin-bottom: 1em">
						<h2>Login</h2>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod erat tincidunt. Donec tincidunt volutpat erat.</p> -->
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 center-block">
						<form method="post">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" value="<?php echo GetPost('email'); ?>" name="email" id="email">
							</div>
							<div class="form-group">
								<label for="password">Senha</label>
								<input type="password" class="form-control" name="password" id="password">
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary btn-color" name="send" value="Entrar">
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 center-block">
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo URLBASE; ?>login/registrar">Cadastrar-se</a>
							</div>
							<div class="col-md-6 text-right">
								<a href="#">Esqueci minha senha</a>
							</div>
						</div>
					</div>
				</div>
				<?php
					}else if ($url[0] == 'registrar') {
						if (isset($_POST['registrar'])) {
							$form['nome'] 	= GetPost('nome');
							$form['email'] 	= GetPost('email');
							$form['password'] 	= GetPost('senha');

							if (empty($form['nome']) || empty($form['email']) || empty($form['password']) || empty(GetPost('senhaConfirm'))) {
								alerta('Algum campo está vazio');
							}else if ($form['password'] != GetPost('senhaConfirm')) {
								alerta('As senhas não correspondem!');
							}else if(strlen($form['password']) < 6){
								alerta('A senha deve ter no mínimo 6 caracteres');
							}else if(DBread('users', "WHERE email = '".$form['email']."'")){
								alerta('Esse email já está cadastrado');
							}else{
								$form['password'] = md5($form['password']);
								$form['status']	  = 1;
								$form['registro'] = date('Y-m-d H:i:s');
								$form['tipo']	  = 'Candidato';
								$form['tipoSlug'] = 'candidato';
								if (DBcreate('users', $form)) {
									alertaLoad("Você foi registrado com sucesso! Por favor, entre e comece a Bateria", URLBASE.'login');
								}
							}
						}
				?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 gtco-heading text-center" style="margin-bottom: 1em">
						<h2>Cadastre-se</h2>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod erat tincidunt. Donec tincidunt volutpat erat.</p> -->
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 center-block">
						<form method="post">
							<div class="form-group">
								<label for="nome">Nome Completo</label>
								<input type="text" value="<?php echo GetPost('nome'); ?>" class="form-control" name="nome" id="nome">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" value="<?php echo GetPost('email'); ?>" class="form-control" name="email" id="email">
							</div>
							<div class="form-group">
								<label for="senha">Senha</label>
								<input type="password" minlength="6" class="form-control" name="senha" id="senha">
							</div>
							<div class="form-group">
								<label for="senhaConfirm">Confirmar Senha</label>
								<input type="password" minlength="6" class="form-control" name="senhaConfirm" id="senhaConfirm">
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary btn-color" name="registrar" value="Registrar-se">
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 center-block">
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo URLBASE; ?>login">Logar</a>
							</div>
							
						</div>
					</div>
				</div>
				<?php
					}else if ($url[0] == 'recuperar-senha') {
				?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 gtco-heading text-center" style="margin-bottom: 1em">
						<h2>Recuperar Senha</h2>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus placerat enim et urna sagittis, rhoncus euismod erat tincidunt. Donec tincidunt volutpat erat.</p> -->
					</div>
				</div>
				<?php
					}else{
						?>
						<center>
							<h2>Erro 404</h2>
							<h2>Página não encontrada</h2>
						</center>
						<?php
					}
				?>
			</div>
		</div>		

<?php include '../includes/footer.php'; ?>

