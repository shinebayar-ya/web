<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  include("check_login.php");
  include("db.php");
  $conn = new mysqli($host, $user, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection error:" . $conn->connect_error);
  }
  $id = $_GET["id"];
  // Sanitize inputs
  $id = mysqli_real_escape_string($conn, $id);

  $query = "DELETE FROM Pet WHERE PetID ='$id';";
  if ($conn->query($query) === TRUE) {
    header('location:' . $_SERVER['HTTP_REFERER']);
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  $conn->close();
}
