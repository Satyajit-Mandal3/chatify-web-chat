<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <style type='text/css'>
        .send{
            background:black;
            color:lightgreen;
            text-transform:uppercase;
            transition:0.3s;
            padding:2px 5px;
            border-radius:20px;
            width: 60px;
            box-shadow:0 0 15px lightgreen,0 0 15px lightgreen;
        }
        .send:hover{
            background:#7b2cbf;
            color:black;
            width: 50px;
            border-radius:20px;
            box-shadow: 0 0 10px gray,0 0 15px gray;
        }
        .inputGlow{
            padding:15px 15px;
            font-size:14px;
            color:black;
            background-color:lightyellow;
            border-radius: 10px;
            width:350px;
            border-width:4px;
            border-color:#c77dff;

        }
        .inputGlow:hover{
            background-color:white;
            box-shadow: 0 0 20px lightgray,0 0 20px lightgray;
            opacity:0.6;
        }
    </style>
    <script type='text/javascript'>
        
        function loadMessage()
        {
            fetch('loadMessage.php')
            .then(r=>r.text())
            .then(html =>{
                document.getElementById("msgShow").innerHTML=html;
            });
        }
        function sendMessage()
        {
            var msg=document.getElementById("message").value;
            fetch('sendMessage.php',{
                method:"POST",
                headers:{"Content-Type":
                 "application/x-www-form-urlencoded"   
                },
                body:"message="+encodeURIComponent(msg)
        }).then(()=>{
            document.getElementById("message").value="";
            loadMessage();
        });
        }
        setInterval(() => {
            loadMessage();
        }, 2000);
        window.onload=loadMessage;
    </script>
</head>
<body  bgcolor="#0a0a0f">
    <center>
                   <p id="msgShow">
                        </p>
        <input type="text" id="message" class='inputGlow' placeholder="Write something...">
        &nbsp; &nbsp; &nbsp; &nbsp;
        <button class='send' onclick="sendMessage()">Send</button>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            session_start();
            if(isset($_POST['viewProf']))
            {
                $_SESSION['ReciverId']= $_POST['viewProf'];
                header("Location:http://localhost:8080/projChatApp/chatProfView.php");
                exit();
            }
            $_SESSION['ReciverId']= $_POST['click'];
             $recId=$_POST['click'];
             $senId= $_SESSION['UserId'];
             $mycon= mysqli_connect("localhost","root","usbw","chatApp");
             $chSt=mysqli_query($mycon,"SELECT * FROM chats WHERE ReciverId='$senId' AND msgRead='00'");
             if(mysqli_num_rows($chSt))
                 mysqli_query($mycon,"UPDATE chats  SET msgRead='11' WHERE SenderId ='$recId' AND ReciverId='$senId' AND msgRead='00'");
             mysqli_close($mycon);
        }
        ?>
    </center>
</body>
</html>