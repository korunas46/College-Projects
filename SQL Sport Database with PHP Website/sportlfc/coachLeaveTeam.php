<!DOCTYPE html>
<html>
<head><title>Leave Team as Coach</title></head>

<body>

<?php
    session_start();
    // Checks to see if the user is supposed to be on this page
    if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Coach")
    {
        echo "This application is being used by ";
        echo $_SESSION["fname"];
        echo "<br>";
?>
  <!-- Form to receive team name information -->
  <h1>Leave Team</h1>
  <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "get">
      Name: <input type = "text" name = "team_name">
      <br><br>
      <input type = "submit" value = "Leave">
    </form>
    <br>
<?php
    // Back and logout buttons
    echo "<ul>";
    echo "<li> <a href=\"coach.php\"> Go back </a></li>";
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

    // Performs a query with the given team name and coach name
    if (isset($_GET["team_name"]))
    {
      echo "<h2>Results</h2>";
      $team_name = $_GET["team_name"];

      $sql = "SELECT * FROM Team, Coaches";
      $sql = $sql . " WHERE TEAM.NAME = '" . $team_name . "' and TEAM.TEAMID = COACHES.TEAMID and COACHES.USERID = '" . $_SESSION["userid"] . "';";
      $result = $conn -> query($sql);
      // Checks to see if the coach is a coach on the given team, if so, they are removed
      if($result !== false && $result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $teamid = $row["TEAMID"];
            $newsql = "DELETE FROM COACHES";
            $newsql = $newsql . " WHERE COACHES.TEAMID = '" . $teamid . "' and COACHES.USERID = '" . $_SESSION["userid"] . "';";
            $conn -> query($newsql);
            echo "You have left as the coach of team " . $team_name . "";
        }
      else
      {
        echo "Sorry! It seems that you weren't a coach for this team.";
      }
      $conn->close();
    }
    }
    else
    {
        // If user is not supposed to be here, print this instead of normal page
        echo "You are not supposed to be here!<br>";
        echo "<a href =\"login.php\">Login</a> to continue.";
    }
?>
</body>
</html>
