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
  echo $_POST["id"];

  $sql = 'DELETE FROM diary_entries WHERE id = "'.$_POST["id"].'";';

  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();

header("Location: diary_main.php");
?>
