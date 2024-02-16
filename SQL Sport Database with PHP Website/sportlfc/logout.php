<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>

<?php
     session_start();
     if(isset($_SESSION["userid"]) && $_SESSION["userid"]!="")
     {
            echo $_SESSION["fname"];
            echo " logged out successfully.";
            session_destroy();
     }

?>
<br><br>
<a href='login.php'>Login Again</a>
</body>
</html>
