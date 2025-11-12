<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type='text/css'>
        .cellData2{
            background:purple;
            border-radius:10px;
             border-color:black;
             border-width:2px;
             width:300px;
             color:lightyellow;
             font-size:20px;
            word-wrap: break-word;
             box-shadow: 0 0 15px lightyellow,0 0 15px  lightyellow;
        }
        .cellData1{
            background:navy;
            border-radius:10px;
             border-color:black;
             border-width:2px;
             width:300px;
             color:lightyellow;
             font-size:20px;
             box-shadow: 0 0 15px lightyellow,0 0 15px lightyellow;
        }
        .contGlow1{
            padding:10px 10px;
            height:50px;
            background:#0077cc;
            border-radius:25px;
            box-shadow: 0 0 15px lightblue,0 0 15px lightblue;
            font-family:Engravers MT;
            color:#f1f1f1;
            font-size:30px;
        }
        .tableBorder{
            background:#161b22;
            border-radius:10px;
            box-shadow: 0 0 30px purple,0 0 30px purple;
            font-family:Engravers MT;
            color:navy;
            font-size:25px;
        }
        .imageGlow{
            width: 250px;
            height:250px;
            border-radius:125px;
            border-width:2px;
            border-color:black;
            box-shadow:0 0 15px white,0 0 15px white;
        }
        
    </style>
</head>
<body bgcolor="#0a0f14">
    <center>
        <br>
        <table class='tableBorder' width="60%" cellspacing="15" cellpadding="3">
            <tr>
                <th  class='contGlow1'>
                     Your profile
                </th>
            </tr>
     <?php
     session_start();
     $UserId=$_SESSION['UserId'];
        $mycon= mysqli_connect("localhost","root","usbw","chatApp");
        $mycom="SELECT * FROM users WHERE Uid ='$UserId'";
        $chats=mysqli_query($mycon,$mycom);
        if(mysqli_num_rows($chats)>0)
        {
            echo"<tr><th align='center'><table border='0' cellpadding='5' cellspacing='25'>";
            while($cr=mysqli_fetch_array($chats))
            {
                echo "
                <tr>
                    <th colspan='2'>
                        <img src='".htmlspecialchars($cr['UserDp'])."' class='imageGlow' height='200%' width='50%'>
                    </th>
                </tr>
                <tr>
                    <th class='cellData1'>
                        Name
                    </th>
                    <th class='cellData2'>
                        ".htmlspecialchars($cr['UName'])."
                    </th>
                </tr>
                <tr>
                    <th class='cellData1'>
                    Phone number
                    </th>
                    <th class='cellData2'>
                        ".htmlspecialchars($cr['UPhNo'])."
                    </th>
                </tr>
                 <tr>
                    <th class='cellData1'>
                    Description
                    </th>
                    <th class='cellData2'>
                        ".htmlspecialchars($cr['UDescription'])."
                    </th>
                </tr></table></th></tr></table>";
            }
        
        mysqli_close($mycon);
    }
    ?>
    </center>
</body>
</html>