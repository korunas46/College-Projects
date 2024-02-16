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
       // Queries for the most popular equipment on order
       $sql = "SELECT EQUIPMENT.NAME, SUM(BUY.QTY) AS totalQTY
            FROM EQUIPMENT
            JOIN BUY ON EQUIPMENT.EQID = BUY.EQID
            GROUP BY EQUIPMENT.NAME
            ORDER BY totalQTY DESC
            LIMIT 10";
      $result = $conn->query($sql);
      // If equipment is found, print table
      if($result->num_rows > 0){
        echo "<table>";
		echo "<tr>";
			echo "<th>Equipment</th>";
			echo "<th>Amount_Purchased</th>";
		echo "</tr>";
        while($row = $result->fetch_assoc()) {
			echo "<tr>";
				echo "<td>" . $row['NAME'] . "</td>";
				echo "<td>" . $row["totalQTY"] . "</td>";
			echo "</tr>";
    }
    echo "</table>";
    // Back and logout button
    echo "<ul>";
    echo "<li> <a href=\"admin.php\"> Go back </a></li>";
    echo "<li> <a href=\"logout.php\"> Logout </a></li>";
    echo "</ul>";
  }else{
    // If no equipment is found, print this
    echo "Nobody bought equipment.";
    echo "<ul>";
    echo "<li> <a href=\"admin.php\"> Go back </a></li>";
    echo "<li> <a href=\"logout.php\"> Logout </a></li>";
    echo "</ul>";
  }
  $conn->close();

} // end of else
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
