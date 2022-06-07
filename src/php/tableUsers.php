<?php
session_start();
include('base.php');
include('connectionDb.php');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<body background="../assets/img/telecall-background.jpg">
    <?php
    if(!isset($_SESSION['user']) or $_SESSION['isValidated'] != 1){
        header("Location:Login.php");
    }
    $userSession = $_SESSION['user'];
    $query = "SELECT * FROM tbl_users";
    // $result = $conn->query($query);
    $result = mysqli_query($conn, $query);
    $rows = array();
    while($row = mysqli_fetch_array($result)){
        $resultset[] = $row;
    }
    ?>
    <div>
        <div class="card-header text-center bg-light">
            Tabela de usuários
        </div>
        <div class="bg-light">
            <table class="table table-light table-striped table-bordered" id="users" width="100%">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Admin</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Nome da mãe</th>
                        <th>CPF</th>
                        <th>CEP</th>
                        <th>Logradouro</th>
                        <th>Numero</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>UF</th>
                        <th>Localidade</th>
                        <th>Excluir</th>
                    </tr>
                    </thead>
                <?php
                foreach ($resultset as $result){?>
                    <?php
                    $id = $result['id'];
                    $firstname =  $result['firstname'];
                    $lastname = $result['lastname'];
                    $cpf =  $result['cpf'];
                    $motherName = $result['motherName'];
                    $birthday = $result['birthday'];
                    $phone = $result['phone'];
                    $cellphone = $result['cellphone'];
                    $cep = $result['cep'];
                    $logradouro = $result['logradouro'];
                    $numero = $result['numero'];
                    $complemento = $result['complemento'];
                    $bairro = $result['bairro'];
                    $uf = $result['uf'];
                    $localidade = $result['localidade'];
                    $user = $result['user'];
                    $pass = $result['pass'];
                    $isAdmin = $result['isAdmin'];
                    ?>
                <tbody class="text-center">
                    <tr>
                        <!-- <td><a href="adminEdit.php"><?php echo $id; ?></a></td> -->
                        <td><a href="adminEdit.php?id=<?php echo $id; ?>"><?php echo $id; ?></a></td>
                        <td><?php echo $user ?></td>
                        <?php
                        if($isAdmin == 0){?>
                            <td>Não</td>
                        <?php } else { ?>
                            <td>Sim</td>
                        <?php } ?>
                        <td><?php echo $firstname ?></td>
                        <td><?php echo $lastname ?></td>
                        <td><?php echo $motherName ?></td>
                        <td><?php echo $cpf ?></td>  
                        <td><?php echo $cep ?></td>
                        <td><?php echo $logradouro ?></td>
                        <td><?php echo $numero ?></td>
                        <td><?php echo $complemento ?></td>
                        <td><?php echo $bairro ?></td>
                        <td><?php echo $uf ?></td>
                        <td><?php echo $localidade ?></td>
                        <?php 
                        if($isAdmin == 0){
                        ?>
                        <td><a href="adminDelete.php?id=<?php echo $id; ?>" class="btn btn-danger">Excluir</a></td>
                        <?php } else {?>
                        <td ><a><button class="btn btn-danger" disabled> Excluir </button></a></td>
                        <?php } ?>
                        
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>


</body>
<script>
$(document).ready(function (){
$('#users').DataTable();
});
</script>