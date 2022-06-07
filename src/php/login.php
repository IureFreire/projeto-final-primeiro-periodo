<?php
session_start();
include('base.php');
$_SESSION['isValidated'] = '';
?>
<body background="../assets/img/telecall-background.jpg">
    <div class="container" style="width: 30%">
        <div class="card" style="margin-top: 20%;">
            <div class="card-header card-outline card-dark">
            
                <h4 class="text-center">Login</h4>
                <!-- <img src="assets/img/telecall-logo.png" class="row loginTitle"> -->
            </div>  
            <div class="card-body bg-light">
                <form method='post' action="valida.php">
                    <div class="form-outline mb-4" style="margin-left: 10%; margin-right:10%; margin-top: 10%; width: 80%;">      
                        <input type="text" name="user" id="user" class="form-control" required>  
                        <label class="form-label" for="user">Usuário</label>     
                    </div>
                    <div class="form-outline mb-4" style="margin-left: 10%; margin-right:10%; width: 80%;">      
                        <input type="password" name="pass" id="pass" class="form-control"  minlength="3" maxlength="10" required>
                        <label class="form-label" for="pass">Senha</label>
                    </div>
                
                    <?php
                        if(isset($_SESSION['msg']) != ''){
                    ?>
                            <div class="text-center alert alert-danger mb-4" style="width:80%; margin-left: 10%; margin-right:10%">
                                <?php echo $_SESSION['msg']; 
                                    unset($_SESSION['msg']);
                                ?>
                            </div>
                                            
                        <?php }   ?>
            
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center" style="margin-left: 15px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked disabled/>
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <a href="register.php">Cadastre-se</a>
                    </div>
                    <div class="text-center">
                        
                        <input type="submit" value="Entrar" name="login" class="btn btn-primary btn-block mb-4" style="margin-top: 10px; width: 80%" >
                        </input>
                        </input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
