<?php
require_once("config.php");
$Sql = new sql();
$usuarios = $Sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);
?>