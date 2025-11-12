<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
        <frameset rows=16%,* name=fullPage bordercolor='black'>
            <frameset cols=60%,* noresize>
                <frame src="http://localhost:8080/projChatApp/template.php">
                <frame src="http://localhost:8080/projChatApp/navbar.php">
            </frameset>
            <frameset cols=37%,* bordercolor='black'>
                <frame src="http://localhost:8080/projChatApp/chatFriend.php" name="chatShow"></frame>
                <frame name="workSec">
            </frameset>
        </frameset>

</html>