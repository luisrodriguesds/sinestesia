<?php 
	
	//CASO TENHA SAIDO SEM TERMINAR O TESTE
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

	//ENVIAR O PESQUISADOR PRA PÁGINA DE CANDITO
	$pesq = DBread('exames_pesquisadores', "WHERE emailPesquisador = '".$user['email']."'", 'id');
	if ($pesq == true) {
		load(URL_PAINEL.'resultados');
	}

	//ENVIAR O ROOT PARA RESULTADOS
	if ($user['tipoSlug'] == 'root') {
		load(URL_PAINEL.'resultados');
	}
	//CASO QUEIRA COMPARTILHAR O RESULTADO COM ALGUM PESQUISADOR
	if (isset($_POST['continuar'])) {
		if (empty(GetPost('email'))) {
			load(URL_PAINEL.'termo');
		}else{
			if ($user['email'] == GetPost('email')) {
				alerta("Você não pode enviar o resultado para você mesmo!");
			}else{
				$form['emailPesquisador'] = GetPost('email');
				$id = DBread('users', "WHERE email = '".GetPost('email')."'", 'id, email, nome');
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
					$form['nomePesquisador']  = GetPost('nome');
					$form['id_candidato']	  = $user['id'];
					$form['emailCandidato']	  = $user['email'];
					$form['status']			  = 1;
					$form['registro']		  = date('Y-m-d H:i:s');
					if (DBcreate('exames_pesquisadores', $form)) {
						load(URL_PAINEL.'termo');
					}
				}
			}
		}
	}
?>
<div class="row">
	<div class="col-md-6 center-block p">
		<p>
			Você gostaria de compartilhar seus resultados com um pesquisador?
		</p>
		<p style="text-align: justify;">
			Se você estiver participando de alguma pesquisa experimental específica, 
			digite o nome e o email do pesquisador que o direcionou até este site. 
			Caso contrário, deixe as barras de resposta em branco e clique em continuar.
		</p>
		<form method="post">
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="nome" class="form-control" value="<?php echo GetPost('nome'); ?>" name="nome" id="nome">	
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" value="<?php echo GetPost('email'); ?>" name="email" id="email">
			</div>
			<div class="form-group text-right">
				<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Continuar">
			</div>
		</form>
	</div>
</div>