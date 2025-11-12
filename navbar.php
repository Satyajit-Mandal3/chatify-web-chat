<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type='text/css'>
         .logout{
            background-color:black;
            color:red;
            text-transform:uppercase;
            cursor:pointer;
            transition:0.3s;
            width: 100px;
            height:40px;
             border-radius:5px;
              box-shadow: 0 0 15px red,0 0 15px red;
             
        }
        .logout:hover{
            background:red;
            color:black;
            width: 90px;
            border-radius:20px;
            box-shadow: 0 0 10px white,0 0 15px white;
        }
        .update{
            background:black;
            color:lightgreen;
            text-transform:uppercase;
            cursor:pointer;
            transition:0.3s;
            padding:2px 5px;
            border-radius:5px;
            width: 150px;
            height:40px;
            box-shadow: 0 0 10px lightgreen,0 0 15px lightgreen;
        }
        .update:hover{
            color:black;
            width: 140px;
            background:lightgreen;
            border-radius:20px;
            box-shadow: 0 0 10px gray,0 0 15px gray;
        }
         .view{
            background:black;
            color:lightpink;
            text-transform:uppercase;
            cursor:pointer;
            transition:0.3s;
            padding:2px 5px;
            border-radius:5px;
            width: 150px;
            height:40px;
            box-shadow: 0 0 10px lightpink,0 0 15px lightpink;
        }
        .view:hover{
            color:black;
            width: 120px;
            background:lightpink;
            border-radius:20px;
            box-shadow: 0 0 10px white,0 0 15px white;
        }
           
    </style>
</head>
<body bgcolor="black">
    <center>
        <br>
        <a href=http://localhost:8080/projChatApp/viewProf.php target=workSec><button class='view'>View Profile</button></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href=http://localhost:8080/projChatApp/profUpdate.php target=workSec><button class='update'>Update Profile</button></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href=http://localhost:8080/projChatApp/creAccnt.php target=fullPage><button class='logout'>Log-Out</button></a>
    </center>
</body>
<?php
session_start();
?>
</html>