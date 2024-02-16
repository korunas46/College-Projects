<!DOCTYPE html>

<html>

<head></head>

<body>

<?php
  session_start();
  if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Player")
  {

    echo "This application is being used by: ";
    echo $_SESSION["fname"];
    echo "<br>";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SportLFC";


    $conn = new mysqli($servername,$username,$password,$dbname);
    if ($conn -> connect_error)
    {
        die("Connection failed: " . $conn -> connect_error);
    }

    // Queries the database for each team the player is a part of
    $sql = "SELECT TEAM.TEAMID, NAME, SNAME from TEAM, PLAYS_IN";
    $sql =  $sql . " where TEAM.TEAMID = PLAYS_IN.TEAMID and PLAYS_IN.USERID='" . $_SESSION["userid"] . "';";
    $result = $conn->query($sql);
    // If a team is found, print following table
    if ($result !== false && $result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
  		echo "<th>Team ID</th>";
  		echo "<th>Team Name</th>";
  		echo "<th>Sport Name</th>";
        echo "</tr>";
  // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['TEAMID'] . "</td>";
            echo "<td>" . $row["NAME"] . "</td>";
            echo "<td>" . $row['SNAME'] . "</td>";
            echo "</tr>";
		}
		echo "</table>";
        // Back and logout buttons
        echo "<ul>";
        echo "<li> <a href=\"player.php\"> Go back </a></li>";
        echo "<li> <a href=\"logout.php\"> Logout </a></li>";
        echo "</ul>";
	  }
      else {
        // If no teams are found, print this
		echo "0 results";
        echo "<ul>";
        echo "<li> <a href=\"player.php\"> Go back </a></li>";
        echo "<li> <a href=\"logout.php\"> Logout </a></li>";
        echo "</ul>";
	  }
  $conn->close();
  }
  else
  {
      echo "You are not supposed to be here!<br>";
      echo "<a href =\"login.php\">Login</a> to continue."; //swap index.php with Tucker's signup page
  }
 ?>
</body>
</html>
