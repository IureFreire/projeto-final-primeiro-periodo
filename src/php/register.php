<?php
include('base.php');
include('connectionDb.php');
?>
<body background="../assets/img/telecall-background.jpg">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script 
     src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
     integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
     crossorigin="anonymous" 
     referrerpolicy="no-referrer"
></script>
<link rel="stylesheet" href="../assets/css/form.css">

<form id="regForm" method="POST">
<h1>Cadastro:</h1>

<!-- One "tab" for each step in the form: -->
<div class="tab">Informações Pessoais:
     <p><input name="firstname" id="firstname" placeholder="Nome" oninput="this.className = ''"></p>
     <p><input name="lastname" id="lastname" placeholder="Sobrenome" oninput="this.className = ''"></p>
     <p><input name="cpf" id="id" placeholder="CPF" oninput="this.className = ''"></p>
     <p><input name="motherName" id="motherName" placeholder="Filiação (Mãe)" oninput="this.className = ''"></p>
</div>

<div class="tab">Informações Pessoais:
  
     <p><input name="birthday" id="birthday" type="date" placeholder="Data de Nascimento" oninput="this.className = ''"></p>
     <p><input name="phone" id="phone" placeholder="Telefone" oninput="this.className = ''"></p>
     <p><input name="cellphone" id="cellphone" placeholder="Celular" oninput="this.className = ''"></p>

</div>

<div class="tab">Endereço:
     <p><input name="cep" id="cep" placeholder="CEP" oninput="this.className = ''"></p>
     <p><input name="logradouro" id="logradouro" placeholder="Endereço" oninput="this.className = ''"></p>
     <div style="display: flex; justify-content: space-between">
          <p><input name="numero" id="numero" style="width: 200px" placeholder="Nº" oninput="this.className = ''"></p>
          <p><input name="complemento" id="complemento" style="width: 600px" placeholder="Complemento" oninput="this.className = ''"></p>
     </div>
     <p><input name="bairro" id="bairro" placeholder="Bairro" oninput="this.className = ''"></p>
     <p><input name="uf" id="uf" placeholder="UF" oninput="this.className = ''"></p>
     <p><input name="localidade" id="localidade" placeholder="Estado" oninput="this.className = ''"></p>
</div>

<div class="tab">Informações de Login:
     <p><input name="user" id="user" placeholder="Usuário" oninput="this.className = ''"></p>
     <p><input name="pass" id="pass" type="password" placeholder="Senha" oninput="this.className = ''"></p>
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
  <span class="step"></span>
</div>
</form>

<?php
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
     $user = $_REQUEST['user'];
     $pass = $_REQUEST['pass'];
     $isAdmin = 0;
 
 
     $sql = "INSERT INTO tbl_users (firstname, lastname, cpf, motherName, birthday, phone, cellphone, cep, logradouro, numero, complemento, bairro, uf, localidade, user, pass, isAdmin ) VALUES ('$firstname', '$lastname', '$cpf', '$motherName', '$birthday', '$phone', '$cellphone', '$cep', '$logradouro', '$numero', '$complemento', '$bairro', '$uf', '$localidade', '$user', '$pass', '$isAdmin' )";
     $result = mysqli_query($conn, $sql);
     mysqli_close($conn);

}

?>
</body>
<link rel="stylesheet" href="assets/css/form.css">
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
     } else {
     document.getElementById("prevBtn").style.display = "inline";
     }
     if (n == (x.length - 1)) {
     document.getElementById("nextBtn").innerHTML = "Cadastrar";
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
     if (currentTab >= x.length) {
     document.getElementById("regForm").submit();
     return false;
     }
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
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
     /*
          * Para efeito de demonstração, o JavaScript foi
          * incorporado no arquivo HTML.
          * O ideal é que você faça em um arquivo ".js" separado. Para mais informações
          * visite o endereço https://developer.yahoo.com/performance/rules.html#external
          */
     
     // Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
     // quando o usuário sair do campo "cep"
     $("#cep").blur(function(){
          // Remove tudo o que não é número para fazer a pesquisa
          var cep = this.value.replace(/[^0-9]/, "");
          
          // Validação do CEP; caso o CEP não possua 8 números, então cancela
          // a consulta
          if(cep.length != 8){
               return false;
          }
          
          // A url de pesquisa consiste no endereço do webservice + o cep que
          // o usuário informou + o tipo de retorno desejado (entre "json",
          // "jsonp", "xml", "piped" ou "querty")
          var url = "https://viacep.com.br/ws/"+cep+"/json/";
          
          // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
          // caso ocorra algum erro (o cep pode não existir, por exemplo) a
          // usabilidade não seja afetada, assim o usuário pode continuar//
          // preenchendo os campos normalmente
          $.getJSON(url, function(dadosRetorno){
               try{
                    // Preenche os campos de acordo com o retorno da pesquisa
                    $("#logradouro").val(dadosRetorno.logradouro);
                    $("#bairro").val(dadosRetorno.bairro);
                    $("#localidade").val(dadosRetorno.localidade);
                    $("#uf").val(dadosRetorno.uf);
               }catch(ex){}
          });
     });
</script>

