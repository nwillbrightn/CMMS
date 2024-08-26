<?php
    include('../session/fetchSession.php');
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CMMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['sender'])){
$sender = $_GET['sender'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdfFile"])) {
    $to = $_POST['to'];
    if ($_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";
        $fileName = uniqid() . "-" . basename($_FILES["pdfFile"]["name"]);

        $targetFilePath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFilePath)) {
            $sql = "INSERT INTO documents (filePath , meetingCode) VALUES ('$targetFilePath' , '$to')";

            if ($conn->query($sql) === TRUE) {
                echo "<script> alert ('submitted successfully'); </script>";
                echo "<script>window.location.href='../notifications/notifications.php'</script>";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    } else {
        $error = "Error uploading file. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:black;
            color:rgb(245,245,245);
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color:rgba(245,245,245,0.5);
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="file"] {
            display: block;
            margin-top: 5px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }

        #uploadBtn {
            color:rgb(245,245,245);
            background-color: rgb(96, 8, 20);
        }

        .wavy-bounce {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  display: inline-block;
  font-size: 200%;
  color: rgb(245,245,245);
  animation: wavyBounce 2s ease-in-out infinite;
}

.wavy-bounce:nth-child(1) {
  animation-delay: 0s;
}

.wavy-bounce:nth-child(2) {
  animation-delay: 0.25s;
}

.wavy-bounce:nth-child(3) {
  animation-delay: 0.5s;
}

.wavy-bounce:nth-child(4) {
  animation-delay: 0.75s;
}

.wavyCMMS {
    position: fixed;
    top: 5%;
    left: 5%;
}
@keyframes wavyBounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-20px) rotate(5deg);
  }
  60% {
    transform: translateY(-10px) rotate(-5deg);
  }}
    </style>
</head>
<body>
    <div>
    <span class="wavyCMMS">
        <span class="wavy-bounce">C</span>
        <span class="wavy-bounce">M</span>
        <span class="wavy-bounce">M</span>
        <span class="wavy-bounce">S</span>
        </span>
</div>

<div class="container" style='margin-top:100px;'> 
    <h2>Documents submission panel</h2>
    <?php if(isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php elseif(isset($message)): ?>
        <p class="success"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <?php
    echo "<span> <input type='text' placeholder='invitedBy' name='to' value='".$sender."' readonly style='display:none;'/></span>";
    ?>     
        <div class="form-group">
            <label for="pdfFile">Choose PDF File:</label>
            <input type="file" name="pdfFile" id="pdfFile" accept=".pdf" required>
        </div>
        <div class="form-group">
            <button type="submit" id="uploadBtn">Upload PDF</button>
        </div>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
