<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            CMMS->signup
        </title>
        <link rel='stylesheet' href='signup.css'/>
    </head>
    <body class='sBody'>
        <?php
            $fName = $_POST['fName'];
            $sName = $_POST['sName'];
            $department = $_POST['department'];
            $passwords = $_POST['passwords'];
            $rank = $_POST['rank'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include('../connect/connect.php');
        $uName = $fName.$sName;

        $checkUsername = "SELECT * FROM EmployeeDetails WHERE username = ? ";
        $stmt1 = $conn->prepare($checkUsername);
        $stmt1->bind_param("s" , $uName);
        $stmt1->execute();
        $stmt1->store_result();

        if ($stmt1->num_rows >= 1) {
            $conn->close();
        }
        else {
    
        $sql = "INSERT INTO EmployeeDetails (fName, sName, username , passwords ,department ,rank)
                VALUES (? , ? , ? , ? , ? , ?)";

        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("ssssss" , $fName ,  $sName , $uName ,$passwords ,$department , $rank);

        if ($stmt2->execute()) {
            echo "<script>window.location.href= '../index.php'</script>";
                }
            }
        }
        ?>
        <span class="wavyCMMS">
        <span class="wavy-bounce">C</span>
        <span class="wavy-bounce">M</span>
        <span class="wavy-bounce">M</span>
        <span class="wavy-bounce">S</span>
    </span>
        <div class="signupFormContainer">
            <span>
                <form class="signupForm" method='POST'>
                    <div class="nInputContainer">
                        <span>
                            <input type="text" placeholder="First Name" class="nInput" name='fName'/>
                        </span>
                        <span>
                            <input type="text" placeholder="Last Name" class="nInput" name='sName'/>
                        </span>
                    </div>
                    <span>
                        <select class='sInput dptSelection' name='department'>
                            <option disabled selected>
                                Select department
                            </option>
                            <option value='Department A'>
                                Department A
                            </option>
                            <option value='Department B'>
                                Department B
                            </option>
                            <option value='Department C'>
                                Department C
                            </option>
                            <option value='Department D'>
                                Department D
                            </option>
                            <option value='Department E'>
                                Department E
                            </option>
                        </select>
                    </span>
                    <span>
                        <input type="password" placeholder="Password" class="sInput" name='passwords' required/>
                    </span>
                    
                    <span>
                        <select class='sInput dptSelection' name='rank'>
                            <option disabled selected>
                                rank
                            </option>
                            <option value='normal'>
                                Normal user
                            </option>
                            <option value='admin'>
                                Administrator
                            </option>
                        </select>
                    </span> 

                    <span>
                        <input type="submit" value="Sign up" class="signupButton"/>
                    </span>
                </form>
            </span>
        </div>
    </body>
</html>