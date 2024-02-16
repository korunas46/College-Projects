<!DOCTYPE html>

<html>

<head></head>

<body>
<?php
      session_start();
      // Checks to see if user is supposed to be on this page
      if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Admin")
      {
        echo "This application is being used by ";
        echo $_SESSION["fname"];
        echo "<br>";
        echo "<br>";

?>
<!-- Form for team name, sport, gender, age range and number of assistants -->
<form action="createTeam.php" method="POST">
Team Name: <input type="text" name="teamName">
<br><br>
Sport: <input type="text" name="sport">
<br><br>
Sex: <input type="text" name="sex">
<br><br>
Min Age: <input type="text" name="minAge">
<br><br>
Max Age: <input type="text" name="maxAge">
<br><br>
Number of Assistants: <input type="text" name="numAssistant">
<input type="reset" value="clear">
<input type ="submit" value="submit">
</form>
<?php

  echo "<ul>";
  // Back and logout buttons
  echo "<li> <a href=\"admin.php\"> Go back </a></li>";
  echo "<li> <a href=\"logout.php\"> Logout </a></li>";
  echo "</ul>";

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
    if(isset($_POST["teamName"]) && isset($_POST["sport"]) && isset($_POST["sex"]) && isset($_POST["minAge"]) && isset($_POST["maxAge"]) && isset($_POST["numAssistant"]))
    {
      // Checks to see if the sport of the team given is listed in the database
      $sport = $_POST["sport"];
      $sql = "SELECT NAME FROM SPORT WHERE NAME = '" . $sport . "';";
      $result = $conn -> query($sql);
      if($result !== false && $result->num_rows > 0)
      {
          // If sport is valid, runs a while loop to create a unique team ID
          $unique_num = false;
          $team_id = mt_rand(100000000, 999999999);
          while($unique_num == false) {
            $sql = "SELECT TEAMID FROM TEAM";
            $sql = $sql . " WHERE TEAMID = '" . $team_id . "';";
            $result = $conn -> query($sql);
            if($result !== false && $result->num_rows > 0)
            {
              $unique_num = false;
              $team_id = mt_rand(1,99);
            }
            else
            {
              $unique_num = true;
            }
          }
          // Creates a query for adding the new team to the database
          $teamName = $_POST["teamName"];
          $sex = $_POST["sex"];
          $minAge = $_POST["minAge"];
          $maxAge = $_POST["maxAge"];
          $assistants = $_POST["numAssistant"];
          $sql = "INSERT INTO TEAM (TEAMID, SEX, NAME, MIN_AGE, MAX_AGE, SNAME, NO_ASSISTANT)";
          $sql = $sql . " VALUES ('" . $team_id . "', '" . $sex . "', '" . $teamName . "', '" . $minAge . "', '" . $maxAge . "', '" . $sport . "', '" . $assistants . "');";
          $conn->query($sql);
          echo "<br>";
          echo "The team " . $teamName . " has been added to the database";
          $conn->close();
      }
      else
      {
        // Prints this if the sport is not listed in the database
        echo "<br>";
        echo "That sport is not listed in the database";
      }
    }
  }
}
else {
  // If user is not supposed to be on this page, print this instead of normal page
  echo "You are not supposed to be here!<br>";
  echo "<a href =\"login.php\">Login</a> to continue."; 
}
?>

</body>

</html>
