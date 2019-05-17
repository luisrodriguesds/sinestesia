<?php include 'includes/head.php'; ?>
		<div class="gtco-section" id="gtco-header" style="margin-top: 24px; padding-top: 50px; padding-bottom: 0px;">
			<div class="gtco-container" style="background: #fff; padding: 30px;">
				<?php 
					//FAZER AS VERFICACOES PRA SABER PRA ONDE MANDAR O USUARIO
					

					if ($url[0] == 'home') {
						include 'paginas/home.php';
					}else if ($url[0] == 'termo') {
						include 'paginas/termo.php';
					}else if ($url[0] == 'dados') {
						include 'paginas/dados.php';
					}else if ($url[0] == 'teste') {
						include 'paginas/teste.php';
					}else if ($url[0] == 'sobre-voce') {
						include 'paginas/sobre-voce.php';
					}else if ($url[0] == 'associador-projetor') {
						include 'paginas/associador-projetor.php';
					}else if ($url[0] == 'resultados') {
						include 'paginas/resultados.php';
					}

				?>
			</div>
		</div>
<?php include '../../includes/footer.php'; ?>
