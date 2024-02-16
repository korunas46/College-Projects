<!DOCTYPE html>
<html>
<head><title>Add Player as Coach</title></head>

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
  <!-- Form for getting player and team info -->
  <h1>Add Player</h1>
  <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "get">
      First Name: <input type = "text" name = "first_name">
      <br><br>
      Last Name: <input type = "text" name = "last_name">
      <br><br>
      Team Name: <input type = "text" name = "team_name">
      <br><br>
      <input type = "submit" value = "Add Player">
    </form>
    <br>
<?php
    echo "<ul>";
    // Back and logout button
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
    // Performs a SQL query based on the player name and team name given
    if (isset($_GET["team_name"]) && isset($_GET["first_name"]) & isset($_GET["last_name"]))
    {
      echo "<h2>Results</h2>";
      $team_name = $_GET["team_name"];
      $first_name = $_GET["first_name"];
      $last_name = $_GET["last_name"];

      $sql = "SELECT * FROM User, Player, Plays_In, Team";
      $sql = $sql . " WHERE USER.FNAME = '" . $first_name . "' and USER.LNAME = '" . $last_name . "' and USER.USERID = PLAYER.USERID";
      $sql = $sql . "  and PLAYER.USERID = PLAYS_IN.USERID and TEAM.NAME = '" . $team_name . "' and TEAM.TEAMID = PLAYS_IN.TEAMID;";
      $result = $conn -> query($sql);
      // Checks to see if the player is already on the team
      if($result !== false && $result->num_rows > 0)
        {
          echo "This player is already on this team";
        }
      else
        {
          // Performs another query to gather age range and user/team IDs
          $sql = "SELECT * FROM User, Team WHERE USER.FNAME = '" . $first_name . "' and USER.LNAME = '" . $last_name . "' and TEAM.NAME = '" . $team_name . "';";
          $result = $conn -> query($sql);
          $row = $result->fetch_assoc();
          $player_age = date_diff(date_create($row["DOB"]), date_create(date('Y-m-d\\TH:i:sP')))->y;
          $player_id = $row["USERID"];
          $team_min = $row["MIN_AGE"];
          $team_max = $row["MAX_AGE"];
          $team_id = $row["TEAMID"];
          // Checks to see if the player is in the proper age range
          if($player_age < $team_min || $player_age > $team_max)
            {
              echo "This player is not in the proper age range for this team";
            }
          else
            {
              // Query to get the gender of the team
              $sql = "SELECT * FROM User WHERE USERID = '" . $player_id . "';";
              $result = $conn -> query($sql);
              $row = $result->fetch_assoc();
              $player_sex = $row["SEX"];
              $sql = "SELECT * FROM Team WHERE TEAMID = '" . $team_id . "';";
              $result = $conn -> query($sql);
              $row = $result->fetch_assoc();
              $team_sex = $row["SEX"];
              // Checks to see if the player's gender matches the team's
              if($player_sex != $team_sex)
                {
                  echo "This player is in the wrong gender team";
                }
              else
                { 
                  // Loop to give the new player a random, untaken uniform number
                  $unique_num = false;
                  $uniform_num = mt_rand(1,99);
                  while($unique_num == false) {
                    $sql = "SELECT UNOFORM_NO FROM PLAYS_IN";
                    $sql = $sql . " WHERE UNOFORM_NO = '" . $uniform_num . "' AND TEAMID = '" . $team_id . "';";
                    $result = $conn -> query($sql);
                    if($result !== false && $result->num_rows > 0)
                      {
                        $unique_num = false;
                        $uniform_num = mt_rand(1,99);
                      }
                    else
                      {
                        $unique_num = true;
                      }
                  }
                  // Adds the player to the team after the above checks are made
                  $sql = "INSERT INTO PLAYS_IN (USERID, TEAMID, UNOFORM_NO)";
                  $sql = $sql . " VALUES('" . $player_id . "', '" . $team_id . "', '" . $uniform_num . "');";
                  $conn -> query($sql);
                  echo $first_name . " " . $last_name . " was added to team " . $team_name . " with a uniform number of " . $uniform_num . ".";
                }
            }
          }
        }
      $conn->close();
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
