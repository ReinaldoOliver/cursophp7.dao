<?php
class usuarios{
	private $idusuarios; 
	private $login;
	private $senha;
	private $cadastro;

 public function getidusuarios(){
	return $this->idusuarios;
 }
 public function setidusuarios($value){
 	$this->idusuarios=$value;
 }
  public function getlogin(){
	return $this->login;
 }
 public function setlogin($value){
 	$this->login=$value;
 }
  public function getsenha(){
	return $this->senha;
 }
 public function setsenha($value){
 	$this->senha=$value;
 }
  public function getcadastro(){
	return $this->cadastro;
 }
 public function setcadastro($value){
 	$this->cadastro=$value;
 }
 public function loadById($id)
 {
    $sql = new Sql();
    $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuarios = :ID", array(":ID" =>$id ));
    if (count($results)>0){
      $this->setData($results[0]);
    }
 }
 public static function getList(){
    $sql = new Sql();
   return $sql->select("SELECT * FROM tb_usuarios ORDER BY login;");
 }
 public static function search($login){
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY login", array(':SEARCH'=>"%".$login."%"));
 }
 public function login($login,$password){
    $sql = new sql();
    $results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :PASSWORD", array(":LOGIN"=>$login,":PASSWORD"=>$password));
     if(count($results)>0){
        $row = $results[0];
        $this->setData($results[0]);
       
     }else{
        throw new Exception("login e/ou senha invalidos");

     }
 }
 public function setData($data){
 $this->setidusuarios($data['idusuarios']);
        $this->setlogin($data['login']);
        $this->setsenha($data['senha']);
        $this->setcadastro(new DateTime($data['cadastro']));
     }
 public function insert(){
   $sql = new Sql();
   $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(':LOGIN'=>$this->getlogin(), ':PASSWORD'=>$this->getsenha()));
 if(count($results)>0){
   $this->setData($results[0]);}
 }
public function update($login, $senha){
   $this->setlogin($login);
   $this->setsenha($senha);
   $sql= new Sql();
   $sql->query("UPDATE tb_usuarios SET login = :LOGIN, senha = :PASSWORD WHERE idusuarios = :ID", array(':LOGIN'=>$this->getlogin(), ':PASSWORD'=>$this->getsenha(),'ID'=>$this->getidusuarios()));


}
 //toString executa o que ha dentro dele[]
   public function __toString(){
    return json_encode(array(
        "idusuarios"=>$this->getidusuarios(),
        "login"=>$this->getlogin(),
        "senha"=>$this->getsenha(), 
        "cadastro"=>$this->getcadastro()->format("d/m/y H:i:s"))
    );
 }
}

?>