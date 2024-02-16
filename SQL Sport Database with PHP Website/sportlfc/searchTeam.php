<!DOCTYPE html>
<html>
<head><title>Search for a Team</title></head>

<body>

<?php
    session_start();
    // Checks to see if the user is supposed to be here
    if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="")
    {
        echo "This application is being used by ";
        echo $_SESSION["fname"];
        echo "<br>";

?>
<!-- Form for receiving sport and team name -->
<h1>Search a Team by Sport and Name</h1>
<form action="searchTeam.php" method="GET">
    Sport: <input type="text" name="Sport">
    <br><br>
    Team Name: <input type="text" name="Team">
    <br><br>
    <br><br>
    <br><br>
    <input type="reset" value="Clear">
    <input type = "submit" value="Search">
</form>

<?php
      // Logout button
      echo "<ul>";
      echo "<li> <a href=\"logout.php\"> Logout </a></li>";
      echo "</ul>";
      }
    else
    {
        // If the user is not supposed to be here, print this instead of normal page
        echo "You are not supposed to be here!<br>";
        echo "<a href=\"login.php\">Login</a> to continue.";
    }

    if (isset($_GET["Team"]) && !($_GET["Team"]==null && $_GET["Sport"]==null))
    {
        echo "<h2>Search Results</h2>";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sportlfc";

        // Create connection
        $conn = new mysqli($servername,$username,$password,$dbname);
        if ($conn -> connect_error)
        {
            die("Connection failed: " . $conn -> connect_error);
        }
        else
        {
            // Using the given sport and team name, query the database for a match
            $team = $_GET["Team"];
            $sport = $_GET["Sport"];

            $sql = "select * from TEAM JOIN SPORT on TEAM.SNAME = SPORT.NAME where SPORT.NAME = '" .$sport. "' and team.NAME = '" . $team. "';";
            //echo $sql;
            $result = $conn->query($sql);
            // If match is found, print table with team and its related attributes
            if($result->num_rows > 0)
            {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<td><b>TeamID</b></td>";
                echo "<td><b>Team Name</b></td>";
                echo "<td><b>Sex</b></td>";
                echo "<td><b>Minimum Age</b></td>";
                echo "<td><b>Maximum Age</b></td>";
                echo "<td><b>Sport</b></td>";
                echo "<td><b>Max Players</b></td>";
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["TEAMID"] . "</td>";
                    echo "<td>" . $team . "</td>";
                    echo "<td>" . $row["SEX"] . "</td>";
                    echo "<td>" . $row["MIN_AGE"] . "</td>";
                    echo "<td>" . $row["MAX_AGE"] . "</td>";
                    echo "<td>" . $sport . "</td>";
                    echo "<td>" . $row["MAX_PLAYER"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else
            {
                // If no entry matches the query, print this
                echo "Sorry! No results match your search.";
            }
            $conn->close();

    }
    }
?>
<br><br>
</body>
</html>
