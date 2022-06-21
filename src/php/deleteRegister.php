<?php  
include('connectionDb.php');
session_start(); //O garantir que você esteja usando a mesma sessão
$userSession = $_SESSION['user'];
$query = "DELETE FROM tbl_users WHERE user='$userSession'";
$result = $conn->query($query);
session_destroy(); // Destruir a sessão
header("location: login.php"); //Para redirecionar de volta " Login.php depois de sair 
exit();
?>

