<?php include 'includes/head.php'; ?>

<?php 
	if (isset($url[0]) && $url[0] == 'home') {
		include 'paginas/home.php';
	}else if (isset($url[0]) && $url[0] == 'equipe-do-laboratio') {
		include 'paginas/equipe-do-laboratio.php';
	}else if (isset($url[0]) && $url[0] == 'questionario') {
		include 'paginas/questionario.php';
	}else{
		include 'login/painel/includes/404.php';
	}
?>

		
<?php include 'includes/footer.php'; ?>