<?php
session_start();
include('base.php');
include('connectionDb.php');
?>
<link rel="stylesheet" href="../assets/css/form.css">
<body background="../assets/img/telecall-background.jpg">
    <!-- esse comentário é para eu saber como eu posso fazer um git push -->
    
    <?php
    if(!isset($_SESSION['user'])){
        header("Location:Login.php");
    }
    if($_SESSION['isAdmin'] == 1 and $_SESSION['isValidated'] != 1){
       header("Location:Login.php"); 
    }
    $userSession = $_SESSION['user'];
    $query = "SELECT * FROM tbl_users WHERE user='$userSession'";
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

        $sql = "UPDATE tbl_users SET firstname='$firstname', lastname='$lastname', cpf='$cpf', motherName='$motherName', birthday='$birthday', phone='$phone', cellphone='$cellphone', cep='$cep', logradouro='$logradouro', numero='$numero', complemento='$complemento', bairro='$bairro', uf='$uf', localidade='$localidade', complemento='$complemento', pass='$pass' WHERE user='$userSession'";
        $result2 = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }?>
        
    <form id="regForm" method="POST">
    <h1>Perfil:</h1>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">Informações Pessoais:
        <p><input disabled value=<?php echo $firstname; ?> name="firstname" id="firstname" placeholder="Nome" oninput="this.className = ''"></p>
        <p><input disabled value=<?php echo $lastname; ?> name="lastname" id="lastname" placeholder="Sobrenome" oninput="this.className = ''"></p>
        <p><input disabled value=<?php echo $cpf; ?> name="cpf" id="id" placeholder="CPF" oninput="this.className = ''"></p>
        <p><input disabled value=<?php echo $motherName; ?> name="motherName" id="motherName" placeholder="Filiação (Mãe)" oninput="this.className = ''"></p>
    </div>

    <div class="tab">Informações Pessoais:
    
        <p><input disabled value=<?php echo $birthday; ?> name="birthday" id="birthday" type="date" placeholder="Data de Nascimento" oninput="this.className = ''"></p>
        <p><input disabled value=<?php echo $phone; ?> name="phone" id="phone" placeholder="Telefone" oninput="this.className = ''"></p>
        <p><input disabled value=<?php echo $cellphone; ?> name="cellphone" id="cellphone" placeholder="Celular" oninput="this.className = ''"></p>

    </div>

    <div class="tab">Endereço:
        <p><input disabled value="<?php echo $cep; ?>" name="cep" id="cep" placeholder="CEP" oninput="this.className = ''"></p>
        <p><input disabled value="<?php echo $logradouro; ?>" name="logradouro" id="logradouro" placeholder="Endereço" oninput="this.className = ''"></p>
        <div style="display: flex; justify-content: space-between">
            <p><input disabled value="<?php echo $numero; ?>" name="numero" id="numero" style="width: 200px" placeholder="Nº" oninput="this.className = ''"></p>
            <p><input disabled value="<?php echo $complemento; ?>" name="complemento" id="complemento" style="width: 600px" placeholder="Complemento" oninput="this.className = ''"></p>
        </div>
        <p><input disabled value="<?php echo $bairro; ?>" name="bairro" id="bairro" placeholder="Bairro" oninput="this.className = ''"></p>
        <p><input disabled value="<?php echo $uf; ?>" name="uf" id="uf" placeholder="UF" oninput="this.className = ''"></p>
        <p><input disabled value="<?php echo $localidade; ?>" name="localidade" id="localidade" placeholder="Estado" oninput="this.className = ''"></p>
    </div>

    <div class="tab">Informações de Login:
        <p><input disabled value="<?php echo $user; ?>" name="user" id="user" placeholder="Usuário" oninput="this.className = ''"></p>
        <p><input disabled value="<?php echo $pass; ?>" name="pass" id="pass" type="password" placeholder="Senha" oninput="this.className = ''"></p>
    </div>
    <div style="overflow:auto;">
    <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Voltar</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Próximo</button>
    </div>
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    </div>
    </form>
</body>
<script>
     var currentTab = 0; // Current tab is set to be the first tab (0)
     showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("nextBtn").style.display = "inline";
    } else {
    document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
    document.getElementById("nextBtn").style.display = "none";
    } else {
    document.getElementById("nextBtn").innerHTML = "Próximo";
    }
     // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }

    function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false:
        valid = false;
    }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }
</script>