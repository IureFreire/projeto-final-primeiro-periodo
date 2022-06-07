<?php
         $host = "localhost";
         $user = "root";
         $pass = "root";
         $banco = "telecall_db";
         $conn = new mysqli ($host, $user, $pass, $banco); 
         
         
         if($conn->connect_errno)
?>