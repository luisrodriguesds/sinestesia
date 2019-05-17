
<?php 

if (isset($url[1]) && $url[1] == 'finish') {
	if (isset($_POST['continuar'])) {
		if (GetPost('email_pesquisador')) {
			$form['emailPesquisador'] = GetPost('email_pesquisador');
				$id = DBread('users', "WHERE email = '".GetPost('email_pesquisador')."'", 'id, email, nome');
				if ($id == true) {
					if (DBread('exames_user', "WHERE id_user = '".$id[0]['id']."'", 'id')) {
						alerta("Esse email já realizou exames enão pode receber exames de terceiros.");
					}else{
						$form['nomePesquisador']  = $id[0]['nome'];
						$form['id_candidato']	  = $user['id'];
						$form['emailCandidato']	  = $user['email'];
						$form['status']			  = 1;
						$form['registro']		  = date('Y-m-d H:i:s');
						if (DBcreate('exames_pesquisadores', $form)) {
							load(URL_PAINEL.'termo');
						}						
					}
				}else{
					$form['nomePesquisador']  = '';
					$form['id_candidato']	  = $user['id'];
					$form['emailCandidato']	  = $user['email'];
					$form['status']			  = 1;
					$form['registro']		  = date('Y-m-d H:i:s');
					if (DBcreate('exames_pesquisadores', $form)) {
						load(URL_PAINEL.'termo');
					}
				}
		}else{
			load(URL_PAINEL.'resultados');
		}
	}
?>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-6 center-block p">
				<div style="padding: 60px 0 60px 0;">
					<center>
						<p><strong>Você concluiu a Bateria de Sinestesia! Obrigado por sua colaboração!</strong></p>
						<p style="text-align: justify;"> Você pode acessar os resultados do seus testes através do seu email e da sua senha ou clicando em ver resultados. Confirme o email do pesquisador no campo abaixo, caso você esteja vinculado a alguma pesquisa.  </p>
						<form method="post">
							<div class="form-group">
								<input type="text" placeholder="email do seu pesquisador" class="form-control" value="<?php echo GetPost('email_pesquisador'); ?>" name="email_pesquisador" id="">
							</div>
							<div class="form-group text-center">
								<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Ver resultados">
							</div>
						</form>
					</center>
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
			// $form['quest_9'] = GetPost('quest_9');
			$form['quest_10'] = GetPost('quest_10');
			$form['quest_11'] = GetPost('quest_11');
			$form['quest_12'] = GetPost('quest_12');
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
			}else if (empty($form['quest_10'])) {
				alerta("Questão 10 vazia");
			}else if (empty($form['quest_11'])) {
				alerta("Questão 11 vazia");
			}else if (empty($form['quest_12'])) {
				alerta("Questão 12 vazia");
			}else{
				$quest = DBread('associador_projetor', "WHERE id_user = '".$user['id']."'",'id');
				if ($quest == false) {
					if (DBcreate('associador_projetor', $form)) {
						load(URL_PAINEL.$url[0].'/finish');
					}	
				}else{
					if (DBUpDate('associador_projetor', $form, "id = '".$user['id']."'")) {
						load(URL_PAINEL.$url[0].'/finish');
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
				<p>Por favor, indique até que ponto essas declarações correspondem às suas experiências sinestésicas.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 center-block">
				<form method="post">
					<div class="form-group">
						<label for=""> <strong>1. Quando olho para um determinado estímulo (como letras, números, dias da semana e meses do ano), vejo uma cor específica:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_1'), 'discordo totalmente') ?> name="quest_1"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_1'), 'discordo Parcialmente') ?> name="quest_1"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_1'), 'Nem Concordo e nem Discordo') ?> name="quest_1"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_1'), 'Concordo Parcialmente') ?> name="quest_1"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_1'), 'concordo totalmente') ?> name="quest_1"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>2. Quando olho para um determinado estímulo, a sensação de cor aparece apenas em meus pensamentos e não em algum lugar fora da minha cabeça (como no papel):</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_2'), 'discordo totalmente') ?> name="quest_2"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_2'), 'discordo Parcialmente') ?> name="quest_2"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_2'), 'Nem Concordo e nem Discordo') ?> name="quest_2"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_2'), 'Concordo Parcialmente') ?> name="quest_2"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_2'), 'concordo totalmente') ?> name="quest_2"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>3. Quando olho para um determinado estímulo, a sensação de cor aparece em meus pensamentos, mas no papel aparece apenas a cor em que o estímulo é impresso (por exemplo, uma letra preta contra um fundo branco):</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_3'), 'discordo totalmente') ?> name="quest_3"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_3'), 'discordo Parcialmente') ?> name="quest_3"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_3'), 'Nem Concordo e nem Discordo') ?> name="quest_3"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_3'), 'Concordo Parcialmente') ?> name="quest_3"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_3'), 'concordo totalmente') ?> name="quest_3"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>4. Parece que a cor está no estímulo quando estes são impressos no papel:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_4'), 'discordo totalmente') ?> name="quest_4"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_4'), 'discordo Parcialmente') ?> name="quest_4"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_4'), 'Nem Concordo e nem Discordo') ?> name="quest_4"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_4'), 'Concordo Parcialmente') ?> name="quest_4"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_4'), 'concordo totalmente') ?> name="quest_4"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>5. O estímulo em si não tem cor, mas estou ciente de que ele está associado a uma cor específica:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_5'), 'discordo totalmente') ?> name="quest_5"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_5'), 'discordo Parcialmente') ?> name="quest_5"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_5'), 'Nem Concordo e nem Discordo') ?> name="quest_5"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_5'), 'Concordo Parcialmente') ?> name="quest_5"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_5'), 'concordo totalmente') ?> name="quest_5"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>6. A cor é projetada (impressa) no estímulo:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_6'), 'discordo totalmente') ?> name="quest_6"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_6'), 'discordo Parcialmente') ?> name="quest_6"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_6'), 'Nem Concordo e nem Discordo') ?> name="quest_6"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_6'), 'Concordo Parcialmente') ?> name="quest_6"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_6'), 'concordo totalmente') ?> name="quest_6"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>7. Eu não vejo os estímulos literalmente em uma cor, mas tenho um forte sentimento de que eu sei qual cor pertence a cada um deles:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_7'), 'discordo totalmente') ?> name="quest_7"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_7'), 'discordo Parcialmente') ?> name="quest_7"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_7'), 'Nem Concordo e nem Discordo') ?> name="quest_7"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_7'), 'Concordo Parcialmente') ?> name="quest_7"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_7'), 'concordo totalmente') ?> name="quest_7"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>8. A cor do estímulo não está no papel, mas flutua no espaço:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_8'), 'discordo totalmente') ?> name="quest_8"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_8'), 'discordo Parcialmente') ?> name="quest_8"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_8'), 'Nem Concordo e nem Discordo') ?> name="quest_8"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_8'), 'Concordo Parcialmente') ?> name="quest_8"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_8'), 'concordo totalmente') ?> name="quest_8"> Concordo totalmente</div>
					</div>
					<!-- <div class="form-group">
						<label for=""> <strong>9. A cor tem a mesma forma que a letra e/ou que o número:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php // echo printRadio(GetPost('quest_9'), 'discordo totalmente') ?> name="quest_9"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php // echo printRadio(GetPost('quest_9'), 'discordo Parcialmente') ?> name="quest_9"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php // echo printRadio(GetPost('quest_9'), 'Nem Concordo e nem Discordo') ?> name="quest_9"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php /// echo printRadio(GetPost('quest_9'), 'Concordo Parcialmente') ?> name="quest_9"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php // echo printRadio(GetPost('quest_9'), 'concordo totalmente') ?> name="quest_9"> Concordo totalmente</div>
					</div> -->
					<div class="form-group">
						<label for=""> <strong>9. Eu vejo a cor do estímulo apenas na minha cabeça:</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_10'), 'discordo totalmente') ?> name="quest_10"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_10'), 'discordo Parcialmente') ?> name="quest_10"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_10'), 'Nem Concordo e nem Discordo') ?> name="quest_10"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_10'), 'Concordo Parcialmente') ?> name="quest_10"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_10'), 'concordo totalmente') ?> name="quest_10"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>10. Eu vejo a cor sinestésica muito claramente na proximidade do estímulo (por exemplo, em cima ou atrás ou acima):</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_11'), 'discordo totalmente') ?> name="quest_11"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_11'), 'discordo Parcialmente') ?> name="quest_11"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_11'), 'Nem Concordo e nem Discordo') ?> name="quest_11"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_11'), 'Concordo Parcialmente') ?> name="quest_11"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_11'), 'concordo totalmente') ?> name="quest_11"> Concordo totalmente</div>
					</div>
					<div class="form-group">
						<label for=""> <strong>11. Quando olho para um certo estímulo, a cor sinestésica aparece em algum lugar fora da minha cabeça (como no papel):</strong> </label>
						<div><input type="radio" value="discordo totalmente" <?php echo printRadio(GetPost('quest_12'), 'discordo totalmente') ?> name="quest_12"> Discordo totalmente </div>
						<div><input type="radio" value="discordo Parcialmente" <?php echo printRadio(GetPost('quest_12'), 'discordo Parcialmente') ?> name="quest_12"> Discordo Parcialmente</div>
						<div><input type="radio" value="Nem Concordo e nem Discordo" <?php echo printRadio(GetPost('quest_12'), 'Nem Concordo e nem Discordo') ?> name="quest_12"> Nem Concordo e nem Discordo</div>
						<div><input type="radio" value="Concordo Parcialmente" <?php echo printRadio(GetPost('quest_12'), 'Concordo Parcialmente') ?> name="quest_12"> Concordo Parcialmente</div>
						<div><input type="radio" value="concordo totalmente" <?php echo printRadio(GetPost('quest_12'), 'concordo totalmente') ?> name="quest_12"> Concordo totalmente</div>
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