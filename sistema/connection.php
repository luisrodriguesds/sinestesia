<?php
	
	//protege contra myqli injection	
	function DBescape($dados){
		$link = DBconnec();
		if(!is_array($dados)){
			$dados = mysqli_escape_string($link, $dados);
		}else{
			$arr = $dados;

			foreach ($arr as $key => $value) {
				$key 		 = mysqli_escape_string($link, $key);
				$value 		 = mysqli_escape_string($link, $value);
				$dados[$key] = $value;
			}
		}
		DBclose($link);
		return $dados;
	}

	//Fecha conexcao com myqli
	function DBclose($link){
		mysqli_close($link) or die(mysqli_error($link));
	}

	//Abre conexcao com msqli
	function DBconnec(){
		$link = @mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE, PORT) or die(mysqli_connect_error());
		mysqli_set_charset($link, CHARSET) or die(mysqli_error($link));
		
		return $link;
	}

?>