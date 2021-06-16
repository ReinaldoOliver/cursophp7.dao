<?php
//sql extende a class PDO 
class sql extends PDO {
/*$CONN é utlizada para estanciar(new) a class sql e conectar ao BANCO DE DADOS pelo metodo construtor(__construct)*/
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7.0","root","");}
// comandos utilizados para execultar no DB 
/*PREPAR utiliza declarações preparadas uma vez feita a consulta ela é otimizada pelo banco e pode ser executada N vezes o que muda são os argumentos, seu uso evita problema com sql injection desde que usado corretamente.*/	
//setParams retorna o resultado de toa a consulta ao DB em um array.
	private function setParams($statment, $parameters = array()){
/*foreach retorna os resultados de cada campo  consulta no caso os parametros do DB e seus valores */
		foreach ($parameters as $key => $value) {
			//$statment->bindParam($key, $value);
			$this->statment($key, $value);
	    }
	}
	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}
/*PDO :: query () executa uma instrução SQL em uma única chamada de função, retornando o conjunto de resultados (se houver) retornado pela instrução como um objeto PDOStatement.*/
	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		 $stmt->execute();
		 return $stmt;
	}
	public function select($rawQuery, $params = array()):array{
		$stmt = $this->query($rawQuery, $params);
/* fetchAll retorna todas as linhas do seu sql, quando vc diz a ele PDO::FETCH_CLASS e passa o nome da classe (nesse caso Aluno) vc está obrigando retornar tudo objetos dessa classe…*/		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}




?>



