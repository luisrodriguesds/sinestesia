
<?php 
	if (isset($url[1]) && $url[1] == 'start'){
		$exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = '2' LIMIT 1");
		
		if ($exames == false) {
			echo '<center>
				<h2>Nenhum exame liberado foi encontrado</h2>
			</center>';
		}else{
			$exames = $exames[0];
			$exame = DBread('exames', "WHERE nomeSlug = '".$exames['exame_tipoSlug']."'", 'trials_count, nomeSlug');
			$trials = DBread('exames_trials', "WHERE id_exame = '".$exames['id']."' AND id_user = '".$user['id']."' AND status_bloco = true ORDER BY id ASC", 'id, valor');
			$trial  = DBread('exames_trials', "WHERE id_exame = '".$exames['id']."' AND id_user = '".$user['id']."' AND status_bloco = false ORDER BY id ASC", 'id, valor');
			if ($trials == false) {
				load(URL_PAINEL.'teste/start-confirme');
			}
			// var_dump($trials);
			$rand_color = random_color();
			$rand_color_rgb = hex2rgb($rand_color);
			
		?>
		<div class="box-check"><div>
			<div id="infos" style="display: none;"><?php echo $user['id'].':'.$user['token']; ?></div>
			<div id="id_trial" style="display: none;"><?php echo $trials[0]['id']; ?></div>
			<div id="url" style="display: none;"><?php echo URL_PAINEL; ?></div>
		</div></div>
		<style type="text/css">
			#gtco-header{ background: #fff !important; }
			.box-color{ background-color: <?php echo $rand_color; ?>;  }
			.box-trials h2{ <?php if($exame[0]['nomeSlug'] == 'grafema-cor'){ echo 'font-size: 80px !important;';  }else{ echo 'font-size: 45px !important; margin-bottom: 0px !important; line-height: 2;'; } ?>; }
		</style>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-10 center-block">
				<h3>Instruções</h3>
					<p style="text-align: justify; color: #000;">Clique e arraste a barrinha vertical que está à direita da paleta de cores para escolher
					a cor que você associa ao estímulo apresentado. Depois de ter escolhido a
					cor, clique e arraste o círculo para ajustar o matiz. A cor selecionada
					aparecerá no retângulo que está em cima do estímulo. Quando você terminar
					de fazer os emparelhamento entre os estímulos e as cores, o teste terminará
					automaticamente.</p>
			</div>
		</div>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-10 center-block p">
				<div class="header-exame" style="margin-bottom: 50px;">
					<center><h2>Teste: <?php echo $exames['exame_tipo']; ?></h2></center>
				</div>
				<div class="row">
					<div class="col-md-5">
						<!-- <div class="colorpickerHolder" id="colorpickerHolder"></div> -->
						<div id="cp2" data-color="<?php echo $rand_color; ?>"></div>
						
					</div>	
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-12">
								<div class="box-color"><p><?php echo $rand_color.':rgb('.$rand_color_rgb['red'].', '.$rand_color_rgb['green'].', '.$rand_color_rgb['blue'].')'; ?></p></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="box-trials"><h2><?php echo $trials[0]['valor']; ?></h2></div>
								<div class="box-count-trials text-center"><span class="trial-now"><?php echo (($trial == false) ? '1' : count($trial)+1) ?></span>/<?php echo $exame[0]['trials_count']; ?> trials</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="box-button">
									<a href="#" class="btn btn-block btn-chose" style="color: #000 !important; border: 1px solid #000 !important; background: #fff !important;" rel="0">Escolher esta cor</a>
									<a href="#" class="btn btn-block btn-chose" style="color: #000 !important; border: 1px solid #000 !important; background: #fff !important;" rel="1">Sem cor</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	
		<?php
		}
	}else if (isset($url[1]) && $url[1] == 'start-confirme'){
		$exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = true ORDER BY id ASC LIMIT 1");
		
		?>
	<div class="row" style="margin-top: 50px;">
		<div class="col-md-8 center-block p">
		<?php
		if ($exames == false) {
			//VERIFICAR INDEPENDENTE DO STATUS
			$exames = DBread('exames_user', "WHERE token = '".$user['token']."' ORDER BY id ASC");
			if ($exames == false) {
				load(URL_PAINEL);
			}

			//Continuar
			if (isset($_POST['continuar'])) {

				load(URL_PAINEL.'sobre-voce');
			}
		?>	
			<div style="padding: 60px 0 60px 0;">
				<center>
					<h2>Você já concluiu os testes! Agora, clique em continuar e finalize a Bateria. </h2>
					<form method="post">
						<div class="form-group text-center">
							<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Continuar">
						</div>
					</form>
				</center>
			</div>	
		<?php
		}else{
			if (isset($_POST['comecar'])) {
				//STATUS DA TABELA EXAMES_USERS:
				// 0 => O TESTE FOI REALIZADO POR COMPLETO
				// 1 => O TESTE ESTÁ DISPONÍVEL PARA SER REALIZADO
				// 2 => O TESTE ESTÁ SENDO REALIZADO NO MOMENTO
				//STATUS INDICA QUE O TESTE COMEÇOU
				$up['status'] = 2;
				if (DBUpDate('exames_user', $up, "id = '".$exames[0]['id']."'")) {
					load(URL_PAINEL.'teste/start');
				}
			}

			$exame_msn = DBread('exames', "WHERE nomeSlug = '".$exames[0]['exame_tipoSlug']."'");
			$exame_msn = $exame_msn[0];

			?>
			<div style="padding: 60px 0 60px 0;">
			<?php
			echo '<h2> Teste '.$exame_msn['nome'].'</h2>';
			echo '<p>'.$exame_msn['mensagem_inicio'].'</p>';
			?>
				<form method="post">
					<div class="form-group text-right">
						<input type="submit" class="btn btn-primary btn-color" name="comecar" value="Começar">
					</div>
				</form>			
			</div>
		<?php
		}
		?>
		</div>
	</div>
		<?php

	}else if (isset($url[1]) && $url[1] == 'confirme'){
		$exames = DBread('exames_user', "WHERE token = '".$user['token']."'");
		if ($exames == false) {
			$testesNot = DBread('exames_indisponiveis', "WHERE token = '".$user['token']."'");
			if ($testesNot == true) {
				?>
				<div class="row" style="margin-top: 50px;">
					<div class="col-md-6 center-block p">
						<center><h2>Atenção!</h2></center>
						<p>Olá! Obrigado pela sua disponibilidade, mas a Bateria de Sinestesia ainda não contém testes específicos para o(s) tipo(s) de sinestesia que você selecionou anteriormente.</p>
					</div>
					<div class="col-md-10 center-block text-center">
						<a href="?logout" class="btn btn-primary btn-color"> Voltar para página inicial</a>
					</div>
				</div>				
				<?php				
			}else{
				?>
				<div class="row" style="margin-top: 50px;">
					<div class="col-md-6 center-block p">
						<center><h2>Atenção!</h2>
						<p>Nenhum exame encontrado na fila</p></center>
						
					</div>
					<div class="col-md-10 center-block text-center">
						<a href="?logout" class="btn btn-primary btn-color"> Voltar para página inicial</a>
					</div>
				</div>
				<?php
			}
		}else{
						
			if (isset($_POST['continuar'])) {
				//GERAR TRIALS
				for ($i=0; $i < count($exames); $i++) { 
					//GERAR TRAILS DE NUMERO
					//GRAFEMA
					if ($exames[$i]['exame_tipoSlug'] == 'grafema-cor') {

						//DADOS DO TESTE
						$form['id_user'] 		= $user['id'];
						$form['id_exame']		= $exames[$i]['id'];
						$form['exame_tipo'] 	= $exames[$i]['exame_tipo'];
						$form['exame_tipoSlug'] = $exames[$i]['exame_tipoSlug'];
						$form['status_bloco']	= 1;
						$form['status']			= 1;
						$form['registro']		= date('Y-m-d H:i:s');

						//GERAR BLOCO 1 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$crc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
						for ($j=0; $j < 36; $j++) { 
							$choce = $crc[rand(0, (strlen($crc)-1))];
							$crc = str_replace($choce, '', $crc);
							$trails_valores[$j] = $choce;
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 1;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}
						$trails_valores = array();
						//GERAR BLOCO 2 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$crc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
						for ($j=0; $j < 36; $j++) { 
							$choce = $crc[rand(0, (strlen($crc)-1))];
							$crc = str_replace($choce, '', $crc);
							$trails_valores[$j] = $choce;
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 2;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}
						$trails_valores = array();
						//GERAR BLOCO 3 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$crc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
						for ($j=0; $j < 36; $j++) { 
							$choce = $crc[rand(0, (strlen($crc)-1))];
							$crc = str_replace($choce, '', $crc);
							$trails_valores[$j] = $choce;
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 3;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}
						//fim grafemas cor
					}else if ($exames[$i]['exame_tipoSlug'] == 'dias-da-semana-cor') {
						//DADOS DO TESTE
						$form['id_user'] 		= $user['id'];
						$form['id_exame']		= $exames[$i]['id'];
						$form['exame_tipo'] 	= $exames[$i]['exame_tipo'];
						$form['exame_tipoSlug'] = $exames[$i]['exame_tipoSlug'];
						$form['status_bloco']	= 1;
						$form['status']			= 1;
						$form['registro']		= date('Y-m-d H:i:s');

						//GERAR BLOCO 1 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$trails_valores = array();
						$choce = array();
						$crc = array(0 => 'Domingo', 1=> 'Segunda-feira', 2 =>'Terça-feira', 3 =>'Quarta-feira', 4 => 'Quinta-feira', 5 => 'Sexta-feira', 6 => 'Sábado');
						for ($j=0; $j < 7; $j++) { 
							$choce['indice'] = rand(0, count($crc)-1);
							$choce['valor']  = $crc[$choce['indice']];
							unset($crc[$choce['indice']]);
							sort($crc);
							$trails_valores[$j] = $choce['valor'];
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 1;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}

						//GERAR BLOCO 2 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$trails_valores = array();
						$choce = array();
						$crc = array(0 => 'Domingo', 1=> 'Segunda-feira', 2 =>'Terça-feira', 3 =>'Quarta-feira', 4 => 'Quinta-feira', 5 => 'Sexta-feira', 6 => 'Sábado');
						for ($j=0; $j < 7; $j++) { 
							$choce['indice'] = rand(0, count($crc)-1);
							$choce['valor']  = $crc[$choce['indice']];
							unset($crc[$choce['indice']]);
							sort($crc);
							$trails_valores[$j] = $choce['valor'];
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 2;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}

						//GERAR BLOCO 3 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$trails_valores = array();
						$choce = array();
						$crc = array(0 => 'Domingo', 1=> 'Segunda-feira', 2 =>'Terça-feira', 3 =>'Quarta-feira', 4 => 'Quinta-feira', 5 => 'Sexta-feira', 6 => 'Sábado');
						for ($j=0; $j < 7; $j++) { 
							$choce['indice'] = rand(0, count($crc)-1);
							$choce['valor']  = $crc[$choce['indice']];
							unset($crc[$choce['indice']]);
							sort($crc);
							$trails_valores[$j] = $choce['valor'];
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 3;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}
						//fim dias da semana cor
					}else if ($exames[$i]['exame_tipoSlug'] == 'meses-cor') {
						//DADOS DO TESTE
						$form['id_user'] 		= $user['id'];
						$form['id_exame']		= $exames[$i]['id'];
						$form['exame_tipo'] 	= $exames[$i]['exame_tipo'];
						$form['exame_tipoSlug'] = $exames[$i]['exame_tipoSlug'];
						$form['status_bloco']	= 1;
						$form['status']			= 1;
						$form['registro']		= date('Y-m-d H:i:s');

						//GERAR BLOCO 1 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$trails_valores = array();
						$choce = array();
						$crc = array(0 => 'Janeiro', 1 => 'Fevereiro', 2 =>'Março', 3 =>'Abril', 4 => 'Maio', 5 => 'Junho', 6 => 'Julho', 7 => 'Agosto', 8 => 'Setembro', 9 => 'Outubro', 10 => 'Novembro', 11 => 'Dezembro');
						for ($j=0; $j < 12; $j++) { 
							$choce['indice'] = rand(0, count($crc)-1);
							$choce['valor']  = $crc[$choce['indice']];
							unset($crc[$choce['indice']]);
							sort($crc);
							$trails_valores[$j] = $choce['valor'];
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 1;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}

						//GERAR BLOCO 2 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$trails_valores = array();
						$choce = array();
						$crc = array(0 => 'Janeiro', 1 => 'Fevereiro', 2 =>'Março', 3 =>'Abril', 4 => 'Maio', 5 => 'Junho', 6 => 'Julho', 7 => 'Agosto', 8 => 'Setembro', 9 => 'Outubro', 10 => 'Novembro', 11 => 'Dezembro');
						for ($j=0; $j < 12; $j++) { 
							$choce['indice'] = rand(0, count($crc)-1);
							$choce['valor']  = $crc[$choce['indice']];
							unset($crc[$choce['indice']]);
							sort($crc);
							$trails_valores[$j] = $choce['valor'];
						}

						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 2;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}

						//GERAR BLOCO 3 REFERENCIA QUE SERÁ USADO NOS TRAILS
						$trails_valores = array();
						$choce = array();
						$crc = array(0 => 'Janeiro', 1 => 'Fevereiro', 2 =>'Março', 3 =>'Abril', 4 => 'Maio', 5 => 'Junho', 6 => 'Julho', 7 => 'Agosto', 8 => 'Setembro', 9 => 'Outubro', 10 => 'Novembro', 11 => 'Dezembro');
						for ($j=0; $j < 12; $j++) { 
							$choce['indice'] = rand(0, count($crc)-1);
							$choce['valor']  = $crc[$choce['indice']];
							unset($crc[$choce['indice']]);
							sort($crc);
							$trails_valores[$j] = $choce['valor'];
						}
						//Registrar no banco
						for ($k=0; $k < count($trails_valores); $k++) { 
							$form['valor'] = $trails_valores[$k];
							$form['bloco'] = 3;
							if (DBcreate('exames_trials', $form)) {
								
							}
						}
						//fim meses cor
					}
				}
				load(URL_PAINEL.'teste/start-confirme');
			}

			$testesNot = DBread('exames_indisponiveis', "WHERE token = '".$user['token']."'");
			
?>	
		
		<div class="row">
			<div class="col-md-6 center-block p">
				<h2><?php echo ((count($exames) == 1) ? 'Teste' : 'Testes'); ?></h2>
				<p>Você fará <?php echo count($exames).' '.((count($exames) == 1) ? 'teste' : 'testes'); ?> da Bateria de Sinestesia:</p>
				<ul style="margin-bottom: 40px;">
					<?php 
						for ($i=0; $i < count($exames); $i++) { 
							echo '<li>'.$exames[$i]['exame_tipo'].'</li>';
						}
					?>
				</ul>
				<?php 
					if ($testesNot == true) {
				?>
				<h2>Atenção!</h2>
				<p>Você selecionou testes que ainda não estão disponíveis, logo não será possível realizá-los. Estamos trabalhando para disponibilizá-los em breve!</p>
				<?php
					}
				?>
				<form method="post">
					<div class="form-group text-right">
						<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Continuar">
					</div>
				</form>
			</div>
		</div>
<?php
		}
	}else{
		//PROTEJE A PAGINA
		if ($user['token'] != '') {
			$exames = DBread('exames_user', "WHERE token = '".$user['token']."'AND status = '2' LIMIT 1", 'id');
			if ($exames == true) {
				load(URL_PAINEL.'teste/start');
			}else{
				$exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = true LIMIT 1", 'id');
				if ($exames == true) {
					load(URL_PAINEL.'teste/start-confirme');
				}else{
					$exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = false LIMIT 1", 'id');
					if ($exames == true) {
						load(URL_PAINEL.'resultados');
					}
				}
			}
		}

		if (isset($_POST['continuar'])) {
			if (empty($_POST['sines'])) {
				alerta("Escolha um teste!");
			}else{

				//TIRAR O VALR REPETIDO
				$testes = array('Grafema-Cor', 'Dias da semana-cor', 'Meses-cor'); 
				$exames_sines = array();
				
				if($_POST['sines'][0] == 'Grafema-Cor' && isset($_POST['sines'][1]) && $_POST['sines'][1] == 'Grafema-Cor'){
					unset($_POST['sines'][0]);
					for ($i=0; $i < count($_POST['sines']); $i++) {
						$exames_sines[$i] = $_POST['sines'][$i+1]; 
					}
				}else{
					$exames_sines = $_POST['sines'];
				}
				$filtro = array();
				$testesNot = array();
				$l=0;
				for ($i=0; $i < count($exames_sines); $i++) { 
					if (in_array($exames_sines[$i], $testes)) {
						$filtro[$i] = $exames_sines[$i];
					}else{
						$testesNot[$l] = $exames_sines[$i];
						$l++;
					}
				}
				$exames_sines = $filtro;
				

				//SEM VERIFICACAO SE ELE JÁ REALIZOU AQUELE EXAME
				//load(URL_PAINEL.$url[0].'/confirme');
				//GERAR TOKEN
				$crc = '0123456789ABCDEFGHIJLMNOPQRSTUVWXYXKabcdefghijklmnopqrsvtxyz';
				$str = '';
			    for ($i=0; $i < 100; $i++) {
			    	$rand = $crc[rand(0, 59)];
			    	$str .= $rand;
			    }

			    if (count($exames_sines) >= 1) {
					$form['id_user'] 	= $user['id'];
					$form['status'] 	= 1;
					$form['registro'] 	= date('Y-m-d H:i:s');
					$form['token']		= $str;
					$cont=0;
					for ($i=0; $i < count($exames_sines); $i++) { 
						$form['exame_tipo'] = $exames_sines[$i];
						$form['exame_tipoSlug'] = Slug($exames_sines[$i]);
						if (DBcreate('exames_user', $form)) {
							$cont++;
						}
					}
			    }

				if (count($testesNot) >= 1) {
					$form = array();
					$form['id_user'] 	= $user['id'];
					$form['status'] 	= 1;
					$form['registro'] 	= date('Y-m-d H:i:s');
					$form['token']		= $str;
					for ($i=0; $i < count($testesNot); $i++) { 
						$form['exame'] = $testesNot[$i];
						$form['exameSlug'] = Slug($testesNot[$i]);
						if (DBcreate('exames_indisponiveis', $form)) {
						}
					}
				}

				$up['token'] = $str;
				if (DBUpDate('users', $up, "id = '".$user['id']."'")) {
					if ($cont == count($exames_sines)) {
						load(URL_PAINEL.$url[0].'/confirme');
					}
				}
			}
		}
?>

<div class="row">
	<div class="col-md-8 center-block p">
		
		<p>Por favor, escolha o(s) tipo(s) de sinestesia que você acha que tem</p>
		<form method="post">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col"></th>
			      <th scope="col">Tipo de Sinestesia</th>
			      <th scope="col">Descrição</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  		$exames_select = DBread('exames_escolher', "WHERE status = true ORDER BY id ASC");
			  		if ($exames_select == true) {
			  			for ($i=0; $i < count($exames_select); $i++) { 
			  		?>
			  			<tr>
			  				<th scope="row"><input type="checkbox" value="<?php echo (($exames_select[$i]['nome'] == 'Número-cor' || $exames_select[$i]['nome'] == 'Letra-cor') ? 'Grafema-Cor' : $exames_select[$i]['nome']); ?>" name="sines[]"></th>
						    <td><?php echo $exames_select[$i]['nome']; ?></td>
						    <td style="text-align: justify;"><?php echo $exames_select[$i]['descricao']; ?></td>
			  			</tr>
			  		<?php
			  			}
			  		}
			  	?>
			  </tbody>
			</table>
			<div class="form-group text-right">
				<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Continuar">
			</div>
		</form>
	</div>
</div>
<?php 
	}
?>