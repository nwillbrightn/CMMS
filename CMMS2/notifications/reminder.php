<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CMMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$today = date("Y-m-d");
$tomorrow = date("Y-m-d", strtotime("+1 day"));

$sql = "SELECT * FROM meetings WHERE tarehe IN ('$today', '$tomorrow') AND department = '$currentDpt'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<script>alert('Reminder: Meeting on ";
    while ($row = $result->fetch_assoc()) {
        $meetingDate = $row["tarehe"];
        $meetingTitle = $row["title"]; 

    echo $meetingDate;
    echo " about ";
    echo $meetingTitle;
    echo ", ";
    }
    echo "')</script>";
} 

$conn->close();

?>
