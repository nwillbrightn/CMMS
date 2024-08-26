<?php
    include('../session/fetchSession.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            CMMS->home
        </title>
        <link rel='stylesheet' href='myDetails.css'/>
    </head>
    <body class="hBody">
        <div class="hBodyContainer">
            <div class="dashboard">
                <span class="CMMS">
                    CMMS
                </span>

                <span class='logo3'>
                <img src='../images/logo3.png' alt='' width='1200px' style='z-index:-1'/>    
                </span>

                <?php
                    if ($currentRank === 'admin') {
                        echo "
                        <span class='menuSpan newMeeting'>
                        <a href='../newMeeting/newMeeting.php' class='newMeetingLink'>
                            Create new meeting
                       </a>
                    </span>
                        ";
                    }
                ?>
                
                <span class="menuSpan">
                    <a href="signup.php">
                        Create new Account
                   </a>
                </span>

                <span class="menuSpan">
                    <a href="../notifications/notifications.php">
                        Notifications
                   </a>
                </span>

                <span class="menuSpan">
                    <a href="#" >
                        My Details
                   </a>
                </span>

                <span class="menuSpan">
                    <a href="../index.php">
                        Log Out
                   </a>
                </span>

            </div>
            <div class="details">
                <span class='currentDiv'>
                <span>
                    <?php
                    include ('../connect/connect.php');
                    
                        echo "
                        <span class='dTitle'>
                            My details
                        </span>
                        ";
                        $sql = "SELECT * FROM EmployeeDetails WHERE username = '$currentUser' ";
                        $result = mysqli_query($conn, $sql);
                    
                        if ($result && mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='detailContainer'>";
                                echo "<div class='detail'>First Name: " . $row['fName'] . "</div>";
                                echo "<div class='detail'>Surname: " . $row['sName'] . "</div>";
                                echo "<div class='detail'>Username: " . $row['username'] . " ,</div>";
                                echo "<div class='detail'>Rank: " . $row['rank'] . " ,</div>";
                                echo "<div class='detail'> Date Registered: " . $row['dateRegistered'] . "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "
                            <div style='margin-top:14px;'>
                            Your notifications will appear here.
                            </div>
                            ";
                        }
                    
                    
                    ?>
                </span>
                    </span>
            </div>
        </div>
       
    </body>
</html>