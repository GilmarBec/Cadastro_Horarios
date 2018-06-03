<?php
class Unidades {
	private $conexao;

	public function __construct() {
		$this->conexao = new PDO("mysql:host=localhost;", "root", "") or print (mysql_error());
		$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function clear($string){
    return strtr(utf8_decode($string),utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ '),'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy_');
	}

	public function acesso($host, $username, $pass, $unidade) {
		$this->conexao = new PDO("mysql:host=".$host.";", $username, $pass) or print (mysql_error());
		$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try{
			$sql = "CREATE DATABASE IF NOT EXISTS spd;";
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute();
		} catch(PDOException $e) {
			echo 'Erro: ' . $e;
		}

		try{
			$sql = 'USE spd;';
			$sql .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/master/lib/spd.sql');
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute();
		} catch(PDOException $e) {
			echo 'Erro: ' . $e;
		}

		try{
			$array = array('unidade'=>utf8_decode($unidade));
			$sql = "INSERT INTO spd.db (nome) VALUES (:unidade);";
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute($array);
		} catch(PDOException $e) {
			echo '<br>Erro: ' . $e;
		}

		try{
			$sql = "CREATE DATABASE IF NOT EXISTS spd_" . $this->clear($unidade);
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute();
		} catch(PDOException $e) {
			echo 'Erro: ' . $e;
		}

		try{
			$sql = 'USE spd_' . $this->clear($unidade) . ';';
			$sql .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/master/lib/spdUnidades.sql');
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute();
		} catch(PDOException $e) {
			echo 'Erro: ' . $e;
		}
	}

	public function insert($unidade) {
		$array = array('unidade'=>utf8_decode($unidade));
		$sql = "INSERT INTO spd.db (nome) VALUES (?);";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute($array);

		$sql = "CREATE DATABASE IF NOT EXISTS spd_" . $this->clear($unidade);
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute();

		$sql = 'USE spd_' . $this->clear($unidade) . ';';
		$sql .= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/master/lib/spdUnidades.sql');
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute();
	}
}
