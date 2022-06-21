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

<!-- Uma "guia" para cada etapa do formulário: -->
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

<!-- Círculos que indicam as etapas do formulário: Páginas -->
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
     var currentTab = 0; // A guia atual esta definida para ser a primeira guia (0)
     showTab(currentTab); // Exibir a guia atual

     function showTab(n) {
     // Esta função irá mostrar a aba especificada do formulário ...
     var x = document.getElementsByClassName("tab");
     x[n].style.display = "block";
     // ... Botões de Anterior/Próximo:
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
     // ... e execute uma função que exibe o indicador de etapa correto:
     fixStepIndicator(n)
     }

     function nextPrev(n) {
     // Esta função irá descobrir qual guia exibir
     var x = document.getElementsByClassName("tab");
     // Saia da função se alguma campo na guia atual for invalido
     if (n == 1 && !validateForm()) return false;
     // Ocultar a guia atual:
     x[currentTab].style.display = "none";
     // Aumente ou diminua a guia atual em 1
     currentTab = currentTab + n;
     // Se você chegou ao final do formulário.. :
     if (currentTab >= x.length) {
     document.getElementById("regForm").submit();
     return false;
     }
     // Caso contrário, exiba a guia correta:
     showTab(currentTab);
     }

     function validateForm() {
     // Esta função trata da validação dos campos do formulário
     var x, y, i, valid = true;
     x = document.getElementsByClassName("tab");
     y = x[currentTab].getElementsByTagName("input");
     // Um loop que verifica todos os campos de ebtrada na guia atual:
     for (i = 0; i < y.length; i++) {
     // Se um campo estiver vazio....
     if (y[i].value == "") {
          // Adicione uma classe " invalida" ao campo:
          y[i].className += " invalid";
          // e defina o status válido atual como false:
          valid = false;
     }
     }
     // Se o status válido for verdadeiro, marque a etapa como concluída e válida:
     if (valid) {
     document.getElementsByClassName("step")[currentTab].className += " finish";
     }
     return valid; // retornar ao status válido
     }

     function fixStepIndicator(n) {
     // Esta função remove a classe "ativa de todas as etapas..
     var i, x = document.getElementsByClassName("step");
     for (i = 0; i < x.length; i++) {
     x[i].className = x[i].className.replace(" active", "");
     }
     //... adiciona a classe "active" a etapa atual:
     x[n].className += " active";
     }
</script>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
     /*
          * Para efeito de demonstração, o JavaScript foi
          * incorporado no arquivo HTML.
          * O ideal é fazer um arquivo em  ".js" separado. 
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

