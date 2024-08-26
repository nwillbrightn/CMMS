<?php

$ipAddress = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$lastSeen = 'seen';

$currentUser = strtolower($uName);

$sql = "INSERT INTO CMMSSession (username, ipAddress, userAgent)
VALUES (? , ? , ?)";

$stmt2 = $conn->prepare($sql);
$stmt2->bind_param("sss" , $uName ,  $ipAddress , $userAgent);

if ($stmt2->execute()) {
   if ($currentUser === 'admin') {
    echo "<script>window.location.href='admin/admin.php'</script>";
   }
   else {
echo "<script>window.location.href='notifications/notifications.php'</script>";
   }
 }
else {
     echo "Error: " . $sql . "<br>" . $conn->error;
     echo "<script>
    alert('Incorrect passusername');
    </script>";
}

$checkQuery = "SELECT * FROM CMMSSession WHERE ipAddress = '$ipAddress' AND userAgent = '$suserAgent' AND username = '$currentUser'";
$result = $conn->query($checkQuery);

        if ($result->num_rows == 0) {
            echo "";
        }

        else {
            echo "<script>
            alert('Incorrect passusername');
         </script>";
        }

?>