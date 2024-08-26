<?php
    $sql = "SELECT * FROM silicaSession WHERE username = '$currentUser' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    while(($row = $result->fetch_assoc())) {
        $currentUser = strtolower($row['username']); 
    }
    }
?>