<?php 
	if (DBread('dados', "WHERE id_user = '".$user['id']."'")) {
		load(URL_PAINEL.'teste');
	}	
	
	if (isset($_POST['continuar'])) {
		$form['id_user']    = $user['id'];
		$form['dataNasc'] 	= GetPost('dataNasc');
		$form['sexo'] 		= GetPost('sexo');
		$form['naturalidade'] = GetPost('naturalidade');
		$form['formacao'] 	= GetPost('formacao');
		$form['casoSup'] 	= GetPost('casoSup');
		$form['quest1'] 	= GetPost('quest1');
		$form['quest2'] 	= GetPost('quest2');
		$form['quest3'] 	= GetPost('quest3');
		$form['quest3_2'] 	= GetPost('quest3_2');

		$form['registro'] 	= date('Y-m-d H:i:s');
		$form['status']		= 1;

		if (empty($form['dataNasc']) || empty($form['sexo']) || empty($form['naturalidade']) || empty($form['formacao']) || empty($form['quest1']) || empty($form['quest2']) || empty($form['quest3'])) {
			alerta("Um ou mais campo estão vazios!");
		}else if (DBread('dados', "WHERE id_user = '".$user['id']."'")) {
			if (DBUpDate('dados', $form, "id_user = '".$user['id']."'")) {
				load(URL_PAINEL.'teste');
			}
		}else{
			if (DBcreate('dados', $form)) {
				load(URL_PAINEL.'teste');
			}
		}
	}
?>

<div class="row">
	<div class="col-md-6 center-block p">
		<h3>Seja Bem vindo à Bateria de Sinestesia, <?php echo $user['nome']; ?>! </h3>
		<p>Por favor, resposta às perguntas abaixo:</p>
		<form method="post">
			<div class="form-group">
				<label for="dataNasc">Data de nascimento</label>
				<input type="date" class="form-control" value="<?php echo GetPost('dataNasc'); ?>" name="dataNasc" id="">
			</div>
			<div class="form-group">
				<label for="sexo">Sexo</label>
				<!-- <input type="password" class="form-control" name="password" id="password"> -->
				<select name="sexo" class="form-control">
					<option value="Masculino">Masculino</option>
					<option value="Feminino">Feminino</option>
				</select>
			</div>
			<div class="form-group">
				<label for="naturalidade">Naturalidade</label>
				<input type="text" class="form-control" value="<?php echo GetPost('naturalidade'); ?>" name="naturalidade" id="">
			</div>
			<div class="form-group">
				<label for="formacao">Formação</label>
				<!-- <input type="password" class="form-control" name="password" id="password"> -->
				<select name="formacao" class="form-control">
					<option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
					<option value="Ensino Fundamental Completo ">Ensino Fundamental Completo </option>
					<option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
					<option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
					<option value="Ensino Superior Completo">Ensino Superior Completo</option>
				</select>
			</div>
			<div class="form-group">
				<label for="casoSup">Se você assinalou formação em nível superior, nos informe o seu Curso.</label>
				<input type="text" class="form-control" value="<?php echo GetPost('casoSup'); ?>" name="casoSup" id="">
			</div>
			<div class="form-group">
				<label for="quest1">Você toma alguma medicação que afete o seu Sistema Nervoso Central?</label>
				<select name="quest1" class="form-control">
					<option value="Não">Não</option>
					<option value="Sim">Sim</option>
				</select>
			</div>
			<div class="form-group">
				<label for="quest2">Possui histórico de doenças neurológicas? </label>
				<select name="quest2" class="form-control">
					<option value="Não">Não</option>
					<option value="Sim">Sim</option>
				</select>
			</div>
			<div class="form-group">
				<label for="quest3">Você usou hoje alguma droga ou remédio que afete o seu Sistema Nervoso? Se sim, qual?</label>
				<select name="quest3" class="form-control">
					<option value="Não">Não</option>
					<option value="Sim">Sim</option>
				</select>
			</div>
			<div class="form-group">
				<label for="quest3_2">Se sim, qual?</label>
				<input type="text" class="form-control" value="<?php echo GetPost('qual3_2'); ?>" name="qual3_2" id="">
			</div>

			<div class="form-group text-right">
				<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Salvar e continuar">
			</div>
		</form>
	</div>
</div>