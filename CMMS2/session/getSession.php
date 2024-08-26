<?php
    $currentUser; 
    include('../connect/connect.php');

    echo "<script>
                        alert('Incorrect password or username');
                     </script>";

    $getSql = "SELECT * FROM CMMSSession WHERE ipAddress = '$ipAddress'  AND userAgent = '$userAgent'";

    $result = $conn->query($getSql);

    if ($result->num_rows > 0) {
    while(($row = $result->fetch_assoc())) {
        $currentUser = strtolower($row['username']); 
    }
    
    }
?>