<?php 

	include '../../../sistema/system.php'; 

	if (isset($_POST['token']) && isset($_POST['id_user']) && isset($_POST['valor']) && isset($_POST['id_trial'])) {
		// var_dump($_POST);
		$dados = DBescape($_POST);
		$exames = DBread('exames_user', "WHERE token = '".$dados['token']."' AND status = '2'", 'id, status');
		if ($exames == false) {
			echo 'terminou';
			exit();	
		}
		
		$trials = DBread('exames_trials', "WHERE id_exame = '".$exames[0]['id']."' AND id_user = '".$dados['id_user']."' AND status_bloco = true ORDER BY id ASC LIMIT 2", 'id, valor');
		if ($trials == false) {
			echo 'terminou';
			exit();
		}
		

		$trial = DBread('exames_trials', "WHERE id = '".$dados['id_trial']."'");
		if ($dados['valor'] != 1) {
			$valor = explode(':', $dados['valor']);
			$valorRGB = $valor[1];
			$valorHex = $valor[0];	
		}else{
			$valorRGB = 'não selecionada';
			$valorHex = 'não selecionada';
		}
		
		$form['cor_hexadecimal'] = $valorHex;
		$form['cor_rgb'] 		 = $valorRGB;
		$form['status_bloco'] 	 = 0;
		$form['time']			 = date('Y-m-d H:i:s');

		if (DBUpDate('exames_trials', $form, "id = '".$dados['id_trial']."'")) {
			if (!isset($trials[1])) {
				//STATUS 0=> TESTE FOI REALIZADO POR COMPLETO
				$up['status'] = 0;
				if (DBUpDate('exames_user', $up, "id ='".$exames[0]['id']."'")) {
					echo 'finish';
				}
			}else{
				echo json_encode($trials[1]);
			}
		}
		
	}
	