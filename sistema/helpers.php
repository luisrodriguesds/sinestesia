<?php
	function calc_sinestesia($user, $exames, $tipo){
		
			if ($exames == false) {
				echo '<p>Você não possue nenhum teste para ser calculado</p>';
			}else{
				?>
				<div class="row">
					<div class="col-md-10 center-block">
						<?php 
							if ($tipo == 'pesquisador') {
						?>
						<p>Teste realizado por: <strong><?php echo $user['nome']; ?></strong></p>
						<p>Os resultados estão prontos e serão apresentados considerando a ordem de realização dos testes. </p>
						<?php	
							}else{
						?>
						<p>Olá, <strong><?php echo $user['nome']; ?></strong>, seus resultados estão prontos e estão divididos por teste que você realizou! </p>
						<?php
							}
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 center-block">
						<p style="text-align: justify;">O resultado de cada teste é calculado através de um score geral. Um score igual
							ou menor do que 1.0 indica que você tem sinestesia.
							<br><br>As barras que aparecem ao lado de cada estímulo indicam a proximidade das cores. 0% indica que as
							cores atribuídas para cada estímulo não seguem um padrão de
							proximidade, ou seja, as cores são totalmente diferentes. 100% indica que não houve diferença entre as 3 cores
							atribuídas para dado estímulo, ou seja, que o participante escolheu a
							mesma cor para o estímulo em todas as vezes que ele foi exibido.
							<br><br>Os estímulos aparecem 3 vezes em cada linha da tabela, pois foram apresentados
							3 vezes durante o teste. Se você deixou de atribuir uma cor para certo
							estímulo, sua porcentagem para tal estímulo não pôde ser calculada.</p>
					</div>
				</div>

				<?php
				for ($n=0; $n < count($exames); $n++) { 
					$trials = DBread('exames_trials', "WHERE id_exame = '".$exames[$n]['id']."' AND id_user = '".$user['id']."' AND status_bloco = false ORDER BY valor ASC", 'id, exame_tipoSlug, valor, cor_rgb, cor_hexadecimal');
					
		?>
		<div class="row">
			<div class="col-md-10 center-block">
				<h2>Teste -> <?php echo $exames[$n]['exame_tipo'] ?></h2>
				<table class="table table-bordered text-center">
				  <thead>
				    <tr>
				      <th class="text-center">Valor 1</th>
				      <th class="text-center">Valor 2</th>
				      <th class="text-center">Valor 3</th>
				      <th class="text-center" style="width: 200px;">Scores</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  		$k=0;
				  		$notCor=0;
				  		$vj = array();
				  		for ($i=0; $i < (count($trials)/3); $i++) { 
				  		//Abre a linha do grupo de trials
				  		echo '<tr>';
				  			for ($j=1; $j <= 3; $j++) { 
								//SOMENTE PARA VER CADA VALOR
								//EXTRAIR O RGB DE CADA GRUPO DE TRIALS
								if ($trials[$k]['cor_rgb'] != 'não selecionada') {
									$x['x'.$j] = getRGB($trials[$k]['cor_rgb']);
								}else{
									$x['x'.$j] = array(0 => -1, 1 => -1, 2 => -1);
								}
								
								//color e bg da celula
								if ($trials[$k]['cor_rgb'] != 'não selecionada') {
									$rgb_white = getRGB($trials[$k]['cor_rgb']);
									if (intval($rgb_white[0]) > 198 && intval($rgb_white[1]) > 198 && intval($rgb_white[2]) > 198) {
										$bg = 'color: '.$trials[$k]['cor_rgb'].'; background: black;';
									}else{
										$bg = 'color: '.$trials[$k]['cor_rgb'];
									}
								}else{
									$bg = 'color: #fff; background:red;';
								}
							?>
						  		<td style="font-size: 22px; <?php echo $bg; ?>" <?php echo (($trials[$k]['cor_rgb'] == 'não selecionada') ? 'title="Cor não selecionada"' : '');?>>
						  			<strong><?php echo $trials[$k]['valor']; ?></strong>
						  		</td>
							<?php
								$k++;
							}

							//CALCULO PARA CADA LETRA
							$vj[$i]['score'] = 0;
							for ($j=0; $j < count($x); $j++) { 
								if ($x['x1'][$j] == -1 || $x['x2'][$j] == -1 || $x['x3'][$j] == -1) {
									$vj[$i]['score'] = -1;
								}else{
									$vj[$i]['score'] = $vj[$i]['score'] + abs($x['x1'][$j] - $x['x2'][$j]) + abs($x['x2'][$j] - $x['x3'][$j]) + abs($x['x3'][$j] - $x['x1'][$j]);
								}
							}
							if ($vj[$i]['score'] != -1) {
								$porcento = (($vj[$i]['score']/10) > 100) ? 100 : ($vj[$i]['score']/10);
								$porcento = 100 - $porcento;
								echo '<td>
									<div class="progress">
									  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: '.$porcento.'%; '.($porcento < 16 ? 'color: #000;' : '').'" aria-valuenow="'.$porcento.'" aria-valuemin="0" aria-valuemax="100">'.$porcento.'%</div>
									</div>
									</td>';
							}else{
								echo '<td title="O calculo da da proximidade das cores não pode ser realizado, pois um ou mais dos trials não teve cor associada.">Não calculado</td>';
								$notCor++;
							}

				  		echo '</tr>'; 
				  		}

				  		$v = 0;
						for ($i=0; $i < count($vj); $i++) { 
							$v = $v + $vj[$i]['score'];
						}
						$v = $v/((count($trials)/3)-$notCor);
						$v = $v/100;
						$vj = array();
				  	?>
				  </tbody>
				</table>
				(<?php echo count($trials)/3; ?>)
			</div>
		</div>
		<div class="row" style="margin-bottom: 50px;">
			<div class="col-md-4 center-block">
				<h3>Score: <?php echo round($v, 2);  //(($notCor == 0) ? round($v, 2) : 'Não calculado'); ?></h3>
			</div>
		</div>

		<?php 
				}
			}
		
	}

	function calc_rgb($trials){
		$k=0;
		for ($i=0; $i < count($trials)/3; $i++) { 
			
			for ($j=1; $j <= 3; $j++) { 
				//SOMENTE PARA VER CADA VALOR
				// echo $trials[$k]['valor'];
				//EXTRAIR O RGB DE CADA GRUPO DE TRIALS
				$x['x'.$j] = getRGB($trials[$k]['cor_rgb']);
				$k++;
			}
			//CALCULO PARA CADA LETRA
			$vj[$i]['score'] = 0;
			$vj[$i]['valor'] = $trials[$k-1]['valor'];
			for ($j=0; $j < count($x); $j++) { 
				$vj[$i]['score'] = $vj[$i]['score'] + abs($x['x1'][$j] - $x['x2'][$j]) + abs($x['x2'][$j] - $x['x3'][$j]) + abs($x['x3'][$j] - $x['x1'][$j]);
			}
		}
		return $vj;
	}

	function getRGB($rgb){
		$rgb = str_replace('rgb(', "", $rgb);
		$rgb = str_replace(')', "", $rgb);
		$rgb = explode(', ', $rgb);
		for ($i=0; $i < count($rgb); $i++) { 
			$rgb[$i] = intval($rgb[$i]);
		}
		return $rgb;
	}
	function random_color() {
	    $letters = '0123456789ABCDEF';
	    $color = '#';
	    for($i = 0; $i < 6; $i++) {
	        $index = rand(0,15);
	        $color .= $letters[$index];
	    }
	    return $color;
	}

	function hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}
	
	function actions($table, $way, $caminho, $foto, $padrao){
	      if (isset($_GET['action']) && $_GET['action'] != '' && isset($_GET['id']) && $_GET['id'] != '') {
		    $action = DBescape($_GET['action']);
		    $id     = DBescape($_GET['id']);

		    switch ($action) {
		        case 0:
		            $up['status'] = 0;
		            if (DBUpDate($table, $up, "id = '$id'")) {
		                load($way);
		            }
		        break;
		        case 1:
		            $up['status'] = 1;
		            if (DBUpDate($table, $up, "id = '$id'")) {
		                load($way);
		            }
		        break;
		        case 2:
		        	if ($caminho != '') {
		        		$nome = DBread($table, "WHERE Id = '".$id."'", $foto);
		        	}
		        	if (DBDelete($table, "Id = '".$id."'")) {
				        if ($caminho != '') {
				        	if (file_exists($caminho.$nome[0][$foto])) {
				        		if ($nome[0][$foto] != $padrao) {
					        		if (unlink($caminho.$nome[0][$foto])) {
					        		}
				        		}
					    	}
				        }
				        load($way);
				    }
		        break;
		    }

		}
	}

	function getPlataforma($user, $url){
		if (isset($_GET['plataforma']) && $_GET['plataforma'] != '') {
			$form['id_plataforma']  = DBescape($_GET['plataforma']);
			if (DBUpDate('users', $form, "Id = '".$user['Id']."' ")) {
				load($url);
			}
		}
	}

	function getMib($input){
		$con = $input/(1024*1024);

		$con = round($con, 2);
		$exi = explode('.', $con);
		$exi[1] = ($exi[1] == 1) ? $exi[1].'0' : $exi[1];

		return $exi[0].','.$exi[1];
	}

	function getFullHour($input) {
	    $seconds = intval($input); //Converte para inteiro
	    $negative = $seconds < 0; //Verifica se é um valor negativo
	    if ($negative) {
	        $seconds = -$seconds; //Converte o negativo para positivo para poder fazer os calculos
	    }
	    $hours = floor($seconds / 3600);
	    $mins = floor(($seconds - ($hours * 3600)) / 60);
	    $secs = floor($seconds % 60);
	    $sign = $negative ? '-' : ''; //Adiciona o sinal de negativo se necessário
	    return $sign . sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
	}

	function alerta($text){
		echo '<script>alert("'.$text.'");</script>';
	}

	function alertaLoad($text, $url){
		echo '<script>alert("'.$text.'");
	        window.location="'.$url.'";</script>';
	}

	function load($url){
		echo '<script>
	        window.location="'.$url.'";</script>';
	}

	function alertaQuest($text, $url1, $url2){
		echo '<script>
			if(confirm("'.$text.'")){
	        	 window.location="'.$url1.'";
	        }else{
	        	window.location="'.$url2.'";
	        }</script>';
	}

	//SOMENTE PARA O FORUM
	function alertaConfirm($text, $url, $get){

		echo '<script>
			if(confirm("'.$text.'")){
	        	 window.location="'.$url.'?forum='.$get.'&&confirm=sim";
	        }else{
	        	window.location="'.$url.'?forum='.$get.'";
	        }</script>';

	}

	function removerEspacos($str){
		$str = str_replace('\n', "", $str);
		$str = str_replace(" ", "", $str);
		$str = strip_tags($str);
		return $str;
	}

	function fitImagem($caminho, $tamanho){
		echo 'style="background: url('.$caminho.') center center/'.$tamanho.'px no-repeat; background-size: cover;"';
	}

	function printCheckbox($post, $valor){
		if ($post !== false) {
			for ($i=0; $i < count($post); $i++) {
				if ($post[$i] == $valor) {
					return 'checked';
				}
			}
		}
	}

	function printSelect($post, $valor){
		if ($post !== false) {
			if ($post == $valor) {
				return 'selected';
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
	function printRadio($post, $valor){

		if ($post !== false) {
			if ($post == $valor) {
				return 'checked';
			}else{
				return '';
			}
		}else{
			return '';
		}
	}


	function printPost($post, $ind){
		if ($post == null) {
			$post = '';
		}
		if ($ind == 'page') {
			$post = printPostHTML($post);
			return $post;
		}else if($ind == 'campo'){
			$post = printPostTextarea($post);
			return $post;
		}else{
			$post = printPostHTML($post);
			return $post;
		}
	}
	function printPostHTML($post){
		$post = str_replace('\r\n', "<br>", $post);
		$post = str_replace('\\', "", $post);
		return $post;
	}
	function printPostTextarea($post){
		$post = str_replace('\r\n', "&#10;", $post);
		$post = str_replace('\\', "", $post);
		return $post;
	}

	//Pegar a primeira, segunda... n palavra de uma string
	function GetName($nome, $n){
		if ($n === null || $n === false) {
			$n = 1;
		}
		$nome 	= explode(" ", $nome);
		$n 		= $n-1;
		return $nome[$n];
	}
	function GetCampo($key = null){
		if($key == null)
			return $_POST;
		else
			return (isset($_POST[$key])) ? str_replace("'", "", $_POST[$key]) : false;
	}


	//CONVER EM MAIÚSCULA
	 function nomeM($nome){
          $nome = str_replace("-", "1", $nome);
          $nome = strtoupper($nome);
          $nome = str_replace("ç", "Ç", $nome); $nome = str_replace("â", "Â", $nome);
          $nome = str_replace("ã", "Ã", $nome); $nome = str_replace("á", "Á", $nome);
          $nome = str_replace("ê", "Ê", $nome); $nome = str_replace("é", "É", $nome);
          $nome = str_replace("í", "Í", $nome); $nome = str_replace("ó", "Ó", $nome);
          $nome = str_replace("ô", "Ô", $nome); $nome = str_replace("ú", "Ú", $nome);
          $nome = str_replace("1", "-", $nome);
          return $nome;

    }

	//Converte para Slug
	function Slug($name){
		$name = str_replace(" - ", " ", $name);
		$name = str_replace(" ", "-", $name);
		$name = str_replace("à", "a", $name); $name = str_replace("á", "a", $name); $name = str_replace("ã", "a", $name); $name = str_replace("â", "a", $name);
		$name = str_replace("À", "a", $name); $name = str_replace("Á", "a", $name); $name = str_replace("Ã", "a", $name); $name = str_replace("Â", "a", $name);

		$name = str_replace("è", "e", $name); $name = str_replace("é", "e", $name); $name = str_replace("ê", "e", $name);
		$name = str_replace("È", "e", $name); $name = str_replace("É", "e", $name); $name = str_replace("Ê", "e", $name);

		$name = str_replace("ì", "i", $name); $name = str_replace("í", "i", $name); $name = str_replace("î", "i", $name);
		$name = str_replace("Ì", "i", $name); $name = str_replace("Í", "i", $name); $name = str_replace("Î", "i", $name);

		$name = str_replace("ò", "o", $name); $name = str_replace("ó", "o", $name); $name = str_replace("õ", "o", $name); $name = str_replace("ô", "o", $name);
		$name = str_replace("Ò", "o", $name); $name = str_replace("Ó", "o", $name); $name = str_replace("Õ", "o", $name); $name = str_replace("Ô", "o", $name);

		$name = str_replace("ù", "u", $name); $name = str_replace("ú", "u", $name); $name = str_replace("û", "u", $name);
		$name = str_replace("Ù", "u", $name); $name = str_replace("Ú", "u", $name); $name = str_replace("Û", "u", $name);
		$name = str_replace("ç", "c", $name); $name = str_replace("Ç", "c", $name); $name = str_replace(".", "", $name); $name = str_replace(";", "", $name);
		$name = str_replace("[", "", $name);  $name = str_replace("]", "", $name); $name = str_replace("[]", "", $name); $name = str_replace("|", "", $name);
		$name = str_replace("/", "", $name);  $name = str_replace("''", "", $name); $name = str_replace(":", "-", $name);
		$name = str_replace('"', "", $name);  $name = str_replace('""', "", $name);  $name = str_replace(",", "", $name);  $name = str_replace("#", "", $name);
		$name = str_replace("?", "", $name);
		$name = strtolower($name);
		return $name;
	}

	//VERIFICA SE EXTISTE O COOKIE CONECTADO
	function VerifyConectado(){

		if (isset($_COOKIE['conectado']) && $_COOKIE['conectado'] == '1'  && isset($_COOKIE['email']) && $_COOKIE['email'] != '') {
			$user 		= $_COOKIE['email'];
			$senha		= $_COOKIE['senha'];
			$conectado 	= $_COOKIE['conectado'];

			if(userVerify($user, $senha) == 'erro2'){
				$msg = "Esta conta está Desativada";
			}if(userVerify($user, $senha) == 'erro1'){
				$msg = "Email ou senha estão incorretos";
			}else{
				CreateSession($user, $senha);
			}
		}
	}
	//Valida Login
	function ValidaLogin(){
		if(isset($_POST['send'])){

			$msg 		= null;
			$user 		= GetPost('email');
			$senha		= GetPost('password');
			$conectado 	= GetPost('conectado');


			if(empty($user)){
				$msg = "Informe seu Nome de Usuário";

			}else if(empty($senha)){
				$msg = "Informe sua Senha!";

			}else{
				if(userVerify($user, $senha) == 'erro2'){
					$msg = "Esta conta está desativada.";
				}else if(userVerify($user, $senha) == 'erro1'){
					$msg = "Email ou senha estão incorretos.";
				}else{
					if ($conectado == 'on' || $conectado == true || $conectado == '1') {
						setcookie('conectado', true, time() + 3600 * 24 * 30 * 12, '/');
						setcookie('email', $user, time() + 3600 * 24 * 30 * 12, '/');
						setcookie('senha', $senha, time() + 3600 * 24 * 30 * 12, '/');
					}else{
						setcookie('conectado', '', time() - 3600 * 24 * 30 * 12, '/');
						setcookie('email', '', time() - 3600 * 24 * 30 * 12, '/');
						setcookie('senha', '', time() - 3600 * 24 * 30 * 12, '/');
					}
					CreateSession($user, $senha);
				}

			}
			if ($msg != null) {
				alerta($msg);
			}
			// echo ($msg != null) ? '<div class="msg" style="color: red; font-weight: 700; border: 1px solid #ccc; display: block;">'.$msg.'</div>' : null;
		}
	}


	/* ======================================== */
	//PROTECAO
	//Controla Acesso Publico
	function AcessPublic(){
  		if(IsLogged()){
			Redirect(URL_PAINEL);
		}
	}

	//Controla Acesso Privado
	function AcessPrivate(){
		if(!IsLogged()){
			Redirect(URLBASE);
		}
	}

	/* ======================================== */

	/* ======================================== */
	//SESSÃO

	//Executa Logout
	function DoLogout(){
		if(isset($_GET['logout'])){
			//MATA OS COOKIES QUE SALVAM SUA SESSÃO
			if (isset($_COOKIE['conectado']) && $_COOKIE['conectado'] == '1') {
				setcookie('conectado', '', time() - 3600 * 24 * 30 * 12, '/');
				setcookie('email', '', time() - 3600 * 24 * 30 * 12, '/');
				setcookie('senha', '', time() - 3600 * 24 * 30 * 12, '/');
			}
			DestroySession();
		}

	}

	//Destroi Sessao
	function DestroySession(){
		unset($_SESSION['user']);
		AcessPrivate();
	}

	//Cria Sessao
	function CreateSession($user, $password){
		$key = GetKey($user, $password);
		UserLog($key);
		AcessPublic();
	}

	//Seta ou Recupera USER LOG
	function UserLog($value = null){
		if($value === null)
			return $_SESSION['user'];
		else
			$_SESSION['user'] = $value;

	}

	//Verifica Login
	function IsLogged(){
		if(!isset($_SESSION['user']) || empty($_SESSION['user']))
			return false;
		else{
			if(StayLogged())
				return true;
			else
				DestroySession();
		}
	}

	/* ======================================== */

	//Crypt Senha
	function CryptPassword($password){
		$password = sha1($password);
		return $password;
	}


	//Gera key
	function KeyGeneration(){
		return sha1(rand().time());
	}

	//recuperar POST[]
	function GetPost($key = null){
		if($key == null)
			return $_POST;
		else
			return (isset($_POST[$key])) ? trim(strip_tags($_POST[$key])) : false;
	}

	//redirecinar
	function Redirect($url){
		header("Location: ".$url);
		die();
	}

//Limita Texto
	function texto($texto, $maximo = 200){
		$texto = strip_tags($texto);
		$conta = strlen($texto);

		if($conta <= $maximo){
			return $texto;
		}else{
			$limita = substr($texto, 0, $maximo);
			$espaco	= strrpos($limita, " ");
			$limita = substr($texto, 0, $espaco);
			return $limita.'...';
		}
	}

//Paginador
	//Paginador Categoria
	function paginatorCategoria($sql,$categoria,$maxPosts, $paginaAtual){
		//PAGINATOR

		$resultsAll = DBread($sql, "WHERE status = true AND categoriaSlug = '$categoria'");

		//Contagem
		$totalPost	= count($resultsAll);

		//Paginas
		$paginas	= ceil($totalPost / $maxPosts);

		if($paginaAtual > $paginas || $totalPost <= $maxPosts){
		}else{
			if(isset($_GET['url'])){
				$GetUrl = $_GET['url'];
			}else{
				$GetUrl = '';
			}
			echo '<div class="pagenav clearfix">';

				//Pagina Inicial
				//
				echo '<a href="'.URLBASE.''.$GetUrl.'?page=1" class="number">Primeira Página</a>';

				//Pagina Alterior
				if($paginaAtual >= 2){
					$pagePrev = $paginaAtual - 1;
					echo '<a href="'.URLBASE.''.$GetUrl.'?page='.$pagePrev.'" class="number">'.$pagePrev.'</a>';
				}

				//Pagina Atual
				echo '<span>'.$paginaAtual.'</span>';

				//Proxima Pagina
				if($paginaAtual != $paginas){
					$pageNext = $paginaAtual + 1;
					echo '<a href="'.URLBASE.''.$GetUrl.'?page='.$pageNext.'" class="number">'.$pageNext.'</a>';
				}

				//Ultima Inicial
				echo '<a href="'.URLBASE.''.$GetUrl.'?page='.$paginas.'" class="number">Ultima Página</a>';

			echo '</div>';
		}
	}
?>