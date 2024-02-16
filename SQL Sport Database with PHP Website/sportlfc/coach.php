<!DOCTYPE html>
<html>
<head><title>Coach Submenu</title></head>

<body>
<?php
    session_start();
    // Checks to see if the user should be on this page
    if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Coach")
    {
        echo "This application is being used by ";
        echo $_SESSION["fname"];
        echo "<br>";
        echo "<h3>Coach Control Panel</h3>";
        echo "<ul>";
        // Search for a team by sport and name.
        echo "<li> <a href=\"searchTeam.php\"> Search for a team </a></li>"; // done by Matthew
        // View current teams
        echo "<li> <a href=\"viewCoachTeam.php\"> View my teams </a></li>"; // done
        // Leave a team
        echo "<li> <a href=\"coachLeaveTeam.php\"> Leave a team </a></li>"; // done
        // Add a player to a team
        echo "<li> <a href=\"coachAddPlayer.php\"> Add a player to a team </a></li>"; // done
        echo "</ul>";
        // Quit (Log out)
        echo "<a href=\"logout.php\">Sign Out</a>";

      }
    else
    {
        // If the user is not supposed to be here, print this instead of normal page
        echo "You are not supposed to be here!<br>";
        echo "<a href =\"login.php\">Login</a> to continue."; //swap index.php with Tucker's signup page
    }
  ?>
</body>
</html>
