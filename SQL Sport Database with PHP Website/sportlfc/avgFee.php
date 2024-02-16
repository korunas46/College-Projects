<!DOCTYPE html>

<html>

<head></head>

<body>
<?php
session_start();
// Checks to see if the user should be on this page
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
       // Performs a SQL query to collect average fees based on the user
       $sql = "SELECT CONCAT(USER.FNAME, ' ', USER.LNAME) AS fullName, SUM(BUY.QTY * EQUIPMENT.PRICE) / SUM(BUY.QTY) AS avgFee
            FROM USER
            JOIN BUY ON USER.USERID = BUY.USERID
            JOIN EQUIPMENT ON BUY.EQID = EQUIPMENT.EQID
            GROUP BY fullName";
            $result = $conn->query($sql);
            // If an average fee is found, print table
            if($result->num_rows > 0){
              echo "<table>";
		            echo "<tr>";
			             echo "<th>Name</th>";
			             echo "<th>Avg_Fee</th>";
		            echo "</tr>";
              while($row = $result->fetch_assoc()) {
			        echo "<tr>";
				        echo "<td>" . $row['fullName'] . "</td>";
				        echo "<td>" . $row["avgFee"] . "</td>";
			        echo "</tr>";
                }
                echo "</table>";
                // Back and logout buttons
                echo "<ul>";
                echo "<li> <a href=\"admin.php\"> Go back </a></li>";
                echo "<li> <a href=\"logout.php\"> Logout </a></li>";
                echo "</ul>";
            } // If no fees are found, print this
            else{
                echo "No fees found";
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
