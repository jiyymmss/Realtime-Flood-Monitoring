<?php

$db_host        = 'localhost';
$db_user        = 'root';
$db_pass        = '';
$db_database    = 'bantay'; 
$conn=new mysqli($db_host, $db_user, $db_pass, $db_database, 3307);
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
    echo "";


$query = "SELECT * FROM records"; // Replace with your table name and query as needed

$result = $conn->query($query);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

// Encode the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
