<?php   
session_start(); //Para garantir que vc esta usando a mesma sessão
session_destroy(); //Destruir a sessão
header("location: login.php"); //Para redirecionar de volta para o "Login.php" depois sair
exit();
?>