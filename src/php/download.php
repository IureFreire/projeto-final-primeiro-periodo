<?php
session_start();
include('connectionDb.php');


$userSession = $_SESSION['user'];
$query = "SELECT * FROM tbl_logs";
$result = mysqli_query($conn, $query);
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $filename = 'logs.csv';
    $fp = fopen($filename, 'w');
    $data = ['Usuário', 'Status', 'Data e Hora'];
    $output[] = array($row['user'], $row['isSuccess'], $row['dataehora']);
    fputcsv($fp, $data);
    foreach($output as $rows){
        fputcsv($fp, $rows); 
    }      
    fclose($fp);
    
}


header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));
flush(); // Esvazie o buffer de saida do sistema
readfile($filename);
die();
?>