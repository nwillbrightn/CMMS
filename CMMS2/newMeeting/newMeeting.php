<?php
    $currentRank;
    $timeStatus = 'different';
    $venueStart;
    $venueEnd;
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
        <link href='newMeeting.css' rel='stylesheet'/>
        <style>
            .mInput{
                width:97%;
            }

            .sInput {
                width: 99%;
            }

            @keyframes wavyBounce {
                0%{
      opacity:0;
    }
    100% {
        opacity:1;
    }
  }

  @keyframes zoomingForm {
    0%{
      transform: scale(0);
      transform: translateY(-30px);
      opacity:0;
    }
    50% {
        opacity:0.5;
    }
    100% {
        transform: scale(1);
        opacity:1;
        transfomr:translateY(0)
    }
  }

  @keyframes buttonAnimation {
    0%{
      transform: scale(0);
      transform: translateY(-50px);
      opacity:0;
    }
    30% {
        opacity: 0;
    }
    50% {
        opacity:0.5;
    }
    70% {
        transform: scale(1);
        opacity:0.5;
        transform:translateY(10px);
    }
    100% {
        transform: scale(1);
        opacity:1;
        transform:translateY(0px);
    }
  }
  #sendButton {
    animation: buttonAnimation 2s ease-in-out;
  }

  #meetingTitle {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  display: inline-block;
  font-size: 200%;
  color: rgb(245,245,245);
  animation: wavyBounce 3s ease-in-out;
  }

.invitationForm {
    animation:zoomingForm 1s ease-in-out;
}
        </style>
    </head>
    <body class="hBody">
    <?php
     include('../connect/connect.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $descriptions = $_POST['descriptions'];
            $department = $_POST['department'];
            $tarehe = $_POST['tarehe'];
            $muda = $_POST['muda'];
            $venue = $_POST['venue'];
            $endTime = $_POST['mudaMwisho'];
            $currentDateTime = date("YmdHis");
            $meetingCode = $currentDateTime.$currentUser;

        $checkUsername = "SELECT * FROM meetings WHERE venue = ? AND tarehe = ?";
        $stmt1 = $conn->prepare($checkUsername);
        $stmt1->bind_param("ss" , $venue , $tarehe);
        $stmt1->execute();
        $stmt1->store_result();

        //////////////////
        $sql = "SELECT muda, endTime FROM meetings WHERE tarehe = '$tarehe' "; 

// Execute the query
$result = $conn->query($sql);
$hardcoded_time = $muda;
$hardcoded_time2 = $endTime ;

if ($result->num_rows > 0) {

    // Check if the hardcoded time falls between the two times from the database
    while($row = $result->fetch_assoc()) {
        $time1 = strtotime($row["muda"]); // Convert time_column1 to Unix timestamp
        $time2 = strtotime($row["endTime"]); // Convert time_column2 to Unix timestamp
        $hardcoded_time_unix = strtotime($hardcoded_time);
        $hardcoded_time_unix2 = strtotime($hardcoded_time2); // Convert hardcoded_time to Unix timestamp
        
        // Check if the hardcoded time falls between the two times
        if ($hardcoded_time_unix >= $time1 && $hardcoded_time_unix <= $time2) {
           
            $timeStatus = 'same';
            $venueStart = $row['muda'];
            $venueEnd = $row['endTime'];
        } else {
           // echo "$hardcoded_time is not between " . $row["time_column1"] . " and " . $row["time_column2"] . "<br>";
        }

        if ($hardcoded_time_unix2 >= $time1 && $hardcoded_time_unix2 <= $time2) {
            //echo "$hardcoded_time is between " . $row["time_column1"] . " and " . $row["time_column2"] . "<br>";
            $timeStatus = 'same';
            $venueStart = $row['muda'];
            $venueEnd = $row['endTime'];
        } else {
           // echo "$hardcoded_time is not between " . $row["time_column1"] . " and " . $row["time_column2"] . "<br>";
        }
    }
} else {
    echo "0 results";
}
        /////////////////

        if ($stmt1->num_rows >= 1 && $timeStatus === 'same') {
            
            echo "
            <script>
                alert('".$venue." is already under use between ".$venueStart." and ".$venueEnd." on  ".$tarehe."!');
            </script>
            ";
            $conn->close();
        }
        
        else {
    
        $sql = "INSERT INTO meetings (title, descriptions , department , tarehe , muda , venue , meetingCode , endTime)
                VALUES (? , ? , ? , ? , ? , ? , ? , ?)";

        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("ssssssss" , $title ,  $descriptions , $department ,$tarehe ,$muda , $venue , $meetingCode , $endTime);

        if ($stmt2->execute()) {
            echo "<script>window.location.href='newMeeting.php'</script>";
        }
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
                    <a href="#" class="newMeetingLink">
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

                <?php
                    if ($currentRank === 'admin') {
                        echo "
                        <span class='menuSpan'>
                        <a href='../myDetails/myDetails.php' class='newMeetingLink'>
                            My Details
                       </a>
                    </span>
                        ";
                    }
                ?>
            
                <span class="menuSpan">
                    <a href="../index.php" class="newMeetingLink">
                        Log Out
                   </a>
                </span>

            </div>
            <div class="currentDiv">
                <span class="mTitle" id='meetingTitle'>
                    Create new meeting
                </span>
                <span>
                    <form class="invitationForm" method='POST' >
                            <div class="label"> 
                                Meeting title
                            </div>
                            <span>
                                <input type="text" placeholder="Title" name='title' class="mInput"/>
                            </span>
                        <span>
                            <div class="label">
                                Meeting description
                            </div>
                            <textarea class="mInput descriptionArea" name="descriptions">

                            </textarea>
                        </span>
                        <div  class="label">
                            Select the department concerned
                        </div>
                        <span>
                            <select class='sInput dptSelection' name='department' class="mInput selectInput">
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
                                <option value='all'>
                                    All departments
                                </option>
                            </select>
                        </span>
                        <div class="label">
                        </div>
                        <div>
                            <span>
                                <span>
                                    Select
                                </span>
                                <span>
                                meeting date
                                </span>
                                <span>
                                <input type="date" name='tarehe' class="mInput tInput" id='dateSelect' style='width:auto;'/>
                                </span>
                                
                </span>
                            <span>
                            <span>
                                start time
                            </span>
                                <input type="time" name='muda' class="mInput tInput"  style='width:auto;'/>
                            </span>
                            <span>
                            <span>
                                end time
                            </span>
                                <input type="time" name='mudaMwisho' class="mInput tInput"  style='width:auto'/>
                            </span>
                        </div>

                        <div class="label">
                            Venue
                        </div>
                    
                        <span>
                            <select class='sInput dptSelection' id='localVenue' name='venue' class="mInput selectInput">
                            <option value='select venue' disabled selected>
                                    select venue
                                </option>
                                <option value='Venue A'>
                                    Venue A
                                </option>
                                <option value='Venue B'>
                                    Venue B
                                </option>
                                <option value='Venue C'>
                                    Venue C
                                </option>
                                <option value='Venue D'>
                                    Venue D
                                </option>
                                <option value='Venue E'>
                                    Venue E
                                </option>
                            </select>
                        </span>

    
                        
                        <div class="btnContainer">
                            <span>
                                <input type="submit" value="Send Inivitation" class="sendButton" id='sendButton'/>
                            </span>
                        </div>
                        
                    </form>
                </span>
            </div>
        </div>
       
    </body>
</html>