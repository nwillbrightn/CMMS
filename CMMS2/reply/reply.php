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
        <link rel='stylesheet' href='reply.css'/>
    </head>
    <body class="hBody">
        
    <?php
            $reason = $_POST['reason'];
            $sender = $_GET['sender'];
            $to = $_POST['to'];
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include('../connect/connect.php');
    
        $sql = "INSERT INTO replies (username , reason  , meetingCode)
                VALUES (? , ? , ?)";

        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("sss" , $currentUser ,$reason , $to);

        if ($stmt2->execute()) {
            echo "<script>window.location.href='../notifications/notifications.php'</script>";
        }
            }

        ?>
        <div class="hBodyContainer">
            <div class="dashboard">
                <span class="CMMS">
                    CMMS
                </span> 
                
                <span class='logo3'>
                <img src='../images/logo3.png' alt='' width='1200px' style='z-index:-1'/>    
                </span>

                <span class="menuSpan newMeeting">
                    <a href="../newMeeting/newMeeting.php" class="newMeetingLink">
                        Create new meeting
                   </a>
                </span>

                <span class="menuSpan">
                    <a href="../signup/signup.php" class="newMeetingLink">
                        Create new Account
                   </a>
                </span>

                <span class="menuSpan">
                    <a href="../notifications/notifications.php" class="newMeetingLink">
                        Notifications
                   </a>
                </span>

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
                <span class="mTitle">
                    Absence form
                </span>
                <span>
                    <form class="invitationForm" method='POST'>
                            <?php
                            echo "
                                 <span>
                                 <input type='text' placeholder='invitedBy' name='to' class='mInput' value='".$sender."' readonly style='display:none;'/>
                             </span>
                             ";
                            ?>
                           
                        <span>
                            <div class="label">
                                Reason
                            </div>
                            <textarea class="mInput descriptionArea" name="reason">

                            </textarea>
                        </span>
                        
                        <div class="btnContainer">
                            <span>
                                <input type="submit" value="Reply" class="sendButton"/>
                            </span>
                        </div>
                        
                    </form>
                </span>
            </div>
        </div>
       
    </body>
</html>