<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
    ob_start();
    session_start();

    $phno   = $_POST['txtPh'];
    $passwd = $_POST['txtPasswd'];

    $mycon = mysqli_connect("localhost","root","usbw","chatApp");

    $mycom = "select * from users where UPhNo='$phno'";
    $result = mysqli_query($mycon, $mycom);

    $dr = "";
    $i  = 0;

    if(mysqli_num_rows($result)==0) {
        echo "<script type='text/javascript'>alert('No account found on this number. Please create an account.');</script>";
    } 
    else 
    {
        // ✅ Fixed the while loop syntax
        while($dr = mysqli_fetch_array($result))
        {
            $logPasswd = $dr[1]; // password field

            if($logPasswd != $passwd) {
                echo "<script type='text/javascript'>alert('Wrong Phone number or Password. Please check!');</script>";
            }
            else if($logPasswd == $passwd)
            {
                $_SESSION['UserId']      = $dr[0];
                $_SESSION['UserPasswd']  = $dr[1];
                $_SESSION['UserName']    = $dr[3];
                $_SESSION['UserDescrip'] = $dr[5];
                $i = 1;
                break;
            }
        }
    }

    mysqli_close($mycon);
    if($i == 1) {
        header("Location:http://localhost:8080/projChatApp/masterFrame.php");
        exit;
    }

    ob_end_flush();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in account</title>
    <style type='text/css'>
       .create{
            background:#00ffcc;
            color:#0d1117;
            text-transform:uppercase;
            cursor:pointer;
            transition:0.3s;
            padding:2px 5px;
            border-radius:5px;
            width: 100px;
            height:30px;
             box-shadow: 0 0 15px lightgreen,0 0 15px lightgreen;
        }
        .create:hover{
            width: 90px;
            background:#00dfa6;
            border-radius:20px;
            box-shadow: 0 0 15px gray,0 0 15px gray;
        }
        .reset{
            background:#ff4c4c;
            color:#ffffff;
            text-transform:uppercase;
            cursor:pointer;
            transition:0.3s;
            padding:2px 5px;
            width: 100px;
            height:30px;
             border-radius:5px;
             box-shadow: 0 0 15px red,0 0 15px red;
        }
        .reset:hover{
            background-color:#cc0000;
            width: 90px;
            border-radius:20px;
            box-shadow: 0 0 10px gray,0 0 15px gray;
        }
        .inputGlow{
            padding:12px 12px;
            font-size:14px;
            color:white;
            background-color:black;
            border-radius: 10px;
            box-shadow:0 0 10px lightpink,0 0 10px lightpink;
            transition:0.2s;
            width:350px;
        }
        .inputGlow:hover{
            background-color:white;
            color:black;
            box-shadow: 0 0 10px black,0 0 10px black;
            opacity:0.6;
        }
        .tableBorder{
            border-style:double;
            border-width:2px;
            border-color:#00ffcc;
            background-color:#161b22;
            border-top-left-radius:30px;
            border-bottom-right-radius:30px;
            box-shadow: 0 0 15px white,0 0 15px white;
        }
        .contGlow1{
            width:500px;
            height:40px;
            background:black;
            border-radius:5px;
            box-shadow: 0 0 10px lightblue,0 0 10px lightblue;
            font-family:Engravers MT;
            color:lightblue;
            font-size:25px;
        }
        .contGlow2{
            width:400px;
            height:40px;
            background:black;
             border-top-left-radius:20px;
            border-bottom-right-radius:20px;
            box-shadow: 0 0 10px lightyellow,0 0 10px lightyellow;
            color:#f1f1f1;
            font-size:17px;
        }
        .contGlow3{
            width:300px;
            height:40px;
            background:black;
            border-radius:5px;
            box-shadow: 0 0 10px lightgreen ,0 0 10px lightgreen;
            font-family:Engravers MT;
            color:white;
            font-size:20px;
        }
    </style>
</head>
<body bgcolor="#0d1117">
    <center>
        <br><br>
        <form action="" method="POST">
        <table border="0" cellspacing="20" cellpadding="10" class="tableBorder">
            <tr>
                <th colspan="2" class="contGlow1">
                    Log-in your account
                </th>
            </tr>
            <tr>
                <th class="contGlow3">
                    Phone No.
                </th>
                <th>
                    <input type="tel" autocomplete="off" class="inputGlow" required name="txtPh" maxlength="10">
                </th>
            </tr>
            <tr>
                <th class="contGlow3">
                   Password
                </th>
                <th>
                    <input type="password" name="txtPasswd" minlength="6" class="inputGlow" placeholder="Enter your account password" maxlength="10">
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <input type="reset" value="Reset" class="reset">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Log-in" class="create">
                </th>
            </tr>
            <tr>
                <th colspan="2" class="contGlow2">
                    Do you want to create an account ?
                    <br> If yes, then <a href="http://localhost:8080/projChatApp/creAccnt.php">Click here</a>
                </th>
            </tr>
        </table>
        </form>
    </center>
</body>
</html>
