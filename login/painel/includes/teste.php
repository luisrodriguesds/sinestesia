
<?php 
	if (isset($url[1]) && $url[1] == 'start'){
		$exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = '2'");
//		var_dump($exames);
		if ($exames == false) {
		?>
		<center>
			<h2>Nenhum exame liberado foi encontrado</h2>
		</center>
		<?php
		}else{

		?>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-10 center-block p">
				<div class="header-exame" style="margin-bottom: 50px;">
					<center><h2>Teste: <?php echo $exames[0]['exame_tipo']; ?></h2></center>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="colorpickerHolder" id="colorpickerHolder"></div>
					</div>	
					<div class="col-md-6">
						
					</div>
				</div>
				<div class="row" style="margin-top: 50px;">
					<div class="col-md-12">
						<h3>Instruções</h3>
						<p style="text-align: justify;">Clique e arraste os triângulos ou o círculo para escolher a cor que mais se 
							aproxima da sua cor sinestésica associada ao estímulo apresentado. 
							Você também pode usar as teclas de seta do teclado para  ajustar o 
							matiz da cor. Quando você terminar de fazer os emparelhamentos entre os 
							estímulos e as cores, o teste terminará automaticamente.</p>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
	}else if (isset($url[1]) && $url[1] == 'start-confirme'){
		$exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = true");
		?>
	<div class="row" style="margin-top: 50px;">
		<div class="col-md-8 center-block p">
		<?php
		if ($exames == false) {
		?>	
			<center>
				<h2>Você realizou todos os testes!</h2>
			</center>
		<?php
		}else{
			if (isset($_POST['comecar'])) {
				$up['status'] = 2;
				if (DBUpDate('exames_user', $up, "id = '".$exames[0]['id']."'")) {
					load(URL_PAINEL.'teste/start');
				}
			}
			$exame_msn = DBread('exames', "WHERE nomeSlug = '".$exames[0]['exame_tipoSlug']."'");
			$exame_msn = $exame_msn[0];
			echo '<h2> Teste '.$exame_msn['nome'].'</h2>';
			echo '<p>'.$exame_msn['mensagem_inicio'].'</p>';
			?>
				<form method="post">
					<div class="form-group text-right">
						<input type="submit" class="btn btn btn-special" name="comecar" value="Começar">
					</div>
				</form>			
		<?php
		}
		?>
		</div>
	</div>
		<?php

	}else if (isset($url[1]) && $url[1] == 'confirme'){
		$exames = DBread('exames_user', "WHERE token = '".$user['token']."'");
		if ($exames == false) {
			echo '<center>
					<h2>Erro 500</h2>
					<h2>Nenhum exame na fila</h2>
				</center>';
		}else{
						
			if (isset($_POST['continuar'])) {
				//GERAR TRIALS
				for ($i=0; $i < count($exames); $i++) { 
					//GERAR TRAILS DE NUMERO
					if ($exames[$i]['exame_tipoSlug'] == 'numero-cor') {
						//GERO O BLOCO REFERENCIA QUE SERÁ USADO NOS TRAILS
						$crc = '0123456789';
						for ($j=0; $j < 10; $j++) { 
							$choce = $crc[rand(0, (strlen($crc)-1))];
							$crc = str_replace($choce, '', $crc);
							$trails_valores[$j] = $choce;
						}

						$form['id_user'] 		= $user['id'];
						$form['id_exame']		= $exames[$i]['id'];
						$form['exame_tipo'] 	= $exames[$i]['exame_tipo'];
						$form['exame_tipoSlug'] = $exames[$i]['exame_tipoSlug'];
						$form['status_bloco']	= 1;
						$form['status']			= 1;
						$form['registro']		= date('Y-m-d H:i:s');
						//GERA OS BLOCOS e COLOCA NO BANCO
						for ($j=0; $j < 3; $j++) { 
							for ($k=0; $k < count($trails_valores); $k++) { 
								$form['valor'] = $trails_valores[$k];
								$form['bloco'] = ($j+1);
								if (DBcreate('exames_trials', $form)) {
									
								}
							}
						}
					}else if ($exames[$i]['exame_tipoSlug'] == 'letra-cor') {

						//GERO O BLOCO REFERENCIA QUE SERÁ USADO NOS TRAILS
						$crc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
						for ($j=0; $j < 26; $j++) { 
							$choce = $crc[rand(0, (strlen($crc)-1))];
							$crc = str_replace($choce, '', $crc);
							$trails_valores[$j] = $choce;
						}

						$form['id_user'] 		= $user['id'];
						$form['id_exame']		= $exames[$i]['id'];
						$form['exame_tipo'] 	= $exames[$i]['exame_tipo'];
						$form['exame_tipoSlug'] = $exames[$i]['exame_tipoSlug'];
						$form['status_bloco']	= 1;
						$form['status']			= 1;
						$form['registro']		= date('Y-m-d H:i:s');
						//GERA OS BLOCOS e COLOCA NO BANCO
						for ($j=0; $j < 3; $j++) { 
							for ($k=0; $k < count($trails_valores); $k++) { 
								$form['valor'] = $trails_valores[$k];
								$form['bloco'] = ($j+1);
								if (DBcreate('exames_trials', $form)) {
									
								}
							}
						}
					}else if ($exames[$i]['exame_tipoSlug'] == 'dias-da-semana') {
						$crc = array(0 => 'Domingo', 1=> 'Segunda-feira', 2 =>'Terça-feira', 3 =>'Quarta-feira', 4 => 'Quinta-feira', 5 => 'Sexta-feira', 6 => 'Sábado');
						
					}else if ($exames[$i]['exame_tipoSlug'] == 'meses-cor') {
						
					}
				}
				load(URL_PAINEL.'teste/start-confirme');
			}
?>	
		
		<div class="row">
			<div class="col-md-6 center-block p">
				<p>Você fará <?php echo count($exames).' '.((count($exames) == 1) ? 'teste' : 'testes'); ?> da Bateria de Sinestesia:</p>
				<ul style="margin-bottom: 40px;">
					<?php 
						for ($i=0; $i < count($exames); $i++) { 
							echo '<li>'.$exames[$i]['exame_tipo'].'</li>';
						}
					?>
				</ul>
				<form method="post">
					<div class="form-group text-right">
						<input type="submit" class="btn btn btn-special" name="continuar" value="Continuar">
					</div>
				</form>
			</div>
		</div>
<?php
		}
	}else{

		if (isset($_POST['continuar'])) {
			if (empty($_POST['sines'])) {
				alerta("Escolha um teste!");
			}else{
				//SEM VERIFICACAO SE ELE JÁ REALIZOU AQUELE EXAME
				//load(URL_PAINEL.$url[0].'/confirme');
				//GERAR TOKEN
				$crc = '0123456789ABCDEFGHIJLMNOPQRSTUVWXYXKabcdefghijklmnopqrsvtxyz';
				$str = '';
			    for ($i=0; $i < 100; $i++) {
			    	$rand = $crc[rand(0, 59)];
			    	$str .= $rand;
			    }

				$form['id_user'] 	= $user['id'];
				$form['status'] 	= 1;
				$form['registro'] 	= date('Y-m-d H:i:s');
				$form['token']		= $str;
				$cont=0;
				for ($i=0; $i < count($_POST['sines']); $i++) { 
					$form['exame_tipo'] = $_POST['sines'][$i];
					$form['exame_tipoSlug'] = Slug($_POST['sines'][$i]);
					if (DBcreate('exames_user', $form)) {
						$cont++;
					}
				}
				$up['token'] = $str;
				if (DBUpDate('users', $up, "id = '".$user['id']."'")) {
					if ($cont == count($_POST['sines'])) {
						load(URL_PAINEL.$url[0].'/confirme');
					}
				}
			}
		}
?>
<div class="row">
	<div class="col-md-8 center-block p">
		<h2>Exame</h2>
		<p>Por favor, escolha o(s) tipo(s) de sinestesia que você acha que tem</p>
		<form method="post">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Tipo de Sinestesia</th>
			      <th scope="col">Descrição</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row"><input type="checkbox" value="Número-Cor" name="sines[]"></th>
			      <td>Número-Cor</td>
			      <td>Ver, pensar ou ouvir um número causa uma percepção de cor.</td>
			    </tr>
			    <tr>
			      <th scope="row"><input type="checkbox" value="Letra-Cor" name="sines[]"></th>
			      <td>Letra-Cor</td>
			      <td>Ver, pensar ou ouvir uma letra causa uma percepção de cor.</td>
			    </tr>
			    <tr>
			      <th scope="row"><input type="checkbox" value="Dias da semana-cor" name="sines[]"></th>
			      <td>Dias da semana-cor</td>
			      <td>Os nomes dos dias da semana causam percepções de cor.</td>
			    </tr>
			    <tr>
			      <th scope="row"><input type="checkbox" value="Meses-cor" name="sines[]"></th>
			      <td>Meses-cor</td>
			      <td>Os nomes dos meses do ano causam percepções de cor.</td>
			    </tr>
			  </tbody>
			</table>
			<div class="form-group text-right">
				<input type="submit" class="btn btn btn-special" name="continuar" value="Continuar">
			</div>
		</form>
	</div>
</div>
<?php 
	}
?>