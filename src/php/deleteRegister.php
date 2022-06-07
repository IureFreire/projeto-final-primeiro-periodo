<?php  
include('connectionDb.php');
session_start(); //to ensure you are using same session
$userSession = $_SESSION['user'];
$query = "DELETE FROM tbl_users WHERE user='$userSession'";
$result = $conn->query($query);
session_destroy(); //destroy the session
header("location: login.php"); //to redirect back to "index.php" after logging out
exit();
?>

