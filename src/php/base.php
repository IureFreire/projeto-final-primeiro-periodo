<?php
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="../assets/css/telecall.css">
    <title>Telecall - Login</title>
    <title>Telecall - Interconnections</title>
</head>
<body class="background">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="home.php">
            <img src="../assets/img/telecall-logo.png" class="img-fluid navimg">  
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navlinks" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['isAdmin'])){
                    
                    if($_SESSION['isAdmin'] == 1 and $_SESSION['isValidated'] == 1){?>
                        <li class="nav-item active">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="editUser.php">Editar</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="tableUsers.php">Tabela de Usuários</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="logs.php">Logs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php } 
                    if ($_SESSION['isAdmin'] == 0) {?>
                        <li class="nav-item active">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="editUser.php">Editar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                         
                    <?php                         
                   }} else {?>
                    <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Cadastrar-se</a>
                    </li>   
                <?php } ?>                               
            </ul>
        </div>
    </nav>
</body>