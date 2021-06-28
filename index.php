<?php
require_once("config.php");
//$Sql = new sql();
//$usuarios = $Sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

///*carrega um usuarios referente ao id referenciado.
//$root = new usuarios();
//$root->loadById(5);
//echo $root;

//*carrega uma lista de usuarios
//$lista = usuarios::getList();
//echo json_encode($lista);
 
//carrega uma lista de usuarios buscando pelo login
//$search = usuarios::search("D");
//echo json_encode($search);

//carrega um usuario usando o login e a senha
$usuario = new usuarios();
$usuario->login("Daniel","1982");
echo $usuario;


?>