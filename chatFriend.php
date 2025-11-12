<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Dashboard</title>
    <style type='text/css'>
        .chatBt{
            background:black;
            border-radius:10px;
            color:lightgreen;
            width: 70px;
            height:25px;
            transition:0.3s;
            box-shadow:0 0 10px lightgreen,0 0 10px lightgreen;
           
        }
        .chatBt:hover{
            width: 60px;
            color:black;
            background:lightgreen;
            border-radius:20px;
            box-shadow:0 0 15px white,0 0 15px white;
        }
        .viewBt{
            background:black;
            border-radius:10px;
            color:lightblue;
            width: 70px;
            height:25px;
            transition:0.3s;
            box-shadow:0 0 10px lightblue,0 0 10px lightblue;
           
        }
        .viewBt:hover{
            width: 60px;
            background:lightblue;
            color:black;
            border-radius:20px;
            box-shadow:0 0 15px white,0 0 15px white;
        }
        .cellData{
            background:#161b22;
            border-radius:10px;
             border-color:black;
             border-width:2px;
             width:250px;
             color:lightyellow;
             font-size:15px;
             font-family:Engravers MT;
             box-shadow: 0 0 10px lightyellow,0 0 10px lightyellow;
        }
        .contGlow{
            width: 250px;
            height:50px;
            border-radius:5px;
            box-shadow: 0 0 10px #9d4edd,0 0 10px #9d4edd;
            font-family:Engravers MT;
            color:#9d4edd;
            background:black;
            font-size:20px;
        }
        .imageGlow{
            width: 50px;
            height:50px;
            border-radius:25px;
            box-shadow: 0 0 10px #85C7EA,0 0 10px #85C7EA;
        }
        
    </style>
</head>
<body bgcolor="black">
    <center>
         
        <table border="0" height=100% width=100% cellspacing="5" cellpadding="0">
            <tr>
                <th colspan=3 class='contGlow'>
                    Your Chat Friends
                </th>
            </tr>
            <?php
     session_start();
    $userId=$_SESSION['UserId'];
    $mycon= mysqli_connect("localhost","root","usbw","chatApp");
    $mycom="select * from Users";
    $result=mysqli_query($mycon,$mycom);
    if(mysqli_num_rows($result)>0)
    {
        echo"<tr><th colspan='3'><form action='chatBoard.php' method='POST' target='workSec'><table width='100%' height='100%' cellpadding='0' cellspacing='15'>";
        while($dr=mysqli_fetch_array($result))
        {
            echo "<tr><th ><img src='".htmlspecialchars($dr['UserDp'])."' class='imageGlow'></th><th  class='cellData' colspan='2'>".$dr['UName']."<br><small>".$dr['UPhNo']."</small></th></tr><tr><th></th><th align='center'><button class='chatBt' name='click' value='$dr[Uid]'>Chat</button></th>
            <th><button class='viewBt' name='viewProf' value='$dr[Uid]'>View</button> &nbsp;&nbsp;&nbsp;&nbsp;";
                $chats=mysqli_query($mycon,"SELECT DISTINCT msgRead FROM chats WHERE reciverId ='$userId' and msgRead='00'and senderId='$dr[Uid]'");
                if(mysqli_num_rows($chats)>0)
            {
                    while($cSr=mysqli_fetch_array($chats))
                {
                        if($cSr['msgRead']=='00')
                            echo"🟢</th>";
                        else
                        echo "</th>";
            }
            echo"</tr>";
        }
            
        }
            echo"</table></form></th></tr></table> </center>";
    }
    mysqli_close($mycon);
        ?>
        
</body>
</html>