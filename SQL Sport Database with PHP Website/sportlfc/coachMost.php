<!DOCTYPE html>

<html>

<head></head>

<body>
<?php
session_start();
// Checks to see if the user is supposed to be on this page
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
    // Queries the entire database and gets how many teams a coach is assigned too
    $sql = "SELECT CONCAT(USER.FNAME, ' ', USER.LNAME) AS fullName, COUNT(COACHES.USERID) as teamCount
            FROM USER
            JOIN COACHES ON USER.USERID = COACHES.USERID
            GROUP BY fullName
            ORDER BY teamCount DESC";
            $result = $conn->query($sql);
            // If the query returns a result, print the following table
            if($result->num_rows > 0){
              echo "<table>";
		          echo "<tr>";
			           echo "<th>Coach</th>";
			           echo "<th>Amount_of_Teams</th>";
		          echo "</tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                       echo "<td>" . $row['fullName'] . "</td>";
                       echo "<td>" . $row["teamCount"] . "</td>";
			      echo "</tr>";
            }
                echo "</table>";
                // Back and logout buttons
                echo "<ul>";
                echo "<li> <a href=\"admin.php\"> Go back </a></li>";
                echo "<li> <a href=\"logout.php\"> Logout </a></li>";
                echo "</ul>";
            }else{
                // If no coach info is found, print this
                echo "Nobody coaches any teams.";
                echo "<ul>";
                echo "<li> <a href=\"admin.php\"> Go back </a></li>";
                echo "<li> <a href=\"logout.php\"> Logout </a></li>";
                echo "</ul>";
            }
  $conn->close();

} // end of else
}
else {
  // If user is not supposed to be here, print this instead of normal page
  echo "You are not supposed to be here!<br>";
  echo "<a href =\"login.php\">Login</a> to continue."; 
}

 ?>

</body>

</html>
