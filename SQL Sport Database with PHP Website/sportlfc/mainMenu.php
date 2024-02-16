<!DOCTYPE html>
<html>
<head></head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SportLFC"; //add name of our database

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn -> connect_error)
{
    die("Connection failed: " . $conn -> connect_error);
}
else
{
    session_start();

if(isset($_POST["userid"]))
{
    // Queries the database with the given user ID and password on the login page
    $userid = $_POST["userid"];
    $password = $_POST["password"];

    $sql = "SELECT FNAME, LNAME, USERID, PASSWORD, USER_TYPE FROM USER ";
    $sql =  $sql . "where USERID = '" . $userid . "' and PASSWORD= '". $password . "'";
    $result = $conn->query($sql);

}
if($result->num_rows > 0)
  {
    // If a result is found, the user type is saved
    $row = $result->fetch_assoc();
    //Set session variables
    $_SESSION["userid"] = $userid;
    $_SESSION["fname"] = $row["FNAME"] . " " . $row["LNAME"];
    $_SESSION["usertype"] = $row["USER_TYPE"];
    // $_SESSION["is_admin"] = $row["is_admin"];
    $conn->close();

    // Based on the user type, redirects to user to one of three pages
    switch($row["USER_TYPE"]){
    case "Player":
    header('Location: player.php');
    break;
    case "Coach":
    header('Location: coach.php');
    break;
    case "Admin":
    header('Location: admin.php');
    break;
}
  }
  else
  {
      // Prints if no matching database entry is found
      echo "Sorry! You don't have a login.";
      $conn->close();
  }

}
?>

</body>
</html>
