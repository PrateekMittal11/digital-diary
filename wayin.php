
<?php
$servername = "localhost";
$username = "prateek";
$password = "qazwsxedc";
$database = "diary";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y");
$time = date("h:i a");
echo $date." ".$time;
// sql to create table
/*$sql = "CREATE TABLE diary_entries (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(80) NOT NULL,
note VARCHAR(500) NOT NULL,
tarikh VARCHAR(15) NOT NULL,
samay VARCHAR(10) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}*/
if($_POST["name"]!="" && $_POST["note"]!=""){
  $title = $_POST["name"];
  $note = nl2br($_POST["note"]);
  $title = "'".$title."'";
  $note = "'".$note."'";
  $date = "'".$date."'";
  $time = "'".$time."'";
  $sql = "INSERT INTO diary_entries (title, note, tarikh, samay)
  VALUES ($title, $note, $date, $time)";

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
else {
  echo "Enter both title and note";
}

header("Location: diary_main.php");
?>
