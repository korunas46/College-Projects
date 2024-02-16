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
    // Queries database for all entries with user type PLAYER
    $sql = "SELECT * from USER where USER_TYPE='Player'";
    $result = $conn->query($sql);
    // If a player is found, print following table
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>UserID</th>";
  		echo "<th>First Name</th>";
  		echo "<th>Last Name</th>";
  		echo "<th>DOB</th>";
  		echo "<th>Sex</th>";
        echo "</tr>";
  // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['USERID'] . "</td>";
            echo "<td>" . $row["FNAME"] . "</td>";
            echo "<td>" . $row['LNAME'] . "</td>";
            echo "<td>" . $row['DOB'] . "</td>";
            echo "<td>" . $row['SEX'] . "</td>";
            echo "</tr>";
		}
		echo "</table>";
        // Back and logout button
        echo "<ul>";
        echo "<li> <a href=\"admin.php\"> Go back </a></li>";
        echo "<li> <a href=\"logout.php\"> Logout </a></li>";
        echo "</ul>";
	}
	else {
        // If no players are found, print this
		echo "0 results";
        echo "<ul>";
        echo "<li> <a href=\"admin.php\"> Go back </a></li>";
        echo "<li> <a href=\"logout.php\"> Logout </a></li>";
        echo "</ul>";
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
