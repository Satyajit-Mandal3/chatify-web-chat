<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type='text/css'>
    .container1 {
        width: 90%;
        height: 250px;
        overflow-y: auto;
        border-width: 2px;
        border-color:black;
        border-style: solid;
        padding: 10px;
        background:#161621;
        box-shadow:0 0 10px #9d4edd,0 0 10px #9d4edd;
        box-sizing: border-box;
        scroll-behavior:smooth;
    }
    .container2{
        width: 80%;
        height: 50px;
        border-width: 2px;
        background:black;
        text-align:center;
        font-size:30px;
        color:#f1f1f1;
        box-shadow:0 0 15px lightyellow,0 0 15px lightyellow;
    }
    .contGlow1 {
        text-align:right;
        background-color: #e8f5e9;
        border-top-left-radius: 25px;
        border-bottom-right-radius: 25px;
        border-bottom-left-radius: 25px;
        padding: 15px;
        width: 40%;
        word-wrap: break-word;
        box-shadow: 0 0 10px lightgreen, 0 0 10px lightgreen;
    }
    .contGlow2 {
       text-align:left;
        background-color: #d0e6ff;
        border-top-right-radius: 25px;
        border-bottom-right-radius: 25px;
        border-bottom-left-radius: 25px;
        padding: 15px;
        width: 40%;
        word-wrap: break-word;
        box-shadow: 0 0 10px lightgreen, 0 0 10px lightgreen;
    }
</style>

</head>
<body>
    
<center>
    <?php
    session_start();
    $recId = $_SESSION['ReciverId'];
    $senId = $_SESSION['UserId'];
    $mycon = mysqli_connect("localhost","root","usbw","chatApp");
    // Check whom to message ". htmlspecialchars($i['UserDp']) ."
    $recName = mysqli_query($mycon, "SELECT * FROM USERS WHERE Uid='$recId';");
    while ($i = mysqli_fetch_array($recName))
        echo "<table width='75%' style='background-color:#161621; box-shadow:0 0 20px purple,0 0 20px purple;' cellspacing='5' cellpadding='0'><tr><th align='center'><img src='". htmlspecialchars($i['UserDp']) ."' width='50px' height='50px' style='box-shadow:0 0 15px lightyellow,0 0 15px lightyellow;'></th><th align='center'><p class='container2'>" . htmlspecialchars($i['UName']) . "</p></th></tr>";

    displayMsg($senId, $recId, $mycon);

    mysqli_close($mycon);

    function displayMsg($senId, $recId, $mycon)
    {
        // Select messages
        $mycom = "SELECT * FROM message 
                  WHERE Mid IN (
                      SELECT chats.Mid FROM chats 
                      WHERE (chats.SenderId='$senId' AND chats.ReciverId='$recId') 
                         OR (chats.SenderId='$recId' AND chats.ReciverId='$senId')
                  ) 
                  ORDER BY msgTime DESC";
        $result = mysqli_query($mycon, $mycom);

        // Chat container
        echo "<tr><th colspan='2' align='center'>
        <div id='chatBox' 
             class='container1'>";

        if (mysqli_num_rows($result)) {
            // Show messages between Sender and Receiver
            while ($datareader = mysqli_fetch_array($result)) {
                $chkWhoMsg = mysqli_query($mycon, "SELECT SenderId FROM CHATS WHERE Mid ='$datareader[Mid]';");

                while ($i = mysqli_fetch_array($chkWhoMsg)) {
                    $msg  = htmlspecialchars($datareader['Msg']);
                    $time = htmlspecialchars($datareader['msgTime']);

                    if ($i['SenderId'] == $senId) {
                        echo"&nbsp;
                        <p class='contGlow1'>
                        <font style='background:black;color:lightgreen;font-size:20px;width:30pxheight:30px;border-radius:40px;'>You</font><br>
                            $msg<br>
                           <sub><smallstyle='color:#555;'>$time</small><sub>
                        </p><br>";
                    } else {
                        echo "
                        <p class='contGlow2'>$msg<br>
                            <sub><small style='color:#555;'>$time</small></sub>
                        </p><br>";
                    }
                }
            }
        } else {
            echo "<p style='color:White; font-size:20px;'>Start messaging...</p>";
        }

        echo "</div></th></tr></table>";
    }
?>
</center>
</body>
</html>
