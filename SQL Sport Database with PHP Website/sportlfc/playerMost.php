<!DOCTYPE html>

<html>

<head></head>

<body>
<?php
session_start();
if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"] == "Admin"){
     echo "This application is being used by ";
     echo $_SESSION["fname"];
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "SportLFC";

     $conn = new mysqli($servername,$username,$password,$dbname);
     if ($conn -> connect_error)
     {
        die("Connection failed: " . $conn -> connect_error);
      }
      else
      {
          // Queries the database for the amount of teams a player is assigned to
          $sql = "SELECT CONCAT(USER.FNAME, ' ', USER.LNAME) AS fullName, COUNT(PLAYS_IN.USERID) as teamCount
              FROM USER
              JOIN PLAYS_IN ON USER.USERID = PLAYS_IN.USERID
              GROUP BY fullName
              ORDER BY teamCount DESC";
          $result = $conn->query($sql);
  // If query returns result, prints table
  if($result->num_rows > 0){
    echo "<table>";
		echo "<tr>";
			echo "<th>Player</th>";
			echo "<th>Amount_of_Teams</th>";
		echo "</tr>";
    while($row = $result->fetch_assoc()) {
			echo "<tr>";
				echo "<td>" . $row['fullName'] . "</td>";
				echo "<td>" . $row["teamCount"] . "</td>";
			echo "</tr>";
    }
    // Back and logout buttons
    echo "</table>";
    echo "<ul>";
    echo "<li> <a href=\"admin.php\"> Go back </a></li>";
    echo "<li> <a href=\"logout.php\"> Logout </a></li>";
    echo "</ul>";

  }else{
    // If nothing is returned, prints this
    echo "No players in any teams.";
    echo "<ul>";
    echo "<li> <a href=\"admin.php\"> Go back </a></li>";
    echo "<li> <a href=\"logout.php\"> Logout </a></li>";
    echo "</ul>";
  }
  $conn->close();

} // end of else
}
else {
  echo "You are not supposed to be here!<br>";
  echo "<a href =\"login.php\">Login</a> to continue."; //swap index.php with Tucker's signup page
}

 ?>

</body>

</html>
