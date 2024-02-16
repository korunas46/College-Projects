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

  // Create connection
  $conn = new mysqli($servername,$username,$password,$dbname);
  if ($conn -> connect_error)
  {
      die("Connection failed: " . $conn -> connect_error);
  }
  else
  {
      // Queries for all entries in the coach table
      $sql = "SELECT * from USER, COACH where USER.USERID = COACH.USERID";
      $result = $conn->query($sql);
      // If entries are found, print each coach and their related attribute
      if ($result->num_rows > 0) {
		echo "<table>";
		echo "<tr>";
			echo "<th>UserID</th>";
			echo "<th>First Name</th>";
			echo "<th>Last Name</th>";
			echo "<th>DOB</th>";
			echo "<th>Sex</th>";
            echo "<th>Years of Experience</th>";
		echo "</tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
				echo "<td>" . $row['USERID'] . "</td>";
				echo "<td>" . $row["FNAME"] . "</td>";
				echo "<td>" . $row['LNAME'] . "</td>";
				echo "<td>" . $row['DOB'] . "</td>";
				echo "<td>" . $row['SEX'] . "</td>";
                echo "<td>" . $row['YRS_OF_EXP'] . "</td>";
			echo "</tr>";

		}
		echo "</table>";
    echo "<ul>";
    // Back and logout buttons
    echo "<li> <a href=\"admin.php\"> Go back </a></li>";
    echo "<li> <a href=\"logout.php\"> Logout </a></li>";
    echo "</ul>";
	}
	else {
    // If no entries are found, print this
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
  echo "<a href =\"login.php\">Login</a> to continue."; //swap index.php with Tucker's signup page
}



 ?>

</body>

</html>
