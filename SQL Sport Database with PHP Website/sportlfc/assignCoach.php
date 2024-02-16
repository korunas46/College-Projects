<!DOCTYPE html>

<html>

<head></head>

<body>

<?php
    session_start();
    // Checks to see if the user should be on this page
    if (isset($_SESSION["userid"]) && $_SESSION["userid"]!="" && $_SESSION["usertype"]=="Admin")
    {
      echo "This application is being used by ";
      echo $_SESSION["fname"];
      echo "<br>";
      echo "<br>";

?>
<!-- Form for taking in coach and team information -->
<form action="assignCoach.php" method="POST">
Coach First Name: <input type="text" name="coachFirstName">
<br><br>
Coach Last Name: <input type="text" name="coachLastName">
<br><br>
Team Name: <input type="text" name="teamName">
<br><br>
Head Coach(Y or N): <input type="text" name="headCoachStatus">
<br><br>
<input type="reset" value="Clear">
<input type ="submit" value="Add Coach">
</form>
<?php

  // Back and logout button 
  echo "<ul>";
  echo "<li> <a href=\"admin.php\"> Go back </a></li>";
  echo "<li> <a href=\"logout.php\"> Logout </a></li>";
  echo "</ul>";

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
    // Checks to see if the form has been filled and does a query with the info
    if(isset($_POST["coachFirstName"]) && isset($_POST["coachLastName"]) && isset($_POST["teamName"]) && isset($_POST["headCoachStatus"]))
    {
      $coachFirstName = $_POST["coachFirstName"];
      $coachLastName = $_POST["coachLastName"];
      $teamName = $_POST["teamName"];
      $isHead = $_POST["headCoachStatus"];
      $sql = "SELECT * FROM USER, COACH, COACHES, TEAM WHERE FNAME = '" . $coachFirstName . "' AND LNAME = '" . $coachLastName . "' AND USER.USERID = COACH.USERID AND";
      $sql = $sql . " COACH.USERID = COACHES.USERID AND NAME = '" . $teamName . "' AND TEAM.TEAMID = COACHES.TEAMID;";
      $result = $conn->query($sql);
      // Checks if the coach has already been assigned to a team
      if($result !== false && $result->num_rows > 0)
      {
        echo "<br>";
        echo "This coach is already assigned to this team";
      }
      else
      {
        // Checks to see if the coach is being assigned as a head coach
        if($isHead == "Y") {
          $sql = "SELECT * FROM COACHES, TEAM WHERE";
          $sql = $sql . " NAME = '" . $teamName . "' AND TEAM.TEAMID = COACHES.TEAMID AND IS_HEAD = 'Y';";
          $result = $conn->query($sql);
          // Checks to see if the team already has a head coach, if false the coach will be added
          if($result !== false && $result->num_rows > 0)
          {
            echo "<br>";
            echo "This team already has a head coach";
          }
          else
          {
            $sql = "SELECT USERID FROM USER WHERE FNAME = '" . $coachFirstName . "' AND LNAME = '" . $coachLastName . "';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $coachID = $row["USERID"];
            $sql = "SELECT TEAMID FROM TEAM WHERE NAME = '" . $teamName . "';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $teamID = $row["TEAMID"];
            $sql = "INSERT INTO COACHES (USERID, TEAMID, IS_HEAD)";
            $sql = $sql . " VALUES('" . $coachID. "', '" . $teamID . "', '" . $isHead . "');";
            $conn->query($sql);
            echo "<br>";
            echo "Coach " .$coachFirstName . " " . $coachLastName . " is now a coach of " . $teamName . ".";
          }
        } // Checks to see if the coach is being added as an assistant coach
          elseif ($isHead == "N") {
          $sql = "SELECT NO_ASSISTANT FROM TEAM WHERE";
          $sql = $sql. " NAME = '" . $teamName . "';";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $maxAssistant = $row["NO_ASSISTANT"];
          $sql = "SELECT * FROM COACHES, TEAM WHERE";
          $sql = $sql. " NAME = '" . $teamName . "' AND TEAM.TEAMID = COACHES.TEAMID AND IS_HEAD = 'N';";
          $result = $conn->query($sql);
          // Checks if the team already has the max number of assistant coaches, if not the coach is added
          if($result !== false && $result->num_rows >= $maxAssistant)
          {
            echo "<br>";
            echo "This team has the maximum amount of assistant coaches";
          }
          else
          {
            $sql = "SELECT USERID FROM USER WHERE FNAME = '" . $coachFirstName . "' AND LNAME = '" . $coachLastName . "';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $coachID = $row["USERID"];
            $sql = "SELECT TEAMID FROM TEAM WHERE NAME = '" . $teamName . "';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $teamID = $row["TEAMID"];
            $sql = "INSERT INTO COACHES (USERID, TEAMID, IS_HEAD)";
            $sql = $sql . " VALUES('" . $coachID. "', '" . $teamID . "', '" . $isHead . "');";
            $conn->query($sql);
            echo "<br>";
            echo "Coach " .$coachFirstName . " " . $coachLastName . " is now a coach of " . $teamName . ".";
          }
        }
      }
    }
  }
}
else {
  // If user is not supposed to be here, print this instead of normal page
  echo "You are not supposed to be here!<br>";
  echo "<a href =\"login.php\">Login</a> to continue.";
}
?>

</body>

</html>
