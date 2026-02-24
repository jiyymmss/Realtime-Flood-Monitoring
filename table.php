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


$sql= "SELECT * FROM records";
$result= $conn->query($sql);

if($result->num_rows > 0){
    while ($row = $result-> fetch_assoc()){
        echo "<tr>
        <td>" . $row["date_time"] . "</td>
        <td>" . $row["flood_flow"] . "</td>
        <td>" . $row["water_level"] .  "</td>
        </tr>";
    }
}
else{
    echo "No Results";
}    
$conn->close();
?>