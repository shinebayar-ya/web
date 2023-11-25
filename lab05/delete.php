<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  include 'db.php';
  $conn = new mysqli($host, $user, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection error:" . $conn->connect_error);
  }
  $id = $_GET["id"];
  $query = "DELETE FROM Pet WHERE PetID ='$id';";
  if ($conn->query($query) === TRUE) {
    header('location:' . $_SERVER['HTTP_REFERER']);
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}
?>