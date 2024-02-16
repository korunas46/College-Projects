<!DOCTYPE html>
<html>
<head><title>Leave Team as Player</title></head>
<body>
<?php
    session_start();
    // Checks to see if the user is supposed to be on this page
    if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Player")
    {
        echo "This application is being used by ";
        echo $_SESSION["fname"];
        echo "<br>";
?>
  <!-- Form to receive name of team that player wants to leave -->
  <h1>Leave Team</h1>
  <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "get">
      Name: <input type = "text" name = "team_name">
      <br><br>
      <input type = "submit" value = "Leave">
    </form>
    <br>
<?php
    // Back and logout button
    echo "<ul>";
    echo "<li> <a href=\"player.php\"> Go back </a></li>";
    echo "<li> <a href=\"logout.php\"> Logout </a></li>";
    echo "</ul>";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SportLFC";

    $conn = new mysqli($servername,$username, $password, $dbname);
    if($conn -> connect_error)
    {
        die("Connection failed: " . $conn -> connect_error);
    }

    if (isset($_GET["team_name"]))
    {
      // Queries the database for the given team name along with the player's information
      echo "<h2>Results</h2>";
      $team_name = $_GET["team_name"];

      $sql = "SELECT * FROM Team, PLAYS_IN";
      $sql = $sql . " WHERE TEAM.NAME = '" . $team_name . "' and TEAM.TEAMID = PLAYS_IN.TEAMID and PLAYS_IN.USERID = '" . $_SESSION["userid"] . "';";
      $result = $conn -> query($sql);
      // If player is found on the team, removes them
      if($result !== false && $result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $teamid = $row["TEAMID"];
            $newsql = "DELETE FROM PLAYS_IN";
            $newsql = $newsql . " WHERE PLAYS_IN.TEAMID = '" . $teamid . "' and PLAYS_IN.USERID = '" . $_SESSION["userid"] . "';";
            $conn -> query($newsql);
            echo "You have left as a player of team " . $team_name . "";
        }
      else
      {
        // If player is not found, prints this
        echo "Sorry! It seems that you weren't a player for this team.";
      }
      $conn->close();
    }
    }
    else
    {
        // If the user is not supposed to be here, print this instead of normal page
        echo "You are not supposed to be here!<br>";
        echo "<a href =\"login.php\">Login</a> to continue.";
    }
?>
</body>
</html>