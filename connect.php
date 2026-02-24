<?php

$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= '';
$db_database	= 'bantay'; 
$conn=new mysqli($db_host, $db_user, $db_pass, $db_database, 3307);
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
    echo "";
?>