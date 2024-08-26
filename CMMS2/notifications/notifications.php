<?php
 $currentDpt;
 $currentRank;
    include('../session/fetchSession.php');
    include('reminder.php');
    include('../session/killSession.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            CMMS->home
        </title>
        <link href='notifications.css' rel='stylesheet'/>
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
                    $currentUser = strtolower($currentUser);
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
                    <a href="../signup/signup.php" class="newMeetingLink">
                        Create new Account
                   </a>
                </span>

                <?php
                     if ($currentUser != 'admin') {
                        echo "
                        <span class='menuSpan'>
                        <a href='#' class='newMeetingLink'>
                            Notifications
                       </a>
                    </span>
                        ";
                     }
                ?>


                <?php
                    if ($currentUser === 'admin') {
                        echo "
                        <span class='menuSpan'>
                            <a href='../admin/admin.php' class='newMeetingLink'>
                                Admin panel
                            </a>
                        </span>
                        ";
                    }
                ?>

                <span class="menuSpan">
                    <a href="../myDetails/myDetails.php" class="newMeetingLink">
                        My Details
                   </a>
                </span>

                <span class="menuSpan">
                    <a href="../index.php" class="newMeetingLink">
                        Log Out
                   </a>
                </span>

            </div>
            <div class="currentDiv">
                <span class="nTitle">
                    Announcements
                </span>
                <span>
                    <?php
                    include ('../connect/connect.php');

                    $sql = "SELECT * FROM meetings WHERE department = '$currentDpt'  OR department = 'all' ORDER BY meetingId DESC";

                        $result = mysqli_query($conn, $sql);
                    
                        if ($result && mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $meetingCode = $row['meetingCode'];
                                $sql2 = "SELECT * FROM replies WHERE meetingCode = '$meetingCode' ORDER BY rId DESC ";

                                $result2 = mysqli_query($conn, $sql2);
                            
                                
                                $title = "";
                                echo "<div class='notificationContainer'>";
                                echo "<h2 style='color:black;'>~" . $row['title'] . "</h2>";
                                echo "<p class='meetingDescription'>" . $row['descriptions'] . "</p>";
                                echo "<span class='notificationVenue'>Location: <b>" . $row['venue'] . " ,</b></span>";
                                echo "<span class='notificationDate'>Date: " . $row['tarehe'] . " ,</span>";
                                echo "<span class='notificationTime'> Time:" . $row['muda'] . "</span>";
                                echo "<a href='../reply/reply.php?title=".$title."&sender=".$row['meetingCode']."' style='color:rgb(96, 8, 20)'>
                                   will not attend?
                                </a>";


                                echo ".";
                                echo "<a href='../document/document.php?title=".$title."&sender=".$row['meetingCode']."' style='color:rgb(6,15,46)'>
                                Add document
                             </a>";

                                echo "</div>";

                                if ($result2 && mysqli_num_rows($result2) > 0) {
                                    
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        echo "<div class='notificationContainer'style='padding-top:10px;width:80%;justify-content:end;display:flex;'>";
                                        echo "<span style='border-right:1px dotted #ccc;margin-right:5px;'>Reply on <b>" . $row['title'] . "</b></span>";
                                        echo "<p class='meetingDescription'>" . $row2['reason'] . "</p>";
                                        echo "<span class='notificationVenue' style='border-left:1px dotted #ccc;padding-left:5px;'>by <b>" . $row2['username'] . "</b></span>";
                                        echo "</div>";
                                    }
                                } 

                                echo "
                                <div style='border-bottom:1px solid white;margin :10px;width:80%;'></div>
                                ";
    
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
            </div>
        </div>
       
    </body>
</html>