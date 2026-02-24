<?php

// Database connection parameters
$databaseServer = "localhost";
$databaseUser = "pma";
$databasePassword = "";
$databaseName = "bantay";

// Check if the 'data' parameter is set in the URL
 $conn = new mysqli("localhost", "pma", "", "bantay");
print_r($_GET);
if (isset($_GET['data'])) {
    $data = $_GET['data'];

    // Create a MySQL connection
    $mysqli = new mysqli($databaseServer, $databaseUser, $databasePassword, $databaseName);
    print_r($mysqli);die();
    // Check the database connection
    if ($mysqli->connect_error) {
        error_log("Connection failed: " . $mysqli->connect_error);
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert the data into the table
    $sql = "INSERT INTO records (water_level) VALUES ('$data')"; // Replace with your table and column names

    if ($mysqli->query($sql) === true) {
        echo "Data inserted successfully";
    } else {
        error_log("Error: " . $sql . " - " . $mysqli->error);
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "No data parameter provided in the URL.";
}
?>
