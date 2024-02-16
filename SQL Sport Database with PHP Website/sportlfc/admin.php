<!DOCTYPE html>

<html>

<head></head>

<body>

  <?php
  session_start();
  // Checks to see if the user is supposed to be here
  if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"] == "Admin"){
       echo "This application is being used by ";
       echo $_SESSION["fname"];
       echo "<br>";
       echo "<h3>Admin Menu</h3>";
       echo "<ul>";
       // Search for a team by sport and name.
       echo "<li> <a href=\"searchTeam.php\"> Search for a team </a></li>";
       // View all players.
       echo "<li> <a href=\"viewPlayers.php\"> View all players </a></li>";
       // View all coaches.
       echo "<li> <a href=\"viewCoaches.php\"> View all coaches </a></li>";
       // Create a team.
      echo "<li> <a href=\"createTeam.php\"> Create a team </a></li>";
      // Assign coaches to teams
      echo "<li> <a href=\"assignCoach.php\"> Assign a coach to a team </a></li>";
      // Print a list of the most popular sports.
      echo "<li> <a href=\"popSports.php\"> Most popular sports </a></li>";
      // Print a list of the players in most teams.
      echo "<li> <a href=\"playerMost.php\"> Players in the most teams </a></li>";
      // Print the list of the coaches coaching most teams.
      echo "<li> <a href=\"coachMost.php\"> Coaches with most teams </a></li>";
      // Find the average fee paid per player.
      echo "<li> <a href=\"avgFee.php\"> Find avg fee paid per player </a></li>";
      // Find the top 10 most popular equipment
      echo "<li> <a href=\"popEquip.php\"> Most popular equipment </a></li>";

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
