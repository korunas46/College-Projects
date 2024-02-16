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
     if ($conn -> connect_error){
       die("Connection failed: " . $conn -> connect_error);
     }
     else{
       // Queries for the most popular sport based on teams
       $sql = "SELECT SNAME, COUNT(TEAMID) as teamCount FROM TEAM GROUP BY SNAME ORDER BY teamCount DESC";
       $result = $conn->query($sql);
       // If query returns a result, prints table
       if($result->num_rows > 0){
         echo "<table>";
		       echo "<tr>";
			        echo "<th>Sport</th>";
			        echo "<th>Amount_of_Teams</th>";
		       echo "</tr>";
         while($row = $result->fetch_assoc()) {
			   echo "<tr>";
                    echo "<td>" . $row['SNAME'] . "</td>";
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
           // If no sport is found with a team, prints this
           echo "No sports are popular.";
           echo "<ul>";
           echo "<li> <a href=\"admin.php\"> Go back </a></li>";
           echo "<li> <a href=\"logout.php\"> Logout </a></li>";
           echo "</ul>";
       }
  $conn->close();

} // end of else
}
else {
  // If the user is not supposed to be here, print this instead of normal page
  echo "You are not supposed to be here!<br>";
  echo "<a href =\"login.php\">Login</a> to continue."; //swap index.php with Tucker's signup page
}

 ?>

</body>

</html>
