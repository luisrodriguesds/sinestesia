<?php 
	//PROTECAO DA PAGINA 
	$exame = DBread('exames_user', "WHERE token = '".$user['token']."'");
	if ($exame == false) {
		load(URL_PAINEL);
	}else{
		$cont=0;
		for ($i=0; $i < count($exame); $i++) { 
			if ($exame[$i]['status'] == '0') {
				$cont++;
			}
		}
		if ($cont != count($exame)) {
			load(URL_PAINEL.'teste/start-confirme');
		}
	}

	if (isset($url[1]) && $url[1] == 'proximo') {
		if (!DBread('sobre_voce_mesmo', "WHERE id_user = '".$user['id']."'", 'id')) {
			load(URL_PAINEL);
		}	
		if (isset($_POST['continuar'])) {
			load(URL_PAINEL.'associador-projetor');
		}
		?>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-10 center-block p">
				<div style="padding: 60px 0 60px 0;">
					<center>
						<h2>A seguir você fará o último teste da Bateria.  </h2>
						<form method="post">
							<div class="form-group text-center">
								<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Continuar">
							</div>
						</form>
					</center>
				</div>
			</div>
		</div>
		<?php
	}else if (isset($url[1]) && $url[1] == '2') {
		if (isset($_POST['enviar'])) {
			$form['id_user'] = $user['id'];
			$form['quest_14'] = GetPost('quest_14');
			$form['quest_15'] = GetPost('quest_15');
			$form['quest_16'] = GetPost('quest_16');
			$form['quest_17'] = GetPost('quest_17');
			$form['quest_18'] = GetPost('quest_18');
			$form['quest_19'] = GetPost('quest_19');
			$form['quest_20'] = GetPost('quest_20');
			$form['quest_21'] = GetPost('quest_21');
			$form['quest_22'] = GetPost('quest_22');
			$form['quest_23'] = GetPost('quest_23');
			$form['quest_24'] = GetPost('quest_24');
			$form['quest_25'] = GetPost('quest_25');
			$form['quest_26'] = GetPost('quest_26');
			$form['quest_27'] = GetPost('quest_27');
			$form['quest_28'] = GetPost('quest_28');
			$form['status']		= 1;
			$form['registro'] = date('Y-m-d H:i:s');	
			if (empty($form['quest_14'])) {
				alerta("Questão 1 vazia");
			}else if (empty($form['quest_15'])) {
				alerta("Questão 2 vazia");
			}else if (empty($form['quest_16'])) {
				alerta("Questão 3 vazia");
			}else if (empty($form['quest_17'])) {
				alerta("Questão 4 vazia");
			}else if (empty($form['quest_18'])) {
				alerta("Questão 5 vazia");
			}else if (empty($form['quest_19'])) {
				alerta("Questão 6 vazia");
			}else if (empty($form['quest_20'])) {
				alerta("Questão 7 vazia");
			}else if (empty($form['quest_21'])) {
				alerta("Questão 8 vazia");
			}else if (empty($form['quest_22'])) {
				alerta("Questão 9 vazia");
			}else if (empty($form['quest_23'])) {
				alerta("Questão 10 vazia");
			}else if (empty($form['quest_24'])) {
				alerta("Questão 11 vazia");
			}else if (empty($form['quest_25'])) {
				alerta("Questão 12 vazia");
			}else if (empty($form['quest_26'])) {
				alerta("Questão 13 vazia");
			}else if (empty($form['quest_27'])) {
				alerta("Questão 13 vazia");
			}else if (empty($form['quest_28'])) {
				alerta("Questão 13 vazia");
			}else{
				$quest = DBread('sobre_voce_mesmo', "WHERE id_user = '".$user['id']."'",'id');
				if ($quest == false) {
					if (DBcreate('sobre_voce_mesmo', $form)) {
						load(URL_PAINEL.$url[0].'/proximo');
					}	
				}else{
					if (DBUpDate('sobre_voce_mesmo', $form, "id = '".$user['id']."'")) {
						load(URL_PAINEL.$url[0].'/proximo');
					}
				}
			}
		}
		?>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-10 center-block p">
				<div class="row">
					<div class="col-md-12 text-center" style="margin-bottom: 1em">
						<h2>Atenção!</h2>
						<p>Por favor, responda a segunda parte do nosso questionário e depois clique em salvar e continuar.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 center-block">
						<form method="post">
							<div class="form-group">
								<label for=""> <strong>1. Eu não posso tolerar experiências que eu não gosto (por exemplo, cheiros, sons, texturas e cores):</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_14'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_14"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_14'), 'Verdade apenas agora') ?> name="quest_14"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_14'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_14"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_14'), 'Nunca foi verdade') ?> name="quest_14"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>2. Eu não gosto de ser tocado ou abraçado:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_15'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_15"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_15'), 'Verdade apenas agora') ?> name="quest_15"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_15'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_15"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_15'), 'Nunca foi verdade') ?> name="quest_15"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>3. Se eu estiver em um lugar com muitos cheiros, texturas, ruídos ou luzes brilhantes, posso ficar sobrecarregado de sensações e me sentir em pânico, ansioso ou assustado:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_16'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_16"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_16'), 'Verdade apenas agora') ?> name="quest_16"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_16'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_16"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_16'), 'Nunca foi verdade') ?> name="quest_16"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>4. O mesmo som às vezes parece muito alto ou muito suave, embora eu saiba que não mudou:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_17'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_17"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_17'), 'Verdade apenas agora') ?> name="quest_17"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_17'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_17"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_17'), 'Nunca foi verdade') ?> name="quest_17"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>5. Às vezes, as coisas que devem ser dolorosas não são (por exemplo, quando me machuco ou queimo a mão no fogão):</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_18'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_18"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_18'), 'Verdade apenas agora') ?> name="quest_18"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_18'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_18"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_18'), 'Nunca foi verdade') ?> name="quest_18"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>6. Às vezes, quando me sinto sobrecarregado pelos meus sentidos, tenho que me isolar para desligá-los:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_19'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_19"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_19'), 'Verdade apenas agora') ?> name="quest_19"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_19'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_19"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_19'), 'Nunca foi verdade') ?> name="quest_19"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>7. Às vezes eu tenho que cobrir meus ouvidos para bloquear ruídos dolorosos (como aspiradores de pó ou pessoas falando muito ou muito alto):</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_20'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_20"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_20'), 'Verdade apenas agora') ?> name="quest_20"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_20'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_20"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_20'), 'Nunca foi verdade') ?> name="quest_20"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>8. Eu sou mais sensível aos cheiros do que qualquer um que conheço:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_21'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_21"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_21'), 'Verdade apenas agora') ?> name="quest_21"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_21'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_21"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_21'), 'Nunca foi verdade') ?> name="quest_21"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>9. Algumas texturas comuns que não incomodam os outros são muito ofensivas quando tocam a minha pele:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_22'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_22"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_22'), 'Verdade apenas agora') ?> name="quest_22"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_22'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_22"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_22'), 'Nunca foi verdade') ?> name="quest_22"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>10. Minhas sensações podem mudar de repente de muito sensíveis para muito maçantes:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_23'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_23"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_23'), 'Verdade apenas agora') ?> name="quest_23"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_23'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_23"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_23'), 'Nunca foi verdade') ?> name="quest_23"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>11. Às vezes o som de uma palavra ou um ruído agudo pode ser doloroso para os meus ouvidos:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_24'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_24"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_24'), 'Verdade apenas agora') ?> name="quest_24"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_24'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_24"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_24'), 'Nunca foi verdade') ?> name="quest_24"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>12. Às vezes eu falo muito alto ou muito baixo, e não tenho consciência disso:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_25'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_25"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_25'), 'Verdade apenas agora') ?> name="quest_25"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_25'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_25"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_25'), 'Nunca foi verdade') ?> name="quest_25"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>13. Não me lembro dos rostos das pessoas. É mais provável que eu me lembre de algo sobre eles que outros possam considerar peculiar (como o cheiro de uma pessoa):</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_26'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_26"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_26'), 'Verdade apenas agora') ?> name="quest_26"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_26'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_26"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_26'), 'Nunca foi verdade') ?> name="quest_26"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>14. Eu sempre percebo como a comida fica na minha boca. Isso é tão importante para mim quanto o gosto:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_27'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_27"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_27'), 'Verdade apenas agora') ?> name="quest_27"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_27'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_27"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_27'), 'Nunca foi verdade') ?> name="quest_27"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<label for=""> <strong>15. Eu sou muito sensível à maneira como eu sinto minhas roupas quando eu as toco. Como eu as sinto é mais importante para mim do que como eles se parecem:</strong> </label>
								<div><input type="radio" value="Verdade agora e para quando eu era mais novo" <?php echo printRadio(GetPost('quest_28'), 'Verdade agora e para quando eu era mais novo') ?> name="quest_28"> Verdade agora e para quando eu era mais novo </div>
								<div><input type="radio" value="Verdade apenas agora" <?php echo printRadio(GetPost('quest_28'), 'Verdade apenas agora') ?> name="quest_28"> Verdade apenas agora</div>
								<div><input type="radio" value="Verdade apenas para quando eu era mais novo" <?php echo printRadio(GetPost('quest_28'), 'Verdade apenas para quando eu era mais novo') ?> name="quest_28"> Verdade apenas para quando eu era mais novo</div>
								<div><input type="radio" value="Nunca foi verdade" <?php echo printRadio(GetPost('quest_28'), 'Nunca foi verdade') ?> name="quest_28"> Nunca foi verdade</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary btn-color" name="enviar" value="Salvar e continuar">
							</div>
						</form>
					</div>
				</div>
		</div>

		<?php
	}else{
		if (isset($_POST['enviar'])) {
			$form['id_user'] = $user['id'];
			$form['quest_1'] = GetPost('quest_1');
			$form['quest_2'] = GetPost('quest_2');
			$form['quest_3'] = GetPost('quest_3');
			$form['quest_4'] = GetPost('quest_4');
			$form['quest_5'] = GetPost('quest_5');
			$form['quest_6'] = GetPost('quest_6');
			$form['quest_7'] = GetPost('quest_7');
			$form['quest_8'] = GetPost('quest_8');
			$form['quest_9'] = GetPost('quest_9');
			$form['quest_10'] = GetPost('quest_10');
			$form['quest_11'] = GetPost('quest_11');
			$form['quest_12'] = GetPost('quest_12');
			$form['quest_13'] = GetPost('quest_13');
			$form['status']	= 1;
			$form['registro'] = date('Y-m-d H:i:s');

			if (empty($form['quest_1'])) {
				alerta("Questão 1 vazia");
			}else if (empty($form['quest_2'])) {
				alerta("Questão 2 vazia");
			}else if (empty($form['quest_3'])) {
				alerta("Questão 3 vazia");
			}else if (empty($form['quest_4'])) {
				alerta("Questão 4 vazia");
			}else if (empty($form['quest_5'])) {
				alerta("Questão 5 vazia");
			}else if (empty($form['quest_6'])) {
				alerta("Questão 6 vazia");
			}else if (empty($form['quest_7'])) {
				alerta("Questão 7 vazia");
			}else if (empty($form['quest_8'])) {
				alerta("Questão 8 vazia");
			}else if (empty($form['quest_9'])) {
				alerta("Questão 9 vazia");
			}else if (empty($form['quest_10'])) {
				alerta("Questão 10 vazia");
			}else if (empty($form['quest_11'])) {
				alerta("Questão 11 vazia");
			}else if (empty($form['quest_12'])) {
				alerta("Questão 12 vazia");
			}else if (empty($form['quest_13'])) {
				alerta("Questão 13 vazia");
			}else{
				$quest = DBread('sobre_voce_mesmo', "WHERE id_user = '".$user['id']."'",'id');
				if ($quest == false) {
					if (DBcreate('sobre_voce_mesmo', $form)) {
						load(URL_PAINEL.$url[0].'/2');
					}	
				}else{
					if (DBUpDate('sobre_voce_mesmo', $form, "id = '".$user['id']."'")) {
						load(URL_PAINEL.$url[0].'/2');
					}
				}
			}
		}	

?>
<div class="row" style="margin-top: 50px;">
	<div class="col-md-10 center-block p">
		<div class="row">
			<div class="col-md-12 text-center" style="margin-bottom: 1em">
				<h2>Atenção!</h2>
				<p>Por favor, responda o questionário a seguir e depois clique em continuar.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 center-block">
				<form method="post">
					<div class="form-group">
						<label for=""> <strong>1. Alguém da sua família também tem sinestesia?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_1'), 'sim') ?> name="quest_1"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_1'), 'nao') ?> name="quest_1"> Não</div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_1'), 'nao sei') ?> name="quest_1"> Não sei</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>2. Você é destro, canhoto ou ambidestro?</strong> </label>
						<div><input type="radio" value="destro" <?php echo printRadio(GetPost('quest_2'), 'destro') ?> name="quest_2"> Destro </div>
						<div><input type="radio" value="canhoto" <?php echo printRadio(GetPost('quest_2'), 'canhoto') ?> name="quest_2"> Canhoto</div>
						<div><input type="radio" value="ambidestro" <?php echo printRadio(GetPost('quest_2'), 'ambidestro') ?> name="quest_2"> Ambidestro</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>3. Você tem ouvido absoluto?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_3'), 'sim') ?> name="quest_3"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_3'), 'nao') ?> name="quest_3"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>4. Quando criança, você teve infecções crônicas no ouvido?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_4'), 'sim') ?> name="quest_4"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_4'), 'nao') ?> name="quest_4"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>5. Você já experienciou um golpe traumático na cabeça?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_5'), 'sim') ?> name="quest_5"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_5'), 'nao') ?> name="quest_5"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>6. Você sofre de enxaqueca?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_6'), 'sim') ?> name="quest_6"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_6'), 'nao') ?> name="quest_6"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>7. Você já teve um ataque epiléptico?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_7'), 'sim') ?> name="quest_7"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_7'), 'nao') ?> name="quest_7"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>8. Você toma ou já tomou algum medicamento antidepressivo ou antipsicótico?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_8'), 'sim') ?> name="quest_8"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_8'), 'nao') ?> name="quest_8"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>9. Você toma ou já tomou algum medicamento para TDA (transtorno de déficit de atenção) ou para TDAH (transtorno de déficit de atenção/hiperatividade)? E para alguma condição relacionada?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_9'), 'sim') ?> name="quest_9"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_9'), 'nao') ?> name="quest_9"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>10. Você notou uma mudança na sua sinestesia depois de tomar analgésicos vendidos sem prescrição médicas?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_10'), 'sim') ?> name="quest_10"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_10'), 'nao') ?> name="quest_10"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>11. Você já foi profissionalmente diagnosticado com autismo e/ou com síndrome de Asperger?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_11'), 'sim') ?> name="quest_11"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_11'), 'nao') ?> name="quest_11"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>12. Você já recebeu um diagnóstico de tumor cerebral?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_12'), 'sim') ?> name="quest_12"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_12'), 'nao') ?> name="quest_12"> Não</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>13. Você já foi diagnosticado com dislexia, discalculia e/ou disgrafia?</strong> </label>
						<div><input type="radio" value="sim" <?php echo printRadio(GetPost('quest_13'), 'sim') ?> name="quest_13"> Sim </div>
						<div><input type="radio" value="nao" <?php echo printRadio(GetPost('quest_13'), 'nao') ?> name="quest_13"> Não</div>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-color" name="enviar" value="Salvar e continuar">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php } ?>