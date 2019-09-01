<?php
	if (isset($url[0]) == 'home') {
		$active = 'active';
	}else if (isset($url[0]) == 'equipe-do-laboratio') {
		$active = 'active';
	}else if (isset($url[0]) == 'login' || $url[0] == 'registrar') {
		$active = 'active';
	}else{
		$active = '';
	}
?>
<nav class="gtco-nav" role="navigation">
	<div class="gtco-container">
		
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				
				<div class="title-header">
					<h4>Bateria de Sinestesia</h4>
					<h5>Laboratório de Ciências Cognitivas e Psicolinguística</h5>
				</div>
				<div class="clear"></div>
			</div>
			<div class="col-xs-6 text-right menu-1">
				<ul>
					<li class="<?php echo (($url[0] == 'home') ? $active : '') ?>"><a href="<?php echo URLBASE; ?>">Home</a></li>
					<li class="<?php echo (($url[0] == 'equipe-do-laboratio') ? $active : '') ?>"><a href="<?php echo URLBASE.'equipe-do-laboratio'; ?>">Equipe do Laboratório</a></li>
					<?php 
					if (IsLogged()) {
					?>
					<li><a href="<?php echo URLBASE.'?logout'; ?>">Sair</a></li>

					<?php
					}else{
						?>

					<li class="<?php echo (($url[0] == 'login' || $url[0] == 'registrar') ? $active : '') ?>"><a href="<?php echo URLBASE.'login'; ?>">Login</a></li>
						<?php
					}
					?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		
	</div>
</nav>
