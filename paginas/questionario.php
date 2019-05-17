<?php 
	if (isset($url[1]) && $url[1] == 'mensagem') {
		
		?>
		<div class="gtco-section">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 gtco-heading text-center" style="margin-bottom: 1em">
						<h2>Atenção!</h2>
						
						<?php 
							if (!isset($_GET['resultado'])) {
								load(URLBASE);
							}else if($_GET['resultado'] == 'sim'){
						?>
							<p>De acordo com a triagem, você pode ter sinestesia. Clique em continuar, faça seu registro e comece a Bateria. </p>
							<div class="row">
								<a href="<?php echo URLBASE.'login/registrar'; ?>" class="btn btn btn-special">Continuar</a>
							</div>
						<?php
							}else if($_GET['resultado'] == 'nao'){
						?>
							<p>De acordo com a triagem, você não tem sinestesia. Obrigado por colaborar conosco!</p>
							<div class="row">
								<a href="<?php echo URLBASE; ?>" class="btn btn btn-special">Continuar</a>
							</div>
						<?php
							}
						?>

						
					</div>
				</div>
			</div>
		</div>			

		<?php
	
	}else{

	if (isset($_POST['enviar'])) {
		$form['quest_1'] = GetPost('quest_1');
		$form['quest_2'] = GetPost('quest_2');
		$form['quest_3'] = GetPost('quest_3');
		$form['quest_4'] = GetPost('quest_4');
		$form['quest_5'] = GetPost('quest_5');
		$form['quest_6'] = GetPost('quest_6');
		$form['quest_7'] = GetPost('quest_7');
		$form['quest_8'] = GetPost('quest_8');

		if (empty($form['quest_1'])) {
			alerta("Preencha a questão 1");
		}else if (empty($form['quest_2'])) {
			alerta("Preencha o questão 2");
		}else if (empty($form['quest_3'])) {
			alerta("Preencha o questão 3");
		}else if (empty($form['quest_4'])) {
			alerta("Preencha o questão 4");
		}else if (empty($form['quest_5'])) {
			alerta("Preencha o questão 5");
		}else if (empty($form['quest_6'])) {
			alerta("Preencha o questão 6");
		}else if (empty($form['quest_7'])) {
			alerta("Preencha o questão 7");
		}else if (empty($form['quest_8'])) {
			alerta("Preencha o questão 8");
		}else{
			$cont = 0;
			if ($form['quest_1'] == 'sim') {
				$cont++;
			}else if ($form['quest_2'] == 'sim') {
				$cont++;
			}else if ($form['quest_3'] == 'sim') {
				$cont++;
			}else if ($form['quest_4'] == 'sim') {
				$cont++;
			}else if ($form['quest_5'] == 'sim') {
				$cont++;
			}else if ($form['quest_6'] == 'sim') {
				$cont++;
			}else if ($form['quest_7'] == 'sim') {
				$cont++;
			}

			if ($cont >= 1) {
				//PODE TER
				load(URLBASE.$url[0].'/mensagem?resultado=sim');
			}else{
				//NAO TEM 
				load(URLBASE.$url[0].'/mensagem?resultado=nao');
			}
		} 
	}
?>
<div class="gtco-section">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 gtco-heading text-center" style="margin-bottom: 1em">
				<h2>Questionário</h2>
				<p>Antes de você começar a Bateria, descubra se você pode ter sinestesia.</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 center-block">
				<form method="post">
					<div class="form-group">
						<label for=""> <strong>1. Os números ou as letras fazem com que você tenha uma experiência relacionada às cores? Por exemplo, a letra J tem a cor amarela para você? O número 5 é associado ao tom lilás?</strong> </label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<p><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_1'), 'sim') ?> name="quest_1"> Sim, eu tenho experiências dessa natureza </p>
						<p><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_1'), 'nao') ?> name="quest_1"> Não, eu nunca experienciei nada dessa natureza</p>
					</div>
					<div class="form-group">
						<label for=""> 
							<strong>
						2.	Os dias da semana e os meses têm cores específicas? Por exemplo, julho parece ser sempre azul marinho para você? Quarta-feira é sempre laranja?
							</strong> 
						</label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<p><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_2'), 'sim') ?> name="quest_2"> Sim, eu tenho experiências dessa natureza </p>
						<p><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_2'), 'nao') ?> name="quest_2"> Não, eu nunca experienciei nada dessa natureza</p>
					</div>
					<div class="form-group">
						<label for=""> 
							<strong>
						3.	Você imagina ou visualiza os dias da semana, os meses e/ou os anos possuindo uma localização particular no espaço ao seu redor? Por exemplo, setembro está sempre localizado um metro a sua frente?
							</strong> 
						</label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<p><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_3'), 'sim') ?> name="quest_3"> Sim, eu tenho experiências dessa natureza </p>
						<p><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_3'), 'nao') ?> name="quest_3"> Não, eu nunca experienciei nada dessa natureza</p>
					</div>
					<div class="form-group">
						<label for=""> 
							<strong>
						4.	Ouvir um som faz com que você perceba uma cor? Por exemplo, o barulho de um carro faz com que você veja a cor verde? O barulho do freio de um ônibus faz você ver a cor rosa?
							</strong> 
						</label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<p><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_4'), 'sim') ?> name="quest_4"> Sim, eu tenho experiências dessa natureza </p>
						<p><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_4'), 'nao') ?> name="quest_4"> Não, eu nunca experienciei nada dessa natureza</p>
					</div>
					<div class="form-group">
						<label for=""> 
							<strong>
						5.	Certas palavras provocam um gosto na boca? Por exemplo, o nome Douglas tem gosto de cera?
							</strong> 
						</label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<p><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_5'), 'sim') ?> name="quest_5"> Sim, eu tenho experiências dessa natureza </p>
						<p><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_5'), 'nao') ?> name="quest_5"> Não, eu nunca experienciei nada dessa natureza</p>
					</div>
					<div class="form-group">
						<label for=""> 
							<strong>
						6.	Você experiencia uma sensação de toque quando cheira as coisas? Por exemplo, o cheiro de café faz você se sentir como se estivesse tocando uma superfície de vidro frio?
							</strong> 
						</label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<p><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_6'), 'sim') ?> name="quest_6"> Sim, eu tenho experiências dessa natureza </p>
						<p><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_6'), 'nao') ?> name="quest_6"> Não, eu nunca experienciei nada dessa natureza</p>
					</div>
					<div class="form-group">
						<label for=""> 
							<strong>
						7.	Nós descrevemos alguns tipos de sinestesia. Muitos outros cruzamentos de sentidos ainda não foram relatados. Você suspeita que experimente alguma interferência sensorial incomum que outras pessoas não possuem (exceto as que estão listadas acima)? Estas podem incluir, simultaneamente, ouvir um som quando você vê o movimento, sentir uma forma sendo desencadeada por um gosto ou experimentar uma cor ao sentir dor.
							</strong> 
						</label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<p><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_7'), 'sim') ?> name="quest_7"> Sim, acredito que posso ter outras formas de experiências sensoriais incomuns  </p>
						<p><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_7'), 'nao') ?> name="quest_7"> Não, eu nunca experienciei nada dessa natureza</p>
					</div>
					<div class="form-group">
						<label for=""> 
							<strong>
						8.	Se quiser, você pode escrever algo aqui sobre sua experiência sinestésica ou sobre alguma interferência de sentido que você experiência:					
							</strong> 
						</label>
						<!-- <input type="email" class="form-control" value="" name="email" id="email"> -->
						<textarea class="form-control" name="quest_8"><?php echo GetPost('quest_8'); ?></textarea>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-color" name="enviar" value="Enviar">
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

<?php } ?>