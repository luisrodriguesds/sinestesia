<?php

	init();

	//inicia Sistema
	function init(){
		//session_cache_expire(1);
		// $lifetime=3600*6;
		// setcookie(session_name(),session_id(),time()+$lifetime);
		session_start();

		//para o Localhhost
		$configFile = $_SERVER['DOCUMENT_ROOT'].'/projetosinestesia/sistema/config.php';

		//Para o remoto
		// $configFile = '/home/luis/dev/plataforma.git/sistema/config.php';

		//Chama config
		if(!file_exists($configFile))
			echo "Erro, Arquivo config.php não encontrado! <br>";
		else
			require_once $configFile;
		//Chama Conexao
		if(!file_exists(FILE_CONNECTION))
			echo "Erro, Arquivo connection.php nao encontrado <br>";
		else
			require_once FILE_CONNECTION;
		//Chama Helpers
		if(!file_exists(FLIE_HELPERS))
			echo "Erro, Arquivo helpers.php não encontrado <br>";
		else
			require_once FLIE_HELPERS;
		//Chama DataBase
		if(!file_exists(FLIE_DATABASE))
			echo "Erro, Arquivo database.php nao encontrado";
		else
			require_once FLIE_DATABASE;
		date_default_timezone_set('America/Fortaleza');
		DBconnec();
		DoLogout();

	}