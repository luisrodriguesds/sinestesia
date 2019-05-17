<?php
	//FICARÁ TANTO OS RESULTADOS INDIVIDUAIS QUANTOS OS GERAIS E OS PESQUISADORES ACESSARAO ESSA PÁGINA PARA VER OS RESULTADOS DOS SEUS CANDIDATOS


	// $exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = '0'");
	
	// $trials = DBread('exames_trials', "WHERE id_exame = '".$exames[1]['id']."' AND id_user = '".$user['id']."' AND status_bloco = false ORDER BY valor ASC", 'id, exame_tipoSlug, valor, cor_rgb');
	// // var_dump(getRGB($trials[1]['cor_rgb']));

	// // var_dump(intval(abs(-1234567890)));
	// $k=0;
	// for ($i=0; $i < count($trials)/3; $i++) { 
		
	// 	for ($j=1; $j <= 3; $j++) { 
	// 		//SOMENTE PARA VER CADA VALOR
	// 		// echo $trials[$k]['valor'];
	// 		//EXTRAIR O RGB DE CADA GRUPO DE TRIALS
	// 		$x['x'.$j] = getRGB($trials[$k]['cor_rgb']);
	// 		$k++;
	// 	}
	// 	//CALCULO PARA CADA LETRA
	// 	$vj[$i]['score'] = 0;
	// 	$vj[$i]['valor'] = $trials[$k-1]['valor'];
	// 	for ($j=0; $j < count($x); $j++) { 
	// 		$vj[$i]['score'] = $vj[$i]['score'] + abs($x['x1'][$j] - $x['x2'][$j]) + abs($x['x2'][$j] - $x['x3'][$j]) + abs($x['x3'][$j] - $x['x1'][$j]);
	// 	}
	// }

	// $v = 0;
	// for ($i=0; $i < count($vj); $i++) { 
	// 	$v = $v + $vj[$i]['score'];
	// }
	// $v = $v/(count($trials)/3);
	// //questao de visualizacao
	// $v = $v/1000;

	// var_dump($v);
	// echo round($v, 2);
	// var_dump($vj);
	//ORIENTACOES PARA RESULTAOS -> UMA PAGINACAO PARA ROOT(USUARIO MASTER), PARA PESQUISADOR(APENAS VISUALIZA DADOS), E UMA PARA CANDIDATO 
	
	$pesquisador = DBread('exames_pesquisadores', "WHERE emailPesquisador = '".$user['email']."'");
	

	if ($pesquisador == true) {
	//PAGINACAO PARA PESQUISADOR
		?>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-10 center-block p">
				<div class="row">
					<div class="col-md-12 text-center" style="margin-bottom: 1em;">
						<h2>Resultados!</h2>
						<p></p>
					</div>
				</div>
				
				<?php 
					//PAGINACAO DE FATO
					if (isset($url[1]) && $url[1] != '') {
						$id_user = DBescape($url[1]);
						$cand    = DBread('users', "WHERE id = '".$id_user."'");
						if ($cand == false) {
							echo '<h2>Nada encontrado</h2>';
						}else{
							$exames = DBread('exames_user', "WHERE id_user = '".$id_user."' AND status = '0' ORDER BY id ASC");
							if ($exames == false) {
								echo '<p>Parece que esse candidato não fez nenhum teste valido :( </p>';
							}else{
								calc_sinestesia($cand[0], $exames, 'pesquisador');
							}
						}
					}else{
						//TABELAS PARA EXIBIR OS TESTE DOS SINESTETAS

						?>
						<div class="row">
							<div class="col-md-10 center-block">
								<div class="row">
									<div class="col-md-12 center-block">
										<p>Caro pesquisador, seja bem vindo a sua base dados. 
										<br><br>Você pode acessar os resultados dos seus participantes individualmente e reenviar os testes para eles quando achar necessário. 
										<br><br>Se houver alguma dúvida, entre em contato conosco através do seguinte e-mail: (brendasouza@letras.ufc.br).</p>
									</div>
								</div>
								<table class="table table-bordered text-center">
								  <thead>
								    <tr>
								      <th class="text-center">Nome</th>
								      <th class="text-center">Email</th>
								      <th class="text-center">Testes</th>
								      <th class="text-center">Data de início</th>
								      <th class="text-center">Data de término</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php 
								  		for ($i=0; $i < count($pesquisador); $i++) { 
								  			$nome = DBread('users', "WHERE email = '".$pesquisador[$i]['emailCandidato']."'", 'nome');
											$exames = DBread('exames_user', "WHERE id_user = '".$pesquisador[$i]['id_candidato']."' AND status = '0' ORDER BY id ASC", 'id, registro');
								  			
								  	?>
								  		<tr>
								  			<td><a href="<?php echo $way.$url[0].'/'.$pesquisador[$i]['id_candidato']; ?>"><?php echo $nome[0]['nome']; ?></a></td>
								  			<td><a href="<?php echo $way.$url[0].'/'.$pesquisador[$i]['id_candidato']; ?>"><?php echo $pesquisador[$i]['emailCandidato']; ?></a></td>
								  			<td><?php echo (($exames == false) ? '0' : count($exames)); ?></td>
								  			<td><?php echo (($exames == false) ? '--/--/--' : date('d/m/Y', strtotime($exames[0]['registro']))); ?></td>
								  			<td>
								  				<?php   
								  					if ($exames == false) {
								  						echo '--/--/--';
								  					}else{
								  						$trials = DBread('exames_trials', "WHERE id_exame = '".$exames[count($exames)-1]['id']."' AND id_user = '".$pesquisador[$i]['id_candidato']."' ORDER BY id DESC LIMIT 1", 'id, time');
								  						echo date('d/m/Y', strtotime($trials[0]['time']));
								  					}
								  				?>		
								  			</td>
								  		</tr>
								  	<?php
								  		}
								  	?>
								  </tbody>
								</table>
							</div>
						</div>
						<?php
					}
				?>
				<div class="row" style="margin-top: 50px;">
					<div class="col-md-10 center-block text-center">
						<a href="?logout" class="btn btn-primary btn-color"> Voltar para página inicial</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}else if ($user['tipoSlug'] == 'root') {
	//PAGINACAO PARA ROOT
		?>

		<div class="row" style="margin-top: 50px;">
			<div class="col-md-10 center-block p">
				<div class="row">
					<div class="col-md-12 text-center" style="margin-bottom: 1em;">
						<h2>Resultados!</h2>
						<p></p>
					</div>
				</div>
				
				<?php 
					//PAGINACAO DE FATO
					if (isset($url[1]) && $url[1] != '') {
						$id_user = DBescape($url[1]);
						$cand    = DBread('users', "WHERE id = '".$id_user."'");
						if ($cand == false) {
							echo '<h2>Nada encontrado</h2>';
						}else{
							$exames = DBread('exames_user', "WHERE id_user = '".$id_user."' AND status = '0' ORDER BY id ASC");
							if ($exames == false) {
								echo '<p>Parece que esse candidato não fez nenhum teste valido :( </p>';
							}else{
								calc_sinestesia($cand[0], $exames, 'pesquisador');
							}
						}
					}else{
						//TABELAS PARA EXIBIR OS TESTE DOS SINESTETAS
						if (isset($_GET['nome']) && $_GET['nome'] != '') {
							$nome = DBescape($_GET['nome']);
							$usuarios = DBread('users', "WHERE tipoSlug != 'root' AND nome LIKE '%$nome%' ORDER BY nome ASC");
						}else{
							$usuarios = DBread('users', "WHERE tipoSlug != 'root' ORDER BY id ASC");
						}

						if (isset($_GET['action']) && $_GET['action'] != '' && isset($_GET['id']) && $_GET['id'] != '') {
							$id_user = DBescape($_GET['id']);
							switch ($_GET['action']) {
								case '1':
									if (DBread('users', "WHERE id = '$id_user'", 'id')) {
										$up['token'] = '';
										if (DBUpDate('users', $up, "id = '$id_user'")) {
											alertaLoad("Usuário está hábito realizar o teste novamente.", $way.$url[0]);
										}
									}
								break;
							}
						}

						?>
						<div class="row">
							<div class="col-md-10 center-block">
								<h2>Candidatos</h2>
								<p>Esses são todos os candidatos que já realizaram ou não testes na bateria</p>
								<div class="row">
									<div class="col-md-10 text-rigth">
										<form method="get">
											<div class="form-group">
												<label for="nome" style="width: 100%;">Pesquisar</label>
												<input type="nome" placeholder="Digite um nome" class="form-control" style="width:70%; margin-right: 20px; float: left;" value="<?php echo ((isset($_GET['nome'])) ? $_GET['nome'] : '' ); ?>" name="nome" id="nome">	
												<input type="submit" class="btn btn-primary btn-color" style="padding-bottom: 16px;padding-top: 16px;" name="pesquisar" value="Pesquisar">
												<div class="clear"></div>
											</div>
										</form>	
									</div>
								</div>
								<table class="table table-bordered text-center">
								  <thead>
								    <tr>
								      <th class="text-center">Nome</th>
								      <th class="text-center">Email</th>
								      <th class="text-center">Testes</th>
								      <th class="text-center">Data de início</th>
								      <th class="text-center">Data de término</th>
								      <th class="text-center">Reenviar</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php 
									  	if ($usuarios == true) {
									  		
									  		for ($i=0; $i < count($usuarios); $i++) { 
									  			$nome = DBread('users', "WHERE email = '".$usuarios[$i]['email']."'", 'nome');
												$exames = DBread('exames_user', "WHERE id_user = '".$usuarios[$i]['id']."' AND status = '0' ORDER BY id ASC", 'id, registro');	
									?>
									  		<tr>
									  			<td><a href="<?php echo $way.$url[0].'/'.$usuarios[$i]['id']; ?>"><?php echo $nome[0]['nome']; ?></a></td>
									  			<td><a href="<?php echo $way.$url[0].'/'.$usuarios[$i]['id']; ?>"><?php echo $usuarios[$i]['email']; ?></a></td>
									  			<td><?php echo (($exames == false) ? '0' : count($exames)); ?></td>
								  				<td><?php echo (($exames == false) ? '--/--/--' : date('d/m/Y', strtotime($exames[0]['registro']))); ?></td>
									  			<td>
									  				<?php   
									  					if ($exames == false) {
									  						echo '--/--/--';
									  						$check = true;
									  					}else{
									  						$trials = DBread('exames_trials', "WHERE id_exame = '".$exames[count($exames)-1]['id']."' AND id_user = '".$usuarios[$i]['id']."' ORDER BY id DESC LIMIT 1", 'id, time');
									  						if ($trials == false) {
									  							echo '--/--/--';	
									  						}else{
																$check = DBread('exames_user', "WHERE id_user = '".$usuarios[$i]['id']."'AND status = '2' LIMIT 1", 'id');
																if ($check == true) {
									  								echo '--/--/--';
																}else{
									  								echo date('d/m/Y', strtotime($trials[0]['time']));
																}
									  						}
									  					}
									  				?>		
									  			</td>
									  			<td>
									  				<?php 
									  					if ($check == true) {
									  					}else{
									  						if ($usuarios[$i]['token'] != '') {
											  				?>
											  				<a href="<?php echo $way.$url[0].'?action=1&&id='.$usuarios[$i]['id']; ?>">Reenviar</a>
											  				<?php
									  						}
									  					}
									  				?>
									  			</td>
									  		</tr>
								  	<?php
								  			}
								  		}
								  	?>
								  </tbody>
								</table>
								<?php echo '('.count($usuarios).')'; ?>
							</div>
						</div>
						<?php
					}
				?>
				<div class="row" style="margin-top: 50px;">
					<div class="col-md-10 center-block text-center">
						<a href="?logout" class="btn btn-primary btn-color"> Voltar para página inicial</a>
					</div>
				</div>
			</div>
		</div>


		<?php
	}else{
	//PAGINACAO PARA CANIDATO
		?>

<div class="row" style="margin-top: 50px;">
	<div class="col-md-10 center-block p">
		<div class="row">
			<div class="col-md-12 text-center" style="margin-bottom: 1em;">
				<h2>Resultados!</h2>
				<p></p>
			</div>
		</div>
		
		<?php 
			$exames = DBread('exames_user', "WHERE token = '".$user['token']."' AND status = '0' ORDER BY id ASC");
			
			calc_sinestesia($user, $exames, 'candidato');
		?>
		<div class="row">
			<div class="col-md-10 center-block text-center">
				<a href="?logout" class="btn btn-primary btn-color"> Voltar para página inicial</a>
			</div>
		</div>
	</div>
</div>

		<?php
	}//FIM PAGINACAO PARA CANDIDATO
?>

