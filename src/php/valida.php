<?php
session_start();
include_once("connectionDb.php");
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
if($login){
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
	$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    if((!empty($user)) AND (!empty($pass))){
        $query = "SELECT * FROM tbl_users WHERE user='$user'";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            while($row_usuario = $result->fetch_assoc()) 
			if($pass == $row_usuario['pass']){
				$_SESSION['id'] = $row_usuario['id'];
				$_SESSION['user'] = $row_usuario['user'];
				$_SESSION['isAdmin'] = $row_usuario['isAdmin'];
                $user = $row_usuario['user'];
                $query = "INSERT INTO tbl_logs (user, isSuccess, dataehora) VALUES ('$user','Sucesso', now())";
                $result = mysqli_query($conn, $query);
                header("Location: f2a.php");
                // if($_SESSION['isAdmin'] == 1){
                //     header("Location: f2a.php");
                // } else {
                //     header("Location: home.php");
                // }
				
            } else {
                $_SESSION['msg'] = "Login ou senha inválido";
                $query = "INSERT INTO tbl_logs (user, isSuccess, dataehora) VALUES ('$user','Falha', now())";
                $result = mysqli_query($conn, $query);
				header("Location: login.php");
            }
        }else{
            $_SESSION['msg'] != "Login ou senha inválido";
            $query = "INSERT INTO tbl_logs (user, isSuccess, dataehora) VALUES ('$user','Falha', now())";
            $result = mysqli_query($conn, $query);
            header("Location: login.php");
        }
    } else {
        $_SESSION['msg'] = "Login ou senha inválido";
        $query = "INSERT INTO tbl_logs (user, isSuccess, dataehora) VALUES ('$user','Falha', now())";
        $result = mysqli_query($conn, $query);
		header("Location: login.php");
    }
    
    } else {
    $_SESSION['msg'] = "$user";
    $query = "INSERT INTO tbl_logs (user, isSuccess, dataehora) VALUES ('$user','Falha', now())";
    $result = mysqli_query($conn, $query);
    header("Location: login.php");
}

