<?php

	//Recuperar Dados do Usuario
	function GetUser($key = null){
		if(!IsLogged()){
			return false;
		}else{
			$usuario = UserLog();
			$result = DBread('users', "WHERE email = '$usuario' AND status = true LIMIT 1");

			if($key == null)
				return $result;
			else{
				if(isset($key))
				 	return $result[0][$key];
				else
					return false;
			}
		}
	}

	//Verifica Usuario Logado
	function StayLogged(){
		$userKey = UserLog();
		$result  = DBread('users', "WHERE email = '$userKey' AND status = true");

		if($result)
			return true;
		else
			return false;
	}

	// Retorna a chave unica do usuário
	function GetKey($usuario, $password){
		$dataKey = userVerify($usuario, $password);
		return $dataKey[0]['email'];
	}


	//Verifica Usuario - onde se usa o md5
	function userVerify($usuario, $password, $status = false){

		$result = DBread('users', "WHERE email = '$usuario' AND password = '".md5($password)."' LIMIT 1");

		if($result == false){
			return 'erro1';
		}else{
			$verificaStatus = $result[0]['status'];
			if($verificaStatus == 0){
				return 'erro2';
			}else{
				return $result;
			}
		}
	}

	//Deletar
	function DBDelete($table, $where = null){
		$table 	= $table;
		$where  = ($where) ? " WHERE {$where}" : null;

		$query = "DELETE FROM {$table}{$where}";
		return DBexecute($query);

	}
	//Alterar valor
	function DBUpDate($table, array $data, $where = null, $insertId = false){
		foreach ($data as $key => $value) {
			$filtro[] = "{$key} = '{$value}'";
		}
		$filtro = implode(", ", $filtro);

		$table 	= $table;
		$campo 	= $data;
		$where  = ($where) ? " WHERE {$where}" : null;

		$query = "UPDATE {$table} SET {$filtro}{$where}";
		return DBexecute($query, $insertId);
	}

	//Selecionar no banco de bados
	function DBread($table, $params = null, $fields = '*'){
		$table 	= $table;
		$params = ($params) ? " {$params}" : null;
		$query 	= "SELECT {$fields} FROM {$table}{$params}";
		$result = DBexecute($query);

		if (!mysqli_num_rows($result)) {
			return false;
		}else{
			while ($res = mysqli_fetch_assoc($result)) {
				$data[] = $res;
			}
			return $data;
		}

	}

	//gravar no banco
	function DBcreate($table, array $data, $insertId = false){
		$table 	= $table;
		$data 	= DBescape($data);
		$campos = implode(", ", array_keys($data));
		$valors = "'".implode("', '", $data)."'";

		$query 	= "INSERT INTO {$table} ({$campos}) VALUES ({$valors})";

		return DBexecute($query, $insertId);
	}

	//Execute query -> banco de dados
	function DBexecute($query, $insertId = false){
		$link = DBconnec();
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		if($insertId){
			$result = mysqli_insert_id($link);
		}
		DBclose($link);

		return $result;
	}



?>