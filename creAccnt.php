<?php
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                ob_start();
                session_start();
                session_unset();
                $name=$_POST['txtName'];
                $phno=$_POST['txtPh'];
                $passwd=$_POST['txtPasswd'];
                $descrip=$_POST['txtDescrip'];
                $mycon= mysqli_connect("localhost","root","usbw","chatApp");
                $mycom="select Uid from users where UPhNo='$phno'";
                $result=mysqli_query($mycon,$mycom);
                if(mysqli_num_rows($result)>0)
                    echo"<script type='text/javascript'>alert('An account already exsits on this mobile number,check your phone number or log-in');</script>";
                else
                {
                    if (isset($_FILES['profPic'])) {
                        $foldLoc = "D:/USBWebserver v8.6/root/projChatApp/";
                        $dpLoc = $foldLoc . basename($_FILES["profPic"]).$phno.".png";
                        move_uploaded_file($_FILES["profPic"]["tmp_name"], $dpLoc);
                        $dpLoc="".$phno.".png";
                    }

                    $mycom="call UserIdGen('$name','$phno','$passwd','$dpLoc','$descrip')";
                    $result=mysqli_query($mycon,$mycom);
                    $mycom="select * from users where UPhNo='$phno'";
                    $result=mysqli_query($mycon,$mycom);
                    if(mysqli_num_rows($result))
                    {
                        while($dr=mysqli_fetch_array($result))
                        {
                            $_SESSION['UserId']=$dr[0];
                            $_SESSION['UserPasswd']=$dr[1];
                            $_SESSION['UserName']=$dr[3];
                            $_SESSION['UserDescrip']=$dr[5];
                            $_SESSION['UserDpLoc']=$dpLoc;
                        }
                    }        
                mysqli_close($mycon);  
                header("Location:http://localhost:8080/projChatApp/masterFrame.php");
                exit; 
                }
        }
        ob_end_flush();
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new account</title>
</head>
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
            border-top-left-radius:20px;
            border-bottom-right-radius:20px;
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
<body bgcolor="#0d1117">
    <center>
        <form action="" method="POST" enctype="multipart/form-data">
            <br>
        <table border="0" class="tableBorder" cellspacing="15" cellpadding="5">
            <tr>
                <th colspan="2" class="contGlow1">
                    Create a new account
                </th>
            </tr>
            <tr>
                <th class='contGlow3'>
                    Name
                </th>
                <th>
                    <input type="text" class="inputGlow" placeholder="Enter your name" autocomplete="off" required name="txtName">
                </th>
            </tr>
            <tr>
                <th class='contGlow3'>
                    Phone No.
                </th>
                <th>
                    <input type="tel"  class="inputGlow"  placeholder="" autocomplete="off" required name="txtPh" maxlength="10">
                </th>
            </tr>
            <tr>
                <th class='contGlow3'>
                   Password
                </th>
                <th>
                    <input type="password"  class="inputGlow" name="txtPasswd" autocomplete=off minlength="6" placeholder="Use mix characters" maxlength="10">
                </th>
            </tr>
            <tr>
                <th class='contGlow3'>
                    Profile picture 
                </th>
                <th>
                    <input type="file"  class="inputGlow" name="profPic" accept="image/*">
                </th>
            </tr>
            <tr>
                <th class='contGlow3'>
                    Description
                </th>
                <th>
                    <input type="text" class="inputGlow" placeholder="Your profile description (Optional)" autocomplete="off" name="txtDescrip">
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <input type="reset"class="reset" value="Reset">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="create" value="Create">
                </th>
            </tr>
            <tr>
                <th colspan="2"  class="contGlow2" >
                   Do you already have an account ?
                    <br> If yes, then <a href="http://localhost:8080/projChatApp/logAccnt.php">Click here</a>
                </th>
            </tr>
        </table>
        </form>
        </center>
</body>
</html>
        
    