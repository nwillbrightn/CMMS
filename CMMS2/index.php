<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            CMMS->Login
        </title>
        <link rel='stylesheet' href='index.css'/>
    </head>
    <body class='iBody'>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                include ('connect/connect.php');
                
                 $uName = $_POST['uName'];
                 $passwords = $_POST['passwords'];
                
                 $query = "SELECT * FROM EmployeeDetails WHERE username = ? AND passwords = ?";
                 $stmt1 = $conn->prepare($query);
                 $stmt1->bind_param("ss" , $uName , $passwords);
                 $stmt1->execute();
                 $stmt1->store_result();
         
                 if ($stmt1->num_rows >= 1) {
                    include('session/saveSession.php');
                 } 
                 else {
                     echo "<script>
                        alert('Incorrect password or username');
                     </script>";
                 }
             }
        ?>
         <span class="wavyCMMS">
        <span class="wavy-bounce">C</span>
        <span class="wavy-bounce">M</span>
        <span class="wavy-bounce">M</span>
        <span class="wavy-bounce">S</span>
        </span>
        <div class="loginContainer">
            <span>
                <form class="loginForm" method='POST'>
                    <span class="loginInputSpan">
                        <input type="text" placeholder="Username"  class="lInput" name='uName'/>
                    </span>
                    <span class="loginInputSpan">
                        <input type="password" placeholder="Password" name='passwords'   class="lInput"/>
                    </span>
                    <span class="loginInputSpan">
                        <input type="submit" value="Login"  class="lInputSubmit"/>
                    </span>
                </form>
                <div class="signupLinkContainer">
                    <a href="signup/signup.php" class="signupLink">
                        Create new account
                    </a>
                </div>
            </span>
        </div>
    </body>
</html>