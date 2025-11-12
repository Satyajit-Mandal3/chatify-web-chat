  <?php
     if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                ob_start();
                session_start();
                $userId=$_SESSION['UserId'];
                $newName=$_POST['txtName'];
                if($_POST['txtPasswd']!="" && $_POST['txtConPasswd']!="")
                {
                    $newPasswd=$_POST['txtPasswd'];
                     $newPasswdCon=$_POST['txtConPasswd'];
                }
                else
                {
                    $newPasswdCon=$_SESSION['UserPasswd'];;
                    $newPasswd=$_SESSION['UserPasswd'];
                }
                $newdescrp=$_POST['txtDescrip'];
                if($newPasswd==$newPasswdCon)
                {  
                    $usDpSts=isset($_POST["removeProfPic"])?"YES":"NO";
                    $rmvDpNa="defUsDp";
                    $oldName="";
                    $oldPasswd="";
                    $mycon= mysqli_connect("localhost","root","usbw","chatApp");
                    $mycom="select * from users where Uid='$userId'";
                    $result=mysqli_query($mycon,$mycom);
                    if(mysqli_num_rows($result)>0)
                    {
                        while($dr=mysqli_fetch_array($result)){
                            $oldPasswd=$dr['UPasswd'];
                            $phno=$dr['UPhNo'];
                            $oldName=$dr['UName'];
                            $olddescrp=$dr['UDescription'];
                        }
                        if(isset($_POST["removeProfPic"]))
                            mysqli_query($mycon," UPDATE users SET UserDp='' where Uid='$userId'");
                        if($newName=="")
                            mysqli_query($mycon," UPDATE users SET UName='$_SESSION[UserName]' where Uid='$userId'");
                        else
                        {
                             mysqli_query($mycon," UPDATE users SET UName='$newName' where Uid='$userId'");
                             $_SESSION['UserName']=$newName;
                        }                        
                        if($oldPasswd!=$newPasswd)
                            mysqli_query($mycon," UPDATE users SET UPasswd='$newPasswd' where Uid='$userId'");
                        if($olddescrp!=$newdescrp)
                            mysqli_query($mycon," UPDATE users SET UDescription='$newdescrp' where Uid='$userId'");
                    }
                    echo"<p class='contGlow1'>Profile Updated Successfully !</p>";
                }
                else
                    echo"<script type='text/javascript'>alert('Passwords are not matched ,please checked it');</script>";
                mysqli_close($mycon); 
                ob_end_flush();          
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type='text/css'>
        .update{
            background:black;
            color:lightgreen;
            text-transform:uppercase;
            cursor:pointer;
            transition:0.3s;
            padding:2px 5px;
            border-radius:5px;
            width: 80px;
            box-shadow: 0 0 10px lightgreen,0 0 15px lightgreen;
        }
        .update:hover{
            color:black;
            width: 70px;
            background:lightgreen;
            border-radius:20px;
            box-shadow: 0 0 10px gray,0 0 15px gray;
        }
        .cancel{
            background:black;
            color:red;
            text-transform:uppercase;
            cursor:pointer;
            transition:0.3s;
            padding:2px 5px;
            width: 80px;
             border-radius:5px;
             box-shadow: 0 0 10px red,0 0 15px red;
        }
        .cancel:hover{
            background-color:red;
            color:black;
            width: 70px;
            border-radius:20px;
            box-shadow: 0 0 10px gray,0 0 15px gray;
        }
        .cellData{
            background:lightyellow;
            border-radius:10px;
            box-shadow:0 0 10px lightblue,0 0 10px lightblue;
            font-size:20px;
            color:navy;
        }
        .inputChkbox{
            padding:12px 12px;
            background:#f78989fa;
            border-radius: 10px;
            box-shadow: 0 0 20px #ff0055ff,0 0 20px #ff0055ff;
            transition:0.5s;
            width:30px;
            height:30px;
        }
        .inputChkbox:hover{
            border-radius: 20px;
            box-shadow: 0 0 20px red,0 0 20px red;
            transition:0.5s;
            width: 20px;
            height:20px;
        }
        .inputGlow{
            padding:12px 12px;
            font-size:14px;
            color:black;
            background-color:#f78989fa;
            border-radius: 10px;
            box-shadow:0 0 10px black;
            transition:0.2s;
            width:300px;

        }
        .inputGlow:hover{
             background-color:white;
            box-shadow: 0 0 20px red,0 0 20px red;
            opacity:0.6;
        }
        .tableBorder{
            border-style:double;
            border-width:2px;
            border-color:black;
            background-color:black;
            border-radius:17px;
            box-shadow: 0 0 20px lightyellow,0 0 20px lightyellow;
        }
        .contGlow1{
            width: 500px;
            height:35px;
            background:darkblue;
            border-radius:5px;
            box-shadow: 0 0 10px white,0 0 10px white;
            font-family:Engravers MT;
            color:lightyellow;
            font-size:20px;
        }
    </style>
</head>
<body bgcolor="#161b22">
    <center>
    <br>
        <form action="" method="POST"> 
         <table border="0" class="tableBorder" cellspacing="18" cellpadding="5">
            <tr>
                <th colspan="2" class="contGlow1">
                    Update Your Profile
                </th>
            </tr>
            <tr>
                <th class="cellData">
                    New name
                </th>
                <th>
                    <input type="text" class="inputGlow" autocomplete="off" name="txtName" placeholder="Enter new profile name"  maxlength="20">
                </th>
            </tr>
            <tr>
                <th class="cellData">
                    New description
                </th>
                <th>
                    <input type="text" class="inputGlow" autocomplete="off" name="txtDescrip" placeholder="Enter new profile description" maxlength="500">
                </th>
            </tr>
            <tr>
                <th class='cellData'>
                   New password
                </th>
                <th>
                    <input type="password"  class="inputGlow" name="txtPasswd" autocomplete=off minlength="6" placeholder="Enter new password (Use mix characters)" maxlength="10">
                </th>
            </tr>
             <tr>
                <th class='cellData'>
                  Confirm password
                </th>
                <th>
                    <input type="password"  class="inputGlow" name="txtConPasswd" autocomplete=off minlength="6" placeholder="Re write the new password" maxlength="10">
                </th>
            </tr>
            <tr>
                <th class='cellData'>
                    Remove profile picture 
                </th>
                <th>
                   <font color="white">Do you want to remove your profile picture ? </font>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input type="checkbox"  class="inputChkbox" name="removeProfPic">
                </th>
            </tr>
        </table>
        <br><br>
        <input type="reset"class="cancel" value="Cancel">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="update" value="Update">
    </form>
    
</body>
</html>