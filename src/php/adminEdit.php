<?php
session_start();
include('base.php');
include('connectionDb.php');
?>
<link rel="stylesheet" href="../assets/css/form.css">
<body background="../assets/img/telecall-background.jpg">
    
    <?php
    if(!isset($_SESSION['user']) ){
        header("Location:Login.php");
    }

    $userSession = $_SESSION['user'];
    $url = $_SERVER["REQUEST_URI"];
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $urlid = $params['id'];
    $query = "SELECT * FROM tbl_users WHERE id='$urlid'";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        while($row_usuario = $result->fetch_assoc()) {
           $firstname =  $row_usuario['firstname'];
           $lastname = $row_usuario['lastname'];
           $cpf =  $row_usuario['cpf'];
           $motherName = $row_usuario['motherName'];
           $birthday = $row_usuario['birthday'];
           $phone = $row_usuario['phone'];
           $cellphone = $row_usuario['cellphone'];
           $cep = $row_usuario['cep'];
           $logradouro = $row_usuario['logradouro'];
           $numero = $row_usuario['numero'];
           $complemento = $row_usuario['complemento'];
           $bairro = $row_usuario['bairro'];
           $uf = $row_usuario['uf'];
           $localidade = $row_usuario['localidade'];
           $user = $row_usuario['user'];
           $pass = $row_usuario['pass'];
           $isAdmin = $row_usuario['isAdmin'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $firstname =  $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $cpf =  $_REQUEST['cpf'];
        $motherName = $_REQUEST['motherName'];
        $birthday = $_REQUEST['birthday'];
        $phone = $_REQUEST['phone'];
        $cellphone = $_REQUEST['cellphone'];
        $cep = $_REQUEST['cep'];
        $logradouro = $_REQUEST['logradouro'];
        $numero = $_REQUEST['numero'];
        $complemento = $_REQUEST['complemento'];
        $bairro = $_REQUEST['bairro'];
        $uf = $_REQUEST['uf'];
        $localidade = $_REQUEST['localidade'];
        $pass = $_REQUEST['pass'];

        $sql = "UPDATE tbl_users SET firstname='$firstname', lastname='$lastname', cpf='$cpf', motherName='$motherName', birthday='$birthday', phone='$phone', cellphone='$cellphone', cep='$cep', logradouro='$logradouro', numero='$numero', complemento='$complemento', bairro='$bairro', uf='$uf', localidade='$localidade', complemento='$complemento', pass='$pass' WHERE id='$urlid'";
        $result2 = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    ?>
<form id="regForm" method="POST">
<h1>Editar:</h1>

<!-- Uma guia para cada etapa do formulario -->
<div class="tab">Informações Pessoais:
     <p><input value=<?php echo $firstname; ?> name="firstname" id="firstname" placeholder="Nome" oninput="this.className = ''"></p>
     <p><input value=<?php echo $lastname; ?> name="lastname" id="lastname" placeholder="Sobrenome" oninput="this.className = ''"></p>
     <p><input value=<?php echo $cpf; ?> name="cpf" id="id" placeholder="CPF" oninput="this.className = ''"></p>
     <p><input value=<?php echo $motherName; ?> name="motherName" id="motherName" placeholder="Filiação (Mãe)" oninput="this.className = ''"></p>
</div>

<div class="tab">Informações Pessoais:
  
     <p><input value=<?php echo $birthday; ?> name="birthday" id="birthday" type="date" placeholder="Data de Nascimento" oninput="this.className = ''"></p>
     <p><input value=<?php echo $phone; ?> name="phone" id="phone" placeholder="Telefone" oninput="this.className = ''"></p>
     <p><input value=<?php echo $cellphone; ?> name="cellphone" id="cellphone" placeholder="Celular" oninput="this.className = ''"></p>

</div>

<div class="tab">Endereço:
     <p><input value="<?php echo $cep; ?>" name="cep" id="cep" placeholder="CEP" oninput="this.className = ''"></p>
     <p><input value="<?php echo $logradouro; ?>" name="logradouro" id="logradouro" placeholder="Endereço" oninput="this.className = ''"></p>
     <div style="display: flex; justify-content: space-between">
          <p><input value="<?php echo $numero; ?>" name="numero" id="numero" style="width: 200px" placeholder="Nº" oninput="this.className = ''"></p>
        <p><input value="<?php echo $complemento; ?>" name="complemento" id="complemento" style="width: 600px" placeholder="Complemento" oninput="this.className = ''"></p>
     </div>
     <p><input value="<?php echo $bairro; ?>" name="bairro" id="bairro" placeholder="Bairro" oninput="this.className = ''"></p>
     <p><input value="<?php echo $uf; ?>" name="uf" id="uf" placeholder="UF" oninput="this.className = ''"></p>
     <p><input value="<?php echo $localidade; ?>" name="localidade" id="localidade" placeholder="Estado" oninput="this.className = ''"></p>
</div>

<div class="tab">Informações de Login:
     <p><input value="<?php echo $user; ?>" name="user" id="user" placeholder="Usuário" oninput="this.className = ''"></p>
     <p><input value="<?php echo $pass; ?>" name="pass" id="pass" type="password" placeholder="Senha" oninput="this.className = ''"></p>
</div>

<div style="overflow:auto;">
  <div style="float:right;">
    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Voltar</button>
    <button type="button" id="nextBtn" onclick="nextPrev(1)">Próximo</button>
  </div>
</div>

<!-- Círculos que indicam os passos do formulário: -->
<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
</div>
</form>
</body>

<script>
     var currentTab = 0; // A guia atual está definida para ser a primeira guia (0)
     showTab(currentTab); // Exibir a guia atual

     function showTab(n) {
     // Esta função exibirá a guia especificada do formulário
     var x = document.getElementsByClassName("tab");
     x[n].style.display = "block";
     // ... Corrigir os botões Anterior/Próximo
     if (n == 0) {
     document.getElementById("prevBtn").style.display = "none";
     } else {
     document.getElementById("prevBtn").style.display = "inline";
     }
     if (n == (x.length - 1)) {
     document.getElementById("nextBtn").innerHTML = "Editar";
     } else {
     document.getElementById("nextBtn").innerHTML = "Próximo";
     }
     // ... e execute uma função que exibe o indicador de etapa correto:
     fixStepIndicator(n)
     }

     function nextPrev(n) {
     // Esta função irá descobrir qual guia exibir 
     var x = document.getElementsByClassName("tab");
     // Saia da função se algum campo na guia atual for invalido:
     if (n == 1 && !validateForm()) return false;
     // Ocultar a guia atual:
     x[currentTab].style.display = "none";
     // Aumente ou diminua a guia atual em 1:
     currentTab = currentTab + n;
     // Se você chegou ao final do formulario. :
     if (currentTab >= x.length) {
     document.getElementById("regForm").submit();  
     }
     // Caso contrario exiba o guia correto.
     showTab(currentTab);
     }

     function validateForm() {
     // Essa função trata da validação dos campos do formulário
     var x, y, i, valid = true;
     x = document.getElementsByClassName("tab");
     y = x[currentTab].getElementsByTagName("input");
     // Um loop que verifica todos os campos de entrada na guia atual:
     for (i = 0; i < y.length; i++) {
     // Se o campo estiver vazio..
     if (y[i].value == "") {
          // adicione uma classe " invalida" ao campo:
          y[i].className += " invalid";
          // e defina o status válido atual como false:
          valid = false;
     }
     }
     // Se o status valido for verdadeiro, marque a etapa como concluida e valida
     if (valid) {
     document.getElementsByClassName("step")[currentTab].className += " finish";
     }
     return valid; // retornar o status valido
     }

     function fixStepIndicator(n) {
     // Essa função remove a classe " ativa" de todas as etapas ...
     var i, x = document.getElementsByClassName("step");
     for (i = 0; i < x.length; i++) {
     x[i].className = x[i].className.replace(" active", "");
     }
     //... e adiciona a classe "active" a etapa atual :
     x[n].className += " active";
     }
</script>