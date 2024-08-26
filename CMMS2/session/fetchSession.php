<?php
$currentDpt;
$currentRank;
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$ipAddress = $_SERVER['REMOTE_ADDR'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CMMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    
}

$stmt = $conn->prepare("SELECT username FROM CMMSSession WHERE userAgent = ? AND ipAddress = ? ORDER BY sessId DESC");
$stmt->bind_param("ss", $userAgent, $ipAddress);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    
    $stmt->bind_result($username);
    $stmt->fetch();
    
    $currentUser = $username;

$stmt2 = $conn->prepare("SELECT department FROM EmployeeDetails WHERE username = ?");
$stmt2->bind_param("s", $currentUser);
$stmt2->execute();
$stmt2->store_result();

if ($stmt2->num_rows > 0) {
    
    $stmt2->bind_result($dpt);
    $stmt2->fetch();

    $currentDpt = $dpt;
    $currentDpt = strtolower($currentDpt);
}
} else {
    echo "";
}

$stmt3 = $conn->prepare("SELECT rank FROM EmployeeDetails WHERE username = ?");
$stmt3->bind_param("s", $currentUser);
$stmt3->execute();
$stmt3->store_result();

if ($stmt3->num_rows > 0) {
    
    $stmt3->bind_result($rank);
    $stmt3->fetch();

    $currentRank = $rank;
    $currentRank = strtolower($currentRank);
}
else {
    echo "";
}


$stmt->close();
$conn->close();

?>
