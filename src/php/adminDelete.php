<?php  
include('connectionDb.php');
$url = $_SERVER["REQUEST_URI"];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$urlid = $params['id'];
$query = "DELETE FROM tbl_users WHERE id='$urlid'";
$result = $conn->query($query);
header("location: tableUsers.php"); //Para redirecionar de volta para "Login.php" depois sair 
?>

