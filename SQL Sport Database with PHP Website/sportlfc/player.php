<!DOCTYPE html>
<html>
<head><title>Player Menu</title></head>
  
<body>
<?php
    session_start();
    // Checks to see if the user is supposed to be here
    if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Player")
    {
        echo "This application is being used by: " . $_SESSION["fname"];
        echo "<br>";
        echo "<h3>Player Menu</h3>";
        echo "<ul>";
        // Search for a team by sport and name.
        echo "<li> <a href=\"searchTeam.php\"> Search for a team </a></li>"; // done! 
        // View current teams
        echo "<li> <a href=\"viewPlayerTeam.php\"> View my teams </a></li>"; // done
        // Leave a team
        echo "<li> <a href=\"playerLeaveTeam.php\"> Leave a team </a></li>"; // done
        echo "</ul>";
        // Quit (Log out)
        echo "<a href=\"logout.php\">Sign Out</a>";

      }
    else
    {
        // If the user is not supposed to be here, print this instead of normal page
        echo "You are not supposed to be here!<br>";
        echo "<a href =\"login.php\">Login</a> to continue."; //swap index.php with Tucker's login page
    }
?>
</body>
</html>