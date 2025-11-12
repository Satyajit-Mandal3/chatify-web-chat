<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type='text/css'>
        .cellData2{
            background:#161d22;
            border-radius:10px;
             border-color:black;
             border-width:2px;
             width:300px;
             color:lightyellow;
             font-size:20px;
            word-wrap: break-word;
             box-shadow: 0 0 15px lightblue,0 0 15px lightblue;
        }
        .cellData1{
            background:#161d22;
            border-radius:10px;
             border-color:black;
             border-width:2px;
             width:300px;
             color:lightyellow;
             font-size:20px;
             box-shadow: 0 0 10px #ff0033,0 0 10px #ff0033;
        }
        .contGlow1{
            padding:10px 10px;
            height:50px;
            background:purple;
            border-radius:5px;
            box-shadow: 0 0 10px white,0 0 10px white;
            font-family:Engravers MT;
            color:#f5f5f5;
            font-size:25px;
        }
        .tableBorder{
            background:#1f1f1f;
            border-radius:10px;
            box-shadow: 0 0 30px rgba(255,0,51,0.3),0 0 30px rgba(255,0,51,0.3);
            font-family:Engravers MT;
            font-size:25px;
        }
        .imageGlow{
            width: 200px;
            height:200px;
            border-radius:50px;
            border-width:2px;
            border-color:black;
            box-shadow:0 0 15px white,0 0 15px white;
        }
        
    </style>
</head>
<body bgcolor="#1a1a1a">
    <center>
        <br>
        <table class='tableBorder' width="60%" cellspacing="20" cellpadding="3">
            <tr>
                <th  class='contGlow1'>
                    View your chat friends profile
                </th>
            </tr>
     <?php
     session_start();
     $recId=$_SESSION['ReciverId'];
        $mycon= mysqli_connect("localhost","root","usbw","chatApp");
        $mycom="SELECT * FROM users WHERE Uid ='$recId'";
        $chats=mysqli_query($mycon,$mycom);
        if(mysqli_num_rows($chats)>0)
        {
            echo"<tr><th align='center'><table border='0' cellpadding='5' cellspacing='20'>";
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