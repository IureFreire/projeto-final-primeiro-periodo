<?php
session_start();
include('base.php');
include('connectionDb.php');
$_SESSION['isValidated'] = '';
?>
<body background="../assets/img/telecall-background.jpg">
<?php 
if(!isset($_SESSION['user'])){
    header("Location:Login.php");
}
$secrets = array("Qual o nome da sua mãe?", "Quais os 3 primeiros digitos do seu cpf?", "Quais os 3 últimos digitos do seu cpf?", "Qual o seu número do seu telefone Celular?", "Qual é a sua data de nascimento?");
$random = array_rand($secrets, 1)
?>
<div class="container" style="width: 40%">
    <div class="card" style="margin-top: 20%;">
        <div class="card-header card-outline card-dark">
            <h4 class="text-center">Pergunta secreta</h4>
        </div>  
        <div class="card-body bg-light">
            <h4><?php echo $secrets[$random]; ?></h4>
            <form id="f2a" method="POST">
                <div>
                <input type="hidden" value="<?php echo $random ?>" name="random" id="random"></input>
                <?php
                if ($random == 4) {?>
                    <input name="secret" type="date" id="secret" style="width: 80%; margin-top: 10px"></input>
                <?php } else {?>
                    <input name="secret" id="secret" placeholder="Resposta" style="width: 80%; margin-top: 10px"></input>
                <?php } ?>
                <input type="submit"></input>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['user'];
    $query = "SELECT * from tbl_users WHERE user='$user'";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        while($row_usuario = $result->fetch_assoc()) {
            $motherName = $row_usuario['motherName'];
            $cpf = $row_usuario['cpf'];
            $birthday = $row_usuario['birthday'];
            $cellphone = $row_usuario['cellphone'];
        }
    }
    if($_REQUEST['random'] == 0 and $_REQUEST['secret'] == $motherName){
        $_SESSION['isValidated'] = 1;
        header('location: home.php');
    }

    elseif($_REQUEST['random'] == 1 and $_REQUEST['secret'] == substr($cpf, 0, -8)){
        $_SESSION['isValidated'] = 1;
        header('location: home.php');
    }
    
    elseif($_REQUEST['random'] == 2 and $_REQUEST['secret'] == substr($cpf, -3)) {
        $_SESSION['isValidated'] = 1;
        header('location: home.php');
    }
   
    elseif($_REQUEST['random'] == 3 and $_REQUEST['secret'] == $cellphone) {
        $_SESSION['isValidated'] = 1;
        header('location: home.php');
    }

    elseif($_REQUEST['random'] == 4 and $_REQUEST['secret'] == $birthday) {
        $_SESSION['isValidated'] = 1;
        header('location: home.php');
    }
    else {
        header('location: f2a.php');
    }
}
?>

</body>