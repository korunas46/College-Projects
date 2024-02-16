<!DOCTYPE html>

<html>

<head></head>

<body>

<?php
  session_start();
  // Checks to see if the user is supposed to be here
  if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Coach")
  {
    echo "This application is being used by ";
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
    // Queries the database for each team the coach is a part of
    $sql = "SELECT TEAM.TEAMID, NAME, SNAME from TEAM, COACHES";
    $sql =  $sql . " where TEAM.TEAMID = COACHES.TEAMID and COACHES.USERID='" . $_SESSION["userid"] . "';";
    $result = $conn->query($sql);
    // If a team with the coach is found, print table with team name and sport
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
        echo "<ul>";
        // Back and logout button
        echo "<li> <a href=\"coach.php\"> Go back </a></li>";
        echo "<li> <a href=\"logout.php\"> Logout </a></li>";
        echo "</ul>";
    }
      else {
        // If no team is found with the coach, print this
		echo "0 results";
        echo "<ul>";
        echo "<li> <a href=\"coach.php\"> Go back </a></li>";
        echo "<li> <a href=\"logout.php\"> Logout </a></li>";
        echo "</ul>";
	  }
  $conn->close();
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
