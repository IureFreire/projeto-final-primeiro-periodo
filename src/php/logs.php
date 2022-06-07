<?php
session_start();
include('base.php');
include('connectionDb.php');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.12.1/sorting/date-uk.js">  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<body background="../assets/img/telecall-background.jpg">
    <?php
    if(!isset($_SESSION['user']) or $_SESSION['isValidated'] != 1){
        header("Location:Login.php");
    }
    $userSession = $_SESSION['user'];
    $query = "SELECT * FROM tbl_logs";
    // $result = $conn->query($query);
    $result = mysqli_query($conn, $query);
    $rows = array();
    while($row = mysqli_fetch_array($result)){
        $resultset[] = $row;
    }
    ?>
    <div>
        <a class="btn btn-secondary" href="download.php" >  Download CSV  </a>
        <div class="card-header text-center bg-light">
            Tabela de Logs
        </div>
        <div class="bg-light">
            <table class="table table-light table-striped table-bordered" id="users" >
                <thead class="text-center">
                    <tr>
                        <th>User</th>
                        <th>Tentativa de Conexão</th>
                        <th>Date e Hora</th>
                    </tr>
                    </thead>
                <?php
                foreach ($resultset as $result){
                    $user = $result['user'];
                    $isSuccess =  $result['isSuccess'];
                    $dataehora = $result['dataehora'];
                    ?>
                <tbody class="text-center">
                    <tr>
                        <td><?php echo $user ?></td>
                        <td><?php echo $isSuccess ?></td>
                        <td><?php echo $dataehora ?></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
<script>
$(document).ready(function (){
    $('#users').DataTable({
        "order": [[2, "desc"]],
        "columnDefs": [{"targets": 0, "type": "date-uk"}]
    });
});
</script>