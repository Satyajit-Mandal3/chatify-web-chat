
<?php
        session_start();
        $recId= $_SESSION['ReciverId'];
        $senId=$_SESSION['UserId'];
        $mycon= mysqli_connect("localhost","root","usbw","chatapp");
        $msg=$_POST['message'];
        //Insert message if send
        $msg=mysqli_query($mycon,"CALL MsgIdChatIns('$msg','$senId','$recId','00');");
        mysqli_close($mycon);
?>
