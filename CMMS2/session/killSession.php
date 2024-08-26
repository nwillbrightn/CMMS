<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "CMMS";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM CMMSSession WHERE sessionDate < CURDATE() - INTERVAL 2 DAY";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "" ;
}

$conn->close();

?>
